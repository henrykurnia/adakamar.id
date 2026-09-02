<!-- Modal Edit Galeri -->
<div id="editGalleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditGalleryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Galeri
                    </h3>
                    <button type="button" onclick="closeEditGalleryModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="#" method="POST" enctype="multipart/form-data" id="editGalleryForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editId">

                        <!-- Judul -->
                        <div>
                            <label for="editTitle"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="editTitle"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan judul galeri" required>
                            <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="editImage"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>

                            <!-- Preview Image -->
                            <div id="editImagePreviewContainer" class="relative w-full mb-3">
                                <img id="editImagePreview" src="#" alt="Preview Gambar"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                <div class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="editImageFileName">Gambar saat ini</span>
                                    <span class="mx-2">|</span>
                                    <span id="editImageFileSize"></span>
                                </div>
                                <button type="button" onclick="removeEditImage()"
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

                            <!-- Upload Area -->
                            <div id="editImageUploadArea"
                                class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="editImageUpload" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> gambar baru
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP, GIF (Maks. 5MB)</p>
                                    </div>
                                    <input type="file" id="editImageUpload" name="image" accept="image/*"
                                        class="hidden">
                                </label>
                            </div>

                            <span class="text-red-500 text-xs error-message" id="edit_image_error"></span>
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="editSortOrder"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Urutan</label>
                            <input type="number" name="sort_order" id="editSortOrder"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan urutan" min="0">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Urutan yang lebih kecil akan tampil lebih dulu</p>
                            <span class="text-red-500 text-xs error-message" id="edit_sort_order_error"></span>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="editIsActive"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select name="is_active" id="editIsActive"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <span class="text-red-500 text-xs error-message" id="edit_is_active_error"></span>
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
                            Update Galeri
                        </button>
                        <button type="button" onclick="closeEditGalleryModal()"
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
    function openEditGalleryModal(id) {
        // Gunakan URL /galeri sesuai route
        var url = '/galeri/' + id + '/edit';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if (data.success) {
                var gallery = data.data;

                document.getElementById('editId').value = gallery.id;
                document.getElementById('editTitle').value = gallery.title || '';
                document.getElementById('editSortOrder').value = gallery.sort_order || '';
                document.getElementById('editIsActive').value = gallery.is_active ? 1 : 0;

                // Preview Image
                var previewContainer = document.getElementById('editImagePreviewContainer');
                var preview = document.getElementById('editImagePreview');
                var uploadArea = document.getElementById('editImageUploadArea');

                if (gallery.image) {
                    var imagePath = gallery.image.replace(/^public\//, '');
                    preview.src = '{{ asset('') }}' + imagePath;
                    previewContainer.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                } else {
                    previewContainer.classList.add('hidden');
                    uploadArea.classList.remove('hidden');
                }

                // Set form action untuk update - gunakan /galeri sesuai route
                document.getElementById('editGalleryForm').action = '/galeri/' + gallery.id;

                document.querySelectorAll('#editGalleryForm .error-message').forEach(function(el) {
                    el.textContent = '';
                });

                document.getElementById('editGalleryModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Gagal memuat data galeri'
                });
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan: ' + error.message
            });
        });
    }

    function closeEditGalleryModal() {
        document.getElementById('editGalleryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== IMAGE PREVIEW ==========
    document.addEventListener('DOMContentLoaded', function() {
        var upload = document.getElementById('editImageUpload');
        var previewContainer = document.getElementById('editImagePreviewContainer');
        var preview = document.getElementById('editImagePreview');
        var uploadArea = document.getElementById('editImageUploadArea');
        var fileName = document.getElementById('editImageFileName');
        var fileSize = document.getElementById('editImageFileSize');

        if (upload) {
            upload.addEventListener('change', function(e) {
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
                    reader.onload = function(event) {
                        preview.src = event.target.result;
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
            });
        }

        window.removeEditImage = function() {
            document.getElementById('editImageUpload').value = '';
            document.getElementById('editImageUploadArea').classList.remove('hidden');
            document.getElementById('editImagePreviewContainer').classList.add('hidden');
            document.getElementById('edit_image_error').textContent = '';
        };
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editGalleryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditGalleryModal();
            }
        }
    });

    document.querySelector('#editGalleryModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditGalleryModal();
        }
    });
</script>

<style>
    #editGalleryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editGalleryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editGalleryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editImagePreviewContainer {
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