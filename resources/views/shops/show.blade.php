@extends('layouts.app')

@section('title', $shop->name)

@section('content')
    @if ($shop->cover_image)
        <img src="{{ asset('storage/'.$shop->cover_image) }}" alt="{{ $shop->name }}" class="h-48 sm:h-64 w-full object-cover">
    @else
        <div class="h-48 sm:h-64 bg-gradient-to-br from-pink-200 via-rose-100 to-mint-200 flex items-center justify-center text-6xl">
            🍨
        </div>
    @endif

    <div class="max-w-3xl mx-auto px-4 py-10">
        @if ($shop->status === 'visited')
            <a href="{{ route('reviews.index') }}" class="text-sm text-stone-400 hover:text-pink-600 transition">&larr; All Reviews</a>
        @else
            <a href="{{ route('wishlist.index') }}" class="text-sm text-stone-400 hover:text-pink-600 transition">&larr; Wishlist</a>
        @endif

        <div class="flex items-start justify-between gap-4 mt-4">
            <h1 class="text-3xl font-bold text-stone-800">{{ $shop->name }}</h1>
            @if ($shop->rating)
                <span class="shrink-0 flex items-center gap-2">
                    <x-star-rating :rating="$shop->rating" class="text-lg" />
                    <span class="text-sm text-stone-400">{{ rtrim(rtrim(number_format($shop->rating, 1), '0'), '.') }}/5</span>
                </span>
            @endif
        </div>

        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-stone-400 mt-2">
            @if ($shop->district)
                <span>📍 {{ $shop->district }}</span>
            @endif
            @if ($shop->address)
                <span>{{ $shop->address }}</span>
            @endif
            @if ($shop->website)
                <a href="{{ $shop->website }}" target="_blank" rel="noopener" class="text-pink-600 hover:underline">Website</a>
            @endif
        </div>

        <p class="text-lg text-stone-600 mt-6">{{ $shop->description }}</p>

        @if ($shop->status === 'visited' && $shop->body)
            <div class="prose prose-stone max-w-none mt-6">
                <p class="whitespace-pre-line">{{ $shop->body }}</p>
            </div>

            @if ($shop->visited_at)
                <p class="text-sm text-stone-400 mt-8">Visited {{ $shop->visited_at->format('F Y') }}</p>
            @endif
        @else
            <div class="mt-8 rounded-2xl border border-dashed border-stone-200 p-6 text-stone-500">
                🍦 Haven't been yet &mdash; this one's still on the list!
            </div>
        @endif
    </div>
@endsection
