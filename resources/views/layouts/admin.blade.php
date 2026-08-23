<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Chłodny Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream-50 text-stone-800 min-h-screen flex flex-col">
    <header class="bg-white border-b border-stone-100">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('admin.shops.index') }}" class="flex items-center gap-2 text-lg font-bold text-pink-600">
                <span>🍦</span>
                <span>Admin</span>
            </a>
            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('admin.shops.index') }}" class="hover:text-pink-600 transition {{ request()->routeIs('admin.shops.*') ? 'text-pink-600' : 'text-stone-600' }}">Shops</a>
                <a href="{{ route('admin.shops.create') }}" class="hover:text-pink-600 transition text-stone-600">Add Shop</a>
                <a href="{{ route('admin.password.edit') }}" class="hover:text-pink-600 transition {{ request()->routeIs('admin.password.*') ? 'text-pink-600' : 'text-stone-600' }}">Change Password</a>
                <a href="{{ route('home') }}" class="hover:text-pink-600 transition text-stone-600">View Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-pink-600 transition text-stone-600">Log Out</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @if (session('status'))
            <div class="max-w-5xl mx-auto px-4 pt-6">
                <div class="rounded-xl bg-mint-100 border border-mint-300 text-stone-700 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
