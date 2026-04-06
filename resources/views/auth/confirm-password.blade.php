<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 px-4">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-md">
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">⚡ BestSkills</a>
            </div>

            <div class="backdrop-blur-xl bg-gray-900/60 border border-gray-800 rounded-2xl p-8 shadow-2xl shadow-black/20">
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-900/30 border border-red-700/50 text-red-300 text-sm">{{ $errors->first() }}</div>
                @endif

                <p class="text-sm text-gray-300 mb-6">这是你账号的安全区域，请重新输入密码确认。</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">密码</label>
                        <input id="password" name="password" type="password" required autofocus autocomplete="current-password" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-gray-800/50 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200" />
                        @error('password')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3 px-4 rounded-xl font-semibold text-white bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-400 hover:to-purple-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-cyan-500/25">确认密码</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>