<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body { background: #dbdbd7; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white rounded-2xl p-6 shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Admin Login</h1>
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1" for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1" for="password">Password</label>
                <input type="password" id="password" name="password" required class="w-full border rounded-md px-3 py-2">
            </div>
            <button type="submit" class="w-full bg-black text-white rounded-md py-2">Login</button>
        </form>
    </div>
</body>
<script></script>
</html>
