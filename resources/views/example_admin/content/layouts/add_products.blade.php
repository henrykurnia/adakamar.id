@extends('example_admin.layouts.default.dashboard')
@section('content')
    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Tambah Produk Baru</h1>
        </div>

        <!-- Ubah action dari route('products.store') menjadi route('admin.products.store') -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            <div class="col-span-full">
                <div class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Upload Foto Section -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-start xl:items-center gap-4 sm:gap-6 pb-6 mb-6 border-b border-[#E8D5F5] dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 w-full sm:w-auto">
                            <!-- Preview Image -->
                            <img id="productImage" src="{{ asset('static/images/products/new-product.png') }}"
                                class="w-32 h-32 rounded-lg object-cover border-2 border-[#E8D5F5] dark:border-gray-600 flex-shrink-0"
                                alt="Preview Foto Produk">

                            <div class="flex flex-col items-center sm:items-start w-full sm:w-auto">
                                <label class="cursor-pointer px-4 py-2 bg-[#1B4EF5] text-white rounded-lg hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF] inline-flex items-center w-full sm:w-auto justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                                    </svg>
                                    Upload Foto
                                    <input type="file" id="imageUpload" name="image" accept="image/*" class="hidden">
                                </label>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center sm:text-left">
                                    JPG, GIF atau PNG. Maksimal ukuran 800K
                                </p>

                                <button type="button" id="removeButton"
                                    class="mt-2 py-1 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#1B4EF5] focus:z-10 focus:ring-4 focus:ring-[#D4E0FF] dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 w-full sm:w-auto">
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Produk -->
                    <div>
                        <h3 class="mb-4 text-xl font-semibold text-[#1B4EF5] dark:text-[#3874FF]">Informasi Produk</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                            <input type="hidden" name="product_image" id="productImageData">

                            <!-- Nama Produk -->
                            <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="New Balance Shoes" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-span-1">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori <span class="text-red-500">*</span></label>
                                <select id="category" name="category_id" required
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] appearance-none">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Supplier -->
                            <div class="col-span-1">
                                <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier <span class="text-red-500">*</span></label>
                                <select id="supplier" name="supplier_id" required
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF] appearance-none">
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="col-span-1">
                                <label for="sku" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKU <span class="text-red-500">*</span></label>
                                <input type="text" name="sku" id="sku"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="PR001" value="{{ old('sku') }}" required>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Warna: Putih, Ukuran: 42">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Beli -->
                            <div class="col-span-1">
                                <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli <span class="text-red-500">*</span></label>
                                <input type="number" name="purchase_price" id="purchase_price"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="750000" value="{{ old('purchase_price') }}" required>
                                @error('purchase_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Harga Jual -->
                            <div class="col-span-1">
                                <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Jual <span class="text-red-500">*</span></label>
                                <input type="number" name="selling_price" id="selling_price"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="850000" value="{{ old('selling_price') }}" required>
                                @error('selling_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok Minimal -->
                            <div class="col-span-1">
                                <label for="minimum_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimal <span class="text-red-500">*</span></label>
                                <input type="number" name="minimum_stock" id="minimum_stock"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="10" value="{{ old('minimum_stock') }}" required>
                                @error('minimum_stock')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-4">
                                <button type="submit"
                                    class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF] w-full sm:w-auto">
                                    Tambahkan Produk
                                </button>
                                <a href="{{ route('admin.products.index') }}"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto">
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
        const productImage = document.getElementById('productImage');
        const imageUpload = document.getElementById('imageUpload');
        const removeButton = document.getElementById('removeButton');
        const productImageData = document.getElementById('productImageData');
        const placeholderImage = '{{ asset("static/images/products/box.png") }}';

        // Fungsi untuk preview gambar yang dipilih
        function previewImage(file) {
            if (!file) return;

            // Validasi ukuran (800KB)
            if (file.size > 800 * 1024) {
                alert('Ukuran file maksimal 800K. Silakan pilih file yang lebih kecil.');
                imageUpload.value = '';
                return;
            }

            // Validasi tipe
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Format file harus JPG, GIF atau PNG.');
                imageUpload.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                const img = new Image();
                img.onload = function () {
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
        imageUpload.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file);
            }
        });

        // Tombol hapus - kembali ke placeholder
        if (removeButton) {
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();
                productImage.src = placeholderImage;
                imageUpload.value = '';
                if (productImageData) {
                    productImageData.value = '';
                }
            });
        }

        // Drag and drop support
        const imageContainer = document.querySelector('.flex.flex-col.sm\\:flex-row.items-center.sm\\:items-start.xl\\:items-center');
        if (imageContainer) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                imageContainer.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            imageContainer.addEventListener('dragover', function () {
                this.classList.add('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
            });

            imageContainer.addEventListener('dragleave', function () {
                this.classList.remove('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
            });

            imageContainer.addEventListener('drop', function (e) {
                this.classList.remove('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
                const file = e.dataTransfer.files[0];
                if (file) {
                    previewImage(file);
                }
            });
        }

        // Klik pada gambar juga membuka file manager
        if (productImage) {
            productImage.addEventListener('click', function () {
                imageUpload.click();
            });
            productImage.style.cursor = 'pointer';
        }
    });
</script>