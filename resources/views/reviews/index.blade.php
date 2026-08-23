@extends('layouts.app')

@section('title', 'All Shops')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-stone-800">All Shops</h1>
        <p class="text-stone-500 mt-2">Every ice cream shop I've visited, sorted by rating.</p>

        @if ($visitedShops->isEmpty())
            <p class="text-stone-500 mt-8">No visits logged yet &mdash; check back soon!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-8">
                @foreach ($visitedShops as $shop)
                    <x-shop-card :shop="$shop" />
                @endforeach
            </div>
        @endif

        @if ($wantToVisitShops->isNotEmpty())
            <h2 class="text-2xl font-bold text-stone-800 mt-16 mb-4">📝 On my list</h2>
            <ul class="divide-y divide-stone-100 bg-white rounded-2xl border border-stone-100 overflow-hidden">
                @foreach ($wantToVisitShops as $shop)
                    <li class="px-5 py-4">
                        <p class="font-medium text-stone-700">{{ $shop->name }}</p>
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
