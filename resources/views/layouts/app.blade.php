<!DOCTYPE html>
<html lang="zh-CN" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Best Skills' }} - Skills 社交生态平台</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { background: #0a0a0f; color: #e2e8f0; font-family: 'Inter', system-ui, sans-serif; }
        .glass-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .glass-card:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(139,92,246,0.3);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3), 0 0 60px rgba(139,92,246,0.08);
        }
        .gradient-text {
            background: linear-gradient(135deg, #a78bfa, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glow-btn {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            position: relative;
            overflow: hidden;
        }
        .glow-btn::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #7c3aed, #2563eb, #06b6d4);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .glow-btn:hover::before { opacity: 1; }
        .nav-blur {
            background: rgba(10,10,15,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .skill-icon { font-size: 2rem; }
        .rating-star { color: #fbbf24; }
        .tag-pill {
            background: rgba(139,92,246,0.15);
            border: 1px solid rgba(139,92,246,0.25);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            transition: all 0.2s;
        }
        .tag-pill:hover, .tag-pill.active {
            background: rgba(139,92,246,0.35);
            border-color: rgba(139,92,246,0.5);
        }
        .search-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            transition: all 0.3s;
        }
        .search-input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 20px rgba(139,92,246,0.15);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(139,92,246,0.3); border-radius: 3px; }
    </style>
</head>
<body class="min-h-screen antialiased">
    <!-- 导航栏 -->
    <nav class="nav-blur fixed top-0 left-0 right-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold">
                    <span class="text-2xl">⚡</span>
                    <span class="gradient-text">BestSkills</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm text-gray-400">
                    <a href="{{ route('home') }}" class="hover:text-white transition {{ request()->is('/') ? 'text-white' : '' }}">首页</a>
                    <a href="{{ route('skills.index') }}" class="hover:text-white transition {{ request()->is('skills*') ? 'text-violet-400' : '' }}">技能库</a>
                    <a href="{{ route('community') }}" class="hover:text-white transition">社区</a>
                    <a href="{{ route('exchange') }}" class="hover:text-white transition">交换</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-300 hover:text-white transition">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-400 hover:text-red-400 transition">退出</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white transition">登录</a>
                    <a href="{{ route('register') }}" class="glow-btn text-sm text-white px-4 py-2 rounded-lg hover:opacity-90 transition">注册</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 主内容 -->
    <main class="pt-20 pb-16 px-4 sm:px-6">
        {{ $slot }}
    </main>

    <!-- 页脚 -->
    <footer class="border-t border-white/5 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <!-- 左侧：Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold no-underline hover:opacity-90 shrink-0">
                    <span class="text-2xl">⚡</span>
                    <span class="gradient-text">BestSkills</span>
                </a>

                <!-- 中间：导航链接 -->
                <div class="flex items-center gap-8 text-sm text-gray-400">
                    <a href="{{ route('guide') }}" class="hover:text-white transition">用户指南</a>
                    <a href="{{ route('about') }}" class="hover:text-white transition">关于我们</a>
                </div>

                <!-- 右侧：版权 -->
                <p class="text-xs sm:text-sm text-gray-500 shrink-0">
                    © 2026 BestSkills系列
                </p>
            </div>
        </div>
    </footer>

    @livewireStyles
    @livewireScripts
</body>
</html>
