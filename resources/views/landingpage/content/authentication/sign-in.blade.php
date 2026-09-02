@extends('landingpage.layouts.default.main')

@section('content')

    <style>
        /* Color palette dari landing page */
        :root {
            --primary-red: #E60000;
            --primary-dark-red: #B71C1C;
            --primary-orange: #FF5733;
            --primary-light: #FF6B6B;
            --bg-light: #F2F2F2;
            --text-dark: #333333;
            --text-gray: #666666;
        }

        /* Full page background */
        .login-page {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('landingpage/login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }

        /* Gradient background dengan warna landing page */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #E60000 0%, #B71C1C 50%, #FF5733 100%);
        }

        .bg-gradient-card {
            background: linear-gradient(145deg, #ffffff 0%, #FFF5F5 100%);
        }

        .dark .bg-gradient-card {
            background: linear-gradient(145deg, #1a1a2e 0%, #2d1b2e 100%);
        }

        /* Custom button dengan warna merah */
        .btn-primary {
            background: linear-gradient(135deg, #E60000 0%, #B71C1C 100%);
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
            background: linear-gradient(135deg, #FF5733 0%, #E60000 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -8px rgba(230, 0, 0, 0.5);
        }

        .btn-primary:active {
            transform: translateY(0px);
            box-shadow: 0 5px 15px -5px rgba(230, 0, 0, 0.4);
        }

        /* Input focus dengan warna merah */
        .input-primary {
            transition: all 0.3s ease;
            background-color: #FFF5F5;
            border: 2px solid #FFD4D4;
        }

        .input-primary:focus {
            border-color: #E60000;
            box-shadow: 0 0 0 4px rgba(230, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .dark .input-primary {
            background-color: #1f2937;
            border-color: #374151;
        }

        .dark .input-primary:focus {
            background-color: #1f2937;
            box-shadow: 0 0 0 4px rgba(230, 0, 0, 0.2);
            border-color: #E60000;
        }

        .input-primary-error {
            border-color: #ef4444 !important;
        }

        .input-primary-error:focus {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
        }

        /* Link styles dengan warna merah */
        .link-primary {
            color: #E60000;
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
            background: linear-gradient(90deg, #E60000, #FF5733);
            transition: width 0.3s ease;
        }

        .link-primary:hover::after {
            width: 100%;
        }

        .link-primary:hover {
            color: #FF5733;
        }

        /* Checkbox custom */
        .checkbox-primary {
            accent-color: #E60000;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .checkbox-primary:hover {
            transform: scale(1.1);
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
            background-color: rgba(230, 0, 0, 0.08);
        }

        .dark .text-primary-dark {
            color: #FF6B6B;
        }

        .dark .border-primary-dark {
            border-color: #FF6B6B;
        }

        /* Hero Background Overlay - Full Page */
        .hero-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg,
                    rgba(230, 0, 0, 0.4) 0%,
                    rgba(183, 28, 28, 0.3) 50%,
                    rgba(255, 87, 51, 0.2) 100%);
            z-index: 1;
        }

        .dark .hero-overlay {
            background: linear-gradient(135deg,
                    rgba(183, 28, 28, 0.5) 0%,
                    rgba(93, 14, 65, 0.4) 50%,
                    rgba(0, 34, 77, 0.4) 100%);
        }

        /* Content wrapper */
        .login-content {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
        }

        /* Center card */
        .login-card-wrapper {
            width: 100%;
            max-width: 28rem;
            margin: 0 auto;
        }

        /* Ensure body has no margin */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* ===== NOTIFICATION TOAST STYLES ===== */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
            width: 100%;
        }

        .toast {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-left: 4px solid;
            transform: translateX(calc(100% + 40px));
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: all;
            cursor: pointer;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.hide {
            transform: translateX(calc(100% + 40px));
            opacity: 0;
        }

        .toast-success {
            border-left-color: #22c55e;
            background: #f0fdf4;
        }

        .toast-success .toast-icon {
            color: #22c55e;
        }

        .toast-error {
            border-left-color: #E60000;
            background: #fef2f2;
        }

        .toast-error .toast-icon {
            color: #E60000;
        }

        .dark .toast-success {
            background: #1a2e1a;
            border-left-color: #4ade80;
        }

        .dark .toast-error {
            background: #2e1a1a;
            border-left-color: #ff6b6b;
        }

        .dark .toast {
            background: #1f2937;
            color: #f3f4f6;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .toast-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            margin-top: 2px;
        }

        .toast-content {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-weight: 600;
            font-size: 0.875rem;
            color: #111827;
            margin-bottom: 2px;
        }

        .dark .toast-title {
            color: #f9fafb;
        }

        .toast-message {
            font-size: 0.8125rem;
            color: #6b7280;
            line-height: 1.4;
        }

        .dark .toast-message {
            color: #9ca3af;
        }

        .toast-close {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 0;
            transition: color 0.2s;
            margin-top: 2px;
        }

        .toast-close:hover {
            color: #374151;
        }

        .dark .toast-close {
            color: #6b7280;
        }

        .dark .toast-close:hover {
            color: #d1d5db;
        }

        /* Toast progress bar */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: currentColor;
            border-radius: 0 0 0 4px;
            animation: progressShrink 4s linear forwards;
        }

        .toast-success .toast-progress {
            color: #22c55e;
        }

        .toast-error .toast-progress {
            color: #E60000;
        }

        @keyframes progressShrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .toast-container {
                top: 16px;
                right: 16px;
                left: 16px;
                max-width: none;
                width: auto;
            }
        }
    </style>

    <!-- Full Page Background -->
    <div class="login-page">
        <!-- Overlay -->
        <div class="hero-overlay"></div>

        <!-- Konten Login -->
        <div class="login-content">

            <!-- Decorative elements -->
            <div class="decorative-circle decorative-circle-1 pulse-slow"></div>
            <div class="decorative-circle decorative-circle-2 pulse-slow"></div>
            <div class="decorative-circle decorative-circle-3 pulse-slow"></div>
            <div class="decorative-circle decorative-circle-4 pulse-slow"></div>

            <!-- Logo -->
            <a href="#"
                class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 relative z-10 logo-shimmer">
                <img src="{{ asset('landingpage/home.png') }}" class="mr-4 h-11" alt="adakamar.id Logo">
                <span class="text-white dark:text-white font-bold">adakamar.id</span>
            </a>

            <!-- Toast Notification Container -->
            <div id="toastContainer" class="toast-container"></div>

            <!-- Card Login -->
            <div class="login-card-wrapper">
                <div
                    class="w-full p-6 sm:p-8 bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl relative z-10 border border-[#FFD4D4] dark:border-gray-700 card-entrance backdrop-blur-sm">

                    <!-- Card Header -->
                    <div class="text-center card-entrance card-entrance-delay-1">
                        <h2 class="text-2xl font-bold text-[#E60000] dark:text-[#FF6B6B]">
                            Selamat Datang Kembali
                        </h2>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Masuk ke akun adakamar.id Anda
                        </p>
                    </div>

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6" id="loginForm">
                        @csrf

                        <!-- Username -->
                        <div class="card-entrance card-entrance-delay-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="text-[#E60000] dark:text-[#FF6B6B]">●</span> Username
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="input-primary w-full p-3 rounded-xl text-gray-900 sm:text-sm dark:text-white @error('name') input-primary-error @enderror"
                                placeholder="Masukkan username Anda" required autofocus>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="card-entrance card-entrance-delay-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span class="text-[#E60000] dark:text-[#FF6B6B]">●</span> Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="input-primary w-full p-3 rounded-xl text-gray-900 sm:text-sm dark:text-white @error('password') input-primary-error @enderror"
                                    required>
                                <button type="button" id="togglePassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between card-entrance card-entrance-delay-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="checkbox-primary w-4 h-4 rounded">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                            </label>
                            <a href="#" class="text-sm link-primary">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn-primary w-full px-5 py-3.5 rounded-xl font-medium text-sm transition-all duration-300 shadow-lg shadow-red-500/20 hover:shadow-red-500/40 card-entrance card-entrance-delay-4">
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
            </div>

            <!-- Footer -->
            <p class="mt-8 text-xs text-center text-white/80 dark:text-gray-400 relative z-10">
                &copy; {{ date('Y') }} adakamar.id. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ============================================================
            // TOGGLE PASSWORD VISIBILITY
            // ============================================================
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

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

            // ============================================================
            // TOAST NOTIFICATION SYSTEM
            // ============================================================
            const toastContainer = document.getElementById('toastContainer');

            function showToast(type, title, message, duration = 4000) {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <div class="toast-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${type === 'success' 
                                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                            }
                        </svg>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">${title}</div>
                        <div class="toast-message">${message}</div>
                    </div>
                    <button class="toast-close" onclick="this.closest('.toast').remove()">&times;</button>
                    <div class="toast-progress" style="animation-duration: ${duration}ms;"></div>
                `;

                toastContainer.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.add('show');
                });

                const timeoutId = setTimeout(() => {
                    toast.classList.remove('show');
                    toast.classList.add('hide');
                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.remove();
                        }
                    }, 500);
                }, duration);

                toast.addEventListener('click', function (e) {
                    if (!e.target.closest('.toast-close')) {
                        clearTimeout(timeoutId);
                        this.classList.remove('show');
                        this.classList.add('hide');
                        setTimeout(() => {
                            if (this.parentNode) {
                                this.remove();
                            }
                        }, 500);
                    }
                });
            }

            // ============================================================
            // SHOW TOAST FROM SESSION (MENGGUNAKAN login_error)
            // ============================================================

            // Cek login_error dari session (khusus untuk error login)
            @if (session('login_error'))
                showToast('error', 'Login Gagal!', '{{ session('login_error') }}');
            @endif

            // Cek success dari session
            @if (session('success'))
                showToast('success', 'Berhasil!', '{{ session('success') }}');
            @endif

            // Cek error dari session (selain login_error)
            @if (session('error') && !session('login_error'))
                showToast('error', 'Gagal!', '{{ session('error') }}');
            @endif

            // Cek error dari Laravel validation (withErrors)
            @if ($errors->any())
                const errorMessages = @json($errors->all());
                const firstError = errorMessages[0] || 'Terjadi kesalahan. Silakan coba lagi.';
                showToast('error', 'Login Gagal!', firstError);
            @endif

            // ============================================================
            // HANDLE FORM SUBMISSION
            // ============================================================
            const loginForm = document.getElementById('loginForm');

            if (loginForm) {
                loginForm.addEventListener('submit', function (e) {
                    // Tampilkan toast loading
                    showToast('success', 'Memproses...', 'Sedang memverifikasi akun Anda.', 3000);
                });
            }
        });
    </script>

@endsection