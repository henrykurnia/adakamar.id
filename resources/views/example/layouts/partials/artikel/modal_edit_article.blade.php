<!-- Modal Edit Artikel -->
<div id="editArticleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditArticleModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Artikel
                    </h3>
                    <button type="button" onclick="closeEditArticleModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form action="#" method="POST" enctype="multipart/form-data" id="editArticleForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editArticleId">
                    <div class="space-y-6">
                        <!-- Informasi Artikel -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Artikel
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Judul -->
                                <div class="sm:col-span-2">
                                    <label for="editTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="editTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan judul artikel" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="sm:col-span-2">
                                    <label for="editSlug"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                    <input type="text" name="slug" id="editSlug"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Auto-generate dari judul">
                                    <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="editCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="editCategory" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_category_id_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="editStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select name="status" id="editStatus" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="Draft">Draft</option>
                                        <option value="Published">Published</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_status_error"></span>
                                </div>

                                <!-- Published At - hanya tanggal -->
                                <div>
                                    <label for="editPublishedAt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                        Publikasi</label>
                                    <input type="date" name="published_at" id="editPublishedAt"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_published_at_error"></span>
                                </div>

                                <!-- Excerpt -->
                                <div class="sm:col-span-2">
                                    <label for="editExcerpt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ringkasan</label>
                                    <textarea name="excerpt" id="editExcerpt" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan ringkasan artikel"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_excerpt_error"></span>
                                </div>

                                <!-- Content -->
                                <div class="sm:col-span-2">
                                    <label for="editContent"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konten
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="content" id="editContent" rows="6"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan konten artikel" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_content_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Thumbnail</h4>
                            <div class="flex flex-col items-center">
                                <!-- Preview Image -->
                                <div id="editThumbnailPreviewContainer" class="hidden relative w-full">
                                    <img id="editThumbnailPreview" src="#" alt="Preview Thumbnail"
                                        class="w-full h-48 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                    <div
                                        class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <span id="editThumbnailFileName"></span>
                                        <span class="mx-2">|</span>
                                        <span id="editThumbnailFileSize"></span>
                                    </div>
                                    <button type="button" onclick="removeEditThumbnail()"
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
                                <div id="editThumbnailUploadArea"
                                    class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                    <label for="editThumbnailUpload"
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
                                        <input type="file" id="editThumbnailUpload" name="thumbnail" accept="image/*"
                                            class="hidden">
                                    </label>
                                </div>

                                <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                            </div>
                        </div>

                        <!-- SEO -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">SEO</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="editMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="edit_meta_title_error"></span>
                                </div>
                                <div>
                                    <label for="editMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="editMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_description_error"></span>
                                </div>
                                <div>
                                    <label for="editMetaKeywords"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Keywords</label>
                                    <input type="text" name="meta_keywords" id="editMetaKeywords"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Keywords (pisahkan dengan koma)">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_keywords_error"></span>
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
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Artikel
                        </button>
                        <button type="button" onclick="closeEditArticleModal()"
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
    function openEditArticleModal(id) {
        // Gunakan route show untuk mengambil data
        var url = '{{ route('articles.show', '') }}/' + id;

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
                if (data.success) {
                    var article = data.data;

                    document.getElementById('editArticleId').value = article.id;
                    document.getElementById('editTitle').value = article.title || '';
                    document.getElementById('editSlug').value = article.slug || '';
                    document.getElementById('editCategory').value = article.category_id || '';
                    document.getElementById('editStatus').value = article.status || 'Draft';

                    // Format published_at untuk input date (hanya tanggal)
                    if (article.published_at) {
                        var date = new Date(article.published_at);
                        var formattedDate = date.getFullYear() + '-' +
                            String(date.getMonth() + 1).padStart(2, '0') + '-' +
                            String(date.getDate()).padStart(2, '0');
                        document.getElementById('editPublishedAt').value = formattedDate;
                    } else {
                        document.getElementById('editPublishedAt').value = '';
                    }

                    document.getElementById('editExcerpt').value = article.excerpt || '';
                    document.getElementById('editContent').value = article.content || '';
                    document.getElementById('editMetaTitle').value = article.meta_title || '';
                    document.getElementById('editMetaDescription').value = article.meta_description || '';
                    document.getElementById('editMetaKeywords').value = article.meta_keywords || '';

                    // Thumbnail
                    var previewContainer = document.getElementById('editThumbnailPreviewContainer');
                    var preview = document.getElementById('editThumbnailPreview');
                    var uploadArea = document.getElementById('editThumbnailUploadArea');

                    if (article.thumbnail) {
                        var thumbnailPath = article.thumbnail.replace(/^public\//, '');
                        preview.src = '{{ asset('') }}' + thumbnailPath;
                        previewContainer.classList.remove('hidden');
                        uploadArea.classList.add('hidden');
                    } else {
                        previewContainer.classList.add('hidden');
                        uploadArea.classList.remove('hidden');
                    }

                    // Set form action untuk update
                    document.getElementById('editArticleForm').action = '{{ route('articles.update', '') }}/' + article.id;

                    document.querySelectorAll('#editArticleForm .error-message').forEach(function (el) {
                        el.textContent = '';
                    });

                    document.getElementById('editArticleModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data artikel'
                    });
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message
                });
            });
    }

    function closeEditArticleModal() {
        document.getElementById('editArticleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('editThumbnailUpload');
        var previewContainer = document.getElementById('editThumbnailPreviewContainer');
        var preview = document.getElementById('editThumbnailPreview');
        var uploadArea = document.getElementById('editThumbnailUploadArea');
        var fileName = document.getElementById('editThumbnailFileName');
        var fileSize = document.getElementById('editThumbnailFileSize');

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

        window.removeEditThumbnail = function () {
            document.getElementById('editThumbnailUpload').value = '';
            document.getElementById('editThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('editThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('edit_thumbnail_error').textContent = '';
        };
    });

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var titleInput = document.getElementById('editTitle');
        var slugInput = document.getElementById('editSlug');

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
            var modal = document.getElementById('editArticleModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditArticleModal();
            }
        }
    });

    document.querySelector('#editArticleModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditArticleModal();
        }
    });
</script>

<style>
    #editArticleModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editArticleModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editArticleModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    #editThumbnailPreviewContainer {
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