<!-- Modal Tambah Artikel -->
<div id="addArticleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddArticleModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm2 0v10h12V5H4z" />
                            <path d="M6 7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" />
                            <path d="M6 11a1 1 0 011-1h4a1 1 0 110 2H7a1 1 0 01-1-1z" />
                        </svg>
                        Tambah Artikel
                    </h3>
                    <button type="button" onclick="closeAddArticleModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data"
                    id="addArticleForm">
                    @csrf
                    <div class="space-y-6">
                        <!-- Informasi Artikel -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Artikel
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Judul -->
                                <div class="sm:col-span-2">
                                    <label for="addTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="addTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan judul artikel" required>
                                    <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="sm:col-span-2">
                                    <label for="addSlug"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                    <input type="text" name="slug" id="addSlug"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Auto-generate dari judul">
                                    <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="addCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="addCategory" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_category_id_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="addStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select name="status" id="addStatus" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="Draft">Draft</option>
                                        <option value="Published">Published</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_status_error"></span>
                                </div>

                                <!-- Published At - hanya tanggal -->
                                <div>
                                    <label for="addPublishedAt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                        Publikasi</label>
                                    <input type="date" name="published_at" id="addPublishedAt"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                    <span class="text-red-500 text-xs error-message" id="add_published_at_error"></span>
                                </div>

                                <!-- Excerpt -->
                                <div class="sm:col-span-2">
                                    <label for="addExcerpt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ringkasan</label>
                                    <textarea name="excerpt" id="addExcerpt" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan ringkasan artikel"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_excerpt_error"></span>
                                </div>

                                <!-- Content -->
                                <div class="sm:col-span-2">
                                    <label for="addContent"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konten
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="content" id="addContent" rows="6"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan konten artikel" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_content_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Thumbnail</h4>
                            <div class="flex flex-col items-center">
                                <!-- Preview Image -->
                                <div id="addThumbnailPreviewContainer" class="hidden relative w-full">
                                    <img id="addThumbnailPreview" src="#" alt="Preview Thumbnail"
                                        class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                    <div
                                        class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <span id="addThumbnailFileName"></span>
                                        <span class="mx-2">|</span>
                                        <span id="addThumbnailFileSize"></span>
                                    </div>
                                    <button type="button" onclick="removeAddThumbnail()"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div
                                        class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none">
                                    </div>
                                    <div
                                        class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terupload
                                    </div>
                                </div>

                                <!-- Upload Area -->
                                <div id="addThumbnailUploadArea"
                                    class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                    <label for="addThumbnailUpload"
                                        class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Klik untuk upload</span> thumbnail
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks.
                                                5MB)</p>
                                        </div>
                                        <input type="file" id="addThumbnailUpload" name="thumbnail" accept="image/*"
                                            class="hidden">
                                    </label>
                                </div>

                                <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">SEO</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="addMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="add_meta_title_error"></span>
                                </div>
                                <div>
                                    <label for="addMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="addMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_meta_description_error"></span>
                                </div>
                                <div>
                                    <label for="addMetaKeywords"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Keywords</label>
                                    <input type="text" name="meta_keywords" id="addMetaKeywords"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Keywords (pisahkan dengan koma)">
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_meta_keywords_error"></span>
                                </div>
                            </div>
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
                            Simpan Artikel
                        </button>
                        <button type="button" onclick="closeAddArticleModal()"
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
    function openAddArticleModal() {
        document.getElementById('addArticleModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addArticleForm').reset();
        document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
        document.getElementById('addThumbnailUploadArea').classList.remove('hidden');

        // Set tanggal hari ini otomatis
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');
        document.getElementById('addPublishedAt').value = year + '-' + month + '-' + day;

        document.querySelectorAll('#addArticleForm .error-message').forEach(function (el) {
            el.textContent = '';
        });
        setTimeout(function () {
            document.getElementById('addTitle').focus();
        }, 100);
    }

    function closeAddArticleModal() {
        document.getElementById('addArticleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('addThumbnailUpload');
        var previewContainer = document.getElementById('addThumbnailPreviewContainer');
        var preview = document.getElementById('addThumbnailPreview');
        var fileName = document.getElementById('addThumbnailFileName');
        var fileSize = document.getElementById('addThumbnailFileSize');

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
                        document.getElementById('addThumbnailUploadArea').classList.add('hidden');
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

        window.removeAddThumbnail = function () {
            document.getElementById('addThumbnailUpload').value = '';
            document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('add_thumbnail_error').textContent = '';
        };
    });

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var titleInput = document.getElementById('addTitle');
        var slugInput = document.getElementById('addSlug');

        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                var slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addArticleModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddArticleModal();
            }
        }
    });

    document.querySelector('#addArticleModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddArticleModal();
        }
    });
</script>

<style>
    #addArticleModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addArticleModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addArticleModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    #addThumbnailPreviewContainer {
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