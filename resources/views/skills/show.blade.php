<x-app-layout :title="$skill->name">

<div class="max-w-4xl mx-auto py-10 px-4">

    <!-- ===== 标题区 ===== -->
    <div class="mb-10">
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">{{ $skill->name }}</h1>
        @if($skill->is_featured)
            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-violet-500/15 text-violet-300 border border-violet-500/25 mb-5">⭐ 强烈推荐</span>
        @endif
        <p class="text-gray-400 text-base leading-relaxed">{{ $skill->description }}</p>

        <!-- 元信息 -->
        <div class="flex items-center gap-5 mt-5 text-sm text-gray-500">
            @if($skill->author)
                <span>by {{ $skill->author }}</span>
            @endif
            <span class="flex items-center gap-1">
                <span class="rating-star text-amber-400">★</span> {{ $skill->avg_rating }}
            </span>
            <span>{{ number_format($skill->install_count) }} 次安装</span>
        </div>
    </div>

    <!-- ===== 安装 & 配置步骤（编号卡片） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">🚀</span> 安装 & 配置步骤
        </h2>
        <div class="space-y-3">
            @php
                $steps = collect(explode("\n", trim($skill->install_steps)))->filter(fn($l) => trim($l));
            @endphp
            @foreach($steps as $i => $step)
                <div class="glass-card p-5 flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-sm font-bold text-white shrink-0 mt-0.5">{{ $i + 1 }}</div>
                    <div class="text-sm text-gray-300 leading-relaxed whitespace-pre-wrap">{{ trim($step) }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ===== 配置详解（代码块） ===== -->
    <section class="mb-10">
        <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <span class="text-xl">⚙️</span> 配置详解
        </h2>
        <div class="glass-card p-6 overflow-hidden">
            <pre class="text-xs sm:text-sm leading-loose overflow-x-auto whitespace-pre-wrap"><code class="text-cyan-300">{!! nl2br(e($skill->config_code)) !!}</code></pre>
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
            @php
                $cases = explode('|', $skill->use_cases);
            @endphp
            @foreach($cases as $case)
                <span class="px-4 py-2.5 rounded-xl bg-blue-500/8 text-blue-300 border border-blue-500/15 text-sm hover:bg-blue-500/12 transition cursor-default">
                    {{ trim($case) }}
                </span>
            @endforeach
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
                    @php
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
                    @endphp
                    @foreach($bestPractices as $pro)
                        @if(trim($pro))
                        <li class="flex items-start gap-3 pl-2">
                            <span class="text-emerald-500 mt-0.8 shrink-0 text-[10px]">●</span>
                            <span>{!! nl2br(e(trim($pro))) !!}</span>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- 避免事项 -->
            <div class="rounded-2xl border border-amber-500/20 bg-amber-500/[0.04] p-6">
                <h3 class="font-bold text-amber-400 mb-5 flex items-center gap-2 text-base">
                    <span class="w-6 h-6 rounded-full bg-amber-500/15 flex items-center justify-center text-sm">⚠</span> 避免事项
                </h3>
                <ul class="space-y-4 text-sm text-gray-300 leading-relaxed">
                    @if(count($avoidList) > 0)
                        @foreach($avoidList as $avoid)
                            @if(trim($avoid))
                            <li class="flex items-start gap-3 pl-2">
                                <span class="text-amber-500 mt-0.8 shrink-0 text-[10px]">●</span>
                                <span>{!! nl2br(e(trim($avoid))) !!}</span>
                            </li>
                            @endif
                        @endforeach
                    @else
                        <li class="text-gray-500 italic text-xs pl-5">暂无特别注意事项 —— 该技能使用风险较低</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- ===== 相关技能推荐 ===== -->
    @if($relatedSkills && $relatedSkills->count() > 0)
    <section class="mb-8">
        <h2 class="text-lg font-bold text-white mb-5">🔗 相关技能</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($relatedSkills as $related)
                <a href="{{ route('skills.show', $related) }}" class="glass-card p-4 flex items-center gap-3 group no-underline">
                    <span class="text-2xl">{{ $related->icon }}</span>
                    <div>
                        <h4 class="font-medium text-sm text-white group-hover:text-violet-300 transition">{{ $related->name }}</h4>
                        <p class="text-xs text-gray-500 line-clamp-1">{{ $related->short_desc }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

</div>

</x-app-layout>
