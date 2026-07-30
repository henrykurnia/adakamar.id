@extends('example.layouts.default.main')

@section('content')

    <style>
        /* Custom colors based on palette */
        :root {
            --primary-dark: #1B4EF5;
            --primary-medium: #3874FF;
            --primary-light: #5996FF;
            --primary-pale: #F4CEFF;
            --primary-soft: #E8D5F5;
        }

        .bg-primary-dark {
            background-color: #1B4EF5;
        }

        .bg-primary-medium {
            background-color: #3874FF;
        }

        .bg-primary-light {
            background-color: #5996FF;
        }

        .bg-primary-pale {
            background-color: #F4CEFF;
        }

        .text-primary-dark {
            color: #1B4EF5;
        }

        .text-primary-medium {
            color: #3874FF;
        }

        .text-primary-light {
            color: #5996FF;
        }

        .border-primary-dark {
            border-color: #1B4EF5;
        }

        .border-primary-medium {
            border-color: #3874FF;
        }

        .border-primary-pale {
            border-color: #F4CEFF;
        }

        /* Gradient background */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #1B4EF5 0%, #3874FF 50%, #5996FF 100%);
        }

        .bg-gradient-card {
            background: linear-gradient(145deg, #ffffff 0%, #faf5ff 100%);
        }

        .dark .bg-gradient-card {
            background: linear-gradient(145deg, #1a1a2e 0%, #16213e 100%);
        }

        /* Custom button */
        .btn-primary {
            background: linear-gradient(135deg, #1B4EF5 0%, #3874FF 100%);
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3874FF 0%, #5996FF 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -8px rgba(27, 78, 245, 0.5);
        }

        .btn-primary:active {
            transform: translateY(0px);
            box-shadow: 0 5px 15px -5px rgba(27, 78, 245, 0.4);
        }

        /* Input focus */
        .input-primary {
            transition: all 0.3s ease;
            background-color: #f8f5ff;
            border-color: #e8d5f5;
        }

        .input-primary:focus {
            border-color: #1B4EF5;
            box-shadow: 0 0 0 4px rgba(27, 78, 245, 0.1);
            background-color: #ffffff;
        }

        .dark .input-primary {
            background-color: #1f2937;
            border-color: #374151;
        }

        .dark .input-primary:focus {
            background-color: #1f2937;
            box-shadow: 0 0 0 4px rgba(56, 116, 255, 0.2);
        }

        .input-primary-error {
            border-color: #ef4444 !important;
        }

        .input-primary-error:focus {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
        }

        /* Link styles */
        .link-primary {
            color: #1B4EF5;
            transition: all 0.3s ease;
            position: relative;
        }

        .link-primary::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #1B4EF5, #5996FF);
            transition: width 0.3s ease;
        }

        .link-primary:hover::after {
            width: 100%;
        }

        .link-primary:hover {
            color: #5996FF;
        }

        /* Checkbox custom */
        .checkbox-primary {
            accent-color: #1B4EF5;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .checkbox-primary:hover {
            transform: scale(1.1);
        }

        /* Decorative elements */
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            animation: float 8s ease-in-out infinite;
        }

        .decorative-circle-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #1B4EF5, #3874FF);
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        .decorative-circle-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #5996FF, #F4CEFF);
            bottom: -100px;
            left: -100px;
            animation-delay: -2s;
        }

        .decorative-circle-3 {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #1B4EF5, #5996FF);
            top: 50%;
            right: -60px;
            animation-delay: -4s;
            opacity: 0.05;
        }

        .decorative-circle-4 {
            width: 80px;
            height: 80px;
            background: #F4CEFF;
            bottom: 30%;
            left: -40px;
            animation-delay: -1s;
            opacity: 0.06;
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-20px) rotate(5deg);
            }
            66% {
                transform: translateY(10px) rotate(-3deg);
            }
        }

        /* Card entrance animation */
        .card-entrance {
            animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-entrance-delay-1 {
            animation-delay: 0.1s;
        }

        .card-entrance-delay-2 {
            animation-delay: 0.2s;
        }

        .card-entrance-delay-3 {
            animation-delay: 0.3s;
        }

        .card-entrance-delay-4 {
            animation-delay: 0.4s;
        }

        /* Shimmer effect for logo */
        .logo-shimmer {
            position: relative;
        }

        .logo-shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg,
                    transparent 30%,
                    rgba(255, 255, 255, 0.05) 50%,
                    transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }
            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        /* Pulse animation for decorative */
        .pulse-slow {
            animation: pulseSlow 4s ease-in-out infinite;
        }

        @keyframes pulseSlow {
            0%,
            100% {
                opacity: 0.08;
            }
            50% {
                opacity: 0.15;
            }
        }

        /* Dark mode adjustments */
        .dark .decorative-circle {
            opacity: 0.06;
        }

        .dark .bg-primary-pale {
            background-color: rgba(244, 206, 255, 0.08);
        }

        .dark .text-primary-dark {
            color: #5996FF;
        }

        .dark .border-primary-dark {
            border-color: #5996FF;
        }
    </style>

    <div
        class="flex flex-col items-center justify-center px-6 pt-8 mx-auto min-h-screen dark:bg-gray-900 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="decorative-circle decorative-circle-1 pulse-slow"></div>
        <div class="decorative-circle decorative-circle-2 pulse-slow"></div>
        <div class="decorative-circle decorative-circle-3 pulse-slow"></div>
        <div class="decorative-circle decorative-circle-4 pulse-slow"></div>

        <!-- Logo -->
        <a href="{{ url('/') }}"
            class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white relative z-10 logo-shimmer">
            <img src="{{ asset('static/images/stockify.png') }}" class="mr-4 h-11" alt="Stockify Logo">
            <span class="text-primary-dark dark:text-primary-light">Stockify</span>
        </a>

        <!-- Pesan Error Global -->
        @if ($errors->any())
            <div class="w-full max-w-xl mb-4 p-4 text-sm text-red-800 bg-red-50 border border-red-200 rounded-xl dark:bg-red-900/30 dark:border-red-700 dark:text-red-200 relative z-10 card-entrance card-entrance-delay-1"
                role="alert">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Error!</span> {{ $errors->first() }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Pesan Success -->
        @if (session('success'))
            <div class="w-full max-w-xl mb-4 p-4 text-sm text-green-800 bg-green-50 border border-green-200 rounded-xl dark:bg-green-900/30 dark:border-green-700 dark:text-green-200 relative z-10 card-entrance card-entrance-delay-1"
                role="alert">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Card -->
        <div
            class="w-full max-w-xl p-6 sm:p-8 bg-gradient-card rounded-3xl shadow-2xl dark:bg-gray-800/90 relative z-10 border border-[#E8D5F5] dark:border-gray-700 card-entrance backdrop-blur-sm">

            <!-- Card Header -->
            <div class="text-center card-entrance card-entrance-delay-1">
                
                <h2 class="text-2xl font-bold text-primary-dark dark:text-primary-light">
                    Selamat Datang Kembali
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Masuk ke akun Stockify Anda
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Email -->
                <div class="card-entrance card-entrance-delay-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span class="text-primary-dark dark:text-primary-light">●</span> Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="input-primary w-full p-3 rounded-xl text-gray-900 sm:text-sm dark:text-white @error('email') input-primary-error @enderror"
                        placeholder="Masukkan email Anda" required autofocus>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="card-entrance card-entrance-delay-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span class="text-primary-dark dark:text-primary-light">●</span> Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="input-primary w-full p-3 rounded-xl text-gray-900 sm:text-sm dark:text-white @error('password') input-primary-error @enderror"
                            required>
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

           
                <!-- Submit Button -->
                <button type="submit"
                    class="btn-primary w-full px-5 py-3.5 rounded-xl font-medium text-sm transition-all duration-300 shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 card-entrance card-entrance-delay-4">
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Masuk ke Akun
                    </span>
                </button>

               

            </form>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-xs text-center text-gray-500 dark:text-gray-400 relative z-10">
            &copy; {{ date('Y') }} Stockify. All rights reserved.
        </p>
    </div>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Update icon
                    if (type === 'text') {
                        eyeIcon.innerHTML = `
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                        `;
                    } else {
                        eyeIcon.innerHTML = `
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        `;
                    }
                });
            }
        });
    </script>

@endsection