@extends('example.layouts.default.dashboard')
@section('content')

    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Laporan Barang Masuk</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Filter Form -->
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <form class="flex flex-wrap items-center gap-2 w-full sm:w-auto" action="{{ route('reports.stock-in') }}"
                        method="GET" id="filterForm">
                        <!-- Search Keyword -->
                        <div class="relative flex-1 sm:w-64 xl:w-96 min-w-[180px]">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#5996FF] dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="products-search" value="{{ request('keyword') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px]"
                                placeholder="Cari produk...">
                        </div>

                        <!-- Filter Tanggal -->
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px] w-[140px]"
                            placeholder="Tanggal">

                        <!-- Filter Bulan -->
                        <input type="month" name="month" value="{{ request('month') }}"
                            class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px] w-[140px]"
                            placeholder="Bulan">

                        <!-- Filter Supplier -->
                        <select name="supplier"
                            class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px] min-w-[130px]">
                            <option value="">Semua Supplier</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ request('supplier') == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tombol Filter -->
                        <button type="submit"
                            class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF] h-[38px] whitespace-nowrap">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filter
                        </button>

                        <!-- Tombol Reset -->
                        @if(request('keyword') || request('supplier') || request('date') || request('month'))
                            <a href="{{ route('reports.stock-in') }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm text-[#1B4EF5] hover:text-[#3874FF] dark:text-[#3874FF] dark:hover:text-[#5996FF] h-[38px] border border-[#E8D5F5] rounded-lg hover:bg-[#F5F0FF] dark:border-gray-600 dark:hover:bg-gray-700 transition-all duration-200 whitespace-nowrap">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        @endif
                        <!-- Bagian Kanan: Export Button -->
                        <div class="flex items-center w-full sm:w-auto sm:justify-end">
                            <button type="button"
                                class="inline-flex items-center justify-center px-4 py-2 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-all duration-200 h-[38px] w-full sm:w-[140px] whitespace-nowrap"
                                id="exportButton">
                                <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Export Excel
                            </button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

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
                                    Tanggal Transaksi
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Nama Produk
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Supplier
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Jumlah
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($transactions as $index => $transaction)
                                @php
    $statusBadge = match ($transaction->status) {
        'Pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
        'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
        'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
    };
                                @endphp
                                <tr>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $transactions->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $transaction->product->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $transaction->product->supplier->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ number_format($transaction->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $statusBadge }}">
                                            {{ $transaction->status ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-xs text-gray-500 dark:text-gray-400">
                                        @if(request('keyword') || request('supplier') || request('date') || request('month'))
                                            Tidak ada transaksi barang masuk dengan filter yang dipilih
                                        @else
                                            Belum ada data transaksi barang masuk.
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

    <!-- Form untuk export (hidden) -->
    <form id="exportForm" action="{{ route('reports.stock-in.export') }}" method="GET" target="_blank">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <input type="hidden" name="month" value="{{ request('month') }}">
        <input type="hidden" name="supplier" value="{{ request('supplier') }}">
        <input type="hidden" name="product" value="{{ request('product') }}">
    </form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== LIVE SEARCH ==========
        const searchInput = document.getElementById('products-search');
        const filterForm = document.getElementById('filterForm');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    filterForm.submit();
                }, 500);
            });

            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    filterForm.submit();
                }
            });

            // Clear search with Escape key
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && this.value !== '') {
                    this.value = '';
                    filterForm.submit();
                }
            });
        }

        // ========== AUTO SUBMIT DATE CHANGE ==========
        const dateInput = document.querySelector('input[name="date"]');
        if (dateInput) {
            dateInput.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        // ========== AUTO SUBMIT MONTH CHANGE ==========
        const monthInput = document.querySelector('input[name="month"]');
        if (monthInput) {
            monthInput.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        // ========== AUTO SUBMIT SUPPLIER CHANGE ==========
        const supplierSelect = document.querySelector('select[name="supplier"]');
        if (supplierSelect) {
            supplierSelect.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        // ========== EXPORT BUTTON ==========
        const exportButton = document.getElementById('exportButton');
        const exportForm = document.getElementById('exportForm');

        if (exportButton && exportForm) {
            exportButton.addEventListener('click', function (e) {
                e.preventDefault();

                // Konfirmasi export
                Swal.fire({
                    title: 'Konfirmasi Ekspor',
                    text: 'Anda akan mengekspor data laporan barang masuk ke Excel. Lanjutkan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1B4EF5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Export!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form export
                        exportForm.submit();
                    }
                });
            });
        }
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('export_success'))
        Swal.fire({
            icon: 'success',
            title: 'Ekspor Berhasil!',
            text: '{{ session('export_success') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#1B4EF5',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('export_error'))
        Swal.fire({
            icon: 'error',
            title: 'Ekspor Gagal!',
            text: '{{ session('export_error') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    @endif
</script>

<style>
    /* Pagination styling */
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

        #filterForm .flex-wrap {
            width: 100%;
        }
        
        #filterForm input,
        #filterForm select,
        #filterForm button,
        #filterForm a {
            width: 100% !important;
            min-width: unset !important;
        }
    }

    /* Export button hover effect */
    #exportButton {
        transition: all 0.3s ease;
    }

    #exportButton:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.4);
    }

    #exportButton:active {
        transform: translateY(0);
    }

    /* Memastikan semua elemen filter memiliki height yang sama */
    #filterForm input,
    #filterForm select,
    #filterForm button,
    #filterForm a {
        height: 38px;
        display: inline-flex;
        align-items: center;
    }
</style>