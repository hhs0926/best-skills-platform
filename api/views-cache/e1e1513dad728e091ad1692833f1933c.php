<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => '关于我们'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-4xl mx-auto py-16 px-4">
    <!-- 标题 -->
    <div class="text-center mb-16">
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6">关于 BestSkills</h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
            最好的 AI 技能精选平台。发现、评测并分享 Claude、GPT 及各类 AI Agent 的技能工具，找到最适合你的组合。
        </p>
    </div>

    <!-- 我们的使命 -->
    <div class="glass-card p-8 sm:p-10 mb-10">
        <div class="flex items-center gap-3 mb-5">
            <span class="text-2xl">💜</span>
            <h2 class="text-xl font-bold text-white">我们的使命</h2>
        </div>
        <p class="text-gray-400 leading-relaxed">
            我们相信 AI 技能应当被更好地发现和使用。BestSkills 是一个开放的技能精选社区，帮助每个人在 AI Agent 浪潮中找到最趁手的工具。
            每个技能都经过真实评测、场景验证，并附带详细的安装与配置指南。不再盲目安装——只选真正好用的。
        </p>
    </div>

    <!-- 数据统计 -->
    <div class="grid grid-cols-3 gap-4 sm:gap-6 mb-10">
        <div class="glass-card p-6 sm:p-8 text-center">
            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">12+</div>
            <div class="text-gray-500 text-sm">精选技能</div>
        </div>
        <div class="glass-card p-6 sm:p-8 text-center">
            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">6</div>
            <div class="text-gray-500 text-sm">分类领域</div>
        </div>
        <div class="glass-card p-6 sm:p-8 text-center">
            <div class="text-3xl sm:text-4xl font-bold gradient-text mb-2">100%</div>
            <div class="text-gray-500 text-sm">免费开源</div>
        </div>
    </div>

    <!-- 价值观 -->
    <h2 class="text-2xl font-bold text-white mb-6">我们的价值观</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <!-- 卡片1 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-4">
                <span class="text-xl">🛡️</span>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">真实评测</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                每个技能在上架前都经过实际使用测试和深度评测，不吹不黑，只说真实体验。
            </p>
        </div>

        <!-- 卡片2 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center mb-4">
                <span class="text-xl">🌐</span>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">开放社区</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                所有内容均来自社区贡献与验证。可讨论、可补充、可纠错，共同维护技能库质量。
            </p>
        </div>

        <!-- 卡片3 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center mb-4">
                <span class="text-xl">👥</span>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">实用优先</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                由实战者打造，服务实干家。提供保姆级教程，帮助每个人快速上手 AI 技能工具。
            </p>
        </div>

        <!-- 卡片4 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="w-10 h-10 rounded-xl bg-violet-500/10 flex items-center justify-center mb-4">
                <span class="text-xl">⚡</span>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">一键上手</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                无需复杂配置。每篇评测附完整安装步骤与代码示例，照着做就能跑起来。
            </p>
        </div>
    </div>
</div>

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
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\pages\about.blade.php ENDPATH**/ ?>