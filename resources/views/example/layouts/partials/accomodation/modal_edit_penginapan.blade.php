<!-- Modal Edit Penginapan -->
<div id="editPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Penginapan
                    </h3>
                    <button type="button" onclick="closeEditPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="editPenginapanForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <div class="space-y-6">
                        <!-- Informasi Penginapan -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi
                                Penginapan</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Kategori -->
                                <div class="sm:col-span-2">
                                    <label for="editCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select id="editCategory" name="category_id" required
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

                                <!-- Title -->
                                <div class="sm:col-span-2 lg:col-span-3">
                                    <label for="editTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Penginapan <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="editTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan nama penginapan" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                                </div>

                                <!-- Slug (Auto-generated with edit option) -->
                                <div class="col-span-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="editSlug"
                                            class="text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                        <button type="button" onclick="generateEditSlugFromTitle()"
                                            class="text-xs text-[#E60000] hover:text-[#B71C1C] dark:text-[#FF6B6B] dark:hover:text-[#FF6B6B] font-medium">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                            Generate dari Nama
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="editSlug"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong untuk
                                        auto-generate atau edit sesuai keinginan</p>
                                    <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                                </div>

                                <!-- Address -->
                                <div class="col-span-full">
                                    <label for="editAddress"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="address" id="editAddress"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan alamat lengkap" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_address_error"></span>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="editPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per
                                        Malam <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" id="editPrice"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="350000" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_price_error"></span>
                                </div>

                                <!-- Capacity -->
                                <div>
                                    <label for="editCapacity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kapasitas
                                        (Orang) <span class="text-red-500">*</span></label>
                                    <input type="number" name="capacity" id="editCapacity"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="4" required min="1">
                                    <span class="text-red-500 text-xs error-message" id="edit_capacity_error"></span>
                                </div>

                                <!-- Bedroom -->
                                <div>
                                    <label for="editBedroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Tidur
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bedroom" id="editBedroom"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="2" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_bedroom_error"></span>
                                </div>

                                <!-- Bathroom -->
                                <div>
                                    <label for="editBathroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Mandi
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bathroom" id="editBathroom"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="1" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_bathroom_error"></span>
                                </div>

                                <!-- Size -->
                                <div>
                                    <label for="editSize"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran
                                        (m²)</label>
                                    <input type="text" name="size" id="editSize"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="45">
                                    <span class="text-red-500 text-xs error-message" id="edit_size_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="editStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select id="editStatus" name="status" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="">Pilih Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Full">Full</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_status_error"></span>
                                </div>

                                <!-- Description -->
                                <div class="col-span-full">
                                    <label for="editDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="description" id="editDescription" rows="3"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan deskripsi lengkap" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_description_error"></span>
                                </div>

                                <!-- Meta Title -->
                                <div class="col-span-full">
                                    <label for="editMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="editMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="edit_meta_title_error"></span>
                                </div>

                                <!-- Meta Description -->
                                <div class="col-span-full">
                                    <label for="editMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="editMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_description_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Thumbnail</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Kosongkan jika tidak ingin
                                mengganti thumbnail</p>
                            <div class="flex flex-col items-center">
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
                                                <span class="font-semibold">Klik untuk upload</span> thumbnail baru
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks.
                                                5MB)</p>
                                        </div>
                                        <input type="file" id="editThumbnailUpload" name="thumbnail" accept="image/*"
                                            class="hidden">
                                    </label>
                                </div>

                                <!-- Preview Thumbnail (muncul setelah upload) -->
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

                                <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Fasilitas</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Pilih fasilitas yang tersedia</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @if(isset($facilities) && $facilities->count())
                                    @foreach($facilities as $facility)
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="facility_ids[]" value="{{ $facility->id }}"
                                                class="edit-facility-checkbox rounded border-gray-300 text-[#E60000] focus:ring-[#E60000] dark:border-gray-600 dark:bg-gray-700"
                                                data-facility-id="{{ $facility->id }}">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada fasilitas
                                        tersedia</p>
                                @endif
                            </div>
                            <span class="text-red-500 text-xs error-message" id="edit_facility_ids_error"></span>
                        </div>

                        <!-- Aturan -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Aturan</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Pilih aturan yang berlaku</p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @if(isset($rules) && $rules->count())
                                    @foreach($rules as $rule)
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="rule_ids[]" value="{{ $rule->id }}"
                                                class="edit-rule-checkbox rounded border-gray-300 text-[#E60000] focus:ring-[#E60000] dark:border-gray-600 dark:bg-gray-700"
                                                data-rule-id="{{ $rule->id }}">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $rule->name }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada aturan
                                        tersedia</p>
                                @endif
                            </div>
                            <span class="text-red-500 text-xs error-message" id="edit_rule_ids_error"></span>
                        </div>

                        <!-- Galeri -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Galeri Foto</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Upload foto galeri penginapan
                                (Maksimal 10 foto)</p>
                            <div id="editGalleryContainer"
                                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                <!-- Galeri akan ditambahkan di sini -->
                            </div>
                            <div id="editUploadGaleriContainer">
                                <label id="editUploadGaleriBtn"
                                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#E60000] text-white rounded-lg hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B]">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                    </svg>
                                    Tambah Foto Galeri
                                    <input type="file" id="editGalleryUpload" name="gallery[]" accept="image/*" multiple
                                        class="hidden">
                                </label>
                                <span id="editGalleryCounter" class="ml-3 text-sm text-gray-500 dark:text-gray-400">0 /
                                    10 foto</span>
                            </div>
                            <span class="text-red-500 text-xs error-message" id="edit_gallery_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="button" onclick="submitEditPenginapan()"
                            class="text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v6h6m-6 0l6-6m0 16v-6h-6m6 0l-6 6"></path>
                            </svg>
                            Update Penginapan
                        </button>
                        <button type="button" onclick="closeEditPenginapanModal()"
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
    let editGalleryPhotos = [];
    let editExistingGallery = [];
    const maxEditGalleryPhotos = 10;
    let editAccommodationId = null;
    let isThumbnailChanged = false;

    // ========== OPEN/CLOSE MODAL ==========
    function openEditPenginapanModal(id) {
        editAccommodationId = id;
        isThumbnailChanged = false;

        Swal.fire({
            title: 'Memuat data...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('{{ route('accommodations.show', '') }}/' + id, {
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
                    const accommodation = data.data;

                    console.log('Data accommodation untuk edit:', accommodation);

                    document.getElementById('editId').value = accommodation.id;

                    document.getElementById('editCategory').value = accommodation.category_id || '';
                    document.getElementById('editTitle').value = accommodation.title || '';
                    document.getElementById('editSlug').value = accommodation.slug || '';
                    document.getElementById('editAddress').value = accommodation.address || '';
                    document.getElementById('editPrice').value = accommodation.price || '';
                    document.getElementById('editCapacity').value = accommodation.capacity || '';
                    document.getElementById('editBedroom').value = accommodation.bedroom || '';
                    document.getElementById('editBathroom').value = accommodation.bathroom || '';
                    document.getElementById('editSize').value = accommodation.size || '';
                    document.getElementById('editStatus').value = accommodation.status || '';
                    document.getElementById('editDescription').value = accommodation.description || '';
                    document.getElementById('editMetaTitle').value = accommodation.meta_title || '';
                    document.getElementById('editMetaDescription').value = accommodation.meta_description || '';

                    // ========== THUMBNAIL ==========
                    const uploadArea = document.getElementById('editThumbnailUploadArea');
                    const previewContainer = document.getElementById('editThumbnailPreviewContainer');
                    const preview = document.getElementById('editThumbnailPreview');
                    const fileName = document.getElementById('editThumbnailFileName');
                    const fileSize = document.getElementById('editThumbnailFileSize');

                    if (accommodation.thumbnail) {
                        let thumbnailPath = accommodation.thumbnail.replace(/^public\//, '');
                        preview.src = '{{ asset('') }}' + thumbnailPath;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = 'Thumbnail saat ini';
                        fileSize.textContent = '';
                    } else {
                        uploadArea.classList.remove('hidden');
                        previewContainer.classList.add('hidden');
                        preview.src = '{{ asset('landingpage/home.png') }}';
                    }

                    // ========== FACILITIES ==========
                    document.querySelectorAll('.edit-facility-checkbox').forEach(checkbox => {
                        checkbox.checked = false;
                    });

                    let facilityIds = [];
                    if (accommodation.facility_ids && accommodation.facility_ids.length > 0) {
                        facilityIds = accommodation.facility_ids;
                    } else if (accommodation.facilities && accommodation.facilities.length > 0) {
                        facilityIds = accommodation.facilities.map(f => f.id);
                    }

                    if (facilityIds.length > 0) {
                        document.querySelectorAll('.edit-facility-checkbox').forEach(checkbox => {
                            const val = parseInt(checkbox.value);
                            if (facilityIds.includes(val)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    // ========== RULES ==========
                    document.querySelectorAll('.edit-rule-checkbox').forEach(checkbox => {
                        checkbox.checked = false;
                    });

                    let ruleIds = [];
                    if (accommodation.rule_ids && accommodation.rule_ids.length > 0) {
                        ruleIds = accommodation.rule_ids;
                    } else if (accommodation.rules && accommodation.rules.length > 0) {
                        ruleIds = accommodation.rules.map(r => r.id);
                    }

                    if (ruleIds.length > 0) {
                        document.querySelectorAll('.edit-rule-checkbox').forEach(checkbox => {
                            const val = parseInt(checkbox.value);
                            if (ruleIds.includes(val)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    // ========== GALLERY ==========
                    editExistingGallery = [];
                    if (accommodation.gallery && accommodation.gallery.length > 0) {
                        editExistingGallery = accommodation.gallery.map(g => ({
                            id: g.id,
                            image: g.image,
                            image_url: g.image ? '{{ asset('') }}' + g.image.replace(/^public\//, '') : null
                        }));
                    }

                    editGalleryPhotos = [];
                    renderEditGallery();
                    updateEditGalleryCounter();

                    document.querySelectorAll('#editPenginapanForm .error-message').forEach(el => el.textContent = '');

                    document.getElementById('editPenginapanModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data penginapan'
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

    function closeEditPenginapanModal() {
        document.getElementById('editPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        editGalleryPhotos = [];
        editExistingGallery = [];
        renderEditGallery();
        updateEditGalleryCounter();
    }

    // ========== SLUG GENERATOR ==========
    function generateEditSlugFromTitle() {
        const title = document.getElementById('editTitle').value.trim();
        const slugInput = document.getElementById('editSlug');

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Masukkan nama penginapan terlebih dahulu'
            });
            document.getElementById('editTitle').focus();
            return;
        }

        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        slugInput.value = slug;

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Slug telah digenerate dari nama penginapan',
            timer: 1500,
            showConfirmButton: false
        });
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editThumbnailUpload');
        const uploadArea = document.getElementById('editThumbnailUploadArea');
        const previewContainer = document.getElementById('editThumbnailPreviewContainer');
        const preview = document.getElementById('editThumbnailPreview');
        const fileName = document.getElementById('editThumbnailFileName');
        const fileSize = document.getElementById('editThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (e.target.files.length > 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Hanya boleh upload 1 foto thumbnail. Foto pertama yang akan digunakan.'
                    });
                    const firstFile = e.target.files[0];
                    const dt = new DataTransfer();
                    dt.items.add(firstFile);
                    this.files = dt.files;
                }

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

                    isThumbnailChanged = true;

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

        window.removeEditThumbnail = function () {
            document.getElementById('editThumbnailUpload').value = '';
            document.getElementById('editThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('editThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('edit_thumbnail_error').textContent = '';
            isThumbnailChanged = true;
        };
    });

    // ========== GALLERY ==========
    function updateEditGalleryCounter() {
        const counter = document.getElementById('editGalleryCounter');
        const uploadBtn = document.getElementById('editUploadGaleriBtn');
        const totalPhotos = editExistingGallery.length + editGalleryPhotos.length;
        const maxPhotos = maxEditGalleryPhotos;

        counter.textContent = `${totalPhotos} / ${maxPhotos} foto`;

        if (totalPhotos >= maxPhotos) {
            uploadBtn.style.opacity = '0.5';
            uploadBtn.style.cursor = 'not-allowed';
            document.getElementById('editGalleryUpload').disabled = true;
        } else {
            uploadBtn.style.opacity = '1';
            uploadBtn.style.cursor = 'pointer';
            document.getElementById('editGalleryUpload').disabled = false;
        }
    }

    function renderEditGallery() {
        const container = document.getElementById('editGalleryContainer');
        container.innerHTML = '';

        const allPhotos = [];

        editExistingGallery.forEach(photo => {
            allPhotos.push({
                id: photo.id,
                url: photo.image_url || '{{ asset('landingpage/home.png') }}',
                isExisting: true
            });
        });

        editGalleryPhotos.forEach((photo, index) => {
            allPhotos.push({
                id: 'new_' + index,
                url: photo.url,
                isExisting: false,
                file: photo.file
            });
        });

        if (allPhotos.length === 0) {
            container.innerHTML = `
                <div class="col-span-full text-center py-8 text-gray-400 dark:text-gray-500 border-2 border-dashed border-[#FFD4D4] dark:border-gray-600 rounded-lg">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada foto galeri</p>
                    <p class="text-xs">Klik tombol "Tambah Foto Galeri" untuk menambahkan</p>
                </div>
            `;
            return;
        }

        allPhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${photo.url}" alt="Galeri ${index + 1}" 
                    class="w-full h-32 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                <button type="button" onclick="removeEditGalleryPhoto(${index})" 
                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition-colors opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                ${photo.isExisting ? '<span class="absolute bottom-2 left-2 bg-green-600/80 text-white text-xs px-2 py-1 rounded">Existing</span>' :
                    `<span class="absolute bottom-2 left-2 bg-blue-600/80 text-white text-xs px-2 py-1 rounded">New</span>`}
            `;
            container.appendChild(div);
        });
    }

    function removeEditGalleryPhoto(index) {
        const allPhotos = [];
        editExistingGallery.forEach(photo => {
            allPhotos.push({ id: photo.id, isExisting: true });
        });
        editGalleryPhotos.forEach(photo => {
            allPhotos.push({ id: 'new_' + Date.now(), isExisting: false });
        });

        if (index < allPhotos.length) {
            const photo = allPhotos[index];
            if (photo.isExisting) {
                const existingIndex = editExistingGallery.findIndex(p => p.id === photo.id);
                if (existingIndex !== -1) {
                    editExistingGallery.splice(existingIndex, 1);
                }
            } else {
                const newIndex = index - editExistingGallery.length;
                if (newIndex >= 0 && newIndex < editGalleryPhotos.length) {
                    editGalleryPhotos.splice(newIndex, 1);
                }
            }
        }

        renderEditGallery();
        updateEditGalleryCounter();
    }

    function addEditGalleryPhoto(file) {
        const totalPhotos = editExistingGallery.length + editGalleryPhotos.length;
        if (totalPhotos >= maxEditGalleryPhotos) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Maksimal 10 foto galeri!'
            });
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Ukuran file maksimal 5MB'
            });
            return;
        }

        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
            });
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            editGalleryPhotos.push({
                url: event.target.result,
                file: file
            });
            renderEditGallery();
            updateEditGalleryCounter();
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editGalleryUpload');
        if (upload) {
            upload.addEventListener('change', function (e) {
                const files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    addEditGalleryPhoto(files[i]);
                }
                this.value = '';
            });
        }

        const container = document.getElementById('editUploadGaleriContainer');
        if (container) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                container.addEventListener(eventName, function (e) { e.preventDefault(); e.stopPropagation(); });
            });
            container.addEventListener('dragover', function () { this.classList.add('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('dragleave', function () { this.classList.remove('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('drop', function (e) {
                this.classList.remove('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg');
                const files = e.dataTransfer.files;
                for (let i = 0; i < files.length; i++) { addEditGalleryPhoto(files[i]); }
            });
        }

        // Auto generate slug on title input - hanya jika slug kosong
        const titleInput = document.getElementById('editTitle');
        const slugInput = document.getElementById('editSlug');
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                // Hanya auto-generate jika slug kosong
                if (slugInput.value === '') {
                    const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }

        console.log('Modal Edit Penginapan siap digunakan.');
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitEditPenginapan = async function () {
        console.log('=== SUBMIT EDIT PENGINAPAN ===');

        document.querySelectorAll('#editPenginapanForm .error-message').forEach(el => el.textContent = '');

        const category = document.getElementById('editCategory').value;
        const title = document.getElementById('editTitle').value.trim();
        const address = document.getElementById('editAddress').value.trim();
        const price = document.getElementById('editPrice').value;
        const capacity = document.getElementById('editCapacity').value;
        const bedroom = document.getElementById('editBedroom').value;
        const bathroom = document.getElementById('editBathroom').value;
        const status = document.getElementById('editStatus').value;
        const description = document.getElementById('editDescription').value.trim();

        if (!category) {
            document.getElementById('edit_category_id_error').textContent = 'Kategori wajib dipilih';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kategori wajib dipilih' });
            document.getElementById('editCategory').focus();
            return;
        }

        if (!title) {
            document.getElementById('edit_title_error').textContent = 'Nama penginapan wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Nama penginapan wajib diisi' });
            document.getElementById('editTitle').focus();
            return;
        }

        if (!address) {
            document.getElementById('edit_address_error').textContent = 'Alamat wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Alamat wajib diisi' });
            document.getElementById('editAddress').focus();
            return;
        }

        if (!price || Number(price) <= 0) {
            document.getElementById('edit_price_error').textContent = 'Harga wajib diisi dan harus lebih dari 0';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Harga wajib diisi dan harus lebih dari 0' });
            document.getElementById('editPrice').focus();
            return;
        }

        if (!capacity || Number(capacity) <= 0) {
            document.getElementById('edit_capacity_error').textContent = 'Kapasitas wajib diisi dan harus lebih dari 0';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kapasitas wajib diisi dan harus lebih dari 0' });
            document.getElementById('editCapacity').focus();
            return;
        }

        if (bedroom === '' || Number(bedroom) < 0) {
            document.getElementById('edit_bedroom_error').textContent = 'Kamar tidur wajib diisi dan minimal 0';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kamar tidur wajib diisi dan minimal 0' });
            document.getElementById('editBedroom').focus();
            return;
        }

        if (bathroom === '' || Number(bathroom) < 0) {
            document.getElementById('edit_bathroom_error').textContent = 'Kamar mandi wajib diisi dan minimal 0';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kamar mandi wajib diisi dan minimal 0' });
            document.getElementById('editBathroom').focus();
            return;
        }

        if (!status) {
            document.getElementById('edit_status_error').textContent = 'Status wajib dipilih';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Status wajib dipilih' });
            document.getElementById('editStatus').focus();
            return;
        }

        if (!description) {
            document.getElementById('edit_description_error').textContent = 'Deskripsi wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Deskripsi wajib diisi' });
            document.getElementById('editDescription').focus();
            return;
        }

        console.log('Validasi berhasil');

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            console.error('CSRF meta tag tidak ditemukan');
            Swal.fire({ icon: 'error', title: 'Error!', text: 'CSRF token tidak ditemukan.' });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        const id = document.getElementById('editId').value;

        const form = document.getElementById('editPenginapanForm');
        const formData = new FormData(form);

        // Hapus gallery dari input asli
        formData.delete('gallery[]');

        // Kirim ID galeri yang ada
        editExistingGallery.forEach(photo => {
            formData.append('existing_gallery_ids[]', photo.id);
        });

        // Kirim file galeri baru
        editGalleryPhotos.forEach(photo => {
            if (photo.file) {
                formData.append('gallery[]', photo.file);
            }
        });

        Swal.fire({
            title: 'Mengupdate...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            console.log('Mengirim PUT ke:', '{{ route('accommodations.update', '') }}/' + id);

            const response = await fetch('{{ route('accommodations.update', '') }}/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            });

            console.log('HTTP Status:', response.status);

            const contentType = response.headers.get('content-type') || '';
            let data;

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Response bukan JSON:', text);
                throw new Error(`Server mengembalikan response bukan JSON. HTTP ${response.status}`);
            }

            console.log('Response JSON:', data);

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Penginapan berhasil diupdate!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeEditPenginapanModal();
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
                    text: data.message || 'Gagal mengupdate penginapan'
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
            const modal = document.getElementById('editPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditPenginapanModal();
            }
        }
    });

    document.querySelector('#editPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeEditPenginapanModal();
    });
</script>

<style>
    #editPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    #editGalleryContainer .group:hover button {
        opacity: 1 !important;
    }

    #editGalleryContainer .group button {
        transition: opacity 0.2s ease;
    }

    .error-message {
        margin-top: 4px;
        display: block;
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
</style>