<!-- Modal Detail Penginapan -->
<div id="detailPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeDetailPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B] flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span id="detailTitle">Detail Penginapan</span>
                    </h3>
                    <button type="button" onclick="closeDetailPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Kolom Kiri: Thumbnail & Galeri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm2 0v10h8V5H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Thumbnail
                            </label>
                            <img id="detailThumbnail" src="#" alt="Thumbnail"
                                class="w-full h-56 object-cover rounded-lg border-2 border-[#FFD4D4] dark:border-gray-600 bg-[#FFF5F5] dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Galeri Foto
                            </label>
                            <div id="detailGallery" class="grid grid-cols-2 gap-2"></div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Informasi -->
                    <div class="space-y-3">
                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</label>
                            <p class="text-gray-900 dark:text-white font-medium" id="detailCategory">-</p>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga
                                per Malam</label>
                            <p class="text-gray-900 dark:text-white font-bold text-[#E60000] text-lg" id="detailPrice">-
                            </p>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alamat</label>
                            <p class="text-gray-900 dark:text-white" id="detailAddress">-</p>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kapasitas</label>
                                <p class="text-gray-900 dark:text-white font-medium" id="detailCapacity">-</p>
                            </div>
                            <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kamar
                                    Tidur</label>
                                <p class="text-gray-900 dark:text-white font-medium" id="detailBedroom">-</p>
                            </div>
                            <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kamar
                                    Mandi</label>
                                <p class="text-gray-900 dark:text-white font-medium" id="detailBathroom">-</p>
                            </div>
                            <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ukuran</label>
                                <p class="text-gray-900 dark:text-white font-medium" id="detailSize">-</p>
                            </div>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</label>
                            <p id="detailStatus"></p>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</label>
                            <p class="text-gray-900 dark:text-white text-sm leading-relaxed" id="detailDescription">-
                            </p>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Fasilitas</label>
                            <div id="detailFacilities" class="flex flex-wrap gap-1.5"></div>
                        </div>

                        <div class="bg-[#FFF5F5] dark:bg-gray-700/50 p-3 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Aturan</label>
                            <div id="detailRules" class="flex flex-wrap gap-1.5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#FFD4D4] dark:border-gray-700">
                <div class="flex justify-end">
                    <button type="button" onclick="closeDetailPenginapanModal()"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#E60000] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openDetailPenginapanModal(id) {
        const url = '{{ route('accommodations.show', '') }}/' + id;

        document.getElementById('detailPenginapanModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('detailTitle').textContent = 'Loading...';

        const thumbnailImg = document.getElementById('detailThumbnail');
        thumbnailImg.src = '{{ asset('landingpage/home.png') }}';
        thumbnailImg.classList.add('opacity-50');

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (!data.success) throw new Error('Data penginapan tidak ditemukan.');

                const accommodation = data.data;

                console.log('Data accommodation:', accommodation); // Untuk debugging

                // Mapping untuk kategori, fasilitas, aturan
                const categoryMap = @json($categories->pluck('name', 'id'));
                const facilityMap = @json($facilities->pluck('name', 'id'));
                const ruleMap = @json($rules->pluck('name', 'id'));

                // Set judul
                document.getElementById('detailTitle').textContent = accommodation.title || 'Detail Penginapan';

                // Set informasi
                document.getElementById('detailCategory').textContent = categoryMap[accommodation.category_id] || '-';
                document.getElementById('detailPrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(accommodation.price || 0);
                document.getElementById('detailAddress').textContent = accommodation.address || '-';
                document.getElementById('detailCapacity').textContent = accommodation.capacity ? accommodation.capacity + ' Orang' : '-';
                document.getElementById('detailBedroom').textContent = accommodation.bedroom ? accommodation.bedroom + ' Kamar' : '-';
                document.getElementById('detailBathroom').textContent = accommodation.bathroom ? accommodation.bathroom + ' Kamar' : '-';
                document.getElementById('detailSize').textContent = accommodation.size ? accommodation.size + ' m²' : '-';
                document.getElementById('detailDescription').textContent = accommodation.description || '-';

                // Status
                const statusColors = {
                    'Available': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'Full': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    'Maintenance': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                };
                const statusText = accommodation.status || '-';
                document.getElementById('detailStatus').innerHTML = `
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusColors[statusText] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'}">
                    ${statusText}
                </span>
            `;

                // Thumbnail
                thumbnailImg.classList.remove('opacity-50');
                if (accommodation.thumbnail) {
                    let thumbnailPath = accommodation.thumbnail.replace(/^public\//, '');
                    thumbnailImg.src = '{{ asset('') }}' + thumbnailPath;
                } else {
                    thumbnailImg.src = '{{ asset('landingpage/home.png') }}';
                }

                // ========== GALLERY ==========
                const galleryContainer = document.getElementById('detailGallery');
                galleryContainer.innerHTML = '';

                // Cek apakah ada gallery (bisa dari relasi gallery atau images)
                let galleryData = [];
                if (accommodation.gallery && accommodation.gallery.length > 0) {
                    galleryData = accommodation.gallery;
                } else if (accommodation.images && accommodation.images.length > 0) {
                    galleryData = accommodation.images;
                }

                if (galleryData.length > 0) {
                    galleryData.forEach(image => {
                        let imagePath = image.image || image;
                        imagePath = imagePath.replace(/^public\//, '');

                        const div = document.createElement('div');
                        div.className = 'relative group overflow-hidden rounded-lg';
                        div.innerHTML = `
                        <img src="{{ asset('') }}${imagePath}" 
                             alt="Galeri" 
                             class="w-full h-24 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600 hover:scale-105 transition-transform duration-300 cursor-pointer"
                             onerror="this.src='{{ asset('landingpage/home.png') }}'"
                             onclick="window.open(this.src, '_blank')">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                            </svg>
                        </div>
                    `;
                        galleryContainer.appendChild(div);
                    });
                } else {
                    galleryContainer.innerHTML = `
                    <div class="col-span-full text-center py-6 text-gray-400 dark:text-gray-500 border-2 border-dashed border-[#FFD4D4] dark:border-gray-600 rounded-lg">
                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm">Tidak ada foto galeri</p>
                    </div>
                `;
                }

                // ========== FACILITIES ==========
                const facilitiesContainer = document.getElementById('detailFacilities');
                facilitiesContainer.innerHTML = '';

                // Cek apakah ada facilities (bisa dari facility_ids atau facilities relasi)
                let facilityIds = [];
                if (accommodation.facility_ids && accommodation.facility_ids.length > 0) {
                    facilityIds = accommodation.facility_ids;
                } else if (accommodation.facilities && accommodation.facilities.length > 0) {
                    facilityIds = accommodation.facilities.map(f => f.id);
                }

                if (facilityIds.length > 0) {
                    facilityIds.forEach(id => {
                        const span = document.createElement('span');
                        span.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
                        span.textContent = facilityMap[id] || 'Fasilitas';
                        facilitiesContainer.appendChild(span);
                    });
                } else {
                    facilitiesContainer.innerHTML = `<span class="text-sm text-gray-400 dark:text-gray-500">Tidak ada fasilitas</span>`;
                }

                // ========== RULES ==========
                const rulesContainer = document.getElementById('detailRules');
                rulesContainer.innerHTML = '';

                // Cek apakah ada rules (bisa dari rule_ids atau rules relasi)
                let ruleIds = [];
                if (accommodation.rule_ids && accommodation.rule_ids.length > 0) {
                    ruleIds = accommodation.rule_ids;
                } else if (accommodation.rules && accommodation.rules.length > 0) {
                    ruleIds = accommodation.rules.map(r => r.id);
                }

                if (ruleIds.length > 0) {
                    ruleIds.forEach(id => {
                        const span = document.createElement('span');
                        span.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                        span.textContent = ruleMap[id] || 'Aturan';
                        rulesContainer.appendChild(span);
                    });
                } else {
                    rulesContainer.innerHTML = `<span class="text-sm text-gray-400 dark:text-gray-500">Tidak ada aturan</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('detailTitle').textContent = 'Error!';
                thumbnailImg.classList.remove('opacity-50');

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data penginapan: ' + error.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    closeDetailPenginapanModal();
                }, 3000);
            });
    }

    function closeDetailPenginapanModal() {
        document.getElementById('detailPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('detailPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeDetailPenginapanModal();
            }
        }
    });

    document.querySelector('#detailPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeDetailPenginapanModal();
    });
</script>

<style>
    #detailPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #detailPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #detailPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #E60000;
        border-radius: 3px;
    }

    .dark #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #FF6B6B;
    }

    #detailGallery .group:hover img {
        transform: scale(1.05);
    }

    #detailGallery .group .absolute {
        border-radius: 0.5rem;
    }

    #detailStatus .inline-flex {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    #detailThumbnail.opacity-50 {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }
</style>