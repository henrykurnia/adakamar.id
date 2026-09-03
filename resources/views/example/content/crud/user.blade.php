@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">


{{-- Header --}}
<div class="mb-6">

    <h1 class="text-2xl font-semibold text-gray-900">
        Profil
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Kelola informasi akun Anda.
    </p>

</div>


{{-- Success --}}
@if(session('success'))

    <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50">
        {{ session('success') }}
    </div>

@endif


{{-- Form --}}
<div class="max-w-3xl bg-white rounded-lg shadow-sm border border-gray-200">

    <form
        action="{{ route('users.update') }}"
        method="POST"
        class="p-6">

        @csrf
        @method('PUT')


        {{-- Username --}}
        <div class="mb-6">

            <label
                for="username"
                class="block mb-2 text-sm font-medium text-gray-900">

                Username

            </label>

            <input
                type="text"
                name="username"
                id="username"
                value="{{ old('username', $user->username) }}"
                required
                class="bg-gray-50 border border-gray-300
                       text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500
                       block w-full p-2.5">

            @error('username')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>

        {{-- Email --}}
        <div class="mb-6">

            <label
                for="username"
                class="block mb-2 text-sm font-medium text-gray-900">

                Email

            </label>

            <input
                type="text"
                name="email"
                id="email"
                value="{{ old('email', $user->email) }}"
                required
                class="bg-gray-50 border border-gray-300
                       text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500
                       block w-full p-2.5">

            @error('email')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Password Baru --}}
        <div class="mb-6">

            <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900">

                Password Baru

            </label>

            <input
                type="password"
                name="password"
                id="password"
                placeholder="Kosongkan jika tidak ingin mengubah password"
                class="bg-gray-50 border border-gray-300
                       text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500
                       block w-full p-2.5">

            <p class="mt-1 text-xs text-gray-500">
                Kosongkan jika password tidak ingin diubah.
            </p>

            @error('password')

                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- Konfirmasi Password --}}
        <div class="mb-6">

            <label
                for="password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-900">

                Konfirmasi Password Baru

            </label>

            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Ulangi password baru"
                class="bg-gray-50 border border-gray-300
                       text-gray-900 text-sm rounded-lg
                       focus:ring-blue-500 focus:border-blue-500
                       block w-full p-2.5">

        </div>


        
        {{-- Button --}}
        <div class="flex justify-end">


            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white
                       bg-blue-700 rounded-lg hover:bg-blue-800">

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>


</div>       

@endsection
