@extends('example.layouts.default.dashboard')
@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="p-6">

        {{-- Card Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

            <!-- Total Produk -->
            <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-[#F5F0FF] rounded-xl dark:bg-gray-700">
                        <svg class="w-6 h-6 text-[#1B4EF5] dark:text-[#3874FF]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">Total Produk</h3>
                        <p class="text-3xl font-bold text-[#1B4EF5] mt-1 dark:text-[#3874FF]">
                            {{ number_format($totalProducts, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Stok -->
            <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-xl dark:bg-blue-900/20">
                        <svg class="w-6 h-6 text-[#3874FF] dark:text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">Total Stok</h3>
                        <p class="text-3xl font-bold text-[#3874FF] mt-1 dark:text-[#5996FF]">
                            {{ number_format($totalStock, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stok Aman -->
            <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-green-50 rounded-xl dark:bg-green-900/20">
                        <svg class="w-6 h-6 text-[#5996FF] dark:text-[#3874FF]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 6.707 8.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">Stok Aman</h3>
                        <p class="text-3xl font-bold text-[#5996FF] mt-1 dark:text-[#3874FF]">
                            {{ number_format($safeStock, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stok Menipis -->
            <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-red-50 rounded-xl dark:bg-red-900/20">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">Stok Menipis</h3>
                        <p class="text-3xl font-bold text-red-600 mt-1 dark:text-red-400">
                            {{ number_format($lowStock, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>


        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Grafik --}}
            <div
                class="xl:col-span-2 bg-white rounded-xl shadow p-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">

                <h2 class="text-lg font-semibold mb-5 text-[#1B4EF5] dark:text-[#3874FF]">
                    Grafik Status Produk
                </h2>

                <div id="stock-chart"></div>

            </div>

            {{-- Statistik Transaksi --}}
            <div class="space-y-5">

                <div class="bg-white rounded-xl shadow p-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">

                    <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Barang Masuk
                    </h3>

                    <p class="text-4xl font-bold text-green-600 mt-3 dark:text-green-400">
                        {{ number_format($barangMasuk, 0, ',', '.') }}
                    </p>

                    <p class="text-sm text-gray-400 mt-2 dark:text-gray-500">
                        Transaksi diterima
                    </p>

                </div>

                <div class="bg-white rounded-xl shadow p-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">

                    <h3 class="text-gray-500 text-sm font-medium dark:text-gray-400">
                        Barang Keluar
                    </h3>

                    <p class="text-4xl font-bold text-red-600 mt-3 dark:text-red-400">
                        {{ number_format($barangKeluar, 0, ',', '.') }}
                    </p>

                    <p class="text-sm text-gray-400 mt-2 dark:text-gray-500">
                        Transaksi dikeluarkan
                    </p>

                </div>

            </div>

        </div>

        {{-- Produk Restock --}}
        <div class="bg-white rounded-xl shadow mt-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">

            <div class="p-5 border-b border-[#E8D5F5] dark:border-gray-700">

                <h2 class="font-semibold text-[#1B4EF5] dark:text-[#3874FF]">
                    Produk yang Perlu Restock
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-[#F5F0FF] dark:bg-gray-700">

                        <tr>

                            <th
                                class="px-4 py-3 text-left text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                Produk
                            </th>

                            <th
                                class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                Stok
                            </th>

                            <th
                                class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                Minimum
                            </th>

                            <th
                                class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($lowStockProducts as $product)

                            <tr
                                class="border-b border-[#E8D5F5] hover:bg-[#F5F0FF] transition-colors duration-200 dark:border-gray-700 dark:hover:bg-gray-700">

                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    {{ $product->name }}
                                </td>

                                <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                    {{ number_format($product->stock, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                    {{ number_format($product->minimum_stock, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium dark:bg-red-900 dark:text-red-300">

                                        Stok Menipis

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-5 text-gray-500 text-sm dark:text-gray-400">

                                    Semua stok aman.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            var options = {

                chart: {

                    type: 'bar',

                    height: 350,

                    background: 'transparent'

                },

                theme: {

                    mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'

                },

                series: [

                    {

                        name: 'Jumlah Produk',

                        data: [

                                  {{ $safeStock }},

                            {{ $lowStock }}

                        ]

                    }

                ],

                xaxis: {

                    categories: [

                        'Stok Aman',

                        'Stok Menipis'

                    ],

                    labels: {

                        style: {

                            colors: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'

                        }

                    }

                },

                yaxis: {

                    labels: {

                        style: {

                            colors: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'

                        }

                    }

                },

                grid: {

                    borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'

                },

                colors: [

                    '#1B4EF5'

                ]

            };

            let chart = new ApexCharts(

                document.querySelector("#stock-chart"),

                options

            );

            chart.render();

        });

    </script>

@endsection