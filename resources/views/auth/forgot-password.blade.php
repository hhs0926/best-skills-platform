<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 px-4">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-md">
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">⚡ BestSkills</a>
                <p class="mt-2 text-sm text-gray-500">重置密码</p>
            </div>

            <div class="backdrop-blur-xl bg-gray-900/60 border border-gray-800 rounded-2xl p-8 shadow-2xl shadow-black/20">
                @session('status')
                    <div class="mb-4 p-3 rounded-lg bg-green-900/30 border border-green-700/50 text-green-300 text-sm">{{ $value }}</div>
                @endsession

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-900/30 border border-red-700/50 text-red-300 text-sm">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">邮箱地址</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com" class="w-full px-4 py-3 rounded-xl bg-gray-800/50 border border-gray-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200" />
                    </div>

                    <button type="submit" class="w-full py-3 px-4 rounded-xl font-semibold text-white bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-400 hover:to-purple-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-cyan-500/25">发送密码重置链接</button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-400">
                    想起密码了？<a href="{{ route('login') }}" class="font-semibold text-cyan-400 hover:text-cyan-300 transition-colors">返回登录</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
