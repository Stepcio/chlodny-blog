@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="bg-gradient-to-b from-pink-50 to-cream-50">
        <div class="max-w-5xl mx-auto px-4 py-16 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-stone-800">
                The best ice cream in <span class="text-pink-600">Warsaw</span>
            </h1>
            <p class="mt-4 text-stone-500 max-w-xl mx-auto">
                A running list of the city's best scoops, plus a write-up of every ice cream shop I visit along the way.
            </p>
            <a href="{{ route('shops.index') }}" class="inline-block mt-8 px-6 py-3 rounded-full bg-pink-600 text-white font-medium hover:bg-pink-700 transition">
                See all shops
            </a>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-stone-800 mb-6">🏆 Best of Warsaw</h2>

        @if ($featuredShops->isEmpty())
            <p class="text-stone-500">No featured shops yet &mdash; check back soon!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($featuredShops as $shop)
                    <x-shop-card :shop="$shop" />
                @endforeach
            </div>
        @endif
    </section>
@endsection
