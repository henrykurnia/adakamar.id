@extends('example.layouts.default.main')

@section('content')

<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0">
<div class="text-center mb-6">
    @if(isset($setting) && $setting->logo)
        <img src="{{ asset('storage/' . $setting->logo) }}"
             alt="{{ $setting->site_name }}"
             class="w-20 h-20 mx-auto mb-3">
    @endif

    <h1 class="text-3xl font-bold">
        {{ $setting->site_name ?? 'Adakamar' }}
    </h1>

    <p class="text-gray-500">
        {{ $setting->tagline ?? 'Silakan login untuk melanjutkan.' }}
    </p>
</div>

<!-- Card -->
<div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow">

    <h2 class="text-2xl font-bold text-center text-gray-900">
        Login
    </h2>

    @if ($errors->any())
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
            <span class="font-medium">Login gagal!</span>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium">
                Username
            </label>

            <input
                type="text"
                name="username"
                value="{{ old('username') }}"
                class="w-full p-2.5 border rounded-lg"
                placeholder="Masukkan Username"
                required 
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                >
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full p-2.5 border rounded-lg"
                placeholder="********"
                required>
        </div>

        <button
            type="submit"
            class="w-full py-3 text-white bg-primary-700 rounded-lg hover:bg-primary-800">
            Login
        </button>

    </form>

</div>
</div>

@endsection