@extends('example.layouts.default.main')

@section('content')

    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="{{ url('/') }}"
            class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <img src="{{ asset('static/images/logo.svg') }}" class="mr-4 h-11" alt="Stockify Logo">
            <span>Stockify</span>
        </a>

        <!-- Pesan Error Global -->
        @if ($errors->any())
            <div class="w-full max-w-xl mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-200"
                role="alert">
                <span class="font-medium">Error!</span> {{ $errors->first() }}
            </div>
        @endif

        <!-- Pesan Success (jika ada) -->
        @if (session('success'))
            <div class="w-full max-w-xl mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200"
                role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Masuk ke Stockify
            </h2>

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email" required autofocus>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                        required>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                        Lupa Password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                    Masuk
                </button>

                <!-- Register Link -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                    Belum punya akun?
                    <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>

@endsection