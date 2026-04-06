<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 px-4">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-md">
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 bg-clip-text text-transparent">⚡ BestSkills</a>
            </div>

            <div class="backdrop-blur-xl bg-gray-900/60 border border-gray-800 rounded-2xl p-8 shadow-2xl shadow-black/20 text-center">
                @session('status')
                    <div class="mb-4 p-3 rounded-lg bg-green-900/30 border border-green-700/50 text-green-300 text-sm">{{ $value }}</div>
                @endsession

                <p class="text-sm text-gray-300 mb-6">感谢注册！请检查邮箱，点击验证链接完成验证。</p>

                @if (Laravel\Fortify\Fortify::confirmsTwoFactorAuthentication())
                    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                @else
                    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="py-3 px-6 rounded-xl font-semibold text-white bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-400 hover:to-purple-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-cyan-500/25">
                        重新发送验证邮件
                    </button>
                </form>

                <p class="mt-6 text-sm text-gray-400">
                    <a href="{{ route('logout') }}" method="POST" class="text-cyan-400 hover:text-cyan-300 transition-colors">退出登录</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>