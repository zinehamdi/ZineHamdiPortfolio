<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center p-6 bg-[#0a0a0f]">
    {{-- Decorative background gradients --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-[#00FF88]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-[#7B61FF]/10 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo/Brand --}}
        <div class="text-center mb-8">
            <div
                class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-[#00FF88] to-[#7B61FF] flex items-center justify-center text-2xl font-extrabold text-[#0a0a0f] shadow-2xl shadow-[#00FF88]/20 mb-4">
                A
            </div>
            <h1 class="text-2xl font-bold text-[#E8E8E8]">Admin Panel</h1>
            <p class="text-[#555] text-sm font-mono mt-1">Secure access</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50 p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-[#A0A0A0] mb-2" for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required
                        class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all"
                        placeholder="Enter username">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A0A0A0] mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 focus:border-[#00FF88]/50 transition-all"
                        placeholder="Enter password">
                </div>
                <button type="submit" class="mlp-btn-laser w-full py-3 text-sm font-bold">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>