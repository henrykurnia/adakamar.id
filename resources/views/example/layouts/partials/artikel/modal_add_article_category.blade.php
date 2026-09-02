<!-- Modal Tambah Kategori Artikel -->
<div id="addArticleCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddArticleCategoryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Kategori Artikel
                    </h3>
                    <button type="button" onclick="closeAddArticleCategoryModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('article-categories.store') }}" method="POST" enctype="multipart/form-data"
                    id="addArticleCategoryForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="addName"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="addName"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="add_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="addSlug"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" name="slug" id="addSlug"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Auto-generate dari nama">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug akan otomatis terisi dari nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
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

                        <!-- Deskripsi -->
                        <div>
                            <label for="addDescription"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="addDescription" rows="3"
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
                        <button type="button" onclick="closeAddArticleCategoryModal()"
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
    function openAddArticleCategoryModal() {
        document.getElementById('addArticleCategoryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addArticleCategoryForm').reset();
        document.querySelectorAll('#addArticleCategoryForm .error-message').forEach(function(el) {
            el.textContent = '';
        });
        setTimeout(function() {
            document.getElementById('addName').focus();
        }, 100);
    }

    function closeAddArticleCategoryModal() {
        document.getElementById('addArticleCategoryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function() {
        var namaInput = document.getElementById('addName');
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
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addArticleCategoryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddArticleCategoryModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#addArticleCategoryModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddArticleCategoryModal();
        }
    });
</script>

<style>
    #addArticleCategoryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addArticleCategoryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addArticleCategoryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }
</style>