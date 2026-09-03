<!-- Modal Edit Setting -->
<div id="editSettingModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditSettingModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Pengaturan Website
                    </h3>
                    <button type="button" onclick="closeEditSettingModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="editSettingForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <!-- Tab Navigation -->
                    <div class="border-b border-[#FFD4D4] dark:border-gray-700 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="editSettingTab"
                            role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg border-[#E60000] text-[#E60000] dark:border-[#FF6B6B] dark:text-[#FF6B6B]"
                                    data-tab="edit-info" role="tab" type="button" onclick="switchEditTab('edit-info')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                        <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                    </svg>
                                    Informasi
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    data-tab="edit-branding" role="tab" type="button"
                                    onclick="switchEditTab('edit-branding')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Branding & Logo
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    data-tab="edit-contact" role="tab" type="button"
                                    onclick="switchEditTab('edit-contact')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Kontak
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    data-tab="edit-social" role="tab" type="button"
                                    onclick="switchEditTab('edit-social')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Sosial Media
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    data-tab="edit-seo" role="tab" type="button" onclick="switchEditTab('edit-seo')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                    SEO
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    data-tab="edit-footer" role="tab" type="button"
                                    onclick="switchEditTab('edit-footer')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 5a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm2 2h10v2H5V7zm0 4h10v2H5v-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Footer
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">
                        <!-- Tab 1: Informasi Website -->
                        <div id="edit-info" class="edit-tab-content">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Website
                            </h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editSiteName"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nama Website <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="site_name" id="editSiteName"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan nama website" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_site_name_error"></span>
                                </div>

                                <div>
                                    <label for="editTagline"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tagline
                                    </label>
                                    <input type="text" name="tagline" id="editTagline"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Tagline website">
                                    <span class="text-red-500 text-xs error-message" id="edit_tagline_error"></span>
                                </div>

                                <div>
                                    <label for="editAbout"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tentang
                                    </label>
                                    <textarea name="about" id="editAbout" rows="3"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Deskripsi tentang website"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_about_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Branding & Logo -->
                        <div id="edit-branding" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Branding & Logo
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Logo
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Kosongkan jika tidak ingin
                                        mengganti logo. Format: JPG, JPEG, PNG, WEBP (Maks. 20MB)</p>

                                    <div id="editLogoUploadArea"
                                        class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                        <label for="editLogoUpload"
                                            class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Klik untuk upload</span> logo baru
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG, PNG, WEBP
                                                    (Maks. 20MB)</p>
                                            </div>
                                            <input type="file" id="editLogoUpload" name="logo" accept="image/*"
                                                class="hidden">
                                        </label>
                                    </div>

                                    <div id="editLogoPreviewContainer" class="hidden relative w-full mt-2">
                                        <img id="editLogoPreview" src="#" alt="Preview Logo"
                                            class="w-32 h-32 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                        <div
                                            class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                            <span id="editLogoFileName"></span>
                                            <span class="mx-2">|</span>
                                            <span id="editLogoFileSize"></span>
                                        </div>
                                        <button type="button" onclick="removeEditLogo()"
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
                                    <span class="text-red-500 text-xs error-message" id="edit_logo_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Kontak -->
                        <div id="edit-contact" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Kontak
                            </h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editAddress"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Alamat
                                    </label>
                                    <textarea name="address" id="editAddress" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Alamat lengkap"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_address_error"></span>
                                </div>

                                <div>
                                    <label for="editPhone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Telepon
                                    </label>
                                    <input type="text" name="phone" id="editPhone"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="08123456789">
                                    <span class="text-red-500 text-xs error-message" id="edit_phone_error"></span>
                                </div>

                                <div>
                                    <label for="editWhatsapp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        WhatsApp
                                    </label>
                                    <input type="text" name="whatsapp" id="editWhatsapp"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="08123456789">
                                    <span class="text-red-500 text-xs error-message" id="edit_whatsapp_error"></span>
                                </div>

                                <div>
                                    <label for="editEmail"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="editEmail"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="admin@website.com">
                                    <span class="text-red-500 text-xs error-message" id="edit_email_error"></span>
                                </div>

                                <div>
                                    <label for="editMapsEmbed"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Google Maps Embed
                                    </label>
                                    <textarea name="maps_embed" id="editMapsEmbed" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="<iframe src='...'></iframe>"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_maps_embed_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 4: Sosial Media -->
                        <div id="edit-social" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Sosial Media</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="editFacebook"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Facebook
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="facebook" id="editFacebook"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://facebook.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_facebook_error"></span>
                                </div>

                                <div>
                                    <label for="editInstagram"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Instagram
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="instagram" id="editInstagram"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://instagram.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_instagram_error"></span>
                                </div>

                                <div>
                                    <label for="editX"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        X (Twitter)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="x" id="editX"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://x.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_x_error"></span>
                                </div>

                                <div>
                                    <label for="editYoutube"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        YouTube
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="youtube" id="editYoutube"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://youtube.com/@channel">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_youtube_error"></span>
                                </div>

                                <div class="col-span-full">
                                    <label for="editTiktok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        TikTok
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-black dark:text-white" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.76-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.06.02-12.09z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="tiktok" id="editTiktok"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://tiktok.com/@username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_tiktok_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 5: SEO -->
                        <div id="edit-seo" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">SEO (Search Engine
                                Optimization)</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Title
                                    </label>
                                    <input type="text" name="meta_title" id="editMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title untuk SEO">
                                    <span class="text-red-500 text-xs error-message" id="edit_meta_title_error"></span>
                                </div>

                                <div>
                                    <label for="editMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Description
                                    </label>
                                    <textarea name="meta_description" id="editMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description untuk SEO"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_description_error"></span>
                                </div>

                                <div>
                                    <label for="editMetaKeywords"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Keywords
                                    </label>
                                    <input type="text" name="meta_keywords" id="editMetaKeywords"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="keyword1, keyword2, keyword3">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_keywords_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 6: Footer -->
                        <div id="edit-footer" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Footer</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editFooterDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Deskripsi Footer
                                    </label>
                                    <textarea name="footer_description" id="editFooterDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Deskripsi untuk footer"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_footer_description_error"></span>
                                </div>

                                <div>
                                    <label for="editCopyright"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Copyright
                                    </label>
                                    <input type="text" name="copyright" id="editCopyright"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="© 2024 Nama Website. All rights reserved.">
                                    <span class="text-red-500 text-xs error-message" id="edit_copyright_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="button" onclick="submitEditSetting()"
                            class="text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v6h6m-6 0l6-6m0 16v-6h-6m6 0l-6 6"></path>
                            </svg>
                            Update Pengaturan
                        </button>
                        <button type="button" onclick="closeEditSettingModal()"
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
    let editSettingId = null;
    let isLogoChanged = false;

    // ========== TAB FUNCTION ==========
    function switchEditTab(tabId) {
        document.querySelectorAll('.edit-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        document.querySelectorAll('#editSettingTab button').forEach(btn => {
            btn.classList.remove('border-[#E60000]', 'text-[#E60000]', 'dark:border-[#FF6B6B]', 'dark:text-[#FF6B6B]');
            btn.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300',
                'dark:hover:text-gray-300');
        });

        const activeBtn = document.querySelector(`#editSettingTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300',
                'dark:hover:text-gray-300');
            activeBtn.classList.add('border-[#E60000]', 'text-[#E60000]', 'dark:border-[#FF6B6B]',
                'dark:text-[#FF6B6B]');
        }
    }

    // ========== OPEN/CLOSE MODAL ==========
    function openEditSettingModal(id) {
        editSettingId = id;
        isLogoChanged = false;

        Swal.fire({
            title: 'Memuat data...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        // PERBAIKAN: Gunakan route dengan parameter yang benar
        const url = '{{ route('pengaturan.edit', ':id') }}'.replace(':id', id);

        fetch(url, {
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
                    const setting = data.data;

                    document.getElementById('editId').value = setting.id;

                    // Informasi Website
                    document.getElementById('editSiteName').value = setting.site_name || '';
                    document.getElementById('editTagline').value = setting.tagline || '';
                    document.getElementById('editAbout').value = setting.about || '';

                    // Kontak
                    document.getElementById('editAddress').value = setting.address || '';
                    document.getElementById('editPhone').value = setting.phone || '';
                    document.getElementById('editWhatsapp').value = setting.whatsapp || '';
                    document.getElementById('editEmail').value = setting.email || '';
                    document.getElementById('editMapsEmbed').value = setting.maps_embed || '';

                    // Sosial Media
                    document.getElementById('editFacebook').value = setting.facebook || '';
                    document.getElementById('editInstagram').value = setting.instagram || '';
                    document.getElementById('editX').value = setting.x || '';
                    document.getElementById('editYoutube').value = setting.youtube || '';
                    document.getElementById('editTiktok').value = setting.tiktok || '';

                    // SEO
                    document.getElementById('editMetaTitle').value = setting.meta_title || '';
                    document.getElementById('editMetaDescription').value = setting.meta_description || '';
                    document.getElementById('editMetaKeywords').value = setting.meta_keywords || '';

                    // Footer
                    document.getElementById('editFooterDescription').value = setting.footer_description || '';
                    document.getElementById('editCopyright').value = setting.copyright || '';

                    // ========== LOGO ==========
                    const uploadArea = document.getElementById('editLogoUploadArea');
                    const previewContainer = document.getElementById('editLogoPreviewContainer');
                    const preview = document.getElementById('editLogoPreview');
                    const fileName = document.getElementById('editLogoFileName');
                    const fileSize = document.getElementById('editLogoFileSize');

                    if (setting.logo) {
                        let logoPath = setting.logo.replace(/^public\//, '');
                        preview.src = '{{ asset('') }}' + logoPath;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = 'Logo saat ini';
                        fileSize.textContent = '';
                    } else {
                        uploadArea.classList.remove('hidden');
                        previewContainer.classList.add('hidden');
                    }

                    document.querySelectorAll('#editSettingForm .error-message').forEach(el => el.textContent = '');

                    switchEditTab('edit-info');

                    document.getElementById('editSettingModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data pengaturan'
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

    function closeEditSettingModal() {
        document.getElementById('editSettingModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== LOGO UPLOAD ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editLogoUpload');
        const uploadArea = document.getElementById('editLogoUploadArea');
        const previewContainer = document.getElementById('editLogoPreviewContainer');
        const preview = document.getElementById('editLogoPreview');
        const fileName = document.getElementById('editLogoFileName');
        const fileSize = document.getElementById('editLogoFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (e.target.files.length > 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Hanya boleh upload 1 gambar logo.'
                    });
                    const firstFile = e.target.files[0];
                    const dt = new DataTransfer();
                    dt.items.add(firstFile);
                    this.files = dt.files;
                }

                if (file) {
                    if (file.size > 20 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 20MB'
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

                    isLogoChanged = true;

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

        window.removeEditLogo = function () {
            document.getElementById('editLogoUpload').value = '';
            document.getElementById('editLogoUploadArea').classList.remove('hidden');
            document.getElementById('editLogoPreviewContainer').classList.add('hidden');
            document.getElementById('edit_logo_error').textContent = '';
            isLogoChanged = true;
        };
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitEditSetting = async function () {
        console.log('=== SUBMIT EDIT SETTING ===');

        document.querySelectorAll('#editSettingForm .error-message').forEach(el => el.textContent = '');

        const siteName = document.getElementById('editSiteName').value.trim();

        if (!siteName) {
            document.getElementById('edit_site_name_error').textContent = 'Nama website wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Nama website wajib diisi' });
            document.getElementById('editSiteName').focus();
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

        const form = document.getElementById('editSettingForm');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Mengupdate...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            // PERBAIKAN: Gunakan route dengan parameter yang benar
            const url = '{{ route('pengaturan.update', ':id') }}'.replace(':id', id);

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            });

            const contentType = response.headers.get('content-type') || '';
            if (!contentType.includes('application/json')) {
                const text = await response.text();
                console.error('Response bukan JSON:', text.substring(0, 500));
                throw new Error('Server mengembalikan response bukan JSON.');
            }

            const data = await response.json();

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Pengaturan berhasil diupdate!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeEditSettingModal();
                    location.href = '{{ route('pengaturan.index') }}';
                });
                return;
            }

            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorEl = document.getElementById('edit_' + key + '_error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data.errors[
                            key];
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
                    text: data.message || 'Gagal mengupdate pengaturan'
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
            const modal = document.getElementById('editSettingModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditSettingModal();
            }
        }
    });

    document.querySelector('#editSettingModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeEditSettingModal();
    });
</script>

<style>
    #editSettingModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editSettingModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editSettingModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editSettingModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editSettingModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #editSettingModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #editSettingModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #editSettingModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }

    #editLogoPreviewContainer {
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