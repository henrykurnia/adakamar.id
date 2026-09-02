<!-- Modal Edit Produk -->
<div id="editProductModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90" aria-hidden="true" onclick="closeEditModal()"></div>

        <!-- Modal panel -->
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            
            <!-- Header Modal -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modal-title">
                        <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        Edit Produk
                    </h3>
                    <button onclick="closeEditModal()" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Body Modal -->
            <div class="px-6 py-4 max-h-[75vh] overflow-y-auto">
                <form id="editProductForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_image" id="modalProductImageData">

                    <!-- Upload Foto Section -->
                    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4 pb-6 mb-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-6">
                            <!-- Preview Image -->
                            <img id="modalProductImage" 
                                 src="{{ $product->image ? asset('storage/' . $product->image) : asset('static/images/products/box.png') }}"
                                 class="w-32 h-32 rounded-lg object-cover border-2 border-gray-200 dark:border-gray-600 cursor-pointer hover:opacity-80 transition-opacity duration-200"
                                 alt="Preview Foto Produk"
                                 onclick="document.getElementById('modalImageUpload').click()">

                            <div>
                                <label class="cursor-pointer px-4 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                                    </svg>
                                    Upload Foto
                                    <input type="file" id="modalImageUpload" name="image" accept="image/*" class="hidden">
                                </label>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    JPG, GIF atau PNG. Maksimal ukuran 800K
                                </p>

                                <button type="button" id="modalRemoveButton"
                                    class="mt-2 py-1 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-600 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-colors duration-200">
                                    <svg class="inline w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Produk -->
                    <div>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Produk</h3>

                        <div class="grid grid-cols-6 gap-6">
                            <!-- Nama Produk -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Produk <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="modalName"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="New Balance Shoes" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalCategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="modalCategory" name="category_id" required
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Supplier -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalSupplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Supplier <span class="text-red-500">*</span>
                                </label>
                                <select id="modalSupplier" name="supplier_id" required
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalSku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    SKU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="sku" id="modalSku"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="PR001" value="{{ old('sku', $product->sku) }}" required>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi
                                </label>
                                <textarea name="description" id="modalDescription" rows="3"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Warna: Putih, Ukuran: 42">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Beli -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalPurchasePrice" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Harga Beli <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="purchase_price" id="modalPurchasePrice"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="750000" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                                @error('purchase_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Jual -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalSellingPrice" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Harga Jual <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="selling_price" id="modalSellingPrice"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="850000" value="{{ old('selling_price', $product->selling_price) }}" required>
                                @error('selling_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Minimal -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="modalMinimumStock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Stok Minimal <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="minimum_stock" id="modalMinimumStock"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="10" value="{{ old('minimum_stock', $product->minimum_stock) }}" required>
                                @error('minimum_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-span-6">
                                <button type="submit" id="modalSubmitBtn"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 transition-colors duration-200">
                                    <span id="modalSubmitText">
                                        <svg class="inline w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Simpan Perubahan
                                    </span>
                                    <span id="modalLoadingSpinner" class="hidden">
                                        <svg class="inline w-4 h-4 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Menyimpan...
                                    </span>
                                </button>
                                <button type="button" onclick="closeEditModal()"
                                    class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-colors duration-200">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editProductModal');
    const form = document.getElementById('editProductForm');
    const imageUpload = document.getElementById('modalImageUpload');
    const productImage = document.getElementById('modalProductImage');
    const removeButton = document.getElementById('modalRemoveButton');
    const productImageData = document.getElementById('modalProductImageData');
    const placeholderImage = '{{ asset("static/images/products/box.png") }}';
    const submitBtn = document.getElementById('modalSubmitBtn');
    const submitText = document.getElementById('modalSubmitText');
    const loadingSpinner = document.getElementById('modalLoadingSpinner');

    // Fungsi preview gambar
    function previewImage(file) {
        if (!file) return;

        // Validasi ukuran (800KB)
        if (file.size > 800 * 1024) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Ukuran file maksimal 800K. Silakan pilih file yang lebih kecil.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            imageUpload.value = '';
            return;
        }

        // Validasi tipe
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Format file harus JPG, GIF atau PNG.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            imageUpload.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                // Buat canvas untuk cropping ke bentuk persegi
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                const size = Math.min(img.width, img.height);
                const offsetX = (img.width - size) / 2;
                const offsetY = (img.height - size) / 2;

                canvas.width = 200;
                canvas.height = 200;

                ctx.drawImage(img, offsetX, offsetY, size, size, 0, 0, 200, 200);

                const imageDataUrl = canvas.toDataURL('image/jpeg', 0.9);

                // Ganti placeholder dengan foto yang dipilih
                productImage.src = imageDataUrl;

                // Simpan data untuk form submission
                if (productImageData) {
                    productImageData.value = imageDataUrl;
                }
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Event listener ketika file dipilih
    imageUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            previewImage(file);
        }
    });

    // Tombol hapus - kembali ke placeholder
    if (removeButton) {
        removeButton.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Foto?',
                text: 'Foto akan dihapus dan kembali ke default',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    productImage.src = placeholderImage;
                    imageUpload.value = '';
                    if (productImageData) {
                        productImageData.value = '';
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Foto berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
    }

    // Drag and drop support
    const imageContainer = document.querySelector('.flex.items-center.space-x-6');
    if (imageContainer) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            imageContainer.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        imageContainer.addEventListener('dragover', function() {
            this.classList.add('ring-4', 'ring-primary-500', 'ring-offset-2', 'rounded-lg');
        });

        imageContainer.addEventListener('dragleave', function() {
            this.classList.remove('ring-4', 'ring-primary-500', 'ring-offset-2', 'rounded-lg');
        });

        imageContainer.addEventListener('drop', function(e) {
            this.classList.remove('ring-4', 'ring-primary-500', 'ring-offset-2', 'rounded-lg');
            const file = e.dataTransfer.files[0];
            if (file) {
                previewImage(file);
            }
        });
    }

    // Validasi form sebelum submit via AJAX
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Tampilkan loading
        submitText.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
        submitBtn.style.cursor = 'not-allowed';

        // Kirim via AJAX
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    closeEditModal();
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                // Reset button
                submitText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan pada server',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
            submitText.classList.remove('hidden');
            loadingSpinner.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
        });
    });

    // Hapus class border-red-500 saat input diisi
    document.querySelectorAll('#editProductForm input, #editProductForm select, #editProductForm textarea').forEach(element => {
        element.addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });
        element.addEventListener('change', function() {
            this.classList.remove('border-red-500');
        });
    });
});

// Fungsi membuka modal
function openEditModal() {
    const modal = document.getElementById('editProductModal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

// Fungsi menutup modal
function closeEditModal() {
    const modal = document.getElementById('editProductModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
}

// Tampilkan modal jika ada error validasi
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        // Buka modal
        openEditModal();

        // Tampilkan error
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal!',
            html: '{!! implode('<br>', $errors->all()) !!}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Perbaiki'
        });
    });
@endif
</script>