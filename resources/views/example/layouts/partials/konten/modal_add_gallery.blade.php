<!-- Modal Tambah Galeri -->
<div id="addGalleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddGalleryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1h1zM7 3a1 1 0 011 1v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4a1 1 0 011-1h2zM10 3a1 1 0 011 1v12a1 1 0 01-1 1H8a1 1 0 01-1-1V4a1 1 0 011-1h2z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Galeri
                    </h3>
                    <button type="button" onclick="closeAddGalleryModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data"
                    id="addGalleryForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="addTitle"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="addTitle"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan judul galeri" required>
                            <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="addImage"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar <span
                                    class="text-red-500">*</span></label>

                            <!-- Preview Image -->
                            <div id="addImagePreviewContainer" class="hidden relative w-full mb-3">
                                <img id="addImagePreview" src="#" alt="Preview Gambar"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                <div
                                    class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="addImageFileName"></span>
                                    <span class="mx-2">|</span>
                                    <span id="addImageFileSize"></span>
                                </div>
                                <button type="button" onclick="removeAddImage()"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div
                                    class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none">
                                </div>
                                <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terupload
                                </div>
                            </div>

                            <!-- Upload Area -->
                            <div id="addImageUploadArea"
                                class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="addImageUpload"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> gambar
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP, GIF (Maks.
                                            5MB)</p>
                                    </div>
                                    <input type="file" id="addImageUpload" name="image" accept="image/*" class="hidden"
                                        required>
                                </label>
                            </div>

                            <span class="text-red-500 text-xs error-message" id="add_image_error"></span>
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="addSortOrder"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Urutan</label>
                            <input type="number" name="sort_order" id="addSortOrder"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan urutan" min="0">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan yang lebih kecil akan tampil
                                lebih dulu</p>
                            <span class="text-red-500 text-xs error-message" id="add_sort_order_error"></span>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="addIsActive"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select name="is_active" id="addIsActive"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <span class="text-red-500 text-xs error-message" id="add_is_active_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="submit"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Galeri
                        </button>
                        <button type="button" onclick="closeAddGalleryModal()"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#E60000] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== OPEN/CLOSE MODAL ==========
    function openAddGalleryModal() {
        document.getElementById('addGalleryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addGalleryForm').reset();
        document.getElementById('addImagePreviewContainer').classList.add('hidden');
        document.getElementById('addImageUploadArea').classList.remove('hidden');
        document.querySelectorAll('#addGalleryForm .error-message').forEach(function (el) {
            el.textContent = '';
        });
        setTimeout(function () {
            document.getElementById('addTitle').focus();
        }, 100);
    }

    function closeAddGalleryModal() {
        document.getElementById('addGalleryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== IMAGE PREVIEW ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('addImageUpload');
        var previewContainer = document.getElementById('addImagePreviewContainer');
        var preview = document.getElementById('addImagePreview');
        var fileName = document.getElementById('addImageFileName');
        var fileSize = document.getElementById('addImageFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 5MB'
                        });
                        this.value = '';
                        return;
                    }
                    var validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (validTypes.indexOf(file.type) === -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
                        });
                        this.value = '';
                        return;
                    }
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        document.getElementById('addImageUploadArea').classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = file.name;
                        var sizeInKB = (file.size / 1024).toFixed(2);
                        if (sizeInKB > 1024) {
                            fileSize.textContent = (sizeInKB / 1024).toFixed(2) + ' MB';
                        } else {
                            fileSize.textContent = sizeInKB + ' KB';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeAddImage = function () {
            document.getElementById('addImageUpload').value = '';
            document.getElementById('addImageUploadArea').classList.remove('hidden');
            document.getElementById('addImagePreviewContainer').classList.add('hidden');
            document.getElementById('add_image_error').textContent = '';
        };
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addGalleryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddGalleryModal();
            }
        }
    });

    document.querySelector('#addGalleryModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddGalleryModal();
        }
    });
</script>

<style>
    #addGalleryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addGalleryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addGalleryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addImagePreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }
</style>