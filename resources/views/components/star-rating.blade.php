@props(['rating'])

@php
    $value = (float) $rating;
    $percent = max(0, min(100, ($value / 5) * 100));
@endphp

<span {{ $attributes->merge(['class' => 'relative inline-block leading-none']) }}>
    <span aria-hidden="true" class="text-stone-200">★★★★★</span>
    <span aria-hidden="true" class="absolute inset-0 overflow-hidden text-amber-500 whitespace-nowrap" style="width: {{ $percent }}%">★★★★★</span>
    <span class="sr-only">{{ rtrim(rtrim(number_format($value, 1), '0'), '.') }} na 5 gwiazdek</span>
</span>
