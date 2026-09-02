@extends('example.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#1B4EF5] lg:mt-1.5 dark:bg-gray-800 dark:border-[#3874FF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Stock Opname</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search & Hapus Filter -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('stock-opnames.index') }}" method="GET"
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
                            <input type="text" name="keyword" id="product-search" value="{{ request('keyword') }}"
                                class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                placeholder="Cari opname...">
                        </div>
                        <button type="submit" class="hidden">Cari</button>
                    </form>

                    @if(request('keyword'))
                        <a href="{{ route('stock-opnames.index') }}"
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
                    <a href="{{ route('stock-opnames.create') }}"
                        class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] focus:outline-none dark:focus:ring-[#5996FF] inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Opname
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
                                    Produk
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    SKU
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Stok Sistem
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Stok Fisik
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Selisih
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Catatan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($stockOpnames as $index => $opname)
                                @php
                                    $difference = $opname->difference ?? ($opname->physical_stock - $opname->system_stock);
                                @endphp
                                <tr class="hover:bg-[#F5F0FF] dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $stockOpnames->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $opname->product->name ?? 'Produk tidak ditemukan' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $opname->product->sku ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ number_format($opname->system_stock, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white">
                                        {{ number_format($opname->physical_stock, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($difference > 0)
                                            <span class="text-green-600 dark:text-green-400 font-bold">
                                                +{{ number_format($difference, 0, ',', '.') }}
                                            </span>
                                        @elseif($difference < 0)
                                            <span class="text-red-600 dark:text-red-400 font-bold">
                                                {{ number_format($difference, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 dark:text-gray-400">
                                                0
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[150px]">
                                        @if($opname->notes)
                                            <div class="relative inline-block w-full group">
                                                <span class="block truncate cursor-help">
                                                    {{ $opname->notes }}
                                                </span>
                                                <div
                                                    class="tooltip-box hidden group-hover:block absolute z-50 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 max-w-xs bottom-full left-0 mb-2 shadow-lg">
                                                    {{ $opname->notes }}
                                                    <div class="absolute -bottom-1 left-4 w-2 h-2 bg-gray-900 rotate-45"></div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500 italic">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($opname->opname_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-1.5">
                                            <!-- Tombol Edit -->
                                            <button onclick="openEditModal({{ $opname->id }})"
                                                class="inline-flex items-center justify-center min-w-[60px] px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3874FF] rounded-lg hover:bg-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#5996FF] dark:focus:ring-[#5996FF] transition-all duration-200">
                                                Edit
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('stock-opnames.destroy', $opname->id) }}" method="POST"
                                                class="inline-block delete-form m-0 p-0" data-opname-id="{{ $opname->id }}"
                                                data-product-name="{{ $opname->product->name ?? 'opname ini' }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-btn inline-flex items-center justify-center min-w-[60px] px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 transition-all duration-200">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center p-8 text-xs text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-[#5996FF] dark:text-gray-600 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-medium">
                                            @if(request('keyword'))
                                                Tidak ada data stock opname dengan produk "{{ request('keyword') }}"
                                            @else
                                                Belum ada data stock opname
                                            @endif
                                        </p>
                                        @if(!request('keyword'))
                                            <p class="text-xs mt-1">Klik tombol "Tambah Opname" untuk menambahkan</p>
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
    @if(method_exists($stockOpnames, 'hasPages') && $stockOpnames->hasPages())
        <div class="p-4 bg-white border-t border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $stockOpnames->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $stockOpnames->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $stockOpnames->total() }}</span>
                    data
                    @if(request('keyword'))
                        <span class="text-[#1B4EF5] dark:text-[#3874FF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $stockOpnames->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Form untuk update (hidden) -->
    <form id="editForm" method="POST" style="display:none">
        @csrf
        @method('PUT')
        <input type="hidden" name="system_stock" id="edit_system_stock">
        <input type="hidden" name="physical_stock" id="edit_physical_stock">
        <input type="hidden" name="notes" id="edit_notes">
        <input type="hidden" name="date" id="edit_date">
    </form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== LIVE SEARCH ==========
        const searchInput = document.getElementById('product-search');
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
                const productName = form.dataset.productName || 'opname ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `Anda akan menghapus data stock opname untuk produk <strong>"${productName}"</strong> secara permanen!<br><span class="text-sm text-yellow-500">Perhatian: Data yang dihapus tidak dapat dikembalikan.</span>`,
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

    // ========== MODAL EDIT ==========
    function openEditModal(opnameId) {
        // Fetch data opname menggunakan route yang benar
        fetch(`{{ route('stock-opnames.edit', ':id') }}`.replace(':id', opnameId))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const difference = data.difference || (data.physical_stock - data.system_stock);
                const productName = data.product ? data.product.name : 'Produk tidak ditemukan';
                const productSku = data.product ? data.product.sku : '-';
                // Format tanggal untuk input date (YYYY-MM-DD)
                const dateObj = new Date(data.opname_date);
                const formattedDate = dateObj.toISOString().split('T')[0];

                Swal.fire({
                    title: 'Edit Stock Opname',
                    html: `
                        <div class="text-left">
                            <div class="mb-4 p-3 bg-[#F5F0FF] dark:bg-gray-700 rounded-lg">
                                <p class="text-sm"><strong>Produk:</strong> <span class="text-gray-900 dark:text-white">${productName}</span></p>
                                <p class="text-sm"><strong>SKU:</strong> <span class="text-gray-500 dark:text-gray-400">${productSku}</span></p>
                            </div>
                            <div class="mb-3">
                                <label for="edit-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tanggal Opname <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="edit-date" 
                                    class="w-full px-3 py-2 border border-[#E8D5F5] rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] bg-[#F5F0FF] dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    value="${formattedDate}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-system-stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Stok Sistem <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="edit-system-stock" 
                                    class="w-full px-3 py-2 border border-[#E8D5F5] rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] bg-[#F5F0FF] dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Masukkan stok sistem" min="0" value="${data.system_stock}" required
                                    oninput="calculateEditDifference()">
                            </div>
                            <div class="mb-3">
                                <label for="edit-physical-stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Stok Fisik <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="edit-physical-stock" 
                                    class="w-full px-3 py-2 border border-[#E8D5F5] rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] bg-[#F5F0FF] dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Masukkan stok fisik" min="0" value="${data.physical_stock}" required
                                    oninput="calculateEditDifference()">
                            </div>
                            <div class="mb-3 p-3 rounded-lg" id="edit-difference-container">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Selisih:</span>
                                    <span id="edit-difference-value" class="text-sm font-bold ${difference > 0 ? 'text-green-600' : (difference < 0 ? 'text-red-600' : 'text-gray-500')}">
                                        ${difference > 0 ? '+' : ''}${difference}
                                    </span>
                                </div>
                                <div id="edit-difference-status" class="text-xs mt-1 ${difference > 0 ? 'text-green-600' : (difference < 0 ? 'text-red-600' : 'text-gray-500')}">
                                    ${difference > 0 ? 'Stok fisik lebih banyak' : (difference < 0 ? 'Stok fisik lebih sedikit' : 'Stok sesuai')}
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="edit-notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Catatan (Opsional)
                                </label>
                                <textarea id="edit-notes" rows="2" 
                                    class="w-full px-3 py-2 border border-[#E8D5F5] rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] bg-[#F5F0FF] dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Tambahkan catatan">${data.notes || ''}</textarea>
                            </div>
                            <div class="mt-3 p-2 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg border border-yellow-200 dark:border-yellow-700">
                                <p class="text-xs text-yellow-700 dark:text-yellow-300">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Perubahan akan langsung memperbarui data stock opname.
                                </p>
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1B4EF5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Update Opname',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    width: 550,
                    didOpen: () => {
                        setTimeout(() => {
                            calculateEditDifference();
                        }, 100);
                    },
                    preConfirm: () => {
                        const date = document.getElementById('edit-date').value;
                        const systemStock = document.getElementById('edit-system-stock').value;
                        const physicalStock = document.getElementById('edit-physical-stock').value;
                        const notes = document.getElementById('edit-notes').value;

                        // Validasi tanggal
                        if (!date) {
                            Swal.showValidationMessage('Tanggal opname harus diisi');
                            return false;
                        }

                        if (!systemStock || systemStock < 0) {
                            Swal.showValidationMessage('Stok sistem harus diisi dengan angka yang valid (minimal 0)');
                            return false;
                        }

                        if (!physicalStock || physicalStock < 0) {
                            Swal.showValidationMessage('Stok fisik harus diisi dengan angka yang valid (minimal 0)');
                            return false;
                        }

                        return {
                            date: date,
                            system_stock: parseInt(systemStock),
                            physical_stock: parseInt(physicalStock),
                            notes: notes
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const data = result.value;

                        document.getElementById('edit_date').value = data.date;
                        document.getElementById('edit_system_stock').value = data.system_stock;
                        document.getElementById('edit_physical_stock').value = data.physical_stock;
                        document.getElementById('edit_notes').value = data.notes || '';

                        const form = document.getElementById('editForm');
                        form.action = `{{ route('stock-opnames.update', ':id') }}`.replace(':id', opnameId);
                        form.submit();

                        Swal.fire({
                            title: 'Mengupdate...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    }
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengambil data opname: ' + error.message,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            });
    }

    // ========== HITUNG SELISIH EDIT ==========
    function calculateEditDifference() {
        const systemStock = parseInt(document.getElementById('edit-system-stock').value) || 0;
        const physicalStock = parseInt(document.getElementById('edit-physical-stock').value) || 0;
        const difference = physicalStock - systemStock;
        const diffValue = document.getElementById('edit-difference-value');
        const diffStatus = document.getElementById('edit-difference-status');
        const container = document.getElementById('edit-difference-container');

        diffValue.textContent = difference > 0 ? '+' + difference : difference;

        if (difference === 0) {
            diffValue.className = 'text-sm font-bold text-gray-500';
            container.className = 'mb-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700';
            diffStatus.textContent = 'Stok sesuai (tidak ada selisih)';
            diffStatus.className = 'text-xs mt-1 text-green-600 dark:text-green-400';
        } else if (difference > 0) {
            diffValue.className = 'text-sm font-bold text-green-600 dark:text-green-400';
            container.className = 'mb-3 p-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700';
            diffStatus.textContent = `Stok fisik lebih banyak ${difference} unit dari stok sistem`;
            diffStatus.className = 'text-xs mt-1 text-green-600 dark:text-green-400';
        } else {
            diffValue.className = 'text-sm font-bold text-red-600 dark:text-red-400';
            container.className = 'mb-3 p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700';
            diffStatus.textContent = `Stok fisik lebih sedikit ${Math.abs(difference)} unit dari stok sistem`;
            diffStatus.className = 'text-xs mt-1 text-red-600 dark:text-red-400';
        }
    }

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
    /* Tooltip styling */
    .tooltip-box {
        min-width: 200px;
        max-width: 300px;
        word-wrap: break-word;
        white-space: normal;
        pointer-events: none;
        z-index: 9999;
        line-height: 1.5;
    }

    .dark .tooltip-box {
        background-color: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    .dark .tooltip-box .absolute {
        background-color: #1f2937 !important;
    }

    .cursor-help {
        cursor: help;
    }

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
</style>