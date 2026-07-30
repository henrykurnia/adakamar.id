@extends('example_admin.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">
                Tambah Stock Opname
            </h1>
        </div>

        <form action="{{ route('admin.stock-opnames.store') }}" method="POST" id="opnameForm">
            @csrf

            <div class="col-span-full">
                <div class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Informasi Opname -->
                    <div>
                        <h3 class="mb-4 text-xl font-semibold text-[#1B4EF5] dark:text-[#3874FF]">
                            Informasi Stock Opname
                        </h3>

                        <div class="grid grid-cols-6 gap-6">

                            <!-- Pilih Produk -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Pilih Produk <span class="text-red-500">*</span>
                                </label>
                                <select id="product_id" name="product_id" required
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" 
                                            data-sku="{{ $product->sku }}"
                                            data-stock="{{ $product->stock }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} ({{ $product->sku }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU (otomatis) -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="sku_display" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    SKU
                                </label>
                                <input type="text" id="sku_display"
                                    class="shadow-sm bg-gray-100 border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed"
                                    placeholder="SKU akan terisi otomatis" readonly disabled>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Sistem -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="system_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Stok Sistem <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="system_stock" id="system_stock"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan stok sistem" value="{{ old('system_stock') }}" required min="0"
                                    oninput="calculateDifference()">
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Masukkan stok yang tercatat di sistem</p>
                                @error('system_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Fisik -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="physical_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Stok Fisik <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="physical_stock" id="physical_stock"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan stok fisik" value="{{ old('physical_stock') }}" required min="0"
                                    oninput="calculateDifference()">
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Masukkan stok hasil pengecekan fisik</p>
                                @error('physical_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Opname -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Tanggal Opname <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" id="date"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Selisih (auto-calculate) -->
                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Selisih
                                </label>
                                <div id="difference-container" class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700 border border-[#E8D5F5] dark:border-gray-600">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Selisih:</span>
                                        <span id="difference-value" class="text-sm font-bold text-gray-500">0</span>
                                    </div>
                                    <div id="difference-status" class="text-xs mt-1 text-gray-500">Masukkan stok sistem dan fisik</div>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="col-span-6">
                                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Catatan (Opsional)
                                </label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Tambahkan catatan jika diperlukan">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Info Penting -->
                            <div class="col-span-6">
                                <div class="p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                                                Pastikan data yang dimasukkan sudah benar
                                            </p>
                                            <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">
                                                Stok sistem dan stok fisik akan dihitung selisihnya secara otomatis
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="col-span-6 sm:col-full">
                                <button type="submit" id="submitBtn"
                                    class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                                    <span id="submitText">Simpan Opname</span>
                                    <span id="loadingSpinner" class="hidden">
                                        <svg class="inline w-4 h-4 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Menyimpan...
                                    </span>
                                </button>
                                <a href="{{ route('admin.stock-opnames.index') }}"
                                    class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Batal
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== AUTO FILL SKU ==========
        const productSelect = document.getElementById('product_id');
        const skuDisplay = document.getElementById('sku_display');

        productSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const sku = selectedOption.getAttribute('data-sku') || '';
            skuDisplay.value = sku;
        });

        // Trigger on load jika ada value
        if (productSelect.value) {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const sku = selectedOption.getAttribute('data-sku') || '';
            skuDisplay.value = sku;
        }

        // ========== HITUNG SELISIH ==========
        const systemStockInput = document.getElementById('system_stock');
        const physicalStockInput = document.getElementById('physical_stock');
        const differenceValue = document.getElementById('difference-value');
        const differenceStatus = document.getElementById('difference-status');
        const differenceContainer = document.getElementById('difference-container');

        window.calculateDifference = function() {
            const systemStock = parseInt(systemStockInput.value) || 0;
            const physicalStock = parseInt(physicalStockInput.value) || 0;
            const difference = physicalStock - systemStock;

            // Update nilai selisih
            differenceValue.textContent = difference > 0 ? '+' + difference : difference;

            // Update warna dan status
            if (difference === 0) {
                differenceValue.className = 'text-sm font-bold text-gray-500';
                differenceContainer.className = 'p-3 rounded-lg bg-gray-50 dark:bg-gray-700 border border-[#E8D5F5] dark:border-gray-600';
                differenceStatus.textContent = 'Stok sesuai (tidak ada selisih)';
                differenceStatus.className = 'text-xs mt-1 text-green-600 dark:text-green-400';
            } else if (difference > 0) {
                differenceValue.className = 'text-sm font-bold text-green-600 dark:text-green-400';
                differenceContainer.className = 'p-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700';
                differenceStatus.textContent = `Stok fisik lebih banyak ${difference} unit dari stok sistem`;
                differenceStatus.className = 'text-xs mt-1 text-green-600 dark:text-green-400';
            } else {
                differenceValue.className = 'text-sm font-bold text-red-600 dark:text-red-400';
                differenceContainer.className = 'p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700';
                differenceStatus.textContent = `Stok fisik lebih sedikit ${Math.abs(difference)} unit dari stok sistem`;
                differenceStatus.className = 'text-xs mt-1 text-red-600 dark:text-red-400';
            }
        };

        // Event listeners untuk auto calculate
        systemStockInput.addEventListener('input', calculateDifference);
        physicalStockInput.addEventListener('input', calculateDifference);

        // Trigger awal
        setTimeout(calculateDifference, 100);

        // ========== VALIDASI FORM ==========
        const form = document.getElementById('opnameForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', function (e) {
            const productId = productSelect.value;
            const systemStock = systemStockInput.value;
            const physicalStock = physicalStockInput.value;
            const date = document.getElementById('date').value;

            // Validasi produk
            if (!productId) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih produk terlebih dahulu',
                    confirmButtonColor: '#1B4EF5',
                    confirmButtonText: 'OK'
                });
                productSelect.focus();
                productSelect.classList.add('border-red-500');
                return false;
            }

            // Validasi stok sistem
            if (!systemStock || systemStock < 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Stok sistem harus diisi dengan angka yang valid (minimal 0)',
                    confirmButtonColor: '#1B4EF5',
                    confirmButtonText: 'OK'
                });
                systemStockInput.focus();
                systemStockInput.classList.add('border-red-500');
                return false;
            }

            // Validasi stok fisik
            if (!physicalStock || physicalStock < 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Stok fisik harus diisi dengan angka yang valid (minimal 0)',
                    confirmButtonColor: '#1B4EF5',
                    confirmButtonText: 'OK'
                });
                physicalStockInput.focus();
                physicalStockInput.classList.add('border-red-500');
                return false;
            }

            // Validasi tanggal
            if (!date) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Silakan pilih tanggal opname',
                    confirmButtonColor: '#1B4EF5',
                    confirmButtonText: 'OK'
                });
                document.getElementById('date').focus();
                document.getElementById('date').classList.add('border-red-500');
                return false;
            }

            // Konfirmasi sebelum submit
            e.preventDefault();

            const productName = productSelect.options[productSelect.selectedIndex]?.text || 'Produk';
            const difference = parseInt(physicalStock) - parseInt(systemStock);
            const formattedDate = date.split('-').reverse().join('/');

            Swal.fire({
                title: 'Konfirmasi Simpan',
                html: `
                    <div class="text-left">
                        <div class="bg-[#F5F0FF] dark:bg-gray-700 p-4 rounded-lg">
                            <p><strong>Produk:</strong> ${productName}</p>
                            <p><strong>Tanggal:</strong> ${formattedDate}</p>
                            <p><strong>Stok Sistem:</strong> ${new Intl.NumberFormat('id-ID').format(systemStock)}</p>
                            <p><strong>Stok Fisik:</strong> ${new Intl.NumberFormat('id-ID').format(physicalStock)}</p>
                            <p><strong>Selisih:</strong> <span class="${difference > 0 ? 'text-green-600' : (difference < 0 ? 'text-red-600' : '')}">${difference > 0 ? '+' : ''}${new Intl.NumberFormat('id-ID').format(difference)}</span></p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Pastikan data yang dimasukkan sudah benar</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1B4EF5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading
                    submitText.classList.add('hidden');
                    loadingSpinner.classList.remove('hidden');
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';

                    // Submit form
                    form.submit();

                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        });

        // Hapus border merah saat diisi
        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('input', function () {
                this.classList.remove('border-red-500');
            });
            el.addEventListener('change', function () {
                this.classList.remove('border-red-500');
            });
        });
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
        }).then((result) => {
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                window.location.href = '{{ route('admin.stock-opnames.index') }}';
            }
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
    /* Custom style untuk input number */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        opacity: 1;
    }
</style>