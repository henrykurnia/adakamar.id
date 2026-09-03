@extends('example.layouts.default.dashboard')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-50">

    <div class="w-full max-w-md bg-white rounded-lg shadow-sm p-6">

        <h1 class="text-2xl font-semibold text-gray-900 mb-2">
            Lupa Password
        </h1>

        <p class="text-sm text-gray-500 mb-6">
            Masukkan email yang terdaftar untuk mendapatkan
            link reset password.
        </p>

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    class="bg-gray-50 border border-gray-300 text-gray-900
                           text-sm rounded-lg block w-full p-2.5"
                    required
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button
                type="submit"
                class="w-full px-5 py-2.5 text-sm font-medium
                       text-white bg-primary-600 rounded-lg
                       hover:bg-primary-700"
            >
                Kirim Link Reset Password
            </button>

        </form>

        <div class="mt-4 text-center">

            <a
                href="{{ route('login') }}"
                class="text-sm text-primary-600 hover:underline"
            >
                Kembali ke Login
            </a>

        </div>

    </div>

</div>

@endsection