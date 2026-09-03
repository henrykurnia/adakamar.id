<!-- Modal Tambah Setting -->
<div id="addSettingModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddSettingModal()"></div>

        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Tambah Pengaturan Website
                    </h3>
                    <button type="button" onclick="closeAddSettingModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addSettingForm" enctype="multipart/form-data">
                    @csrf

                    <!-- Tab Navigation -->
                    <div class="border-b border-[#FFD4D4] dark:border-gray-700 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="addSettingTab" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg border-[#E60000] text-[#E60000] dark:border-[#FF6B6B] dark:text-[#FF6B6B]" 
                                    data-tab="add-info" role="tab" type="button" onclick="switchAddTab('add-info')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                        <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                    </svg>
                                    Informasi
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    data-tab="add-branding" role="tab" type="button" onclick="switchAddTab('add-branding')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    Branding & Logo
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    data-tab="add-contact" role="tab" type="button" onclick="switchAddTab('add-contact')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Kontak
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    data-tab="add-social" role="tab" type="button" onclick="switchAddTab('add-social')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V3z" clip-rule="evenodd" />
                                    </svg>
                                    Sosial Media
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    data-tab="add-seo" role="tab" type="button" onclick="switchAddTab('add-seo')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                    SEO
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    data-tab="add-footer" role="tab" type="button" onclick="switchAddTab('add-footer')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm2 2h10v2H5V7zm0 4h10v2H5v-2z" clip-rule="evenodd" />
                                    </svg>
                                    Footer
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">
                        <!-- Tab 1: Informasi Website -->
                        <div id="add-info" class="add-tab-content">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Website</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addSiteName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nama Website <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="site_name" id="addSiteName"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Masukkan nama website" required>
                                    <span class="text-red-500 text-xs error-message" id="add_site_name_error"></span>
                                </div>

                                <div>
                                    <label for="addTagline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tagline
                                    </label>
                                    <input type="text" name="tagline" id="addTagline"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Tagline website">
                                    <span class="text-red-500 text-xs error-message" id="add_tagline_error"></span>
                                </div>

                                <div>
                                    <label for="addAbout" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tentang
                                    </label>
                                    <textarea name="about" id="addAbout" rows="3"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Deskripsi tentang website"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_about_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Branding & Logo -->
                        <div id="add-branding" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Branding & Logo</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Logo
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Format: JPG, JPEG, PNG, WEBP (Maks. 20MB)</p>
                                    
                                    <div id="addLogoUploadArea"
                                        class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#FFF5F5] border-[#FFD4D4] hover:bg-[#FFE8E8] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                        <label for="addLogoUpload" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-2 text-[#FF6B6B] dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Klik untuk upload</span> logo
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG, PNG, WEBP (Maks. 20MB)</p>
                                            </div>
                                            <input type="file" id="addLogoUpload" name="logo" accept="image/*" class="hidden">
                                        </label>
                                    </div>

                                    <div id="addLogoPreviewContainer" class="hidden relative w-full mt-2">
                                        <img id="addLogoPreview" src="#" alt="Preview Logo"
                                            class="w-32 h-32 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600">
                                        <div class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                            <span id="addLogoFileName"></span>
                                            <span class="mx-2">|</span>
                                            <span id="addLogoFileSize"></span>
                                        </div>
                                        <button type="button" onclick="removeAddLogo()"
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
                                    <span class="text-red-500 text-xs error-message" id="add_logo_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Kontak -->
                        <div id="add-contact" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Informasi Kontak</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Alamat
                                    </label>
                                    <textarea name="address" id="addAddress" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Alamat lengkap"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_address_error"></span>
                                </div>

                                <div>
                                    <label for="addPhone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Telepon
                                    </label>
                                    <input type="text" name="phone" id="addPhone"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="08123456789">
                                    <span class="text-red-500 text-xs error-message" id="add_phone_error"></span>
                                </div>

                                <div>
                                    <label for="addWhatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        WhatsApp
                                    </label>
                                    <input type="text" name="whatsapp" id="addWhatsapp"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="08123456789">
                                    <span class="text-red-500 text-xs error-message" id="add_whatsapp_error"></span>
                                </div>

                                <div>
                                    <label for="addEmail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="addEmail"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="admin@website.com">
                                    <span class="text-red-500 text-xs error-message" id="add_email_error"></span>
                                </div>

                                <div>
                                    <label for="addMapsEmbed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Google Maps Embed
                                    </label>
                                    <textarea name="maps_embed" id="addMapsEmbed" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="<iframe src='...'></iframe>"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_maps_embed_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 4: Sosial Media -->
                        <div id="add-social" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Sosial Media</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="addFacebook" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Facebook
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="facebook" id="addFacebook"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://facebook.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_facebook_error"></span>
                                </div>

                                <div>
                                    <label for="addInstagram" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Instagram
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="instagram" id="addInstagram"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://instagram.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_instagram_error"></span>
                                </div>

                                <div>
                                    <label for="addX" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        X (Twitter)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="x" id="addX"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://x.com/username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_x_error"></span>
                                </div>

                                <div>
                                    <label for="addYoutube" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        YouTube
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="youtube" id="addYoutube"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://youtube.com/@channel">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_youtube_error"></span>
                                </div>

                                <div class="col-span-full">
                                    <label for="addTiktok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        TikTok
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-black dark:text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.76-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.06.02-12.09z"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="tiktok" id="addTiktok"
                                            class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                            placeholder="https://tiktok.com/@username">
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_tiktok_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 5: SEO -->
                        <div id="add-seo" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">SEO (Search Engine Optimization)</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addMetaTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Title
                                    </label>
                                    <input type="text" name="meta_title" id="addMetaTitle"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Title untuk SEO">
                                    <span class="text-red-500 text-xs error-message" id="add_meta_title_error"></span>
                                </div>

                                <div>
                                    <label for="addMetaDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Description
                                    </label>
                                    <textarea name="meta_description" id="addMetaDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Meta Description untuk SEO"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_meta_description_error"></span>
                                </div>

                                <div>
                                    <label for="addMetaKeywords" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Meta Keywords
                                    </label>
                                    <input type="text" name="meta_keywords" id="addMetaKeywords"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="keyword1, keyword2, keyword3">
                                    <span class="text-red-500 text-xs error-message" id="add_meta_keywords_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 6: Footer -->
                        <div id="add-footer" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#E60000] dark:text-[#FF6B6B] mb-4">Footer</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addFooterDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Deskripsi Footer
                                    </label>
                                    <textarea name="footer_description" id="addFooterDescription" rows="2"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="Deskripsi untuk footer"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_footer_description_error"></span>
                                </div>

                                <div>
                                    <label for="addCopyright" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Copyright
                                    </label>
                                    <input type="text" name="copyright" id="addCopyright"
                                        class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                        placeholder="© 2024 Nama Website. All rights reserved.">
                                    <span class="text-red-500 text-xs error-message" id="add_copyright_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#FFD4D4] dark:border-gray-700">
                        <button type="button" onclick="submitAddSetting()"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] dark:focus:ring-[#FF6B6B] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Pengaturan
                        </button>
                        <button type="button" onclick="closeAddSettingModal()"
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
    // ========== TAB FUNCTION ==========
    function switchAddTab(tabId) {
        document.querySelectorAll('.add-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        document.querySelectorAll('#addSettingTab button').forEach(btn => {
            btn.classList.remove('border-[#E60000]', 'text-[#E60000]', 'dark:border-[#FF6B6B]', 'dark:text-[#FF6B6B]');
            btn.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
        });

        const activeBtn = document.querySelector(`#addSettingTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:hover:text-gray-300');
            activeBtn.classList.add('border-[#E60000]', 'text-[#E60000]', 'dark:border-[#FF6B6B]', 'dark:text-[#FF6B6B]');
        }
    }

    // ========== OPEN/CLOSE MODAL ==========
    window.openAddSettingModal = function() {
        const modal = document.getElementById('addSettingModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('addSettingForm');
        form.reset();

        document.getElementById('addLogoUploadArea').classList.remove('hidden');
        document.getElementById('addLogoPreviewContainer').classList.add('hidden');
        document.getElementById('addLogoUpload').value = '';

        document.querySelectorAll('#addSettingForm .error-message').forEach(el => el.textContent = '');

        switchAddTab('add-info');

        setTimeout(() => document.getElementById('addSiteName').focus(), 100);
    };

    window.closeAddSettingModal = function() {
        document.getElementById('addSettingModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ========== LOGO UPLOAD ==========
    document.addEventListener('DOMContentLoaded', function() {
        const upload = document.getElementById('addLogoUpload');
        const uploadArea = document.getElementById('addLogoUploadArea');
        const previewContainer = document.getElementById('addLogoPreviewContainer');
        const preview = document.getElementById('addLogoPreview');
        const fileName = document.getElementById('addLogoFileName');
        const fileSize = document.getElementById('addLogoFileSize');

        if (upload) {
            upload.addEventListener('change', function(e) {
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

                    const reader = new FileReader();
                    reader.onload = function(event) {
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

        window.removeAddLogo = function() {
            document.getElementById('addLogoUpload').value = '';
            document.getElementById('addLogoUploadArea').classList.remove('hidden');
            document.getElementById('addLogoPreviewContainer').classList.add('hidden');
            document.getElementById('add_logo_error').textContent = '';
        };
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddSetting = async function() {
        console.log('=== SUBMIT SETTING ===');

        document.querySelectorAll('#addSettingForm .error-message').forEach(el => el.textContent = '');

        const siteName = document.getElementById('addSiteName').value.trim();

        if (!siteName) {
            document.getElementById('add_site_name_error').textContent = 'Nama website wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Nama website wajib diisi' });
            document.getElementById('addSiteName').focus();
            return;
        }

        console.log('Validasi berhasil');

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            Swal.fire({ icon: 'error', title: 'Error!', text: 'CSRF token tidak ditemukan.' });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        const form = document.getElementById('addSettingForm');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            const response = await fetch('{{ route('pengaturan.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
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
                    text: data.message || 'Pengaturan berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeAddSettingModal();
                    location.href = '{{ route('pengaturan.index') }}';
                });
                return;
            }

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
                    text: data.message || 'Gagal menambahkan pengaturan'
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('addSettingModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddSettingModal();
            }
        }
    });

    document.querySelector('#addSettingModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) closeAddSettingModal();
    });
</script>

<style>
    #addSettingModal .transition-all {
        transition: all 0.3s ease-out;
    }
    #addSettingModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }
    #addSettingModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
    #addSettingModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }
    #addSettingModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    #addSettingModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }
    .dark #addSettingModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }
    .dark #addSettingModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }
    .error-message {
        margin-top: 4px;
        display: block;
    }
    #addLogoPreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>