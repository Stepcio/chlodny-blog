@extends('layouts.admin')

@section('title', 'Edytuj '.$shop->name)

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-stone-800 mb-6">Edytuj {{ $shop->name }}</h1>

        <form method="POST" action="{{ route('admin.shops.update', $shop) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            @include('admin.shops._form', ['shop' => $shop])

            <button type="submit" class="px-6 py-2.5 rounded-full bg-pink-600 text-white font-medium hover:bg-pink-700 transition">
                Zapisz zmiany
            </button>
        </form>
    </div>
@endsection
