@extends('example.layouts.default.dashboard')
@section('content')

    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Laporan Stok Barang</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('reports.stock') }}" method="GET" id="searchForm">
                        <div class="relative w-full sm:w-64 xl:w-96">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#5996FF] dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="products-search" value="{{ request('keyword') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                placeholder="Cari produk...">
                        </div>
                        <button type="submit" class="hidden">Cari</button>
                    </form>

                    @if(request('keyword') || request('category'))
                        <a href="{{ route('reports.stock') }}"
                            class="text-sm text-[#1B4EF5] hover:text-[#3874FF] dark:text-[#3874FF] dark:hover:text-[#5996FF] whitespace-nowrap">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            Hapus Filter
                        </a>
                    @endif
                </div>

                <!-- Bagian Kanan: Filter Kategori & Export -->
                <div class="flex items-center gap-2 w-full sm:w-auto flex-wrap sm:flex-nowrap">
                    <form action="{{ route('reports.stock') }}" method="GET"
                        class="flex items-center gap-2 w-full sm:w-auto" id="filterForm">
                        @if(request('keyword'))
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        @endif

                        <select id="category-filter" name="category" onchange="this.form.submit()"
                            class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px] min-w-[140px] flex-1 sm:flex-none">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Jarak antara filter dan export menggunakan gap pada parent -->
                        <button type="button"
                            class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-all duration-200 h-[38px] min-w-[140px] whitespace-nowrap flex-1 sm:flex-none"
                            id="exportButton">
                            <svg class="w-3.5 h-3.5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Excel
                        </button>
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
                                    Nama Produk
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Gambar
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    SKU
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Kategori
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Supplier
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Stok Saat Ini
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($products as $index => $product)
                                @php
                                    $isLowStock = $product->stock <= $product->minimum_stock && $product->minimum_stock > 0;
                                    $isOutOfStock = $product->stock <= 0;
                                @endphp
                                <tr
                                    class="{{ $isOutOfStock ? 'bg-red-50 dark:bg-red-900/20' : ($isLowStock ? 'bg-yellow-50 dark:bg-yellow-900/20' : '') }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $products->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $product->name }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-12 h-12 object-cover rounded">
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $product->category->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $product->supplier->name ?? '-' }}
                                    </td>
                                    <td
                                        class="p-4 text-xs font-semibold 
                                                        {{ $isOutOfStock ? 'text-red-600 dark:text-red-400' : ($isLowStock ? 'text-yellow-600 dark:text-yellow-400' : 'text-gray-900 dark:text-white') }}">
                                        {{ number_format($product->stock, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-6 text-xs text-gray-500 dark:text-gray-400">
                                        @if(request('keyword'))
                                            Tidak ada produk dengan nama "{{ request('keyword') }}"
                                        @elseif(request('category'))
                                            Tidak ada produk pada kategori ini
                                        @else
                                            Belum ada data produk.
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
    @if(method_exists($products, 'hasPages') && $products->hasPages())
        <div class="p-4 bg-white border-t border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $products->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $products->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span>
                    data
                    @if(request('keyword'))
                        <span class="text-[#1B4EF5] dark:text-[#3874FF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Form untuk export (hidden) -->
    <form id="exportForm" action="{{ route('reports.stock.export') }}" method="GET" target="_blank">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
    </form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== LIVE SEARCH ==========
        const searchInput = document.getElementById('products-search');
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

        // ========== FILTER KATEGORI ==========
        const categoryFilter = document.getElementById('category-filter');
        const filterForm = document.getElementById('filterForm');

        if (categoryFilter) {
            categoryFilter.addEventListener('change', function () {
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
                    text: 'Anda akan mengekspor data laporan stok ke Excel. Lanjutkan?',
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

        /* Mobile: buat filter dan export full width */
        #filterForm {
            width: 100%;
        }

        #category-filter,
        #exportButton {
            flex: 1;
            min-width: 0;
            width: 100%;
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

    /* Memastikan select dan button sejajar */
    #category-filter,
    #exportButton {
        display: inline-flex;
        align-items: center;
        vertical-align: middle;
    }
</style>