<x-app-layout :title="'技能库'">
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
                <input type="text" placeholder="搜索技能名称或描述..." value="{{ $search }}"
                    class="search-input w-full pl-11 pr-4 py-3 text-sm text-white placeholder-gray-500"
                    onkeydown="if(event.key==='Enter'){window.location.href='?category={{ $category }}&search='+this.value}">
            </div>
            <form method="GET" action="{{ route('skills.index') }}" class="flex items-center gap-2 flex-wrap">
                @foreach($categories as $key => $label)
                    <a href="?category={{ $key }}&search={{ $search }}"
                        class="tag-pill {{ $category === $key ? 'active' : '' }} cursor-pointer no-underline text-inherit"
                        style="text-decoration:none;color:inherit;">
                        {{ $label }}
                    </a>
                @endforeach
            </form>
        </div>

        <!-- 技能卡片网格 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($skills as $skill)
                <a href="{{ route('skills.show', $skill) }}" class="glass-card p-5 block group">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-3xl">{{ $skill->icon }}</span>
                        <div>
                            <h3 class="font-semibold text-white group-hover:text-violet-300 transition">{{ $skill->name }}</h3>
                            <span class="text-xs text-gray-500">{{ $skill->author ?? 'Community' }}</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $skill->short_desc }}</p>

                    <!-- 评分条 -->
                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex-1 h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full rounded-full" style="width: {{ ($skill->avg_rating / 5 * 100) }}%; background: linear-gradient(90deg, #7c3aed, #2563eb);"></div>
                        </div>
                        <span class="text-xs rating-star font-medium">★ {{ $skill->avg_rating }}</span>
                    </div>

                    <!-- 底部信息 -->
                    <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-white/5">
                        <span>↓ {{ number_format($skill->install_count) }}</span>
                        <span>❤️ {{ number_format($skill->likes_count) }}</span>
                        <span>💬 {{ number_format($skill->reviews_count) }}</span>
                    </div>

                    <!-- 标签 -->
                    @if($skill->is_featured)
                        <div class="mt-2"><span class="tag-pill text-[10px]">🔥 精选</span></div>
                    @endif
                </a>
            @endforeach
        </div>

        @if($skills->isEmpty())
            <div class="text-center py-20 text-gray-500 glass-card">
                <div class="text-4xl mb-3">🔍</div>
                <p>没有找到匹配的技能，试试其他关键词？</p>
            </div>
        @endif
    </div>
</x-app-layout>
