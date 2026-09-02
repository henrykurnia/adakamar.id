@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Daftar Kamar -->
    <section id="daftar-kamar" class="py-20 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <!-- Header dengan Breadcrumb -->
            <div class="mb-8">
                <nav class="flex text-sm text-[#666666] dark:text-gray-400 mb-4">
                    <a href="{{ url('/') }}" class="hover:text-[#E60000] transition-colors">Beranda</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#E60000] font-semibold">Daftar Kamar</span>
                </nav>
                <div class="text-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-[#E60000] dark:text-[#FF6B6B] mb-3">Daftar Kamar</h1>
                    <p class="text-lg text-[#666666] dark:text-gray-400">Pilih kamar yang sesuai dengan kebutuhan dan budget
                        Anda</p>
                </div>
            </div>

            <!-- Filter / Pencarian -->
            <div
                class="mb-8 flex flex-wrap gap-4 justify-between items-center bg-[#F2F2F2] dark:bg-gray-700 p-4 rounded-2xl">
                <!-- Slider Range Harga - Sebelah Kiri -->
                <div class="flex-1 min-w-[200px]">
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-semibold text-[#333333] dark:text-white">Harga:</span>
                        <div class="flex-1">
                            <input type="range" min="50000" max="10000000" step="50000" value="5000000"
                                class="w-full h-2 bg-[#FFD4D4] dark:bg-gray-600 rounded-lg appearance-none cursor-pointer accent-[#E60000]">
                        </div>
                        <span class="text-sm font-semibold text-[#E60000] dark:text-[#FF6B6B] min-w-[80px]">Rp
                            5.000.000</span>
                    </div>
                    <div class="flex justify-between text-xs text-[#666666] dark:text-gray-400 mt-1 px-1">
                        <span>Rp 50.000</span>
                        <span>Rp 10.000.000</span>
                    </div>
                </div>

                <!-- Filter Status - Sebelah Kanan -->
                <div class="flex flex-wrap gap-3">
                    <button
                        class="px-4 py-2 bg-[#E60000] text-white rounded-lg hover:bg-[#B71C1C] transition-colors text-sm font-semibold">Semua</button>
                    <button
                        class="px-4 py-2 bg-white dark:bg-gray-600 text-[#333333] dark:text-white rounded-lg hover:bg-[#E60000] hover:text-white transition-colors text-sm font-semibold shadow-sm flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        Tersedia
                    </button>
                    
                </div>
            </div>

            <!-- Grid Card Kamar -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Card 1 - Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Kamar Deluxe"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Deluxe</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Hotel Grand • Jakarta Pusat</p>
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
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Kamar Suite"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Suite</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Villa Mewah • Bali</p>
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
                        <img src="{{ asset('landingpage/guest-house.jpg') }}" alt="Kamar Standard"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500 grayscale">
                        <span
                            class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tidak Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Standard</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Guest House • Bandung</p>
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
                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Kamar Eksekutif"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Eksekutif</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Hotel Bintang 3 • Surabaya</p>
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

                <!-- Card 5 - Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/villa.jpg') }}" alt="Kamar Premium"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500">
                        <span
                            class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Premium</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Villa Exclusive • Lombok</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 1.200.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-[#E60000] text-white py-2.5 rounded-lg hover:bg-[#B71C1C] transition-colors text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 6 - Tidak Tersedia -->
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#F2F2F2] dark:border-gray-600 opacity-75">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('landingpage/guest-house.jpg') }}" alt="Kamar Ekonomis"
                            class="w-full h-56 object-cover hover:scale-110 transition-transform duration-500 grayscale">
                        <span
                            class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tidak Tersedia
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-[#333333] dark:text-white text-lg mb-1">Kamar Ekonomis</h3>
                        <p class="text-[#666666] dark:text-gray-400 text-sm mb-2">Guest House • Yogyakarta</p>
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-[#E60000] font-bold text-xl">Rp 120.000</span>
                                <span class="text-[#666666] dark:text-gray-400 text-xs">/malam</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block w-full text-center bg-gray-400 text-white py-2.5 rounded-lg cursor-not-allowed text-sm font-semibold">
                            Tidak Tersedia
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2 mt-12">
                <a href="#"
                    class="px-4 py-2 border border-[#FFD4D4] dark:border-gray-600 rounded-lg hover:bg-[#E60000] hover:text-white hover:border-[#E60000] transition-colors text-[#666666] dark:text-gray-400 font-medium">Sebelumnya</a>
                <a href="#" class="px-4 py-2 bg-[#E60000] text-white rounded-lg font-medium">1</a>
                <a href="#"
                    class="px-4 py-2 border border-[#FFD4D4] dark:border-gray-600 rounded-lg hover:bg-[#E60000] hover:text-white hover:border-[#E60000] transition-colors text-[#666666] dark:text-gray-400 font-medium">2</a>
                <a href="#"
                    class="px-4 py-2 border border-[#FFD4D4] dark:border-gray-600 rounded-lg hover:bg-[#E60000] hover:text-white hover:border-[#E60000] transition-colors text-[#666666] dark:text-gray-400 font-medium">3</a>
                <span class="px-2 text-[#666666] dark:text-gray-400">...</span>
                <a href="#"
                    class="px-4 py-2 border border-[#FFD4D4] dark:border-gray-600 rounded-lg hover:bg-[#E60000] hover:text-white hover:border-[#E60000] transition-colors text-[#666666] dark:text-gray-400 font-medium">10</a>
                <a href="#"
                    class="px-4 py-2 border border-[#FFD4D4] dark:border-gray-600 rounded-lg hover:bg-[#E60000] hover:text-white hover:border-[#E60000] transition-colors text-[#666666] dark:text-gray-400 font-medium">Selanjutnya</a>
            </div>

            <!-- Info Jumlah -->
            <div class="text-center mt-6 text-sm text-[#666666] dark:text-gray-400">
                Menampilkan 4 dari 6 kamar tersedia
            </div>
        </div>
    </section>


    <style>
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Custom Range Slider */
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #E60000;
            cursor: pointer;
            transition: all 0.2s;
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.2);
            background: #B71C1C;
        }

        input[type="range"]::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #E60000;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        input[type="range"]::-moz-range-thumb:hover {
            transform: scale(1.2);
            background: #B71C1C;
        }

        input[type="range"]:focus {
            outline: none;
        }
    </style>

    <script>
        // Update harga saat slider digeser
        document.addEventListener('DOMContentLoaded', function () {
            const rangeInput = document.querySelector('input[type="range"]');
            const priceDisplay = document.querySelector('.min-w-\\[80px\\]');

            if (rangeInput && priceDisplay) {
                rangeInput.addEventListener('input', function () {
                    const value = parseInt(this.value);
                    const formatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(value);
                    priceDisplay.textContent = formatted;
                });
            }
        });
    </script>

@endsection