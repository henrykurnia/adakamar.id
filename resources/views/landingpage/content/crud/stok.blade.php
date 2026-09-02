@extends('example.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Transaksi Stok</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search & Hapus Filter -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('stock-transactions.index') }}" method="GET"
                        id="searchForm">
                        <div class="relative w-full sm:w-64 xl:w-96">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#5996FF] dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="transaction-search" value="{{ request('keyword') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                placeholder="Cari transaksi...">
                        </div>
                        <button type="submit" class="hidden">Cari</button>
                    </form>

                    @if(request('keyword'))
                        <a href="{{ route('stock-transactions.index') }}"
                            class="text-sm text-[#1B4EF5] hover:text-[#3874FF] dark:text-[#3874FF] dark:hover:text-[#5996FF] whitespace-nowrap">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            Hapus Filter
                        </a>
                    @endif
                </div>

                <!-- Bagian Kanan: Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <a href="{{ route('stock-transactions.create') }}"
                        class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] focus:outline-none dark:focus:ring-[#5996FF] inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert untuk stok minus -->
    @php
        $hasNegativeStock = false;
        $negativeProducts = [];
        foreach ($transactions as $transaction) {
            if (isset($transaction->product) && $transaction->product->stock < 0) {
                $hasNegativeStock = true;
                $negativeProducts[] = $transaction->product->name . ' (Stok: ' . $transaction->product->stock . ')';
            }
        }
        $negativeProducts = array_unique($negativeProducts);
    @endphp

    @if($hasNegativeStock)
        <div class="p-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 dark:bg-red-900 dark:text-red-300 dark:border-red-700"
                role="alert">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-red-700 dark:text-red-300" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-bold">Peringatan Stok Minus!</p>
                        <p class="text-sm">Terdapat produk dengan stok negatif. Segera lakukan penyesuaian stok!</p>
                        <div class="mt-2">
                            <p class="text-sm font-semibold">Produk dengan stok minus:</p>
                            <ul class="list-disc list-inside text-sm mt-1">
                                @foreach($negativeProducts as $product)
                                    <li>{{ $product }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button onclick="showStockWarning()"
                            class="mt-3 inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-[#E8D5F5] table-fixed dark:divide-gray-600">
                        <thead class="bg-[#F5F0FF] dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF] w-[60px]">
                                    No
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Nama Produk
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    SKU
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Tipe
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Jumlah
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Catatan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($transactions as $index => $transaction)
                                @php
                                    $currentStock = $transaction->product->stock ?? 0;
                                    $isStockNegative = $currentStock < 0;

                                    $statusBadge = match ($transaction->status) {
                                        'Pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
                                        'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        'Dikeluarkan' => 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };

                                    $typeBadge = match ($transaction->type) {
                                        'Masuk' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Keluar' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <tr
                                    class="hover:bg-[#F5F0FF] dark:hover:bg-gray-700 transition-colors duration-200 {{ $isStockNegative ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $transactions->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->product->name ?? 'Produk tidak ditemukan' }}
                                        @if($isStockNegative)
                                            <span
                                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                Stok Minus
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $transaction->product->sku ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $typeBadge }}">
                                            {{ $transaction->type }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($transaction->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $statusBadge }}">
                                            {{ $transaction->status ?? 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y ') }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[150px]">
                                        <div class="relative inline-block w-full">
                                            <span class="block truncate cursor-help description-text"
                                                data-fulltext="{{ $transaction->notes ?? '-' }}">
                                                {{ $transaction->notes ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-1.5">
                                            <a href="{{ route('stock-transactions.edit', $transaction->id) }}"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-white bg-[#3874FF] rounded-lg hover:bg-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#5996FF] dark:focus:ring-[#5996FF] min-w-[60px]">
                                                Edit
                                            </a>
                                            <form action="{{ route('stock-transactions.destroy', $transaction->id) }}"
                                                method="POST" class="inline-block delete-form m-0 p-0"
                                                data-transaction-name="{{ $transaction->product->name ?? 'Transaksi' }}"
                                                data-transaction-id="{{ $transaction->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[60px]">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center p-8 text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-[#5996FF] dark:text-gray-600 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-medium">
                                            @if(request('keyword'))
                                                Tidak ada transaksi dengan produk "{{ request('keyword') }}"
                                            @else
                                                Belum ada data transaksi
                                            @endif
                                        </p>
                                        @if(!request('keyword'))
                                            <p class="text-xs mt-1">Klik tombol "Tambah Transaksi Baru" untuk menambahkan</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($transactions, 'hasPages') && $transactions->hasPages())
        <div class="p-4 bg-white border-t border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $transactions->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $transactions->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $transactions->total() }}</span>
                    data
                    @if(request('keyword'))
                        <span class="text-[#1B4EF5] dark:text-[#3874FF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection

<script>
    // Fungsi untuk menampilkan detail stok minus
    function showStockWarning() {
        Swal.fire({
            title: 'Peringatan Stok Minus',
            html: `
                <div class="text-left">
                    <p class="mb-2 text-red-600 font-bold">Terdapat produk dengan stok negatif!</p>
                    <div class="bg-red-50 dark:bg-red-900/30 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Stok negatif dapat menyebabkan masalah dalam manajemen inventaris.
                        </p>
                        <ul class="mt-2 space-y-1">
                            @php
                                $negativeList = [];
                                foreach ($transactions as $transaction) {
                                    if (isset($transaction->product) && $transaction->product->stock < 0) {
                                        $negativeList[$transaction->product->id] = [
                                            'name' => $transaction->product->name,
                                            'sku' => $transaction->product->sku,
                                            'stock' => $transaction->product->stock
                                        ];
                                    }
                                }
                            @endphp
                            @foreach($negativeList as $product)
                                <li class="text-sm text-red-700 dark:text-red-300">
                                    • <strong>{{ $product['name'] }}</strong> 
                                    (SKU: {{ $product['sku'] }}) 
                                    - Stok: <span class="font-bold">{{ number_format($product['stock'], 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 p-2 bg-yellow-50 dark:bg-yellow-900/30 rounded border border-yellow-200 dark:border-yellow-700">
                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                <strong>Saran:</strong> Segera lakukan penyesuaian stok atau tambahkan stok masuk untuk produk di atas.
                            </p>
                        </div>
                    </div>
                </div>
            `,
            icon: 'warning',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK, Saya Mengerti',
            width: 600
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // ========== TOOLTIP GLOBAL ==========
        const tooltip = document.createElement('div');
        tooltip.className = 'global-tooltip hidden';
        tooltip.style.cssText = `
            position: fixed;
            z-index: 99999;
            background: #1f2937;
            color: white;
            font-size: 0.75rem;
            padding: 10px 14px;
            border-radius: 8px;
            max-width: 400px;
            min-width: 200px;
            word-wrap: break-word;
            white-space: normal;
            line-height: 1.5;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3), 0 4px 6px -2px rgba(0,0,0,0.2);
            pointer-events: none;
            transition: opacity 0.2s ease;
        `;
        document.body.appendChild(tooltip);

        const descriptionElements = document.querySelectorAll('.description-text');

        descriptionElements.forEach(function (element) {
            const fullText = element.getAttribute('data-fulltext');
            // Cek apakah teks overflow
            const isOverflowing = element.scrollWidth > element.clientWidth;

            if (isOverflowing && fullText) {
                element.addEventListener('mouseenter', function (e) {
                    const rect = element.getBoundingClientRect();
                    const text = this.getAttribute('data-fulltext');

                    tooltip.textContent = text;
                    tooltip.classList.remove('hidden');

                    let top = rect.top - 10;
                    let left = rect.left;

                    if (top < 50) {
                        top = rect.bottom + 10;
                    }

                    const tooltipWidth = Math.min(400, text.length * 7 + 30);
                    if (left + tooltipWidth > window.innerWidth - 20) {
                        left = window.innerWidth - tooltipWidth - 20;
                    }
                    if (left < 20) {
                        left = 20;
                    }

                    tooltip.style.top = top + 'px';
                    tooltip.style.left = left + 'px';
                    tooltip.style.opacity = '1';
                });

                element.addEventListener('mouseleave', function () {
                    tooltip.classList.add('hidden');
                    tooltip.style.opacity = '0';
                });
            }
        });

        // ========== LIVE SEARCH ==========
        const searchInput = document.getElementById('transaction-search');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    searchForm.submit();
                }, 500);
            });

            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });

            // Clear search with Escape key
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && this.value !== '') {
                    this.value = '';
                    searchForm.submit();
                }
            });
        }

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('.delete-form');
                const transactionName = form.dataset.transactionName || 'transaksi ini';

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <div class="text-left">
                            <p class="mb-2">Apakah Anda yakin ingin menghapus transaksi stok ini?</p>
                            <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <span class="font-bold">Nama Produk:</span> 
                                    <span class="text-gray-900 dark:text-white">"${transactionName}"</span>
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <span class="text-yellow-500">Perhatian:</span> Data yang dihapus tidak dapat dikembalikan!
                                </p>
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#1B4EF5',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    }
                });
            });
        });

        // ========== AUTO SHOW WARNING ==========
        @if($hasNegativeStock)
            setTimeout(function () {
                showStockWarning();
            }, 1000);
        @endif

        // ========== NOTIFICATIONS ==========
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor: '#1B4EF5',
                confirmButtonText: 'OK',
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK',
                timerProgressBar: true
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>

