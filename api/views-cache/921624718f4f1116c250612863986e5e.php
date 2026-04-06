<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => '用户指南'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6">用户指南</h1>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
            从浏览到安装，快速上手 BestSkills 的完整使用流程。
        </p>
    </div>

    <!-- 步骤列表 -->
    <div class="space-y-6">
        <!-- 步骤1 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center shrink-0 text-lg font-bold text-violet-400">1</div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-2">浏览技能库</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-3">
                        首页展示精选技能卡片，点击可查看详情。也可以进入「技能库」页面，通过搜索和分类筛选找到你需要的工具。
                    </p>
                    <span class="tag-pill text-xs">首页 → 点击卡片</span>
                </div>
            </div>
        </div>

        <!-- 步骤2 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center shrink-0 text-lg font-bold text-violet-400">2</div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-2">查看评测详情</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-3">
                        每个技能都有完整的详情页，包含功能介绍、安装步骤、配置代码、适用场景以及优缺点分析。
                    </p>
                    <span class="tag-pill text-xs">详情页 = 保姆级教程</span>
                </div>
            </div>
        </div>

        <!-- 步骤3 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center shrink-0 text-lg font-bold text-violet-400">3</div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-2">安装技能</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-3">
                        按照详情页中的安装步骤操作。大部分技能只需在 Claude Desktop 或 Claude Code 中配置即可使用，无需编程基础。
                    </p>
                    <span class="tag-pill text-xs">复制代码 → 粘贴即用</span>
                </div>
            </div>
        </div>

        <!-- 步骤4 -->
        <div class="glass-card p-6 sm:p-8">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center shrink-0 text-lg font-bold text-violet-400">4</div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-2">加入社区（可选）</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-3">
                        注册账号后可以发布自己的使用心得、参与技能交换、给喜欢的技能点赞，与其他 AI 爱好者交流。
                    </p>
                    <span class="tag-pill text-xs">注册免费 · 随时退出</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 常见问题 -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-white mb-6">常见问题</h2>
        <div class="space-y-4">
            <div class="glass-card p-6">
                <h4 class="font-bold text-white mb-2">BestSkills 是什么？</h4>
                <p class="text-gray-500 text-sm">一个专注于 AI Agent 技能工具的精选与评测社区，帮助你找到最实用的 AI 技能组合。</p>
            </div>
            <div class="glass-card p-6">
                <h4 class="font-bold text-white mb-2">技能安装收费吗？</h4>
                <p class="text-gray-500 text-sm">不收费。所有推荐的技能本身都是开源免费的，我们也提供免费的安装教程。</p>
            </div>
            <div class="glass-card p-6">
                <h4 class="font-bold text-white mb-2">如何提交我想评测的技能？</h4>
                <p class="text-gray-500 text-sm">注册账号后可在社区发帖提出需求，或通过「发布交换」功能发起请求。</p>
            </div>
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
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\pages\guide.blade.php ENDPATH**/ ?>