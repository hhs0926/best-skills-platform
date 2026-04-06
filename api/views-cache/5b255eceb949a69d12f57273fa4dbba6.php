<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => '技能库'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="max-w-7xl mx-auto">
        <!-- 页头 -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">📚 Skills 技能库</h1>
            <p class="text-gray-400">发现、评估、分享最优秀的 Claude AI 技能包</p>
        </div>

        <!-- 搜索和筛选 -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="flex-1 relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">🔍</span>
                <input type="text" placeholder="搜索技能名称或描述..." value="<?php echo e($search); ?>"
                    class="search-input w-full pl-11 pr-4 py-3 text-sm text-white placeholder-gray-500"
                    onkeydown="if(event.key==='Enter'){window.location.href='?category=<?php echo e($category); ?>&search='+this.value}">
            </div>
            <form method="GET" action="<?php echo e(route('skills.index')); ?>" class="flex items-center gap-2 flex-wrap">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="?category=<?php echo e($key); ?>&search=<?php echo e($search); ?>"
                        class="tag-pill <?php echo e($category === $key ? 'active' : ''); ?> cursor-pointer no-underline text-inherit"
                        style="text-decoration:none;color:inherit;">
                        <?php echo e($label); ?>

                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </form>
        </div>

        <!-- 技能卡片网格 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('skills.show', $skill)); ?>" class="glass-card p-5 block group">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-3xl"><?php echo e($skill->icon); ?></span>
                        <div>
                            <h3 class="font-semibold text-white group-hover:text-violet-300 transition"><?php echo e($skill->name); ?></h3>
                            <span class="text-xs text-gray-500"><?php echo e($skill->author ?? 'Community'); ?></span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm line-clamp-2 mb-4"><?php echo e($skill->short_desc); ?></p>

                    <!-- 评分条 -->
                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex-1 h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full rounded-full" style="width: <?php echo e(($skill->avg_rating / 5 * 100)); ?>%; background: linear-gradient(90deg, #7c3aed, #2563eb);"></div>
                        </div>
                        <span class="text-xs rating-star font-medium">★ <?php echo e($skill->avg_rating); ?></span>
                    </div>

                    <!-- 底部信息 -->
                    <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-white/5">
                        <span>↓ <?php echo e(number_format($skill->install_count)); ?></span>
                        <span>❤️ <?php echo e(number_format($skill->likes_count)); ?></span>
                        <span>💬 <?php echo e(number_format($skill->reviews_count)); ?></span>
                    </div>

                    <!-- 标签 -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($skill->is_featured): ?>
                        <div class="mt-2"><span class="tag-pill text-[10px]">🔥 精选</span></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($skills->isEmpty()): ?>
            <div class="text-center py-20 text-gray-500 glass-card">
                <div class="text-4xl mb-3">🔍</div>
                <p>没有找到匹配的技能，试试其他关键词？</p>
            </div>
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
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\skills\index.blade.php ENDPATH**/ ?>