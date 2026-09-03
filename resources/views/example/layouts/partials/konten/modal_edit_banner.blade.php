<!-- Modal Edit Banner -->
<div id="editBannerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditBannerModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Banner
                    </h3>
                    <button type="button" onclick="closeEditBannerModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="editBannerForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="editTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="editTitle"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan judul banner" required>
                            <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                        </div>

                        <!-- Subjudul -->
                        <div>
                            <label for="editSubtitle"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Subjudul
                            </label>
                            <input type="text" name="subtitle" id="editSubtitle"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan subjudul banner (opsional)">
                            <span class="text-red-500 text-xs error-message" id="edit_subtitle_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Gambar
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Kosongkan jika tidak ingin
                                mengganti gambar. Format: JPG, JPEG, PNG, WEBP (Maks. 2MB)</p>

                            <div id="editImageUploadArea"
                                class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="editImageUpload"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> gambar baru
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG, PNG, WEBP (Maks.
                                            2MB)</p>
                                    </div>
                                    <input type="file" id="editImageUpload" name="image" accept="image/*"
                                        class="hidden">
                                </label>
                            </div>

                            <!-- Preview Gambar -->
                            <div id="editImagePreviewContainer" class="hidden relative w-full mt-2">
                                <img id="editImagePreview" src="#" alt="Preview Gambar"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                <div
                                    class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="editImageFileName"></span>
                                    <span class="mx-2">|</span>
                                    <span id="editImageFileSize"></span>
                                </div>
                                <button type="button" onclick="removeEditImage()"
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
                            <span class="text-red-500 text-xs error-message" id="edit_image_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="button" onclick="submitEditBanner()"
                            class="text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v6h6m-6 0l6-6m0 16v-6h-6m6 0l-6 6"></path>
                            </svg>
                            Update Banner
                        </button>
                        <button type="button" onclick="closeEditBannerModal()"
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
    let editBannerId = null;
    let isImageChanged = false;

    // ========== OPEN/CLOSE MODAL ==========
    function openEditBannerModal(id) {
        editBannerId = id;
        isImageChanged = false;

        Swal.fire({
            title: 'Memuat data...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch('{{ route('banners.edit', '') }}/' + id, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                Swal.close();

                if (data.success) {
                    const banner = data.data;

                    document.getElementById('editId').value = banner.id;
                    document.getElementById('editTitle').value = banner.title || '';
                    document.getElementById('editSubtitle').value = banner.subtitle || '';

                    // ========== IMAGE ==========
                    const uploadArea = document.getElementById('editImageUploadArea');
                    const previewContainer = document.getElementById('editImagePreviewContainer');
                    const preview = document.getElementById('editImagePreview');
                    const fileName = document.getElementById('editImageFileName');
                    const fileSize = document.getElementById('editImageFileSize');

                    if (banner.image) {
                        let imagePath = banner.image.replace(/^public\//, '');
                        preview.src = '{{ asset('') }}' + imagePath;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = 'Gambar saat ini';
                        fileSize.textContent = '';
                    } else {
                        uploadArea.classList.remove('hidden');
                        previewContainer.classList.add('hidden');
                    }

                    document.querySelectorAll('#editBannerForm .error-message').forEach(el => el.textContent = '');

                    document.getElementById('editBannerModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data banner'
                    });
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message
                });
            });
    }

    function closeEditBannerModal() {
        document.getElementById('editBannerModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== IMAGE UPLOAD ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editImageUpload');
        const uploadArea = document.getElementById('editImageUploadArea');
        const previewContainer = document.getElementById('editImagePreviewContainer');
        const preview = document.getElementById('editImagePreview');
        const fileName = document.getElementById('editImageFileName');
        const fileSize = document.getElementById('editImageFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (e.target.files.length > 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Hanya boleh upload 1 gambar.'
                    });
                    const firstFile = e.target.files[0];
                    const dt = new DataTransfer();
                    dt.items.add(firstFile);
                    this.files = dt.files;
                }

                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 2MB'
                        });
                        this.value = '';
                        return;
                    }
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
                        });
                        this.value = '';
                        return;
                    }

                    isImageChanged = true;

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');

                        fileName.textContent = file.name;
                        const sizeInKB = (file.size / 1024).toFixed(2);
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

        window.removeEditImage = function () {
            document.getElementById('editImageUpload').value = '';
            document.getElementById('editImageUploadArea').classList.remove('hidden');
            document.getElementById('editImagePreviewContainer').classList.add('hidden');
            document.getElementById('edit_image_error').textContent = '';
            isImageChanged = true;
        };
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitEditBanner = async function () {
        console.log('=== SUBMIT EDIT BANNER ===');

        document.querySelectorAll('#editBannerForm .error-message').forEach(el => el.textContent = '');

        const title = document.getElementById('editTitle').value.trim();

        if (!title) {
            document.getElementById('edit_title_error').textContent = 'Judul wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Judul wajib diisi' });
            document.getElementById('editTitle').focus();
            return;
        }

        console.log('Validasi berhasil');

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            Swal.fire({ icon: 'error', title: 'Error!', text: 'CSRF token tidak ditemukan.' });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        const id = document.getElementById('editId').value;

        const form = document.getElementById('editBannerForm');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Mengupdate...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            const response = await fetch('{{ route('banners.update', '') }}/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            });

            let data;
            const contentType = response.headers.get('content-type') || '';
            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Response bukan JSON:', text);
                throw new Error(`Server mengembalikan response bukan JSON. HTTP ${response.status}`);
            }

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Banner berhasil diupdate!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeEditBannerModal();
                    location.reload();
                });
                return;
            }

            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorEl = document.getElementById('edit_' + key + '_error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data.errors[key];
                    }
                });
                const firstError = Object.values(data.errors)[0];
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: Array.isArray(firstError) ? firstError[0] : firstError
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Gagal mengupdate banner'
                });
            }

        } catch (error) {
            console.error('=== ERROR SUBMIT ===', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan: ' + error.message
            });
        }
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('editBannerModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditBannerModal();
            }
        }
    });

    document.querySelector('#editBannerModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeEditBannerModal();
    });
</script>

<style>
    #editBannerModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editBannerModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editBannerModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editBannerModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editBannerModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #editBannerModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #editBannerModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #editBannerModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    .error-message {
        margin-top: 4px;
        display: block;
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
</style>