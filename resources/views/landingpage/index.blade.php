@extends('landingpage.layouts.default.dashboard')

@section('content')
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Hero Section with Full Background Image -->
        <section class="relative min-h-screen flex items-center pt-20 pb-16 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('landingpage/herosection.jpg') }}'); background-size: cover; background-position: center;">
            <!-- Dark Overlay -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-[#E60000]/40 via-[#B71C1C]/30 to-[#FF5733]/20 dark:from-[#B71C1C]/50 dark:via-[#5D0E41]/40 dark:to-[#00224D]/40">
            </div>

            <div class="relative container mx-auto px-4 z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-white">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                            Temukan Penginapan <br>Terbaik untuk Anda
                        </h1>
                        <p class="text-lg md:text-xl text-white/90 mb-8 max-w-lg">
                            Nikmati pengalaman menginap yang nyaman dengan berbagai pilihan kamar, villa, dan guest house
                            berkualitas.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#"
                                class="bg-[#E60000] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#B71C1C] transition-colors shadow-lg hover:shadow-xl">
                                Cari Penginapan
                            </a>
                            <a href="#"
                                class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-colors">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0 z-10">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 40L60 50C120 60 240 80 360 80C480 80 600 60 720 50C840 40 960 40 1080 50C1200 60 1320 80 1380 80L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V40Z"
                        fill="white" class="dark:fill-gray-800" />
                </svg>
            </div>
        </section>

        <!-- Tentang Kami Section -->
        <section id="tentang" class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Kolom Kiri: Gambar/Logo -->
                    <div class="order-2 lg:order-1">
                        <div class="relative">
                            <!-- Background decoration -->
                            <div class="absolute -top-4 -left-4 w-32 h-32 bg-[#E60000]/10 rounded-full"></div>
                            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#FF5733]/10 rounded-full"></div>

                            <!-- Logo Container -->
                            <div
                                class="relative bg-gradient-to-br from-[#FFF5F5] to-[#FFE8E8] dark:from-gray-800 dark:to-gray-700 rounded-3xl p-8 shadow-2xl border border-[#FFD4D4] dark:border-gray-600">
                                <div class="flex flex-col items-center justify-center">
                                    <!-- Logo Image -->
                                    <img src="{{ asset('landingpage/home.png') }}" alt="adakamar.id Logo"
                                        class="w-48 h-48 object-contain mb-6">

                                    <!-- Decorative dots -->
                                    <div class="flex gap-2 mt-4">
                                        <span class="w-3 h-3 bg-[#E60000] rounded-full"></span>
                                        <span class="w-3 h-3 bg-[#FF5733] rounded-full"></span>
                                        <span class="w-3 h-3 bg-[#B71C1C] rounded-full"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Decorative elements -->
                            <div class="absolute -top-6 -right-6 w-16 h-16 bg-[#E60000]/20 rounded-full blur-xl"></div>
                            <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-[#FF6B6B]/20 rounded-full blur-xl"></div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: About & Tagline -->
                    <div class="order-1 lg:order-2">
                        <div class="space-y-6">
                            <!-- Title -->
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#333333] dark:text-white leading-tight">
                                <span class="text-[#E60000]">adakamar.id</span>
                                <br>
                                <span class="text-2xl md:text-3xl lg:text-4xl text-[#666666] dark:text-gray-400">Platform
                                    Penginapan Terpercaya</span>
                            </h2>

                            <!-- Tagline -->
                            <div class="space-y-4">
                                <p class="text-lg text-[#666666] dark:text-gray-400 leading-relaxed">
                                    <span class="text-[#E60000] font-semibold">"Temukan Penginapan Terbaik untuk Anda"</span>
                                </p>
                                <p class="text-base text-[#666666] dark:text-gray-400 leading-relaxed">
                                    adakamar.id hadir sebagai solusi cerdas bagi Anda yang mencari penginapan berkualitas dengan
                                    harga terbaik.
                                    Kami berkomitmen untuk memberikan pengalaman menginap yang nyaman dan tak terlupakan.
                                </p>
                            </div>

                            <!-- Keunggulan -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-[#E60000]/10 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#E60000]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="text-sm text-[#333333] dark:text-white font-medium">Terpercaya</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-[#E60000]/10 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#E60000]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="text-sm text-[#333333] dark:text-white font-medium">Mudah</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-[#E60000]/10 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#E60000]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="text-sm text-[#333333] dark:text-white font-medium">Terjangkau</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Penginapan -->
        <section id="kategori" class="py-20 bg-[#F2F2F2] dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-4">Kategori Penginapan</h2>
                    <p class="text-lg text-[#666666] dark:text-gray-400">Pilih kategori penginapan yang sesuai dengan kebutuhan
                        Anda</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Kamar -->
                    <a href="{{ route('kamar') }}"
                        class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Kamar"
                            class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-8">
                            <div>
                                <h3 class="text-3xl font-bold text-white">Kamar</h3>
                                <p class="text-gray-300 text-sm mt-1">Mulai dari Rp 150.000</p>
                                <span class="inline-block mt-2 text-[#FF6B6B] group-hover:text-white transition-colors">Lihat
                                    Detail →</span>
                            </div>
                        </div>
                    </a>

                    <!-- Villa -->
                    <a href="{{ route('villa') }}"
                        class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Villa"
                            class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-8">
                            <div>
                                <h3 class="text-3xl font-bold text-white">Villa</h3>
                                <p class="text-gray-300 text-sm mt-1">Mulai dari Rp 500.000</p>
                                <span class="inline-block mt-2 text-[#FF6B6B] group-hover:text-white transition-colors">Lihat
                                    Detail →</span>
                            </div>
                        </div>
                    </a>

                    <!-- Guest House -->
                    <a href="{{ route('guesthouse') }}"
                        class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <img src="{{ asset('landingpage/guesthouse.jpg') }}" alt="Guest House"
                            class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end p-8">
                            <div>
                                <h3 class="text-3xl font-bold text-white">Guest House</h3>
                                <p class="text-gray-300 text-sm mt-1">Mulai dari Rp 250.000</p>
                                <span class="inline-block mt-2 text-[#FF6B6B] group-hover:text-white transition-colors">Lihat
                                    Detail →</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    <!-- Daftar Penginapan Unggulan -->
    <section id="unggulan" class="py-20 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-4">Penginapan Unggulan</h2>
                <p class="text-lg text-[#666666] dark:text-gray-400">Rekomendasi penginapan terbaik pilihan pelanggan</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Card 1 - Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Hotel Grand"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Hotel Grand</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Jakarta Pusat</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 350.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-[#E60000] text-white py-2.5 rounded-lg hover:bg-[#B71C1C] transition-colors text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 2 - Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Villa Mewah"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Villa Mewah</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Bali</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 850.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-[#E60000] text-white py-2.5 rounded-lg hover:bg-[#B71C1C] transition-colors text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 3 - Tidak Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600 opacity-75">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/guest-house.jpg') }}" alt="Guest House Nyaman"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500 grayscale">
                        <span
                            class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tidak Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Guest House Nyaman</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Bandung</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 200.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-gray-400 text-white py-2.5 rounded-lg cursor-not-allowed text-sm font-semibold">
                            Tidak Tersedia
                        </a>
                    </div>
                </div>

                <!-- Card 4 - Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Hotel Bintang 3"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Hotel Bintang 3</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Surabaya</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 450.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-[#E60000] text-white py-2.5 rounded-lg hover:bg-[#B71C1C] transition-colors text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Galeri -->
        <section id="galeri" class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-4">Galeri</h2>
                    <p class="text-lg text-[#666666] dark:text-gray-400">Koleksi foto penginapan terbaik kami</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Galeri 1"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Kamar</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Galeri 2"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Villa</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/guesthouse.jpg') }}" alt="Galeri 3"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Guest House</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Galeri 4"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Fasilitas</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Galeri 5"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Pemandangan</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/guesthouse.jpg') }}" alt="Galeri 6"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Lobby</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Galeri 7"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Kamar Mandi</span>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-xl group cursor-pointer">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Galeri 8"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-white font-semibold">Taman</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Artikel Terbaru -->
        <section id="artikel" class="py-20 bg-[#F2F2F2] dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-4">Artikel Terbaru</h2>
                    <p class="text-lg text-[#666666] dark:text-gray-400">Tips dan informasi menarik seputar penginapan</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Artikel" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <span class="text-[#E60000] text-sm font-semibold">Tips Traveling</span>
                            <h3 class="text-xl font-bold text-[#333333] dark:text-white mt-2 mb-3">10 Tips Memilih Penginapan
                                yang Tepat</h3>
                            <p class="text-[#666666] dark:text-gray-400 text-sm mb-4">Panduan lengkap memilih penginapan yang
                                nyaman dan sesuai budget...</p>
                            <a href="#" class="text-[#E60000] font-semibold hover:text-[#FF5733] transition-colors">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Artikel" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <span class="text-[#E60000] text-sm font-semibold">Destinasi</span>
                            <h3 class="text-xl font-bold text-[#333333] dark:text-white mt-2 mb-3">5 Destinasi Wisata dengan
                                Villa Terbaik</h3>
                            <p class="text-[#666666] dark:text-gray-400 text-sm mb-4">Rekomendasi villa terbaik di destinasi
                                wisata populer...</p>
                            <a href="#" class="text-[#E60000] font-semibold hover:text-[#FF5733] transition-colors">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                        <img src="{{ asset('landingpage/guesthouse.jpg') }}" alt="Artikel" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <span class="text-[#E60000] text-sm font-semibold">Tips Liburan</span>
                            <h3 class="text-xl font-bold text-[#333333] dark:text-white mt-2 mb-3">Cara Menghemat Budget Saat
                                Liburan</h3>
                            <p class="text-[#666666] dark:text-gray-400 text-sm mb-4">Strategi cerdas menikmati liburan tanpa
                                menguras kantong...</p>
                            <a href="#" class="text-[#E60000] font-semibold hover:text-[#FF5733] transition-colors">Baca
                                Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Lokasi & Kontak -->
        <section id="lokasi" class="py-20 bg-[#F2F2F2] dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-4">Lokasi & Kontak</h2>
                    <p class="text-lg text-[#666666] dark:text-gray-400">Kunjungi kantor kami atau hubungi kami untuk informasi
                        lebih lanjut</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                            <h3 class="text-2xl font-bold text-[#333333] dark:text-white mb-6">Informasi Kontak</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-[#E60000] flex-shrink-0 mt-1" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-[#333333] dark:text-white">Alamat</p>
                                        <p class="text-[#666666] dark:text-gray-400">Jl. Penginapan No. 123, Jakarta Selatan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-[#E60000] flex-shrink-0 mt-1" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-[#333333] dark:text-white">Email</p>
                                        <p class="text-[#666666] dark:text-gray-400">info@adakamar.id</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-[#E60000] flex-shrink-0 mt-1" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-[#333333] dark:text-white">Telepon</p>
                                        <p class="text-[#666666] dark:text-gray-400">(021) 1234-5678</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-[#E60000] flex-shrink-0 mt-1" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a1 1 0 00-1 1v4a1 1 0 001 1h3a1 1 0 100-2h-2V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-[#333333] dark:text-white">Jam Operasional</p>
                                        <p class="text-[#666666] dark:text-gray-400">Senin - Minggu: 24 Jam</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 h-full flex items-center justify-center">
                            <div class="text-center">
                                <div
                                    class="w-32 h-32 bg-[#E60000]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-16 h-16 text-[#E60000]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-[#333333] dark:text-white mb-2">Kunjungi Kami</h3>
                                <p class="text-[#666666] dark:text-gray-400">Temukan lokasi kami di Google Maps</p>
                                <a href="#"
                                    class="inline-block mt-4 bg-[#E60000] text-white px-6 py-3 rounded-lg hover:bg-[#B71C1C] transition-colors">
                                    Lihat Lokasi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Include Footer - Hanya sekali -->


        <style>
            .container {
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }

            section {
                scroll-margin-top: 80px;
            }

            .faq-open .hidden {
                display: block !important;
            }
        </style>

        <script>
            function toggleFAQ(button) {
                const parent = button.parentElement;
                const answer = parent.querySelector('.hidden');
                const icon = button.querySelector('.text-2xl');

                // Close other FAQs
                document.querySelectorAll('.bg-\\[\\#F2F2F2\\] .hidden').forEach(el => {
                    if (el !== answer) {
                        el.classList.add('hidden');
                        el.parentElement.querySelector('.text-2xl').textContent = '+';
                    }
                });

                // Toggle current FAQ
                if (answer.classList.contains('hidden')) {
                    answer.classList.remove('hidden');
                    icon.textContent = '−';
                } else {
                    answer.classList.add('hidden');
                    icon.textContent = '+';
                }
            }
        </script>

@endsection