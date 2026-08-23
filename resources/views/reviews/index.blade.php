@extends('layouts.app')

@section('title', 'Wszystkie recenzje')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">Wszystkie recenzje</h1>
        <p class="text-stone-500 mt-2">Każda lodziarnia, którą odwiedziłem, posortowana według oceny.</p>

        @if ($shops->isEmpty())
            <p class="text-stone-500 mt-8">Na razie brak zapisanych wizyt &mdash; zajrzyj wkrótce!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-8">
                @foreach ($shops as $shop)
                    <x-shop-card :shop="$shop" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
