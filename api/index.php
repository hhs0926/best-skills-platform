<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirecting writable paths to /tmp
 *
 * KEY FIXES:
 * 1. HandleExceptions - suppress tempnam/rename warnings on Lambda
 * 2. Filesystem::replace() - use file_put_contents instead of atomic rename (fails on Lambda)
 */

// === Monkey-patch Filesystem to fix replace() on Vercel Lambda ===
namespace Illuminate\Filesystem {
    use ErrorException;
    use FilesystemIterator;
    use Illuminate\Contracts\Filesystem\FileNotFoundException;
    use Illuminate\Support\LazyCollection;
    use Illuminate\Support\Traits\Conditionable;
    use Illuminate\Support\Traits\Macroable;
    use RuntimeException;
    use SplFileObject;
    use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
    use Symfony\Component\Finder\Finder;

    class Filesystem {
        use Conditionable, Macroable;

        public function exists($path)
        {
            return file_exists($path);
        }

        public function missing($path)
        {
            return !$this->exists($path);
        }

        public function get($path, $lock = false)
        {
            if ($this->isFile($path)) {
                return $lock ? $this->sharedGet($path) : file_get_contents($path);
            }
            throw new FileNotFoundException("File does not exist at path {$path}");
        }

        public function sharedGet($path)
        {
            $contents = '';
            $handle = fopen($path, 'rb');
            if ($handle) {
                try {
                    if (flock($handle, LOCK_SH)) {
                        clearstatcache(true, $path);
                        $filesize = filesize($path);
                        if ($filesize) {
                            $contents = fread($handle, $filesize);
                        }
                        flock($handle, LOCK_UN);
                    }
                } finally {
                    fclose($handle);
                }
            }
            return $contents;
        }

        public function getRequire($path)
        {
            if ($this->isFile($path)) { return require $path; }
            throw new FileNotFoundException("File does not exist at path {$path}");
        }

        public function requireOnce($file)
        {
            require_once $file;
        }

        public function lines($path)
        {
            return LazyCollection::make(function () use ($path) {
                $file = fopen($path, 'r');
                while (($line = fgets($file)) !== false) {
                    yield $line;
                }
            });
        }

        public function hash($path)
        {
            return md5_file($path);
        }

        public function put($path, $contents, $lock = false)
        {
            return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
        }

        public function replace($path, $content)
        {
            // On Vercel Lambda, the atomic write strategy (tempnam+rename) fails.
            // Use direct file_put_contents instead.
            if (file_exists($path)) { clearstatcache(true, $path); }
            $dir = dirname($path);
            if (!is_dir($dir)) { mkdir($dir, 0755, true); }
            return file_put_contents($path, $content);
        }

        public function append($path, $data)
        {
            return file_put_contents($path, $data, FILE_APPEND);
        }

        public function prepend($path, $data)
        {
            return $this->put($path, $data.$this->get($path));
        }

        public function chmod($path, $mode = null)
        {
            $mode = $mode ?: (0777 - umask());
            return chmod($path, $mode);
        }

        public function delete($paths)
        {
            $paths = is_array($paths) ? $paths : func_get_args();
            $success = true;
            foreach ($paths as $path) {
                try {
                    if (! @unlink($path)) { $success = false; }
                } catch (ErrorException) { $success = false; }
            }
            return $success;
        }

        public function move($path, $target)
        {
            return rename($path, $target);
        }

        public function copy($path, $target)
        {
            return copy($path, $target);
        }

        public function link($target, $link)
        {
            if (! windows_os()) { return symlink($target, $link); }
            $mode = $this->isDirectory($target) ? 'J' : 'H';
            exec("mklink /{$mode} ".escapeshellarg($link).' '.escapeshellarg($target));
        }

        public function relativeLink($target, $link)
        {
            if (! windows_os()) { return symlink($target, $link); }
            $mode = $this->isDirectory($target) ? 'J' : 'H';
            $relativePath = (new SymfonyFilesystem)->makePathRelative($target, dirname($link));
            exec("mklink /{$mode} ".escapeshellarg($link).' '.escapeshellarg($relativePath));
        }

        public function name($path)
        {
            return pathinfo($path, PATHINFO_FILENAME);
        }

        public function basename($path)
        {
            return pathinfo($path, PATHINFO_BASENAME);
        }

        public function dirname($path)
        {
            return pathinfo($path, PATHINFO_DIRNAME);
        }

        public function extension($path)
        {
            return pathinfo($path, PATHINFO_EXTENSION);
        }

        public function guessExtension($path)
        {
            if (!class_exists(MimeTypes::class)) { return $this->extension($path); }
            return (new MimeTypes())->getExtensions($this->mimeType($path))[0] ?? null;
        }

        public function type($path)
        {
            return filetype($path);
        }

