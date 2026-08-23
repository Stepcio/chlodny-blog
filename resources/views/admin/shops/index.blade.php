@extends('layouts.admin')

@section('title', 'Shops')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-stone-800">Shops</h1>
            <a href="{{ route('admin.shops.create') }}" class="px-4 py-2 rounded-full bg-pink-600 text-white text-sm font-medium hover:bg-pink-700 transition">
                + Add Shop
            </a>
        </div>

        <div class="mt-8 bg-white rounded-2xl border border-stone-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-stone-50 text-stone-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Ranked</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($shops as $shop)
                        <tr>
                            <td class="px-4 py-3 font-medium text-stone-700">{{ $shop->name }}</td>
                            <td class="px-4 py-3 text-stone-500">{{ $shop->status === 'visited' ? 'Visited' : 'Want to visit' }}</td>
                            <td class="px-4 py-3">
                                @if ($shop->rating)
                                    <x-star-rating :rating="$shop->rating" class="text-sm" />
                                @else
                                    <span class="text-stone-300">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $shop->is_featured ? '✅' : '' }}</td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.shops.edit', $shop) }}" class="text-pink-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.shops.destroy', $shop) }}" class="inline" onsubmit="return confirm('Delete {{ $shop->name }}? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-stone-400">No shops yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
