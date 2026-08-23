<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Chłodny Blog') — Warsaw Ice Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream-50 text-stone-800 min-h-screen flex flex-col">
    <header class="bg-white/80 backdrop-blur border-b border-stone-100 sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-bold text-pink-600">
                <span>🍦</span>
                <span>Chłodny Blog</span>
            </a>
            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-pink-600 transition {{ request()->routeIs('home') ? 'text-pink-600' : 'text-stone-600' }}">Home</a>
                <a href="{{ route('reviews.index') }}" class="hover:text-pink-600 transition {{ request()->routeIs('reviews.*') ? 'text-pink-600' : 'text-stone-600' }}">All Reviews</a>
                <a href="{{ route('rankings.index') }}" class="hover:text-pink-600 transition {{ request()->routeIs('rankings.*') ? 'text-pink-600' : 'text-stone-600' }}">Rankings</a>
                <a href="{{ route('wishlist.index') }}" class="hover:text-pink-600 transition {{ request()->routeIs('wishlist.*') ? 'text-pink-600' : 'text-stone-600' }}">Wishlist</a>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-stone-100 mt-16">
        <div class="max-w-5xl mx-auto px-4 py-8 text-sm text-stone-500 text-center">
            Chłodny Blog &mdash; one scoop of Warsaw at a time.
        </div>
    </footer>
</body>
</html>
