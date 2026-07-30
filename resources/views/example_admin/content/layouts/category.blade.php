@extends('example_admin.layouts.default.dashboard')
@section('content')

    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-1" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <!-- Breadcrumb items can be added here -->
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Kategori Produk</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search & Hapus Filter -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('admin.categories.index') }}" method="GET"
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
                            <input type="text" name="keyword" id="products-search" value="{{ request('keyword') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                placeholder="Cari kategori...">
                        </div>
                        <button type="submit" class="hidden">Cari</button>
                    </form>

                    @if(request('keyword'))
                        <a href="{{ route('admin.categories.index') }}"
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
                    <a href="{{ route('admin.categories.create') }}"
                        class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] focus:outline-none dark:focus:ring-[#5996FF] inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah kategori baru
                    </a>
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
                                    Nama Kategori
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Deskripsi
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($categories as $index => $category)
                                <tr>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $categories->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $category->name }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[150px]">
                                        <div class="relative inline-block w-full">
                                            <span class="block truncate cursor-help description-text"
                                                data-fulltext="{{ $category->description ?? '-' }}">
                                                {{ $category->description ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-1.5">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="inline-flex items-center justify-center min-w-[60px] px-3 py-1.5 text-xs font-medium text-white bg-[#3874FF] rounded-lg hover:bg-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#5996FF] dark:focus:ring-[#5996FF]">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                                class="delete-form m-0 p-0" data-category-name="{{ $category->name }}"
                                                data-category-id="{{ $category->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-btn inline-flex items-center justify-center min-w-[60px] px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center p-6 text-xs text-gray-500 dark:text-gray-400">
                                        @if(request('keyword'))
                                            Tidak ada kategori dengan nama "{{ request('keyword') }}"
                                        @else
                                            Belum ada data kategori.
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

    <!-- Pagination - Diletakkan di Kanan -->
    @if(method_exists($categories, 'hasPages') && $categories->hasPages())
        <div class="p-4 bg-white border-t border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $categories->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $categories->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $categories->total() }}</span>
                    data
                    @if(request('keyword'))
                        <span class="text-[#1B4EF5] dark:text-[#3874FF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Tambahkan Alpine.js untuk dropdown jika diperlukan -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection

<!-- Script SweetAlert2 untuk konfirmasi hapus dan tooltip -->
<script>
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

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('.delete-form');
                const categoryName = form.dataset.categoryName || 'kategori ini';
                const categoryId = form.dataset.categoryId;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus kategori "${categoryName}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#1B4EF5',
                    confirmButtonText: 'Ya, hapus!',
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
    });

    // Tampilkan notifikasi sukses jika ada session success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Tampilkan notifikasi error jika ada session error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

<style>
    /* Dark mode support untuk global tooltip */
    .dark .global-tooltip {
        background: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    /* Pagination styling - Diletakkan di Kanan dengan Button Biru */
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

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            padding: 4px 10px;
            font-size: 12px;
            min-width: 30px;
        }
    }

    /* Cursor helper */
    .cursor-help {
        cursor: help;
    }
</style>