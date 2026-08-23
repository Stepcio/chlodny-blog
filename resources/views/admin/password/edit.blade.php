@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
    <div class="max-w-sm mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-stone-800 mb-6">Change Password</h1>

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 text-sm px-4 py-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-stone-600">Current password</label>
                <input type="password" name="current_password" id="current_password" required
                    class="mt-1 w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-stone-600">New password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-stone-600">Confirm new password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <button type="submit" class="w-full rounded-full bg-pink-600 text-white font-medium py-2.5 hover:bg-pink-700 transition">
                Update Password
            </button>
        </form>
    </div>
@endsection
