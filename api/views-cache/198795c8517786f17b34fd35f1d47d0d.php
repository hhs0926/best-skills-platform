<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => '首页'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto py-12 text-center">
        <div class="mb-4 inline-block px-3 py-1 rounded-full text-xs bg-violet-500/15 text-violet-300 border border-violet-500/25">
            🚀 AI Skills 社交生态平台 v2.0
        </div>
        <h1 class="text-5xl sm:text-6xl font-bold mb-6 leading-tight">
            发现、分享、交换<br>
            <span class="gradient-text">AI 超能力技能</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10">
            找到最适合你的 AI 技能工具组合，与社区成员共享资源、交换技能。
        </p>
        <div class="flex items-center justify-center gap-4 flex-wrap">
            <a href="<?php echo e(route('skills.index')); ?>" class="glow-btn text-white px-8 py-3 rounded-xl font-medium hover:scale-105 transition-transform shadow-lg shadow-violet-500/25">
                🔍 探索技能库
            </a>
            <a href="<?php echo e(route('register')); ?>" class="px-8 py-3 rounded-xl font-medium border border-white/10 hover:border-violet-500/50 hover:bg-white/5 transition-all">
                ✨ 加入社区
            </a>
        </div>
    </section>

    <!-- 数据统计条（3栏：已实测 / 本期推荐 / 每周更新） -->
    <section class="max-w-3xl mx-auto py-10">
        <div class="grid grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1"><?php echo e($stats['tested_count']); ?><span class="text-lg text-violet-400">+</span></div>
                <div class="text-sm text-gray-500">已实测</div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1"><?php echo e($featuredSkills->count()); ?></div>
                <div class="text-sm text-gray-500">本期推荐</div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-bold text-white mb-1">每周</div>
                <div class="text-sm text-gray-500">更新频率</div>
            </div>
        </div>
    </section>

    <!-- 精选技能 -->
    <section class="max-w-7xl mx-auto mb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold">⭐ 精选推荐</h2>
            <a href="<?php echo e(route('skills.index')); ?>" class="text-sm text-violet-400 hover:text-violet-300 transition">查看全部 →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('skills.show', $skill)); ?>" class="glass-card p-5 block">
                    <div class="flex items-start gap-4">
                        <div class="skill-icon"><?php echo e($skill->icon); ?></div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-white mb-1 truncate"><?php echo e($skill->name); ?></h3>
                            <p class="text-gray-400 text-sm line-clamp-2 mb-3"><?php echo e($skill->short_desc); ?></p>
                            <div class="flex items-center gap-3 text-xs text-gray-500">
                                <span class="flex items-center gap-1"><span class="rating-star">★</span> <?php echo e($skill->avg_rating); ?></span>
                                <span>↓ <?php echo e(number_format($skill->install_count)); ?> 安装</span>
                                <span>❤️ <?php echo e(number_format($skill->likes_count)); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-white/5 flex items-center gap-2">
                        <span class="tag-pill"><?php echo e($categoryLabels[$skill->category] ?? $skill->category); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($skill->is_featured): ?>
                            <span class="tag-pill" style="background:rgba(251,191,36,0.15);border-color:rgba(251,191,36,0.25)">🔥 热门</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-4xl mx-auto glass-card p-10 text-center mb-8" style="background: linear-gradient(135deg, rgba(124,58,237,0.08), rgba(37,99,235,0.08)); border-color: rgba(139,92,246,0.15);">
        <h2 class="text-2xl font-bold mb-3">🔄 想要交换技能？</h2>
        <p class="text-gray-400 mb-6">发布你擅长的技能和想学的技能，AI 智能匹配志同道合的伙伴</p>
        <a href="#" class="glow-btn text-white px-6 py-2.5 rounded-lg font-medium inline-block hover:scale-105 transition-transform">
            发布技能交换需求
        </a>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>

<?php
$categoryLabels = [
    'discovery' => '🔍 发现', 'development' => '💻 开发',
    'design' => '🎨 设计', 'productivity' => '⚡ 效率',
    'automation' => '🤖 自动化', 'creative' => '✨ 创作',
];
?>
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\home.blade.php ENDPATH**/ ?>