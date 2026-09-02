<!-- Modal Tambah Penginapan -->
<div id="addPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Tambah Penginapan Baru
                    </h3>
                    <button type="button" onclick="closeAddPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addPenginapanForm" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <!-- Informasi Penginapan -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi
                                Penginapan</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Kategori -->
                                <div class="sm:col-span-2">
                                    <label for="addCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select id="addCategory" name="category_id" required
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

                                <!-- Title -->
                                <div class="sm:col-span-2 lg:col-span-3">
                                    <label for="addTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Penginapan <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="addTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan nama penginapan" required>
                                    <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                                </div>

                                <!-- Slug (Auto-generated with edit option) -->
                                <div class="col-span-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="addSlug"
                                            class="text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                        <button type="button" onclick="generateSlugFromTitle()"
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
                                    <input type="text" name="slug" id="addSlug"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong untuk
                                        auto-generate atau edit sesuai keinginan</p>
                                    <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                                </div>

                                <!-- Address -->
                                <div class="col-span-full">
                                    <label for="addAddress"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="address" id="addAddress"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan alamat lengkap" required>
                                    <span class="text-red-500 text-xs error-message" id="add_address_error"></span>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="addPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per
                                        Malam <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" id="addPrice"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="350000" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_price_error"></span>
                                </div>

                                <!-- Capacity -->
                                <div>
                                    <label for="addCapacity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kapasitas
                                        (Orang) <span class="text-red-500">*</span></label>
                                    <input type="number" name="capacity" id="addCapacity"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="4" required min="1">
                                    <span class="text-red-500 text-xs error-message" id="add_capacity_error"></span>
                                </div>

                                <!-- Bedroom -->
                                <div>
                                    <label for="addBedroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Tidur
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bedroom" id="addBedroom"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="2" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bedroom_error"></span>
                                </div>

                                <!-- Bathroom -->
                                <div>
                                    <label for="addBathroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Mandi
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bathroom" id="addBathroom"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="1" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bathroom_error"></span>
                                </div>

                                <!-- Size -->
                                <div>
                                    <label for="addSize"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran
                                        (m²)</label>
                                    <input type="text" name="size" id="addSize"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="45">
                                    <span class="text-red-500 text-xs error-message" id="add_size_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="addStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select id="addStatus" name="status" required
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                                        <option value="">Pilih Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Full">Full</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_status_error"></span>
                                </div>

                                <!-- Description -->
                                <div class="col-span-full">
                                    <label for="addDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="description" id="addDescription" rows="3"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan deskripsi lengkap" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_description_error"></span>
                                </div>

                                <!-- Meta Title -->
                                <div class="col-span-full">
                                    <label for="addMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="addMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="add_meta_title_error"></span>
                                </div>

                                <!-- Meta Description -->
                                <div class="col-span-full">
                                    <label for="addMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="addMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_meta_description_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Thumbnail <span
                                    class="text-red-500">*</span></h4>
                            <div class="flex flex-col items-center">
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
                                            class="hidden" required>
                                    </label>
                                </div>

                                <!-- Preview Thumbnail (muncul setelah upload) -->
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

                                <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
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
                                                class="rounded border-gray-300 text-[#E60000] focus:ring-[#E60000] dark:border-gray-600 dark:bg-gray-700">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada fasilitas
                                        tersedia</p>
                                @endif
                            </div>
                            <span class="text-red-500 text-xs error-message" id="add_facility_ids_error"></span>
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
                                                class="rounded border-gray-300 text-[#E60000] focus:ring-[#E60000] dark:border-gray-600 dark:bg-gray-700">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $rule->name }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada aturan
                                        tersedia</p>
                                @endif
                            </div>
                            <span class="text-red-500 text-xs error-message" id="add_rule_ids_error"></span>
                        </div>

                        <!-- Galeri -->
                        <div>
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Galeri Foto
                                <span class="text-red-500">*</span>
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Upload minimal 2 dan maksimal 10
                                foto</p>
                            <div id="addGalleryContainer"
                                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                <!-- Galeri akan ditambahkan di sini -->
                            </div>
                            <div id="addUploadGaleriContainer">
                                <label id="addUploadGaleriBtn"
                                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#E60000] text-white rounded-lg hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B]">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                    </svg>
                                    Tambah Foto Galeri
                                    <input type="file" id="addGalleryUpload" name="gallery[]" accept="image/*" multiple
                                        class="hidden">
                                </label>
                                <span id="addGalleryCounter" class="ml-3 text-sm text-gray-500 dark:text-gray-400">0 /
                                    10 foto</span>
                            </div>
                            <p id="addGalleryError" class="mt-1 text-sm text-red-600 hidden">Minimal upload 2 foto
                                galeri</p>
                            <span class="text-red-500 text-xs error-message" id="add_gallery_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="button" onclick="submitAddPenginapan()"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Penginapan
                        </button>
                        <button type="button" onclick="closeAddPenginapanModal()"
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
    let addGalleryPhotos = [];

    // ========== OPEN/CLOSE MODAL ==========
    window.openAddPenginapanModal = function () {
        const modal = document.getElementById('addPenginapanModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Reset form
        const form = document.getElementById('addPenginapanForm');
        form.reset();

        // Reset gallery
        addGalleryPhotos = [];
        renderAddGallery();
        updateAddGalleryCounter();

        // Reset thumbnail
        document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
        document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
        document.getElementById('addThumbnailUpload').value = '';

        // Reset error messages
        document.querySelectorAll('#addPenginapanForm .error-message').forEach(el => el.textContent = '');
        document.getElementById('addGalleryError').classList.add('hidden');

        setTimeout(() => document.getElementById('addTitle').focus(), 100);
    };

    window.closeAddPenginapanModal = function () {
        document.getElementById('addPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ========== SLUG GENERATOR ==========
    function generateSlugFromTitle() {
        const title = document.getElementById('addTitle').value.trim();
        const slugInput = document.getElementById('addSlug');

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Masukkan nama penginapan terlebih dahulu'
            });
            document.getElementById('addTitle').focus();
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
        const upload = document.getElementById('addThumbnailUpload');
        const uploadArea = document.getElementById('addThumbnailUploadArea');
        const previewContainer = document.getElementById('addThumbnailPreviewContainer');
        const preview = document.getElementById('addThumbnailPreview');
        const fileName = document.getElementById('addThumbnailFileName');
        const fileSize = document.getElementById('addThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];

                // Reset jika user memilih lebih dari 1 file
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

                    // Tampilkan preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        // Sembunyikan upload area, tampilkan preview
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');

                        // Tampilkan info file
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

        window.removeAddThumbnail = function () {
            document.getElementById('addThumbnailUpload').value = '';
            document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('add_thumbnail_error').textContent = '';
        };
    });

    // ========== GALLERY ==========
    function updateAddGalleryCounter() {
        const counter = document.getElementById('addGalleryCounter');
        const uploadBtn = document.getElementById('addUploadGaleriBtn');
        const maxPhotos = 10;
        counter.textContent = `${addGalleryPhotos.length} / ${maxPhotos} foto`;
        if (addGalleryPhotos.length >= maxPhotos) {
            uploadBtn.style.opacity = '0.5';
            uploadBtn.style.cursor = 'not-allowed';
            document.getElementById('addGalleryUpload').disabled = true;
        } else {
            uploadBtn.style.opacity = '1';
            uploadBtn.style.cursor = 'pointer';
            document.getElementById('addGalleryUpload').disabled = false;
        }
        // Validasi minimal 2 foto
        const errorEl = document.getElementById('addGalleryError');
        if (addGalleryPhotos.length >= 2) {
            errorEl.classList.add('hidden');
        }
        if (addGalleryPhotos.length > 0) {
            document.getElementById('add_gallery_error').textContent = '';
        }
    }

    function renderAddGallery() {
        const container = document.getElementById('addGalleryContainer');
        container.innerHTML = '';
        if (addGalleryPhotos.length === 0) {
            container.innerHTML = `
                <div class="col-span-full text-center py-8 text-gray-400 dark:text-gray-500 border-2 border-dashed border-[#FFD4D4] dark:border-gray-600 rounded-lg">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada foto galeri</p>
                    <p class="text-xs">Minimal 2 foto</p>
                </div>
            `;
            return;
        }
        addGalleryPhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${photo.url}" alt="Galeri ${index + 1}" class="w-full h-32 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                <button type="button" onclick="removeAddGalleryPhoto(${index})" class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition-colors opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <span class="absolute bottom-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded">${index + 1}</span>
            `;
            container.appendChild(div);
        });
    }

    function removeAddGalleryPhoto(index) {
        addGalleryPhotos.splice(index, 1);
        renderAddGallery();
        updateAddGalleryCounter();
        if (addGalleryPhotos.length < 2) {
            document.getElementById('addGalleryError').classList.remove('hidden');
        }
    }

    function addAddGalleryPhoto(file) {
        if (addGalleryPhotos.length >= 10) {
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
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const targetWidth = 240;
                const targetHeight = 160;
                const imgRatio = img.width / img.height;
                const targetRatio = targetWidth / targetHeight;
                let cropWidth, cropHeight, offsetX = 0, offsetY = 0;
                if (imgRatio > targetRatio) {
                    cropHeight = img.height;
                    cropWidth = img.height * targetRatio;
                    offsetX = (img.width - cropWidth) / 2;
                } else {
                    cropWidth = img.width;
                    cropHeight = img.width / targetRatio;
                    offsetY = (img.height - cropHeight) / 2;
                }
                canvas.width = targetWidth;
                canvas.height = targetHeight;
                ctx.drawImage(img, offsetX, offsetY, cropWidth, cropHeight, 0, 0, targetWidth, targetHeight);
                const imageDataUrl = canvas.toDataURL('image/jpeg', 0.9);
                addGalleryPhotos.push({ id: Date.now() + addGalleryPhotos.length, url: imageDataUrl, file: file });
                renderAddGallery();
                updateAddGalleryCounter();
                if (addGalleryPhotos.length >= 2) {
                    document.getElementById('addGalleryError').classList.add('hidden');
                }
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('addGalleryUpload');
        if (upload) {
            upload.addEventListener('change', function (e) {
                const files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    addAddGalleryPhoto(files[i]);
                }
                this.value = '';
            });
        }

        // Drag and drop untuk galeri add
        const container = document.getElementById('addUploadGaleriContainer');
        if (container) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                container.addEventListener(eventName, function (e) { e.preventDefault(); e.stopPropagation(); });
            });
            container.addEventListener('dragover', function () { this.classList.add('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('dragleave', function () { this.classList.remove('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('drop', function (e) {
                this.classList.remove('ring-4', 'ring-[#E60000]', 'ring-offset-2', 'rounded-lg');
                const files = e.dataTransfer.files;
                for (let i = 0; i < files.length; i++) { addAddGalleryPhoto(files[i]); }
            });
        }

        // Auto generate slug on title input
        const titleInput = document.getElementById('addTitle');
        const slugInput = document.getElementById('addSlug');
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                // Hanya auto-generate jika slug kosong
                if (slugInput.value === '') {
                    const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }

        console.log('Modal Tambah Penginapan siap digunakan.');
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddPenginapan = async function () {
        console.log('=== SUBMIT PENGINAPAN ===');

        // Reset error messages
        document.querySelectorAll('#addPenginapanForm .error-message').forEach(el => el.textContent = '');
        document.getElementById('addGalleryError').classList.add('hidden');

        // Validasi field
        const category = document.getElementById('addCategory').value;
        const title = document.getElementById('addTitle').value.trim();
        const address = document.getElementById('addAddress').value.trim();
        const price = document.getElementById('addPrice').value;
        const capacity = document.getElementById('addCapacity').value;
        const bedroom = document.getElementById('addBedroom').value;
        const bathroom = document.getElementById('addBathroom').value;
        const status = document.getElementById('addStatus').value;
        const description = document.getElementById('addDescription').value.trim();
        const thumbnail = document.getElementById('addThumbnailUpload').files[0];

        // Validasi Kategori
        if (!category) {
            document.getElementById('add_category_id_error').textContent = 'Kategori wajib dipilih';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kategori wajib dipilih'
            });
            document.getElementById('addCategory').focus();
            return;
        }

        if (!title) {
            document.getElementById('add_title_error').textContent = 'Nama penginapan wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Nama penginapan wajib diisi'
            });
            document.getElementById('addTitle').focus();
            return;
        }

        if (!address) {
            document.getElementById('add_address_error').textContent = 'Alamat wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Alamat wajib diisi'
            });
            document.getElementById('addAddress').focus();
            return;
        }

        if (!price || Number(price) <= 0) {
            document.getElementById('add_price_error').textContent = 'Harga wajib diisi dan harus lebih dari 0';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Harga wajib diisi dan harus lebih dari 0'
            });
            document.getElementById('addPrice').focus();
            return;
        }

        if (!capacity || Number(capacity) <= 0) {
            document.getElementById('add_capacity_error').textContent = 'Kapasitas wajib diisi dan harus lebih dari 0';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kapasitas wajib diisi dan harus lebih dari 0'
            });
            document.getElementById('addCapacity').focus();
            return;
        }

        if (bedroom === '' || Number(bedroom) < 0) {
            document.getElementById('add_bedroom_error').textContent = 'Kamar tidur wajib diisi dan minimal 0';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kamar tidur wajib diisi dan minimal 0'
            });
            document.getElementById('addBedroom').focus();
            return;
        }

        if (bathroom === '' || Number(bathroom) < 0) {
            document.getElementById('add_bathroom_error').textContent = 'Kamar mandi wajib diisi dan minimal 0';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kamar mandi wajib diisi dan minimal 0'
            });
            document.getElementById('addBathroom').focus();
            return;
        }

        if (!status) {
            document.getElementById('add_status_error').textContent = 'Status wajib dipilih';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Status wajib dipilih'
            });
            document.getElementById('addStatus').focus();
            return;
        }

        if (!description) {
            document.getElementById('add_description_error').textContent = 'Deskripsi wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Deskripsi wajib diisi'
            });
            document.getElementById('addDescription').focus();
            return;
        }

        if (!thumbnail) {
            document.getElementById('add_thumbnail_error').textContent = 'Thumbnail wajib diupload';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Thumbnail wajib diupload'
            });
            return;
        }

        if (addGalleryPhotos.length < 2) {
            document.getElementById('addGalleryError').classList.remove('hidden');
            document.getElementById('add_gallery_error').textContent = 'Minimal upload 2 foto galeri';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Minimal upload 2 foto galeri'
            });
            return;
        }

        console.log('Validasi berhasil');

        // Cek CSRF
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            console.error('CSRF meta tag tidak ditemukan');
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'CSRF token tidak ditemukan. Tambahkan <meta name="csrf-token"...> di <head>.'
            });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        console.log('CSRF token ditemukan');

        // Siapkan FormData
        const form = document.getElementById('addPenginapanForm');
        const formData = new FormData(form);

        // Hapus gallery dari input asli
        formData.delete('gallery[]');

        // Tambahkan gallery dari array
        addGalleryPhotos.forEach(photo => {
            if (photo.file) {
                formData.append('gallery[]', photo.file);
            }
        });

        // Tampilkan loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit
        try {
            console.log('Mengirim POST ke:', '{{ route('accommodations.store') }}');

            const response = await fetch('{{ route('accommodations.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
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

            // Success
            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Penginapan berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeAddPenginapanModal();
                    location.reload();
                });
                return;
            }

            // Validation Error
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorEl = document.getElementById('add_' + key + '_error');
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
                    text: data.message || 'Gagal menambahkan penginapan'
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

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('addPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddPenginapanModal();
            }
        }
    });

    document.querySelector('#addPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeAddPenginapanModal();
    });
</script>

<style>
    #addPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    #addGalleryContainer .group:hover button {
        opacity: 1 !important;
    }

    #addGalleryContainer .group button {
        transition: opacity 0.2s ease;
    }

    .error-message {
        margin-top: 4px;
        display: block;
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
</style>