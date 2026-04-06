<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950">
        <!-- Header -->
        <header class="border-b border-gray-800/50 backdrop-blur-xl bg-gray-900/30 sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="/" class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">⚡ BestSkills</a>
                
                <div class="flex items-center gap-6">
                    <a href="/" class="text-sm text-gray-400 hover:text-white transition-colors">首页</a>
                    <a href="/skills" class="text-sm text-gray-400 hover:text-white transition-colors">技能库</a>
                    
                    <div class="flex items-center gap-3 ml-8">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full" />
                        @else
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center text-xs font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        @endif
                        <span class="text-sm text-gray-300">{{ auth()->user()->name }}</span>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-400 hover:text-red-400 transition-colors cursor-pointer bg-transparent border-none">退出</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Dashboard Content -->
        <main class="max-w-7xl mx-auto px-6 py-10">
            <!-- Welcome -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-white mb-2">欢迎回来，{{ auth()->user()->name }} 👋</h1>
                <p class="text-gray-400">这是你的个人仪表盘，查看你的技能生态数据。</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-12">
                <div class="backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 rounded-2xl p-6 hover:border-cyan-500/30 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">⚡</div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $stats['total_skills'] }}</p>
                            <p class="text-sm text-gray-400">平台技能总数</p>
                        </div>
                    </div>
                </div>

                <div class="backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 rounded-2xl p-6 hover:border-purple-500/30 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">💬</div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $stats['total_posts'] }}</p>
                            <p class="text-sm text-gray-400">社区帖子数</p>
                        </div>
                    </div>
                </div>

                <div class="backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">🔄</div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $stats['total_exchanges'] }}</p>
                            <p class="text-sm text-gray-400">我的技能交换</p>
                        </div>
                    </div>
                </div>

                <div class="backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 rounded-2xl p-6 hover:border-pink-500/30 transition-all duration-300 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">❤️</div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $stats['user_likes'] }}</p>
                            <p class="text-sm text-gray-400">我的点赞数</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-white mb-5">快捷操作</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <a href="/skills" class="backdrop-blur-xl bg-gradient-to-br from-cyan-500/10 to-blue-500/10 border border-cyan-500/20 rounded-2xl p-6 hover:border-cyan-400/50 hover:-translate-y-1 transition-all duration-300 block group">
                        <div class="text-3xl mb-3">🔍</div>
                        <h3 class="font-semibold text-white mb-1 group-hover:text-cyan-300 transition-colors">探索技能库</h3>
                        <p class="text-sm text-gray-400">发现更多 AI 技能工具</p>
                    </a>

                    <a href="/skills/exchange" class="backdrop-blur-xl bg-gradient-to-br from-purple-500/10 to-pink-500/10 border border-purple-500/20 rounded-2xl p-6 hover:border-purple-400/50 hover:-translate-y-1 transition-all duration-300 block group">
                        <div class="text-3xl mb-3">🔄</div>
                        <h3 class="font-semibold text-white mb-1 group-hover:text-purple-300 transition-colors">发布技能交换</h3>
                        <p class="text-sm text-gray-400">我会X，想学Y，匹配同好</p>
                    </a>

                    <a href="/community" class="backdrop-blur-xl bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/20 rounded-2xl p-6 hover:border-green-400/50 hover:-translate-y-1 transition-all duration-300 block group">
                        <div class="text-3xl mb-3">📝</div>
                        <h3 class="font-semibold text-white mb-1 group-hover:text-green-300 transition-colors">社区动态</h3>
                        <p class="text-sm text-gray-400">发帖交流，分享使用心得</p>
                    </a>
                </div>
            </div>

            <!-- Recent Skills -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-xl font-semibold text-white">最新上架技能</h2>
                    <a href="/skills" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">查看全部 →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($recentSkills as $skill)
                    <a href="{{ route('skills.show', $skill->slug) }}" class="block backdrop-blur-xl bg-gray-800/40 border border-gray-700/50 rounded-2xl p-5 hover:border-gray-600/80 hover:-translate-y-1 transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-3">
                            <span class="text-2xl">{{ $skill->icon }}</span>
                            <div>
                                <h3 class="font-semibold text-white text-sm group-hover:text-cyan-300 transition-colors">{{ $skill->name }}</h3>
                                <span class="text-xs text-gray-500">{{ $skill->category }}</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-2 mb-3">{{ $skill->short_desc }}</p>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <span>★ {{ $skill->avg_rating }}</span>
                            <span>↓ {{ number_format($skill->install_count) }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</x-app-layout>