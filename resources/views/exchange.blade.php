<x-app-layout :title="'技能交换'">

<div class="max-w-4xl mx-auto py-10 px-4">

    <!-- 标题 -->
    <div class="text-center mb-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-3">🔄 技能交换市场</h1>
        <p class="text-gray-400 text-base max-w-lg mx-auto">发布你「会」的技能，寻找你「想学」的。让社区帮你找到最佳组合。</p>
    </div>

    <!-- 发布交换卡片 -->
    <div class="glass-card p-6 sm:p-8 mb-8">
        <div class="flex items-center gap-2 mb-5">
            <span class="text-xl">💎</span>
            <h2 class="text-lg font-bold text-white">发布你的交换需求</h2>
        </div>

        <!-- 我会 / 我想学 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm text-gray-400 mb-2 font-medium">👆 我会 / 想分享</label>
                <select class="search-input w-full p-3 rounded-lg text-sm">
                    <option value="">选择你会的技能...</option>
                    @foreach(\App\Models\Skill::orderBy('name')->get() as $s)
                        <option>{{ $s->icon }} {{ $s->name }}</option>
                    @endforeach
                    <option>📚 其他（手动输入）</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-2 font-medium">👇 我想学</label>
                <select class="search-input w-full p-3 rounded-lg text-sm">
                    <option value="">选择想学的技能...</option>
                    @foreach(\App\Models\Skill::orderBy('name')->get() as $s)
                        <option>{{ $s->icon }} {{ $s->name }}</option>
                    @endforeach
                    <option>📚 其他（手动输入）</option>
                </select>
            </div>
        </div>

        <!-- 补充说明 -->
        <textarea placeholder="补充说明：比如使用场景、期望的学习方式、可以提供什么帮助等..." class="search-input w-full h-20 resize-none p-3 rounded-lg text-sm mb-4"></textarea>

        <!-- 提交按钮 -->
        <button class="glow-btn text-white px-6 py-2.5 rounded-lg text-sm font-medium w-full sm:w-auto">📤 发布交换需求</button>
    </div>

    <!-- 交换需求列表 -->
    <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
        <span>📋</span> 最新交换需求
        </h2>

    <div class="space-y-4" id="exchanges-container">

        <!-- 交换卡片1 -->
        <div class="glass-card p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-xs font-bold text-white">J</div>
                    <div>
                        <p class="text-sm font-medium text-white">Jerry Huang</p>
                        <p class="text-xs text-gray-500">2小时前</p>
                    </div>
                </div>
                <span class="tag-pill text-xs self-start sm:self-auto">🔥 活跃中</span>
            </div>

            <!-- 交换匹配展示 -->
            <div class="flex items-center gap-3 mb-4">
                <div class="flex-1 bg-emerald-500/8 border border-emerald-500/15 rounded-xl p-3 text-center">
                    <p class="text-xs text-emerald-400 mb-1 font-medium">👆 我会</p>
                    <p class="text-sm text-white font-medium">🐳 Docker Pilot</p>
                </div>
                <div class="text-xl text-violet-400 shrink-0">⇄</div>
                <div class="flex-1 bg-orange-500/8 border border-orange-500/15 rounded-xl p-3 text-center">
                    <p class="text-xs text-orange-400 mb-1 font-medium">👇 想学</p>
                    <p class="text-sm text-white font-medium">✍️ Prompt Engineer</p>
                </div>
            </div>

            <p class="text-gray-400 text-sm leading-relaxed mb-4">
                我是 DevOps 工程师，Docker/Kubernetes 玩得很熟。最近在研究 AI Agent 开发，想找懂 Prompt Engineering 的朋友交流一下，我可以教你容器化部署。
            </p>

            <div class="flex items-center gap-5 text-xs text-gray-500">
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 联系 TA</button>
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 有兴趣</button>
                <span class="ml-auto text-gray-600">12 人感兴趣</span>
            </div>
        </div>

        <!-- 交换卡片2 -->
        <div class="glass-card p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center text-xs font-bold text-white">K</div>
                    <div>
                        <p class="text-sm font-medium text-white">Kelly Zhao</p>
                        <p class="text-xs text-gray-500">5小时前</p>
                    </div>
                </div>
                <span class="tag-pill text-xs self-start sm:self-auto">🟢 开放</span>
            </div>

            <div class="flex items-center gap-3 mb-4">
                <div class="flex-1 bg-emerald-500/8 border border-emerald-500/15 rounded-xl p-3 text-center">
                    <p class="text-xs text-emerald-400 mb-1 font-medium">👆 我会</p>
                    <p class="text-sm text-white font-medium">🖼️ Image Gen Pro</p>
                </div>
                <div class="text-xl text-violet-400 shrink-0">⇄</div>
                <div class="flex-1 bg-orange-500/8 border border-orange-500/15 rounded-xl p-3 text-center">
                    <p class="text-xs text-orange-400 mb-1 font-medium">👇 想学</p>
                    <p class="text-sm text-white font-medium">🔒 Security Guard</p>
                </div>
            </div>

            <p class="text-gray-400 text-sm leading-relaxed mb-4">
                设计背景转行做 AI 产品，擅长用 AI 生成各种设计素材和配图。但安全方面是盲区，希望有安全经验的朋友带带我，我可以用 AI 帮你生成项目所需的任何图片素材作为交换。
            </p>

            <div class="flex items-center gap-5 text-xs text-gray-500">
                <button class="hover:text-violet-400 transition flex items-center gap-1.5"><span>💬</span> 联系 TA</button>
                <button class="hover:text-red-400 transition flex items-center gap-1.5"><span>❤️</span> 有兴趣</button>
                <span class="ml-auto text-gray-600">8 人感兴趣</span>
            </div>
        </div>

        <!-- 交换卡片3 - 已完成示例 -->
        <div class="glass-card p-5 sm:p-6 opacity-60">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-xs font-bold text-white">T</div>
                    <div>
                        <p class="text-sm font-medium text-white">Tom Li</p>
                        <p class="text-xs text-gray-500">昨天 · ✅ 已完成</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">✅ 已完成交换</span>
            </div>

            <div class="flex items-center gap-3 mb-4">
                <div class="flex-1 bg-gray-500/8 border border-gray-500/15 rounded-xl p-3 text-center opacity-60">
                    <p class="text-xs text-gray-500 mb-1">👆 我会</p>
                    <p class="text-sm text-gray-400">🔎 Code Reviewer</p>
                </div>
                <div class="text-xl text-gray-500 shrink-0">⇄</div>
                <div class="flex-1 bg-gray-500/8 border border-gray-500/15 rounded-xl p-3 text-center opacity-60">
                    <p class="text-xs text-gray-500 mb-1">👇 学到了</p>
                    <p class="text-sm text-gray-400">🗄️ SQL Expert</p>
                </div>
            </div>

            <p class="text-gray-500 text-sm mb-4">
                成功！教了 @alexchen 怎么用 Code Reviewer 做 PR 自动审查，他教了我 SQL 性能优化技巧。双赢！感谢这个平台 🙏
            </p>

            <div class="flex items-center gap-5 text-xs text-gray-600">
                <span>💚 双方都给了好评</span>
                <span class="ml-auto">23 人见证了这个交换</span>
            </div>
        </div>

    </div>

    <!-- 加载更多 -->
    <div class="text-center mt-8">
        <button class="px-6 py-2.5 rounded-lg border border-white/10 text-sm text-gray-400 hover:border-violet-500/50 hover:bg-white/5 transition">查看更多交换需求...</button>
    </div>

</div>

</x-app-layout>
