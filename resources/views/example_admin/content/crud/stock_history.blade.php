@extends('example_admin.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-1">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Riwayat Transaksi Stok</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Menampilkan seluruh riwayat transaksi stok</p>
            </div>
        </div>
    </div>

    <!-- Filter Tanggal dan Search -->
    <div class="p-4 bg-white border-b border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
        <form method="GET" action="{{ route('admin.stock-history.index') }}" class="flex flex-wrap items-center gap-3" id="filterForm">
            <input type="date" name="date" value="{{ request('date') }}"
                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">

            <input type="text" name="keyword" value="{{ request('keyword') }}"
                placeholder="Cari produk..."
                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block px-3 py-2 w-48 sm:w-64 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">

            <button type="submit"
                class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-4 py-2 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                    </path>
                </svg>
                Filter
            </button>

            @if(request('date') || request('keyword'))
                <a href="{{ route('admin.stock-history.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Riwayat Stok -->
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
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Produk
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Jenis
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
                                    Catatan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($histories as $index => $history)
                                @php
                                    $statusBadge = match ($history->status) {
                                        'Pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
                                        'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        'Dikeluarkan' => 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };

                                    $typeBadge = match ($history->type) {
                                        'Masuk' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Keluar' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <tr class="hover:bg-[#F5F0FF] dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $histories->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($history->date)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $history->product->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $typeBadge }}">
                                            {{ ucfirst($history->type) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ number_format($history->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $statusBadge }}">
                                            {{ ucfirst($history->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[150px]">
                                        <div class="relative inline-block w-full">
                                            <span class="block truncate cursor-help description-text"
                                                data-fulltext="{{ $history->notes ?? '-' }}">
                                                {{ $history->notes ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-8 text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-[#5996FF] dark:text-gray-600 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-medium">Tidak ada data riwayat stok</p>
                                        @if(request('date') || request('keyword'))
                                            <p class="text-xs mt-1">
                                                @if(request('date') && request('keyword'))
                                                    Tidak ada data pada tanggal {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }} dengan produk "{{ request('keyword') }}"
                                                @elseif(request('date'))
                                                    Tidak ada data pada tanggal {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}
                                                @elseif(request('keyword'))
                                                    Tidak ada data dengan produk "{{ request('keyword') }}"
                                                @endif
                                            </p>
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

    <!-- Pagination dengan Styling Standar Laravel -->
    @if(method_exists($histories, 'hasPages') && $histories->hasPages())
        <div class="p-4 bg-white border-t border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan 
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $histories->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $histories->lastItem() ?? 0 }}</span> 
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $histories->total() }}</span> 
                    data
                </div>
                <div>
                    {{ $histories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        const searchInput = document.querySelector('input[name="keyword"]');
        const filterForm = document.getElementById('filterForm');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    filterForm.submit();
                }, 500);
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    filterForm.submit();
                }
            });
        }

        // ========== AUTO SUBMIT DATE CHANGE ==========
        const dateInput = document.querySelector('input[name="date"]');
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                filterForm.submit();
            });
        }
    });

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
</script>

<style>
    /* Dark mode support untuk global tooltip */
    .dark .global-tooltip {
        background: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    /* Pagination styling - Standar Laravel dengan Button Biru di Kanan */
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