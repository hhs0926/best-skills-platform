<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 px-4">
        <!-- Glow effect -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-md">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent hover:opacity-80 transition-opacity">
                    ⚡ BestSkills
                </a>
                <p class="mt-2 text-sm text-gray-500">登录你的账号</p>
            </div>

            <!-- Card -->
            <div class="backdrop-blur-xl bg-gray-900/60 border border-gray-800 rounded-2xl p-8 shadow-2xl shadow-black/20">

                <!-- Errors -->
                @session('status')
                    <div class="mb-4 p-3 rounded-lg bg-green-900/30 border border-green-700/50 text-green-300 text-sm">
                        {{ $value }}
                    </div>
                @endsession

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-900/30 border border-red-700/50 text-red-300 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">邮箱地址</label>
                        <input id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            required autofocus
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800/50 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200" />
                        @error('email')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">密码</label>
                        <input id="password" name="password" type="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800/50 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200" />
                        @error('password')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded bg-gray-800 border-gray-700 text-cyan-500 focus:ring-cyan-500/50" />
                            <span class="text-sm text-gray-400">记住我</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                                忘记密码？
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-4 rounded-xl font-semibold text-white bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-400 hover:to-purple-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40">
                        登录
                    </button>
                </form>

                <!-- Register Link -->
                <p class="mt-6 text-center text-sm text-gray-400">
                    还没有账号？
                    <a href="{{ route('register') }}" class="font-semibold text-cyan-400 hover:text-cyan-300 transition-colors">
                        立即注册
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
