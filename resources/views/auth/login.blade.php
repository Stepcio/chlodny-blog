@extends('layouts.app')

@section('title', 'Logowanie')

@section('content')
    <div class="max-w-sm mx-auto px-4 py-16">
        <h1 class="text-2xl font-bold text-stone-800 text-center">Logowanie administratora</h1>

        @if ($errors->any())
            <div class="mt-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 text-sm px-4 py-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-stone-600">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-stone-600">Hasło</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <label class="flex items-center gap-2 text-sm text-stone-500">
                <input type="checkbox" name="remember" class="rounded border-stone-300">
                Zapamiętaj mnie
            </label>

            <button type="submit" class="w-full rounded-full bg-pink-600 text-white font-medium py-2.5 hover:bg-pink-700 transition">
                Zaloguj się
            </button>
        </form>
    </div>
@endsection
