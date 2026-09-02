<!-- Modal Edit Kategori -->
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">Edit Kategori</h3>
                    <button type="button" onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="#" method="POST" enctype="multipart/form-data" id="editKategoriForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editId">

                        <!-- Nama Kategori -->
                        <div>
                            <label for="editNama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="editNama"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="edit_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="editSlug"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="slug" id="editSlug"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="auto-generate dari nama" required>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug akan otomatis terisi dari nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                        </div>

                        <!-- Foto dengan Preview -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail</label>

                            <!-- Preview Image (untuk foto lama) -->
                            <div id="editPreviewContainer" class="hidden relative w-full mb-3">
                                <img id="editPreviewImage" src="#" alt="Preview Foto"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                <div
                                    class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="editFileName">Foto saat ini</span>
                                    <span class="mx-2">|</span>
                                    <span id="editFileSize"></span>
                                </div>
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

                            <!-- Tombol Ganti Foto -->
                            <div id="editButtonContainer" class="hidden mb-3">
                                <button type="button" onclick="triggerEditFileInput()"
                                    class="inline-flex items-center px-4 py-2 bg-[#E60000] text-white rounded-lg hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B] transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Ganti Foto
                                </button>
                                <button type="button" onclick="removeEditImage()"
                                    class="inline-flex items-center px-4 py-2 ml-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Hapus Foto
                                </button>
                            </div>

                            <!-- Upload Area (hidden by default, muncul saat tombol ganti diklik) -->
                            <div id="editUploadArea"
                                class="hidden w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="editFoto"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> foto kategori
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks. 2MB)
                                        </p>
                                    </div>
                                    <input type="file" name="thumbnail" id="editFoto" accept="image/*" class="hidden">
                                </label>
                            </div>

                            <!-- Tombol Batal Upload -->
                            <div id="editCancelUploadContainer" class="hidden mt-2">
                                <button type="button" onclick="cancelEditUpload()"
                                    class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal Upload
                                </button>
                            </div>

                            <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="editDeskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="editDeskripsi" rows="3"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan deskripsi kategori"></textarea>
                            <span class="text-red-500 text-xs error-message" id="edit_description_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="submit"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditModal()"
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
    // ========== PREVIEW IMAGE ==========
    function previewEditImage(file) {
        if (!file) return;

        // Validasi ukuran (2MB)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Ukuran file maksimal 2MB. Silakan pilih file yang lebih kecil.'
            });
            document.getElementById('editFoto').value = '';
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
            document.getElementById('editFoto').value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            var previewImage = document.getElementById('editPreviewImage');
            var previewContainer = document.getElementById('editPreviewContainer');
            var uploadArea = document.getElementById('editUploadArea');
            var buttonContainer = document.getElementById('editButtonContainer');
            var cancelContainer = document.getElementById('editCancelUploadContainer');
            var fileName = document.getElementById('editFileName');
            var fileSize = document.getElementById('editFileSize');

            previewImage.src = event.target.result;
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            buttonContainer.classList.remove('hidden');

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

    function removeEditImage() {
        document.getElementById('editFoto').value = '';
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editPreviewContainer').classList.add('hidden');
        document.getElementById('editPreviewImage').src = '#';
        document.getElementById('editButtonContainer').classList.add('hidden');
        document.getElementById('edit_thumbnail_error').textContent = '';
    }

    function triggerEditFileInput() {
        document.getElementById('editFoto').click();
    }

    function cancelEditUpload() {
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editFoto').value = '';
    }

    // ========== SET EXISTING PREVIEW ==========
    function setEditPreviewImage(imageUrl) {
        var previewImage = document.getElementById('editPreviewImage');
        var previewContainer = document.getElementById('editPreviewContainer');
        var uploadArea = document.getElementById('editUploadArea');
        var buttonContainer = document.getElementById('editButtonContainer');
        var cancelContainer = document.getElementById('editCancelUploadContainer');
        var fileName = document.getElementById('editFileName');
        var fileSize = document.getElementById('editFileSize');

        console.log('setEditPreviewImage called with URL:', imageUrl);

        if (imageUrl && imageUrl !== '' && imageUrl !== 'null' && imageUrl !== '#') {
            previewImage.src = imageUrl;
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            buttonContainer.classList.remove('hidden');
            fileName.textContent = 'Foto saat ini';
            fileSize.textContent = '';
            console.log('Preview image set to:', previewImage.src);
        } else {
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.add('hidden');
            buttonContainer.classList.add('hidden');
            previewImage.src = '#';
            console.log('No image to preview');
        }
    }

    // ========== OPEN EDIT MODAL ==========
    window.openEditKategoriModal = function (id) {
        console.log('Opening edit modal for ID:', id);

        // Reset form
        document.getElementById('editKategoriForm').reset();
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editPreviewContainer').classList.add('hidden');
        document.getElementById('editButtonContainer').classList.add('hidden');
        document.getElementById('editPreviewImage').src = '#';
        document.querySelectorAll('#editKategoriForm .error-message').forEach(function (el) {
            el.textContent = '';
        });

        var url = '{{ url('/accommodation-categories') }}/' + id + '/edit';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log('Data received:', data);

                if (!data.success) {
                    throw new Error('Data kategori tidak ditemukan.');
                }

                var category = data.data;

                // Isi form
                document.getElementById('editId').value = category.id;
                document.getElementById('editNama').value = category.name || '';
                document.getElementById('editSlug').value = category.slug || '';
                document.getElementById('editDeskripsi').value = category.description || '';

                // Set action form
                document.getElementById('editKategoriForm').action = '{{ url('/accommodation-categories') }}/' + category.id;

                // Reset input file
                document.getElementById('editFoto').value = '';

                // ========== TAMPILKAN PREVIEW GAMBAR LAMA ==========
                console.log('Thumbnail from DB:', category.thumbnail);
                console.log('Thumbnail URL from DB:', category.thumbnail_url);

                var imageUrl = null;

                if (category.thumbnail_url) {
                    imageUrl = category.thumbnail_url;
                } else if (category.thumbnail) {
                    var cleanPath = category.thumbnail.replace(/^public\//, '');
                    imageUrl = '{{ asset('') }}' + cleanPath;
                }

                console.log('Final Image URL:', imageUrl);

                // Set preview image
                setEditPreviewImage(imageUrl);

                // Buka modal
                document.getElementById('editModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(function (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data kategori. Silakan coba lagi.'
                });
            });
    };

    // ========== CLOSE MODAL ==========
    window.closeEditModal = function () {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        removeEditImage();
    };

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var namaInput = document.getElementById('editNama');
        var slugInput = document.getElementById('editSlug');

        if (namaInput && slugInput) {
            namaInput.addEventListener('input', function () {
                var slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            });
        }

        // ========== EVENT LISTENER FOR FILE INPUT ==========
        var fotoInput = document.getElementById('editFoto');
        if (fotoInput) {
            fotoInput.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    previewEditImage(file);
                }
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#editModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>

<style>
    #editModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    /* Upload Area */
    #editUploadArea {
        transition: all 0.3s ease;
    }

    #editUploadArea:hover {
        border-color: #E60000;
    }

    /* Preview image container */
    #editPreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    #editPreviewImage {
        border: 2px solid #FFD4D4;
        border-radius: 8px;
        object-fit: cover;
        width: 100%;
        height: 192px;
    }

    .dark #editPreviewImage {
        border-color: #374151;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }

    /* Button Container */
    #editButtonContainer {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
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