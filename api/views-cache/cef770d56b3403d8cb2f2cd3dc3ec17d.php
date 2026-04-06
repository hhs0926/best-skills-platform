<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve(['title' => '社区动态'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-4xl mx-auto py-10 px-4">

    <!-- 标题 -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-white">🌐 社区动态</h1>
            <p class="text-gray-500 text-sm mt-1">分享你的 AI 技能使用心得，与社区一起成长</p>
        </div>
        <button onclick="openPostModal()" class="glow-btn text-white px-4 py-2 rounded-lg text-sm font-medium hidden sm:block">✏️ 发布动态</button>
    </div>

    <!-- 发帖入口（移动端） -->
    <div class="glass-card p-4 mb-6 sm:hidden" onclick="openPostModal()">
        <p class="text-gray-400 text-sm text-center cursor-pointer hover:text-white transition">✏️ 点击发布一条新动态...</p>
    </div>

    <!-- 动态列表 -->
    <div class="space-y-5" id="posts-container">

        <!-- 帖子1 -->
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-sm font-bold text-white">A</div>
                <div>
                    <p class="text-sm font-medium text-white">Alex Chen</p>
                    <p class="text-xs text-gray-500">3小时前 · 使用了 Excel Wizard</p>
                </div>
            </div>
            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                今天用 @excel-wizard 处理了公司Q1的销售数据，原本需要半天的人工整理工作，AI 5分钟就搞定了透视表和趋势图。强烈推荐！⭐⭐⭐⭐⭐
            </p>
            <div class="flex items-center gap-6 text-xs text-gray-500">
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 24</button>
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 回复</button>
                <button class="hover:text-blue-400 transition flex items-center gap-1.5"><span>🔄</span> 分享</button>
            </div>
        </div>

        <!-- 帖子2 -->
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-sm font-bold text-white">L</div>
                <div>
                    <p class="text-sm font-medium text-white">Lisa Wang</p>
                    <p class="text-xs text-gray-500">6小时前 · 使用了 Claude Memory</p>
                </div>
            </div>
            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                终于找到解决 AI 记忆问题的神器了！@claude-memory 让我的编码风格偏好跨会话保持，再也不用每次重复说「用 TypeScript 写」了。效率直接翻倍 💪
            </p>
            <!-- 图片占位 -->
            <div class="rounded-xl bg-gradient-to-br from-purple-900/30 to-blue-900/30 border border-white/5 p-8 mb-4 text-center">
                <span class="text-4xl opacity-50">🧠</span>
                <p class="text-xs text-gray-500 mt-2">Claude Memory 配置截图</p>
            </div>
            <div class="flex items-center gap-6 text-xs text-gray-500">
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 56</button>
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 12 条回复</button>
                <button class="hover:text-blue-400 transition flex items-center gap-1.5"><span>🔄</span> 分享</button>
            </div>
        </div>

        <!-- 帖子3 -->
        <div class="glass-card p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-sm font-bold text-white">M</div>
                <div>
                    <p class="text-sm font-medium text-white">Mike Zhang</p>
                    <p class="text-xs text-gray-500">昨天 · 使用了 Docker Pilot</p>
                </div>
            </div>
            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                团队项目从零搭建 Docker 环境，@docker-pilot 一扫项目目录自动生成了完美的 docker-compose.yml。多阶段构建把镜像体积减少了60%，太强了！
            </p>
            <div class="flex items-center gap-6 text-xs text-gray-500">
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 38</button>
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 回复</button>
                <button class="hover:text-blue-400 transition flex items-center gap-1.5"><span>🔄</span> 分享</button>
            </div>
        </div>

        <!-- 帖子4 - 求助帖 -->
        <div class="glass-card p-6 border-l-2 border-l-amber-500/50">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-sm font-bold text-white">S</div>
                <div>
                    <p class="text-sm font-medium text-white">Sarah Liu</p>
                    <p class="text-xs text-gray-500">昨天 · 🆘 求助</p>
                </div>
            </div>
            <p class="text-gray-300 text-sm leading-relaxed mb-4">
                有人用过 @security-guard 扫描 Laravel 项目吗？我跑了一遍报告有 15 个 critical 问题，但不太确定哪些需要优先处理？有没有安全大佬帮忙看看 🔒
            </p>
            <div class="flex items-center gap-6 text-xs text-gray-500">
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 18</button>
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 7 条回复</button>
                <button class="hover:text-blue-400 transition flex items-center gap-1.5"><span>🔄</span> 分享</button>
            </div>
        </div>

    </div>

    <!-- 加载更多 -->
    <div class="text-center mt-8">
        <button class="px-6 py-2.5 rounded-lg border border-white/10 text-sm text-gray-400 hover:border-violet-500/50 hover:bg-white/5 transition">加载更多...</button>
    </div>

</div>

<!-- 发布弹窗（简化版静态交互） -->
<div id="post-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4" onclick="if(event.target===this)closePostModal()">
    <div class="glass-card w-full max-w-lg p-6">
        <h3 class="text-lg font-bold text-white mb-4">✏️ 发布新动态</h3>
        <textarea placeholder="分享你的使用体验、技巧或问题..." class="search-input w-full h-32 resize-none p-3 rounded-lg text-sm"></textarea>
        <div class="mt-3 mb-4">
            <select class="search-input w-full p-2.5 rounded-lg text-sm">
                <option value="">关联技能（可选）</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Skill::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option><?php echo e($s->icon); ?> <?php echo e($s->name); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
        </div>
        <div class="flex gap-3 justify-end">
            <button onclick="closePostModal()" class="px-4 py-2 rounded-lg text-sm text-gray-400 hover:text-white transition">取消</button>
            <button class="glow-btn text-white px-5 py-2 rounded-lg text-sm font-medium">发布</button>
        </div>
    </div>
</div>

<script>
function openPostModal() { document.getElementById('post-modal').classList.remove('hidden'); }
function closePostModal() { document.getElementById('post-modal').classList.add('hidden'); }
</script>

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
<?php /**PATH C:\Users\Administrator\WorkBuddy\20260401194012\best-skills-platform\resources\views\community.blade.php ENDPATH**/ ?>