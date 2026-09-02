<!-- Modal Edit Kategori Artikel -->
<div id="editArticleCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditArticleCategoryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Kategori Artikel
                    </h3>
                    <button type="button" onclick="closeEditArticleCategoryModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="#" method="POST" enctype="multipart/form-data" id="editArticleCategoryForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editId">

                        <!-- Nama Kategori -->
                        <div>
                            <label for="editName"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="editName"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="edit_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="editSlug"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" name="slug" id="editSlug"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Auto-generate dari nama">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug akan otomatis terisi dari nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
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

                        <!-- Deskripsi -->
                        <div>
                            <label for="editDescription"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="editDescription" rows="3"
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
                        <button type="button" onclick="closeEditArticleCategoryModal()"
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
    function openEditArticleCategoryModal(id) {
        // Gunakan URL langsung dengan menghilangkan double slash
        var url = '/article-categories/' + id + '/edit';

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
                    var category = data.data;

                    document.getElementById('editId').value = category.id;
                    document.getElementById('editName').value = category.name || '';
                    document.getElementById('editSlug').value = category.slug || '';
                    document.getElementById('editDescription').value = category.description || '';
                    document.getElementById('editIsActive').value = category.is_active ? 1 : 0;

                    // Set form action untuk update
                    document.getElementById('editArticleCategoryForm').action = '/article-categories/' + category.id;

                    document.querySelectorAll('#editArticleCategoryForm .error-message').forEach(function (el) {
                        el.textContent = '';
                    });

                    document.getElementById('editArticleCategoryModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data kategori'
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

    function closeEditArticleCategoryModal() {
        document.getElementById('editArticleCategoryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var namaInput = document.getElementById('editName');
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
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editArticleCategoryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditArticleCategoryModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#editArticleCategoryModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditArticleCategoryModal();
        }
    });
</script>

<style>
    #editArticleCategoryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editArticleCategoryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editArticleCategoryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }
</style>