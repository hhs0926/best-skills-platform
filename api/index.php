<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirecting writable paths to /tmp
 *
 * KEY FIX: Redefines HandleExceptions BEFORE autoload to suppress tempnam() warnings.
 * We override the full class including bootstrap() so Laravel's bootstrapper chain works.
 * Only handleError() is modified to ignore tempnam warnings on Vercel Lambda.
 */

// === Monkey-patch HandleExceptions - keep original bootstrap(), only fix handleError() ===
namespace Illuminate\Foundation\Bootstrap {

    use ErrorException;
    use Exception;
    use Illuminate\Contracts\Debug\ExceptionHandler;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Log\LogManager;
    use Illuminate\Support\Env;
    use Monolog\Handler\NullHandler;
    use PHPUnit\Framework\TestCase;
    use PHPUnit\Runner\ErrorHandler;
    use PHPUnit\Runner\Version;
    use Symfony\Component\Console\Output\ConsoleOutput;
    use Symfony\Component\ErrorHandler\Error\FatalError;
    use Throwable;

    class HandleExceptions
    {
        public static $reservedMemory;
        protected static $app;

        public function bootstrap(Application $app)
        {
            static::$reservedMemory = str_repeat('x', 32768);
            static::$app = $app;
            error_reporting(-1);
            set_error_handler($this->forwardsTo('handleError'));
            set_exception_handler($this->forwardsTo('handleException'));
            register_shutdown_function($this->forwardsTo('handleShutdown'));
            if (! $app->environment('testing')) {
                ini_set('display_errors', 'Off');
            }
        }

        public function handleError($level, $message, $file = '', $line = 0)
        {
            // === ONLY CHANGE: Suppress tempnam/tmpfile warnings for Vercel Lambda ===
            if ((strpos($message, 'tempnam') !== false || strpos($message, 'tmpfile') !== false)
                && strpos($message, 'temporary directory') !== false) {
                return true;
            }
            // === END CHANGE ===

            if ($this->isDeprecation($level)) {
                $this->handleDeprecationError($message, $file, $line, $level);
            } elseif (error_reporting() & $level) {
                throw new ErrorException($message, 0, $level, $file, $line);
            }
        }

        public function handleException(Throwable $e)
        {
            static::$reservedMemory = null;
            try {
                $this->getExceptionHandler()->report($e);
            } catch (Exception) {
                $exceptionHandlerFailed = true;
            }
            if (static::$app->runningInConsole()) {
                $this->renderForConsole($e);
                if ($exceptionHandlerFailed ?? false) { exit(1); }
            } else {
                $this->renderHttpResponse($e);
            }
        }

        protected function renderForConsole(Throwable $e)
        {
            $this->getExceptionHandler()->renderForConsole(new ConsoleOutput, $e);
        }

        protected function renderHttpResponse(Throwable $e)
        {
            $this->getExceptionHandler()->render(static::$app['request'], $e)->send();
        }

        public function handleShutdown()
        {
            static::$reservedMemory = null;
            if (! is_null($error = error_get_last()) && $this->isFatal($error['type'])) {
                $this->handleException($this->fatalErrorFromPhpError($error, 0));
            }
        }

        protected function fatalErrorFromPhpError(array $error, $traceOffset = null)
        {
            return new FatalError($error['message'], 0, $error, $traceOffset);
        }

        protected function forwardsTo($method)
        {
            return fn (...$arguments) => static::$app
                ? $this->{$method}(...$arguments)
                : false;
        }

        protected function isDeprecation($level)
        {
            return in_array($level, [E_DEPRECATED, E_USER_DEPRECATED]);
        }

        protected function handleDeprecationError($message, $file, $line, $level = E_DEPRECATED)
        {
            if ($this->shouldIgnoreDeprecationErrors()) { return; }
            try {
                $logger = static::$app->make(LogManager::class);
            } catch (Exception) { return; }
            $this->ensureDeprecationLoggerIsConfigured();
            $options = static::$app['config']->get('logging.deprecations') ?? [];
            with($logger->channel('deprecations'), function ($log) use ($message, $file, $line, $level, $options) {
                if ($options['trace'] ?? false) {
                    $log->warning((string) new ErrorException($message, 0, $level, $file, $line));
                } else {
                    $log->warning(sprintf('%s in %s on line %s', $message, $file, $line));
                }
            });
        }

