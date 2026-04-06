<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => 'BestSkills']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title' => 'BestSkills']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="zh-CN" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title); ?> - BestSkills</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { background: #0a0a0f; color: #e2e8f0; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        .glass-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .glass-card:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(139,92,246,0.3);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3), 0 0 60px rgba(139,92,246,0.08);
        }
        .gradient-text {
            background: linear-gradient(135deg, #a78bfa, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glow-btn {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            position: relative;
        }
        .glow-btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
            box-shadow: 0 8px 30px rgba(124,58,237,0.35);
        }
        .nav-blur {
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .tag-pill {
            background: rgba(139,92,246,0.12);
            border: 1px solid rgba(139,92,246,0.22);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            transition: all 0.2s;
            display: inline-block;
            text-decoration: none;
            color: inherit;
        }
        .tag-pill:hover, .tag-pill.active {
            background: rgba(139,92,246,0.3);
            border-color: rgba(139,92,246,0.5);
        }
        .search-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            transition: all 0.3s;
            color: white;
        }
        .search-input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 20px rgba(139,92,246,0.15);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.3); border-radius: 3px; }
        .line-clamp-2 {
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen antialiased">
    <!-- 导航栏 -->
    <nav class="nav-blur fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 py-3.5">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-6 sm:gap-8">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 text-lg sm:text-xl font-bold no-underline hover:opacity-90">
                    <span class="text-xl sm:text-2xl">⚡</span>
                    <span class="gradient-text">BestSkills</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm text-gray-400">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-white transition <?php echo e(request()->is('/') ? 'text-white font-medium' : ''); ?>">首页</a>
                    <a href="<?php echo e(route('skills.index')); ?>" class="hover:text-white transition <?php echo e(request()->is('skills*') && !request()->is('skills/*') ? 'text-violet-400 font-medium' : ''); ?>">技能库</a>
                    <a href="<?php echo e(route('community')); ?>" class="hover:text-white transition <?php echo e(request()->is('community') ? 'text-violet-400 font-medium' : ''); ?>">社区</a>
                    <a href="<?php echo e(route('exchange')); ?>" class="hover:text-white transition <?php echo e(request()->is('exchange') ? 'text-violet-400 font-medium' : ''); ?>">交换</a>
                </div>
            </div>
            <div class="flex items-center gap-3 sm:gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <span class="hidden sm:inline text-sm text-gray-300"><?php echo e(Auth::user()->name); ?></span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-sm text-gray-400 hover:text-red-400 transition cursor-pointer bg-transparent border-none p-0">退出</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-300 hover:text-white transition">登录</a>
                    <a href="<?php echo e(route('register')); ?>" class="glow-btn text-white px-3 sm:px-4 py-2 rounded-lg text-sm">注册</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- 主内容 -->
    <main class="pt-18 sm:pt-20 pb-16 px-4 sm:px-6">
        <?php echo e($slot); ?>

    </main>

    <!-- 页脚 -->
    <footer class="border-t border-white/5 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <!-- 左侧：Logo -->
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 text-xl font-bold no-underline hover:opacity-90 shrink-0">
                    <span class="text-2xl">⚡</span>
                    <span class="gradient-text">BestSkills</span>
                </a>

                <!-- 中间：导航链接 -->
                <div class="flex items-center gap-8 text-sm text-gray-400">
                    <a href="<?php echo e(route('guide')); ?>" class="hover:text-white transition">用户指南</a>
                    <a href="<?php echo e(route('about')); ?>" class="hover:text-white transition">关于我们</a>
                </div>

                <!-- 右侧：版权 -->
                <p class="text-xs sm:text-sm text-gray-500 shrink-0">
                    © 2026 BestSkills系列
                </p>
            </div>
        </div>
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\components\app-layout.blade.php ENDPATH**/ ?>