        public function mimeType($path)
        {
            return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
        }

        public function size($path)
        {
            return filesize($path);
        }

        public function lastModified($path)
        {
            return filemtime($path);
        }

        public function isDirectory($directory)
        {
            return is_dir($directory);
        }

        public function isEmptyDirectory($directory)
        {
            return (new Finder)->files()->in($directory)->depth(0)->count() === 0;
        }

        public function isReadable($path)
        {
            return is_readable($path);
        }

        public function isWritable($path)
        {
            return is_writable($path);
        }

        public function isFile($file)
        {
            return is_file($file);
        }

        public function files($directory, $hidden = false)
        {
            return iterator_to_array(
                Finder::create()->files()->ignoreDotFiles(!$hidden)->in($directory)->depth(0)->sortByName(),
                false
            );
        }

        public function allFiles($directory, $hidden = false)
        {
            return iterator_to_array(
                Finder::create()->files()->ignoreDotFiles(!$hidden)->in($directory)->sortByName(),
                false
            );
        }

        public function directories($directory)
        {
            $directories = [];
            foreach (Finder::create()->in($directory)->directories()->depth(0)->sortByName() as $dir) {
                $directories[] = $dir->getPathname();
            }
            return $directories;
        }

        public function allDirectories($directory)
        {
            $directories = [];
            foreach (Finder::create()->in($directory)->directories()->sortByName() as $dir) {
                $directories[] = $dir->getPathname();
            }
            return $directories;
        }

        public function makeDirectory($path, $mode = 0755, $recursive = false, $force = false)
        {
            if ($force) { return @mkdir($path, $mode, $recursive); }
            return mkdir($path, $mode, $recursive);
        }

        public function moveDirectory($directory, $destination, $overwrite = false)
        {
            if ($overwrite && $this->isDirectory($destination)) { $this->deleteDirectory($destination); }
            return @rename($directory, $destination);
        }

        public function copyDirectory($directory, $destination, $options = null)
        {
            if (! $this->isDirectory($directory)) { return false; }
            (new SymfonyFilesystem)->mirror($directory, $destination, (new FilterIterator(
                new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST)
            ))->getIterator(), $options);
            return true;
        }

        public function deleteDirectory($directory, $preserve = false)
        {
            if (!$this->isDirectory($directory)) { return false; }
            foreach (new IteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $item) {
                if ($item->isDir() && !$item->isLink()) { rmdir((string) $item->getRealPath()); } else { @unlink((string) $item->getRealPath()); }
            }
            if (!$preserve) { @rmdir($directory); }
            return true;
        }

        public function deleteDirectories($directory)
        {
            $allDirectories = $this->directories($directory);
            if (!empty($allDirectories)) {
                foreach ($allDirectories as $directoryName) { $this->deleteDirectory($directoryName); }
            }
            return true;
        }

        public function cleanDirectory($directory)
        {
            return $this->deleteDirectory($directory, true);
        }
    }
}

// === Monkey-patch HandleExceptions BEFORE autoload ===
namespace Illuminate\Foundation\Bootstrap {

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
            // === ONLY CHANGE: Suppress filesystem warnings for Vercel Lambda ===
            // 1. tempnam/tmpfile warnings (harmless)
            // 2. rename() failures in /tmp (Blade compile atomic write - file may not exist on Lambda)
            $msgLower = strtolower($message);
            if ((strpos($msgLower, 'tempnam') !== false || strpos($msgLower, 'tmpfile') !== false)
                && strpos($msgLower, 'temporary') !== false) {
                return true;
            }
            if ((strpos($message, 'rename(') !== false || strpos($message, 'No such file or directory') !== false)
                && (strpos($file, 'Filesystem.php') !== false || strpos($message, '/tmp') !== false)) {
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
// Remove any BOM or non-ASCII characters that Vercel may inject
$tmpDir = preg_replace('/[\xEF\xBB\xBF\x{FEFF}]/u', '', $tmpDir);
$tmpDir = trim($tmpDir);

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

// Copy precompiled Blade view cache to /tmp (avoids runtime compile which fails on Lambda)
$viewCacheSrc = __DIR__ . '/views-cache';
$viewCacheDst = $tmpDir . '/laravel_storage/framework/views';
if (is_dir($viewCacheSrc) && is_dir($viewCacheDst)) {
    foreach (scandir($viewCacheSrc) as $file) {
        if ($file !== '.' && $file !== '..' && !file_exists($viewCacheDst . '/' . $file)) {
            copy($viewCacheSrc . '/' . $file, $viewCacheDst . '/' . $file);
        }
    }
}

// Set environment variables cleanly in code (Vercel env vars have BOM issues)
$_ENV['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_SERVER['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_ENV['APP_DEBUG'] = 'false'; $_SERVER['APP_DEBUG'] = 'false';
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
