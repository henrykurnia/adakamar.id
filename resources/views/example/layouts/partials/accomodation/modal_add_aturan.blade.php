<!-- Modal Tambah Aturan -->
<div id="addAturanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddAturanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">Tambah Aturan Baru</h3>
                    <button type="button" onclick="closeAddAturanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('rules.store') }}" method="POST" id="addAturanForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Aturan -->
                        <div>
                            <label for="addNamaAturan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aturan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="addNamaAturan"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan nama aturan" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="addDeskripsiAturan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="description" id="addDeskripsiAturan" rows="3"
                                class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                placeholder="Masukkan deskripsi aturan"></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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
                            Tambah Aturan
                        </button>
                        <button type="button" onclick="closeAddAturanModal()"
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
    function openAddAturanModal() {
        document.getElementById('addAturanModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addAturanForm').reset();
        document.getElementById('addNamaAturan').classList.remove('border-red-500');
        setTimeout(() => {
            document.getElementById('addNamaAturan').focus();
        }, 100);
    }

    function closeAddAturanModal() {
        document.getElementById('addAturanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAddAturanModal();
    });

    document.querySelector('#addAturanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeAddAturanModal();
    });
</script>

<style>
    #addAturanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addAturanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addAturanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
</style>