        protected function shouldIgnoreDeprecationErrors()
        {
            return ! class_exists(LogManager::class)
                || ! static::$app->hasBeenBootstrapped()
                || (static::$app->runningUnitTests() && ! Env::get('LOG_DEPRECATIONS_WHILE_TESTING'));
        }

        protected function ensureDeprecationLoggerIsConfigured()
        {
            $config = static::$app['config'];
            if ($config->get('logging.channels.deprecations')) { return; }
            $this->ensureNullLogDriverIsConfigured();
            if (is_array($options = $config->get('logging.deprecations'))) {
                $driver = $options['channel'] ?? 'null';
            } else {
                $driver = $options ?? 'null';
            }
            $config->set('logging.channels.deprecations', $config->get("logging.channels.{$driver}"));
        }

        protected function ensureNullLogDriverIsConfigured()
        {
            $config = static::$app['config'];
            if ($config->get('logging.channels.null')) { return; }
            $config->set('logging.channels.null', [
                'driver' => 'monolog',
                'handler' => NullHandler::class,
            ]);
        }

        protected function isFatal($type)
        {
            return in_array($type, [E_COMPILE_ERROR, E_CORE_ERROR, E_ERROR, E_PARSE]);
        }

        protected function getExceptionHandler()
        {
            return static::$app->make(ExceptionHandler::class);
        }

        public static function forgetApp()
        {
            static::$app = null;
        }

        public static function flushState(?TestCase $testCase = null)
        {
            if (is_null(static::$app)) { return; }
            static::flushHandlersState($testCase);
            static::$app = null;
            static::$reservedMemory = null;
        }

        public static function flushHandlersState(?TestCase $testCase = null)
        {
            while (get_exception_handler() !== null) { restore_exception_handler(); }
            while (get_error_handler() !== null) { restore_error_handler(); }
            if (class_exists(ErrorHandler::class)) {
                $instance = ErrorHandler::instance();
                if ((fn () => $this->enabled ?? false)->call($instance)) {
                    $instance->disable();
                    if (version_compare(Version::id(), '12.3.4', '>=')) {
                        $instance->enable($testCase);
                    } else {
                        $instance->enable();
                    }
                }
            }
        }
    }
}

namespace {

$tmpDir = sys_get_temp_dir();

// Create ALL required writable directories in /tmp
$writableDirs = [
    $tmpDir . '/laravel_storage', $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
    $tmpDir . '/laravel_bootstrap_cache',
    $tmpDir . '/laravel_bootstrap_cache/cache',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

// Copy bootstrap/cache files to /tmp (PackageManifest needs write access)
$srcCacheDir = __DIR__ . '/../bootstrap/cache';
$dstCacheDir = $tmpDir . '/laravel_bootstrap_cache';
if (is_dir($srcCacheDir)) {
    foreach (scandir($srcCacheDir) as $file) {
        if ($file !== '.' && $file !== '..' && !file_exists($dstCacheDir . '/' . $file)) {
            copy($srcCacheDir . '/' . $file, $dstCacheDir . '/' . $file);
        }
    }
}

// Copy SQLite database to /tmp
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) { copy($dbPath, $dbTmpPath); }

// Set environment variables cleanly in code (Vercel env vars have BOM issues)
$_ENV['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_SERVER['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_ENV['APP_DEBUG'] = 'true'; $_SERVER['APP_DEBUG'] = 'true';
$_ENV['APP_ENV'] = 'production'; $_SERVER['APP_ENV'] = 'production';
$_ENV['APP_URL'] = 'https://best-skills-platform.vercel.app';
$_SERVER['APP_URL'] = 'https://best-skills-platform.vercel.app';
$_ENV['DB_CONNECTION'] = 'sqlite'; $_SERVER['DB_CONNECTION'] = 'sqlite';
$_ENV['CACHE_DRIVER'] = 'array'; $_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array'; $_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr'; $_SERVER['LOG_CHANNEL'] = 'stderr';

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Boot Laravel application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override paths for Vercel read-only filesystem (MUST be before handle())
$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($dstCacheDir);
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// Use HTTP Kernel to handle request - this properly bootstraps Facades, middleware, etc.
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

}
