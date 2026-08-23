@extends('layouts.app')

@section('title', 'Ranking')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">🏆 Ranking</h1>
        <p class="text-stone-500 mt-2">Mój osobisty ranking najlepszych lodziarni w Warszawie.</p>

        @if ($shops->isEmpty())
            <p class="text-stone-500 mt-8">Na razie brak rankingu &mdash; zajrzyj wkrótce!</p>
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
                                <x-star-rating :rating="$shop->rating" class="shrink-0 text-sm" />
                            @endif
                        </a>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
@endsection
