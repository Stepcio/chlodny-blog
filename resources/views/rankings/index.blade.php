@extends('layouts.app')

@section('title', 'Rankings')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">🏆 Rankings</h1>
        <p class="text-stone-500 mt-2">My personal ranking of Warsaw's best ice cream shops.</p>

        @if ($shops->isEmpty())
            <p class="text-stone-500 mt-8">No rankings yet &mdash; check back soon!</p>
        @else
            <ol class="mt-8 space-y-3">
                @foreach ($shops as $shop)
                    <li>
                        <a href="{{ route('shops.show', $shop) }}" class="flex items-center gap-4 bg-white rounded-2xl border border-stone-100 p-4 hover:shadow-md transition">
                            <span class="text-2xl font-bold text-pink-300 w-10 text-center shrink-0">#{{ $loop->iteration }}</span>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-stone-800">{{ $shop->name }}</p>
                                @if ($shop->district)
                                    <p class="text-xs text-stone-400">{{ $shop->district }}</p>
                                @endif
                            </div>
                            @if ($shop->rating)
                                <span class="shrink-0 text-sm font-medium text-amber-500">{{ str_repeat('★', $shop->rating) }}{{ str_repeat('☆', 5 - $shop->rating) }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
@endsection
