@props(['shop'])

<a href="{{ route('shops.show', $shop) }}" class="group block bg-white rounded-2xl border border-stone-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition overflow-hidden">
    @if ($shop->cover_image)
        <img src="{{ asset('storage/'.$shop->cover_image) }}" alt="{{ $shop->name }}" class="h-32 w-full object-cover">
    @else
        <div class="h-32 bg-gradient-to-br from-pink-200 via-rose-100 to-mint-200 flex items-center justify-center text-4xl">
            🍨
        </div>
    @endif
    <div class="p-4">
        <div class="flex items-start justify-between gap-2">
            <h3 class="font-semibold text-stone-800 group-hover:text-pink-600 transition">{{ $shop->name }}</h3>
            @if ($shop->rating)
                <span class="shrink-0 text-sm font-medium text-amber-500">{{ str_repeat('★', $shop->rating) }}{{ str_repeat('☆', 5 - $shop->rating) }}</span>
            @endif
        </div>
        @if ($shop->district)
            <p class="text-xs text-stone-400 mt-1">{{ $shop->district }}</p>
        @endif
        <p class="text-sm text-stone-500 mt-2 line-clamp-2">{{ $shop->description }}</p>
    </div>
</a>
