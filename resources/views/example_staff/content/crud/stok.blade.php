@extends('example_staff.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Konfirmasi Transaksi Stok</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftar transaksi yang menunggu konfirmasi</p>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Filter Status -->
                <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <form class="flex flex-wrap items-center gap-2 w-full sm:w-auto" action="{{ route('stock-confirmation.index') }}" method="GET" id="filterForm">
                        <!-- Filter Status -->
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <label for="status-filter" class="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">Filter Status:</label>
                            <select id="status-filter" name="status" onchange="this.form.submit()"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] h-[38px] min-w-[150px] flex-1 sm:flex-none">
                                <option value="Pending" {{ request('status') == 'Pending' || !request('status') ? 'selected' : '' }}>
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pending
                                </option>
                                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Diterima
                                </option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Ditolak
                                </option>
                                <option value="Dikeluarkan" {{ request('status') == 'Dikeluarkan' ? 'selected' : '' }}>
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                    Dikeluarkan
                                </option>
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    Semua
                                </option>
                            </select>
                        </div>

                        <!-- Tombol Reset -->
                        @if(request('status') && request('status') != 'Pending')
                            <a href="{{ route('stock-confirmation.index') }}"
                                class="inline-flex items-center px-3 py-1.5 text-sm text-[#1B4EF5] hover:text-[#3874FF] dark:text-[#3874FF] dark:hover:text-[#5996FF] h-[38px] border border-[#E8D5F5] rounded-lg hover:bg-[#F5F0FF] dark:border-gray-600 dark:hover:bg-gray-700 transition-all duration-200 whitespace-nowrap">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Bagian Kanan (kosong) -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <!-- Kosong -->
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

                                    // Status badge
                                    $statusBadge = match ($transaction->status) {
                                        'Pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
                                        'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        'Dikeluarkan' => 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };

                                    $statusIcon = match ($transaction->status) {
                                        'Pending' => '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                        'Diterima' => '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
                                        'Ditolak' => '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
                                        'Dikeluarkan' => '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>',
                                        default => '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                    };

                                    $typeBadge = match ($transaction->type) {
                                        'Masuk' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                                        'Keluar' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                    $typeIcon = $transaction->type === 'Masuk' ? 
                                        '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>' : 
                                        '<svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>';
                                @endphp
                                <tr class="hover:bg-[#F5F0FF] dark:hover:bg-gray-700 transition-colors duration-200 {{ $isStockNegative ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $transactions->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->product->name ?? 'Produk tidak ditemukan' }}
                                        @if($isStockNegative)
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                                Stok Minus
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $transaction->product->sku ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $typeBadge }}">
                                            {!! $typeIcon !!} {{ $transaction->type }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs font-semibold text-gray-900 dark:text-white">
                                        {{ number_format($transaction->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-lg {{ $statusBadge }}">
                                            {!! $statusIcon !!} {{ $transaction->status ?? 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[150px]">
                                        <div class="relative inline-block w-full">
                                            <span class="block truncate cursor-help description-text"
                                                data-fulltext="{{ $transaction->notes ?? '-' }}">
                                                {{ $transaction->notes ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($transaction->status === 'Pending')
                                            <button type="button"
                                                class="confirm-btn inline-flex items-center justify-center min-w-[100px] h-10 px-4 text-sm font-medium text-white bg-[#3874FF] rounded-lg hover:bg-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#5996FF] dark:focus:ring-[#5996FF] transition-all duration-200"
                                                data-transaction-id="{{ $transaction->id }}"
                                                data-transaction-name="{{ $transaction->product->name ?? 'Transaksi' }}"
                                                data-transaction-type="{{ $transaction->type }}"
                                                data-transaction-quantity="{{ $transaction->quantity }}">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Konfirmasi
                                            </button>
                                        @else
                                            <span class="inline-flex items-center px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Terkonfirmasi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center p-8 text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-[#5996FF] dark:text-gray-600 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-sm font-medium">
                                            Tidak ada transaksi dengan status {{ request('status') ?? 'pending' }}
                                        </p>
                                        <p class="text-xs mt-1">Ubah filter untuk melihat transaksi lainnya</p>
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
                </div>
                <div>
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Form untuk konfirmasi (hidden) -->
    <form id="confirmForm" method="POST" style="display:none">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="confirmStatus">
    </form>

@endsection

@push('scripts')
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

            // ========== AUTO SUBMIT STATUS CHANGE ==========
            const statusFilter = document.getElementById('status-filter');
            const filterForm = document.getElementById('filterForm');

            if (statusFilter) {
                statusFilter.addEventListener('change', function () {
                    filterForm.submit();
                });
            }

            console.log('DOM loaded, inisialisasi event listener untuk tombol konfirmasi');

            // Ambil semua tombol konfirmasi
            const confirmButtons = document.querySelectorAll('.confirm-btn');

            confirmButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const transactionId = this.dataset.transactionId;
                    const transactionName = this.dataset.transactionName || 'transaksi ini';
                    const transactionType = this.dataset.transactionType || 'transaksi';
                    const transactionQuantity = this.dataset.transactionQuantity || 0;

                    console.log('Konfirmasi transaksi:', transactionId, transactionName);

                    // Tentukan pilihan status berdasarkan tipe
                    let statusOptions = [];

                    if (transactionType === 'Masuk') {
                        statusOptions = [
                            { value: 'Diterima', label: 'Diterima', color: 'green' },
                            { value: 'Ditolak', label: 'Ditolak', color: 'red' }
                        ];
                    } else if (transactionType === 'Keluar') {
                        statusOptions = [
                            { value: 'Dikeluarkan', label: 'Dikeluarkan', color: 'blue' },
                            { value: 'Ditolak', label: 'Ditolak', color: 'red' }
                        ];
                    } else {
                        statusOptions = [
                            { value: 'Diterima', label: 'Diterima', color: 'green' },
                            { value: 'Ditolak', label: 'Ditolak', color: 'red' },
                            { value: 'Dikeluarkan', label: 'Dikeluarkan', color: 'blue' }
                        ];
                    }

                    // Buat HTML untuk pilihan status
                    let statusButtonsHtml = statusOptions.map(opt =>
                        `<button class="status-option-btn w-full text-left px-4 py-3 text-sm hover:bg-[#F5F0FF] dark:hover:bg-gray-600 transition-colors duration-150 border-b border-[#E8D5F5] dark:border-gray-600 last:border-0 flex items-center" 
                                    data-status="${opt.value}" 
                                    data-color="${opt.color}">
                                <span class="mr-2">${opt.label}</span>
                                <span class="ml-auto text-xs text-gray-400">Pilih</span>
                            </button>`
                    ).join('');

                    // Tampilkan SweetAlert2
                    Swal.fire({
                        title: 'Konfirmasi Transaksi',
                        html: `
                            <div class="text-left">
                                <div class="bg-[#F5F0FF] dark:bg-gray-700 p-4 rounded-lg mb-4">
                                    <p class="mb-1"><strong>Produk:</strong> <span class="text-gray-900 dark:text-white">"${transactionName}"</span></p>
                                    <p class="mb-1"><strong>Tipe:</strong> <span class="font-semibold ${transactionType === 'Masuk' ? 'text-green-600' : 'text-red-600'}">${transactionType === 'Masuk' ? 'Masuk' : 'Keluar'}</span></p>
                                    <p><strong>Jumlah:</strong> <span class="font-bold">${transactionQuantity}</span> unit</p>
                                </div>
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih status konfirmasi:</p>
                                <div class="border border-[#E8D5F5] dark:border-gray-600 rounded-lg overflow-hidden">
                                    ${statusButtonsHtml}
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                                    <span class="text-yellow-500">⚠️</span> Perubahan status akan langsung mempengaruhi stok produk
                                </p>
                            </div>
                        `,
                        icon: 'question',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonColor: '#6b7280',
                        cancelButtonText: 'Batal',
                        width: 500,
                        customClass: {
                            container: 'swal2-confirm-stock'
                        },
                        didOpen: () => {
                            // Event listener untuk tombol status
                            document.querySelectorAll('.status-option-btn').forEach(btn => {
                                btn.addEventListener('click', function () {
                                    const status = this.dataset.status;
                                    const color = this.dataset.color;

                                    // Konfirmasi ulang sebelum submit
                                    Swal.fire({
                                        title: 'Konfirmasi Status',
                                        html: `
                                            <p>Anda akan mengubah status transaksi <strong>"${transactionName}"</strong> menjadi:</p>
                                            <div class="mt-3 p-3 rounded-lg bg-${color}-50 border border-${color}-200 dark:bg-${color}-900/30 dark:border-${color}-700">
                                                <span class="text-${color}-600 dark:text-${color}-400 font-bold text-lg">${this.textContent.trim()}</span>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">
                                                ${status === 'Diterima' ? 'Stok akan bertambah' :
                                                status === 'Dikeluarkan' ? 'Stok akan berkurang' :
                                                    'Stok tidak akan berubah'}
                                            </p>
                                        `,
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#1B4EF5',
                                        cancelButtonColor: '#6b7280',
                                        confirmButtonText: 'Ya, Konfirmasi!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Submit form
                                            const form = document.getElementById('confirmForm');
                                            form.action = `{{ url('stock-confirmation') }}/${transactionId}`;
                                            document.getElementById('confirmStatus').value = status;
                                            form.submit();

                                            Swal.fire({
                                                title: 'Memproses...',
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
                        }
                    });
                });
            });

            // Notifikasi session
            @if(session('success'))
                console.log('Notifikasi sukses:', '{{ session('success') }}');
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
                console.log('Notifikasi error:', '{{ session('error') }}');
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
                console.log('Error validasi:', {!! json_encode($errors->all()) !!});
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

@endpush