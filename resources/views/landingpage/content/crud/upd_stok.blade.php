@extends('example.layouts.default.dashboard')
@section('content')
    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Edit Transaksi Stok</h1>
        </div>

        <form action="{{ route('stock-transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data"
            id="transactionForm">
            @csrf
            @method('PUT')
            <div class="col-span-full">
                <div
                    class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Informasi Transaksi -->
                    <div>
                        <div class="grid grid-cols-6 gap-6">

                            <!-- User ID (Hidden - diisi dengan user yang login) -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <!-- Status (Hidden - selalu Pending) -->
                            <input type="hidden" name="status" value="Pending">

                            <!-- Nama Produk - Dropdown -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                                <select id="product_id" name="product_id" required
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" 
                                            data-sku="{{ $product->sku }}"
                                            data-stock="{{ $product->stock }}"
                                            {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} (Stok: {{ $product->stock }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU - Otomatis terisi -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="sku_display" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU</label>
                                <input type="text" id="sku_display"
                                    class="shadow-sm bg-gray-100 border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                    placeholder="SKU akan terisi otomatis" readonly disabled
                                    value="{{ $transaction->product->sku ?? '' }}">
                                <input type="hidden" name="sku" id="sku_hidden" value="{{ $transaction->product->sku ?? '' }}">
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Saat Ini -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="current_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Saat Ini</label>
                                <input type="number" id="current_stock"
                                    class="shadow-sm bg-gray-100 border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                    placeholder="0" readonly disabled
                                    value="{{ $transaction->product->stock ?? 0 }}">
                                @error('current_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipe Transaksi -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Transaksi</label>
                                <select id="type" name="type" required
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Masuk" {{ old('type', $transaction->type) == 'Masuk' ? 'selected' : '' }}>Masuk (Penambahan Stok)</option>
                                    <option value="Keluar" {{ old('type', $transaction->type) == 'Keluar' ? 'selected' : '' }}>Keluar (Pengurangan Stok)</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jumlah -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan jumlah" value="{{ old('quantity', $transaction->quantity) }}" required min="1">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal (Hanya Tanggal) -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Transaksi</label>
                                <input type="date" name="date" id="date"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    value="{{ old('date', $transaction->date ? \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Info - Menampilkan status Pending -->
                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <div class="p-2.5 bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-lg dark:bg-yellow-900 dark:border-yellow-700 dark:text-yellow-300">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-medium">Pending (Menunggu Persetujuan)</span>
                                    </div>
                                    <p class="text-xs mt-1 text-yellow-700 dark:text-yellow-400">
                                        Jumlah stok TIDAK akan berubah sampai transaksi dikonfirmasi oleh Staff Gudang
                                    </p>
                                </div>
                                <input type="hidden" name="status" value="Pending">
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div class="col-span-6">
                                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Tambahkan catatan jika diperlukan">{{ old('notes', $transaction->notes) }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preview Stok Setelah Transaksi -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="stock_after" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Setelah Transaksi</label>
                                <input type="number" id="stock_after"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 cursor-not-allowed"
                                    placeholder="0" readonly disabled
                                    value="{{ $transaction->product->stock ?? 0 }}">
                            </div>

                            <!-- Info Stok Tidak Berubah -->
                            <div class="col-span-6 sm:col-span-3">
                                <div class="p-3 rounded-lg border bg-[#F5F0FF] border-[#E8D5F5] text-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Jumlah stok produk TIDAK akan berubah</span>
                                    </div>
                                    <p class="text-xs mt-1 text-gray-600 dark:text-gray-400">
                                        Status "Pending" berarti jumlah stok produk belum berubah. Tunggu persetujuan dari Staff Gudang.
                                    </p>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-span-6">
                                <button type="submit"
                                    class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                                    
                                    Update Transaksi
                                </button>
                                <a href="{{ route('stock-transactions.index') }}"
                                    class="inline-flex items-center ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen yang diperlukan
        const productSelect = document.getElementById('product_id');
        const skuDisplay = document.getElementById('sku_display');
        const skuHidden = document.getElementById('sku_hidden');
        const currentStock = document.getElementById('current_stock');
        const quantityInput = document.getElementById('quantity');
        const typeSelect = document.getElementById('type');
        const stockAfter = document.getElementById('stock_after');

        // Status selalu Pending
        const STATUS = 'Pending';

        // Fungsi utama untuk mengupdate stok setelah transaksi
        function updateStockAfter() {
            const current = parseInt(currentStock.value) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const type = typeSelect.value;

            // Karena status selalu Pending, stok tidak berubah
            const result = current; // Stok tetap sama

            stockAfter.value = result;

            // Style untuk menunjukkan stok tidak berubah
            stockAfter.classList.remove('bg-blue-50', 'border-blue-300', 'text-blue-900', 'dark:bg-blue-900', 'dark:border-blue-700', 'dark:text-blue-300');
            stockAfter.classList.remove('bg-green-50', 'border-green-300', 'text-green-900', 'dark:bg-green-900', 'dark:border-green-700', 'dark:text-green-300');
            stockAfter.classList.remove('bg-red-50', 'border-red-300', 'text-red-900', 'dark:bg-red-900', 'dark:border-red-700', 'dark:text-red-300');
            stockAfter.classList.remove('bg-orange-50', 'border-orange-300', 'text-orange-900', 'dark:bg-orange-900', 'dark:border-orange-700', 'dark:text-orange-300');

            // Tambahkan class untuk status Pending
            stockAfter.classList.add('bg-yellow-50', 'border-yellow-300', 'text-yellow-900', 'dark:bg-yellow-900', 'dark:border-yellow-700', 'dark:text-yellow-300');
            stockAfter.title = ' Stok tidak berubah (Pending)';
        }

        // Event listener ketika produk dipilih
        productSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const sku = selectedOption.getAttribute('data-sku') || '';
            const stock = selectedOption.getAttribute('data-stock') || 0;

            // Update SKU
            skuDisplay.value = sku;
            skuHidden.value = sku;

            // Update stok saat ini
            currentStock.value = stock;

            // Update stok setelah transaksi
            updateStockAfter();
        });

        // Event listener untuk tipe
        typeSelect.addEventListener('change', function() {
            updateStockAfter();
        });

        // Event listener untuk jumlah
        quantityInput.addEventListener('input', updateStockAfter);

        // Validasi sebelum submit
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            const type = typeSelect.value;
            const quantity = parseInt(quantityInput.value) || 0;
            const current = parseInt(currentStock.value) || 0;
            const productName = productSelect.options[productSelect.selectedIndex]?.text || '';
            const dateValue = document.getElementById('date').value;

            // Validasi produk
            if (!productSelect.value) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Produk Belum Dipilih',
                    text: 'Silakan pilih produk terlebih dahulu!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                productSelect.focus();
                return false;
            }

            // Validasi tipe
            if (!type) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Tipe Transaksi Belum Dipilih',
                    text: 'Silakan pilih tipe transaksi terlebih dahulu!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                typeSelect.focus();
                return false;
            }

            // Validasi jumlah
            if (quantity <= 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Jumlah Tidak Valid',
                    text: 'Jumlah harus lebih dari 0!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                quantityInput.focus();
                return false;
            }

            // Validasi tanggal
            if (!dateValue) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Tanggal Belum Diisi',
                    text: 'Silakan isi tanggal transaksi!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                document.getElementById('date').focus();
                return false;
            }

            // Validasi stok untuk tipe Keluar (meskipun pending, tetap cek)
            if (type === 'Keluar' && quantity > current) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Mencukupi!',
                    html: `
                        <p>Anda mencoba mengeluarkan <strong>${quantity}</strong> unit dari produk <strong>"${productName}"</strong>.</p>
                        <p class="text-red-500 font-bold">Stok saat ini hanya: ${current} unit</p>
                        <p class="text-sm text-gray-500 mt-2">Mohon kurangi jumlah atau tambah stok terlebih dahulu.</p>
                    `,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                quantityInput.focus();
                quantityInput.select();
                return false;
            }

            // Format tanggal untuk ditampilkan
            const formattedDate = dateValue ? dateValue.split('-').reverse().join('/') : '';

            // Konfirmasi sebelum submit
            e.preventDefault();

            const typeIcon = type === 'Masuk' ? '➕' : '➖';
            const typeColor = type === 'Masuk' ? 'green' : 'red';
            const statusText = 'Pending';
            const effectText = 'TIDAK berubah (menunggu persetujuan)';

            Swal.fire({
                title: 'Konfirmasi Update Transaksi',
                html: `
                    <div class="text-left">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="mb-2"><strong>Produk:</strong> ${productName}</p>
                            <p><strong>SKU:</strong> ${skuDisplay.value}</p>
                            <p class="mt-2"><strong>Tipe:</strong> 
                                <span class="text-${typeColor}-600 font-bold">${typeIcon} ${type}</span>
                            </p>
                            <p><strong>Jumlah:</strong> ${quantity} unit</p>
                            <p><strong>Stok Saat Ini:</strong> ${current} unit</p>
                            <p class="mt-2"><strong>Tanggal:</strong> ${formattedDate}</p>
                            <p class="mt-2"><strong>Status:</strong> 
                                <span class="text-yellow-600 font-bold">⏳ ${statusText}</span>
                            </p>
                            <p class="mt-2"><strong>Efek pada Stok:</strong> 
                                <span class="font-bold text-yellow-600">
                                    ⏸️ ${effectText}
                                </span>
                            </p>
                            <p class="mt-2 font-bold text-gray-600">
                                <strong>Stok Setelah:</strong> ${current} unit (TIDAK berubah)
                            </p>
                            <p class="text-yellow-600 text-sm mt-2">
                                ⚠️ Stok akan tetap sama sampai status disetujui oleh Admin/Manager
                            </p>
                            <p class="text-gray-500 text-xs mt-1">
                                ℹ️ Hanya Staff Gudang yang dapat membuat transaksi, dan Admin/Manager yang menyetujui
                            </p>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1B4EF5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form
                    document.getElementById('transactionForm').submit();

                    // Tampilkan loading
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
        });

        // Trigger initial update jika ada nilai default
        if (productSelect.value) {
            productSelect.dispatchEvent(new Event('change'));
        }

        // Validasi real-time untuk stok keluar
        quantityInput.addEventListener('blur', function() {
            const type = typeSelect.value;
            const quantity = parseInt(this.value) || 0;
            const current = parseInt(currentStock.value) || 0;

            if (type === 'Keluar' && quantity > current && quantity > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Tidak Mencukupi!',
                    text: `Stok saat ini hanya ${current} unit, tetapi Anda memasukkan ${quantity} unit.`,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                this.focus();
                this.select();
            }
        });

        // Informasi produk saat hover
        productSelect.addEventListener('mouseover', function(e) {
            const option = this.options[this.selectedIndex];
            if (option && option.value) {
                const sku = option.getAttribute('data-sku') || '-';
                const stock = option.getAttribute('data-stock') || '0';
                this.title = `SKU: ${sku} | Stok: ${stock}`;
            }
        });
    });
    </script>
@endpush