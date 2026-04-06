<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => $skill->name] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-4xl mx-auto py-10 px-4">

    <!-- ===== 标题区 ===== -->
    <div class="mb-10">
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4"><?php echo e($skill->name); ?></h1>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($skill->is_featured): ?>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-violet-500/15 text-violet-300 border border-violet-500/25 mb-5">⭐ 强烈推荐</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <p class="text-gray-400 text-base leading-relaxed"><?php echo e($skill->description); ?></p>

        <!-- 元信息 -->
        <div class="flex items-center gap-5 mt-5 text-sm text-gray-500">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($skill->author): ?>
                <span>by <?php echo e($skill->author); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="flex items-center gap-1">
                <span class="rating-star text-amber-400">★</span> <?php echo e($skill->avg_rating); ?>

            </span>
            <span><?php echo e(number_format($skill->install_count)); ?> 次安装</span>
        </div>
    </div>

    <!-- ===== 安装 & 配置步骤（编号卡片） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">🚀</span> 安装 & 配置步骤
        </h2>
        <div class="space-y-3">
            <?php
                $steps = collect(explode("\n", trim($skill->install_steps)))->filter(fn($l) => trim($l));
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="glass-card p-5 flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-sm font-bold text-white shrink-0 mt-0.5"><?php echo e($i + 1); ?></div>
                    <div class="text-sm text-gray-300 leading-relaxed whitespace-pre-wrap"><?php echo e(trim($step)); ?></div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>

    <!-- ===== 配置详解（代码块） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">⚙️</span> 配置详解
        </h2>
        <div class="glass-card p-6 overflow-hidden">
            <pre class="text-xs sm:text-sm leading-loose overflow-x-auto whitespace-pre-wrap"><code class="text-cyan-300"><?php echo nl2br(e($skill->config_code)); ?></code></pre>
            <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                <span class="text-base">💡</span> 以上配置可直接复制使用
            </div>
        </div>
    </section>

    <!-- ===== 适用场景（标签） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">💡</span> 适用场景
        </h2>
        <div class="flex flex-wrap gap-3">
            <?php
                $cases = explode('|', $skill->use_cases);
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <span class="px-4 py-2.5 rounded-xl bg-blue-500/8 text-blue-300 border border-blue-500/15 text-sm hover:bg-blue-500/12 transition cursor-default">
                    <?php echo e(trim($case)); ?>

                </span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>

    <!-- ===== 最佳实践 & 避免双栏卡片（参考Skillstore风格） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">⚖️</span> 最佳实践 & 避免事项
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- 最佳实践 -->
            <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/[0.04] p-6">
                <h3 class="font-bold text-emerald-400 mb-5 flex items-center gap-2 text-base">
                    <span class="w-6 h-6 rounded-full bg-emerald-500/15 flex items-center justify-center text-sm">✅</span> 最佳实践
                </h3>
                <ul class="space-y-4 text-sm text-gray-300 leading-relaxed">
                    <?php
                        $bestPractices = [];
                        $avoidList = [];

                        // 解析 pros 字段 —— 用换行分隔（数据库实际存储格式）
                        $allItems = explode("\n", $skill->pros);
                        foreach ($allItems as $item) {
                            $trimmed = trim($item);
                            if (empty($trimmed)) continue;

                            if (str_contains($trimmed, '✓') || str_contains($trimmed, '√')) {
                                $cleaned = trim(str_replace(['✓', '√'], '', $trimmed));
                                $bestPractices[] = $cleaned;
                            }
                            elseif (str_contains($trimmed, '⚠') || str_contains($trimmed, '🔴') || str_starts_with($trimmed, '不要') || str_starts_with($trimmed, '不要')) {
                                $cleaned = trim(str_replace(['⚠', '🔴'], '', $trimmed));
                                $avoidList[] = $cleaned;
                            }
                            else {
                                $bestPractices[] = $trimmed;
                            }
                        }

                        // cons 字段也用换行分隔，全部归入避免列表
                        if (!empty(trim($skill->cons))) {
                            $consItems = explode("\n", $skill->cons);
                            foreach ($consItems as $item) {
                                $t = trim($item);
                                if ($t) { $avoidList[] = trim(str_replace(['⚠', '🔴', '✕'], '', $t)); }
                            }
                        }
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bestPractices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim($pro)): ?>
                        <li class="flex items-start gap-3 pl-2">
                            <span class="text-emerald-500 mt-0.8 shrink-0 text-[10px]">●</span>
                            <span><?php echo nl2br(e(trim($pro))); ?></span>
                        </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>

            <!-- 避免事项 -->
            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/[0.04] p-6">
                <h3 class="font-bold text-amber-400 mb-5 flex items-center gap-2 text-base">
                    <span class="w-6 h-6 rounded-full bg-amber-500/15 flex items-center justify-center text-sm">⚠</span> 避免事项
                </h3>
                <ul class="space-y-4 text-sm text-gray-300 leading-relaxed">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($avoidList) > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $avoidList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avoid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim($avoid)): ?>
                            <li class="flex items-start gap-3 pl-2">
                                <span class="text-amber-500 mt-0.8 shrink-0 text-[10px]">●</span>
                                <span><?php echo nl2br(e(trim($avoid))); ?></span>
                            </li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php else: ?>
                        <li class="text-gray-500 italic text-xs pl-5">暂无特别注意事项 —— 该技能使用风险较低</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- ===== 相关技能推荐 ===== -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedSkills && $relatedSkills->count() > 0): ?>
    <section class="mb-8">
        <h2 class="text-lg font-bold text-white mb-5">🔗 相关技能</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('skills.show', $related)); ?>" class="glass-card p-4 flex items-center gap-3 group no-underline">
                    <span class="text-2xl"><?php echo e($related->icon); ?></span>
                    <div>
                        <h4 class="font-medium text-sm text-white group-hover:text-violet-300 transition"><?php echo e($related->name); ?></h4>
                        <p class="text-xs text-gray-500 line-clamp-1"><?php echo e($related->short_desc); ?></p>
                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\skills\show.blade.php ENDPATH**/ ?>