@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">📝 Wishlist</h1>
        <p class="text-stone-500 mt-2">Ice cream shops I still want to check out.</p>

        @if ($shops->isEmpty())
            <p class="text-stone-500 mt-8">Nothing on the list right now.</p>
        @else
            <ul class="divide-y divide-stone-100 bg-white rounded-2xl border border-stone-100 overflow-hidden mt-8">
                @foreach ($shops as $shop)
                    <li class="px-5 py-4">
                        <a href="{{ route('shops.show', $shop) }}" class="font-medium text-stone-700 hover:text-pink-600 transition">{{ $shop->name }}</a>
                        @if ($shop->district)
                            <p class="text-xs text-stone-400">{{ $shop->district }}</p>
                        @endif
                        <p class="text-sm text-stone-500 mt-1">{{ $shop->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
