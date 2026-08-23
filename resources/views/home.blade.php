@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="bg-gradient-to-b from-pink-50 to-cream-50">
        <div class="max-w-2xl mx-auto px-4 py-16 text-center">
            <div class="text-5xl">👋</div>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-stone-800 mt-4">Hi, I'm Chris</h1>
            <p class="mt-4 text-stone-500 max-w-xl mx-auto">
                Ice cream is my hobby &mdash; this is where I keep track of the best scoops Warsaw has to offer, one shop at a time.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-stone-800">🍦 My Favorite Ice Cream Shops</h2>
            <a href="{{ route('rankings.index') }}" class="text-sm font-medium text-pink-600 hover:underline whitespace-nowrap">See full rankings &rarr;</a>
        </div>

        @if ($favoriteShops->isEmpty())
            <p class="text-stone-500">No favorites yet &mdash; check back soon!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($favoriteShops as $shop)
                    <x-shop-card :shop="$shop" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
