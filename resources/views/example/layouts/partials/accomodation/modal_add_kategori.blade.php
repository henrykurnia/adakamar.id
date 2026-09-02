<!-- Modal Tambah Kategori -->
<div id="addKategoriModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddKategoriModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">Tambah Kategori Baru</h3>
                    <button type="button" onclick="closeAddKategoriModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('accommodation-categories.store') }}" method="POST" enctype="multipart/form-data"
                    id="addKategoriForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="addNama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="addNama"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="add_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="addSlug"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="slug" id="addSlug"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="auto-generate dari nama" required>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug akan otomatis terisi dari nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                        </div>

                        <!-- Foto dengan Preview -->
                        <div>
                            <label for="addFoto"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail
                                </label>

                            <!-- Upload Area -->
                            <div id="addUploadArea"
                                class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="addFoto" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> foto kategori
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="thumbnail" id="addFoto" accept="image/*"
                                        class="hidden">
                                </label>
                            </div>

                            <!-- Preview Image -->
                            <div id="addPreviewContainer" class="hidden relative w-full">
                                <img id="addPreviewImage" src="#" alt="Preview Foto"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                <div class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="addFileName"></span>
                                    <span class="mx-2">|</span>
                                    <span id="addFileSize"></span>
                                </div>
                                <button type="button" onclick="removeAddImage()"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none"></div>
                                <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terupload
                                </div>
                            </div>

                            <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="addDeskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="addDeskripsi" rows="3"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan deskripsi kategori"></textarea>
                            <span class="text-red-500 text-xs error-message" id="add_description_error"></span>
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
                            Tambah Kategori
                        </button>
                        <button type="button" onclick="closeAddKategoriModal()"
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
    function openAddKategoriModal() {
        document.getElementById('addKategoriModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addKategoriForm').reset();
        document.getElementById('addNama').classList.remove('border-red-500');
        document.getElementById('addSlug').classList.remove('border-red-500');
        // Reset thumbnail
        document.getElementById('addUploadArea').classList.remove('hidden');
        document.getElementById('addPreviewContainer').classList.add('hidden');
        document.getElementById('addPreviewImage').src = '#';
        // Reset error messages
        document.querySelectorAll('#addKategoriForm .error-message').forEach(function(el) {
            el.textContent = '';
        });
        setTimeout(function() {
            document.getElementById('addNama').focus();
        }, 100);
    }

    function closeAddKategoriModal() {
        document.getElementById('addKategoriModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== PREVIEW IMAGE ==========
    function previewAddImage(file) {
        if (!file) return;

        // Validasi ukuran (2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Ukuran file maksimal 2MB. Silakan pilih file yang lebih kecil.'
            });
            document.getElementById('addFoto').value = '';
            return;
        }

        // Validasi tipe
        var validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (validTypes.indexOf(file.type) === -1) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
            });
            document.getElementById('addFoto').value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function(event) {
            var previewImage = document.getElementById('addPreviewImage');
            var previewContainer = document.getElementById('addPreviewContainer');
            var uploadArea = document.getElementById('addUploadArea');
            var fileName = document.getElementById('addFileName');
            var fileSize = document.getElementById('addFileSize');

            previewImage.src = event.target.result;
            uploadArea.classList.add('hidden');
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

    function removeAddImage() {
        document.getElementById('addFoto').value = '';
        document.getElementById('addUploadArea').classList.remove('hidden');
        document.getElementById('addPreviewContainer').classList.add('hidden');
        document.getElementById('addPreviewImage').src = '#';
        document.getElementById('add_thumbnail_error').textContent = '';
    }

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function() {
        var namaInput = document.getElementById('addNama');
        var slugInput = document.getElementById('addSlug');

        if (namaInput && slugInput) {
            namaInput.addEventListener('input', function() {
                var slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            });
        }

        // ========== EVENT LISTENER FOR FILE INPUT ==========
        var fotoInput = document.getElementById('addFoto');
        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                var file = e.target.files[0];
                if (file) {
                    previewAddImage(file);
                } else {
                    removeAddImage();
                }
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addKategoriModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddKategoriModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#addKategoriModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddKategoriModal();
        }
    });
</script>

<style>
    #addKategoriModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addKategoriModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addKategoriModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    /* Upload Area */
    #addUploadArea {
        transition: all 0.3s ease;
    }

    #addUploadArea:hover {
        border-color: #E60000;
    }

    /* Preview image container */
    #addPreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    #addPreviewImage {
        border: 2px solid #FFD4D4;
        border-radius: 8px;
        object-fit: cover;
        width: 100%;
        height: 192px;
    }

    .dark #addPreviewImage {
        border-color: #374151;
    }

    .error-message {
        margin-top: 4px;
        display: block;
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
</style>