<style>
    /* Dark mode support untuk global tooltip */
    .dark .global-tooltip {
        background: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    /* Pagination styling - Konsisten dengan halaman lain */
    .pagination {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #1B4EF5;
        background-color: #F5F0FF;
        border: 1px solid #E8D5F5;
        transition: all 0.2s ease;
        text-decoration: none;
        min-width: 36px;
    }

    .pagination .page-link:hover {
        background-color: #1B4EF5;
        border-color: #1B4EF5;
        color: #ffffff;
        text-decoration: none;
    }

    .pagination .active .page-link {
        background-color: #1B4EF5;
        border-color: #1B4EF5;
        color: #ffffff;
    }

    .pagination .active .page-link:hover {
        background-color: #3874FF;
        border-color: #3874FF;
        color: #ffffff;
    }

    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f3f4f6;
        color: #9CA3AF;
        pointer-events: none;
    }

    .dark .pagination .page-link {
        background-color: #1f2937;
        border-color: #374151;
        color: #3874FF;
    }

    .dark .pagination .page-link:hover {
        background-color: #3874FF;
        border-color: #3874FF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link {
        background-color: #3874FF;
        border-color: #3874FF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link:hover {
        background-color: #1B4EF5;
        border-color: #1B4EF5;
        color: #ffffff;
    }

    .dark .pagination .disabled .page-link {
        background-color: #374151;
        color: #6B7280;
    }

    @media (max-width: 640px) {
        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            padding: 4px 10px;
            font-size: 12px;
            min-width: 30px;
        }

        /* Batasi lebar search bar di mobile */
        .flex-1 {
            flex: 1 1 auto;
            min-width: 0;
            max-width: 100%;
        }

        .flex-1 .relative {
            max-width: 100%;
        }
    }

    /* Cursor helper */
    .cursor-help {
        cursor: help;
    }
</style>