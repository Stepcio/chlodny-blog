@extends('layouts.app')

@section('title', 'All Reviews')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">All Reviews</h1>
        <p class="text-stone-500 mt-2">Every ice cream shop I've visited, sorted by rating.</p>

        @if ($shops->isEmpty())
            <p class="text-stone-500 mt-8">No visits logged yet &mdash; check back soon!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-8">
                @foreach ($shops as $shop)
                    <x-shop-card :shop="$shop" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
