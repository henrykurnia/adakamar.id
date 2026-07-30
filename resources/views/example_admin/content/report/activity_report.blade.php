@extends('example_admin.layouts.default.dashboard')
@section('content')

<!-- Tambahkan SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- WRAPPER FULL WIDTH -->
<div class="w-full px-6 py-5">

    <!-- CONTAINER ATAS -->
    <div class="w-full bg-white dark:bg-gray-800 p-6 mb-6 rounded-xl shadow border border-[#E8D5F5] dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Laporan Aktivitas</h1>
            </div>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Filter Form -->
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <form class="flex flex-wrap items-center gap-2 w-full sm:w-auto" action="{{ route('admin.report.activity') }}" method="GET" id="filterForm">
                        <!-- Filter Tanggal -->
                        <div class="relative flex-1 sm:flex-none min-w-[140px]">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#5996FF] dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="date" name="date" id="date-filter" value="{{ request('date') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px]"
                                placeholder="Pilih Tanggal">
                        </div>

                        <!-- Filter User -->
                        <div class="flex-1 sm:flex-none min-w-[130px]">
                            <select name="user" id="user-filter"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px]">
                                <option value="">Semua User</option>
                                @foreach($users as $usr)
                                    <option value="{{ $usr->id }}" {{ request('user') == $usr->id ? 'selected' : '' }}>
                                        {{ $usr->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Aktivitas -->
                        <div class="flex-1 sm:flex-none min-w-[130px]">
                            <select name="activity" id="activity-filter"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-xs rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full py-1.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px]">
                                <option value="">Semua Aktivitas</option>
                                <option value="Produk" {{ request('activity') == 'Produk' ? 'selected' : '' }}>Produk</option>
                                <option value="Transaksi" {{ request('activity') == 'Transaksi' ? 'selected' : '' }}>Transaksi</option>
                                <option value="Stock Opname" {{ request('activity') == 'Stock Opname' ? 'selected' : '' }}>Stock Opname</option>
                            </select>
                        </div>

                        <!-- Tombol Filter -->
                        <button type="submit"
                            class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#5996FF] font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-[#3874FF] dark:hover:bg-[#5996FF] focus:outline-none dark:focus:ring-[#1B4EF5] h-[38px] whitespace-nowrap">
                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>

                        <!-- Reset Filter -->
                        @if(request('date') || request('user') || request('activity'))
                            <a href="{{ route('admin.report.activity') }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm text-[#1B4EF5] hover:text-[#3874FF] dark:text-[#3874FF] dark:hover:text-[#5996FF] h-[38px] border border-[#E8D5F5] rounded-lg hover:bg-[#F5F0FF] dark:border-gray-600 dark:hover:bg-gray-700 transition-all duration-200 whitespace-nowrap">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Bagian Kanan: Total Aktivitas -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        Total: {{ $activities->total() ?? $activities->count() }} aktivitas
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTAINER TABEL -->
    <div class="w-full">
        <div class="overflow-x-auto">
            <div class="w-full">
                <div class="bg-white rounded-xl shadow border border-[#E8D5F5] overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                    <table class="w-full table-auto divide-y divide-[#E8D5F5] dark:divide-gray-700">
                        <thead class="bg-[#F5F0FF] dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF] w-[60px]">
                                    No
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF] w-[180px]">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Nama Pengguna
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Role
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Aktivitas
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Keterangan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($activities as $index => $activity)
                                <tr>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $activities->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($activity['tanggal'])->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $activity['user'] }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @php
                                            $roleBadge = match($activity['role'] ?? '') {
                                                'Admin' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                'Manajer Gudang' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'Staff Gudang' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                                            };
                                        @endphp
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleBadge }}">
                                            {{ $activity['role'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs">
                                        @php
                                            $badgeClass = match($activity['aktivitas']) {
                                                'Menambahkan Produk' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                'Transaksi Masuk' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'Transaksi Keluar' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                                'Stock Opname' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                                default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                                            };
                                        @endphp
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                            {{ $activity['aktivitas'] }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ $activity['keterangan'] }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-xs text-gray-500 dark:text-gray-400">
                                        @if(request('date') || request('user') || request('activity'))
                                            Tidak ada aktivitas dengan filter yang dipilih
                                        @else
                                            Belum ada data aktivitas.
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
    @if(isset($activities) && method_exists($activities, 'hasPages') && $activities->hasPages())
        <div class="mt-4 p-4 bg-white rounded-xl shadow border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $activities->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $activities->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $activities->total() }}</span>
                    data
                    @if(request('keyword'))
                        <span class="text-[#1B4EF5] dark:text-[#3874FF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $activities->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
<!-- END WRAPPER FULL WIDTH -->

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== AUTO SUBMIT FILTER ==========
        const dateFilter = document.getElementById('date-filter');
        const userFilter = document.getElementById('user-filter');
        const activityFilter = document.getElementById('activity-filter');
        const filterForm = document.getElementById('filterForm');

        // Auto submit untuk select
        if (userFilter) {
            userFilter.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        if (activityFilter) {
            activityFilter.addEventListener('change', function () {
                filterForm.submit();
            });
        }

        // Auto submit untuk date dengan debounce
        if (dateFilter) {
            let dateTimeout;
            dateFilter.addEventListener('input', function () {
                clearTimeout(dateTimeout);
                dateTimeout = setTimeout(function () {
                    filterForm.submit();
                }, 500);
            });
        }

        // ========== NOTIFICATION ==========
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
    });
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

        /* Filter elements full width on mobile */
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
        
        #filterForm .relative {
            width: 100% !important;
        }
    }
</style>