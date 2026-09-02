@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_artikel')
    @include('example.layouts.partials.konten.modal_edit_artikel')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#E60000] lg:mt-1.5 dark:bg-gray-800 dark:border-[#FF6B6B]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#E60000] sm:text-2xl dark:text-[#FF6B6B]">Daftar Artikel</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Filter Kategori & Status -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <!-- Tambah Kategori -->
                    <button onclick="openAddKategoriModal()"
                        class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] focus:outline-none dark:focus:ring-[#FF6B6B] inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Kategori
                    </button>

                    <!-- Filter Kategori -->
                    <div class="relative">
                        <select id="filter-kategori"
                            class="bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full sm:w-40 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                            <option value="semua">Semua Kategori</option>
                            <option value="penginapan">Penginapan</option>
                            <option value="travel">Travel</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="budaya">Budaya</option>
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div class="relative">
                        <select id="filter-status"
                            class="bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full sm:w-40 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]">
                            <option value="semua">Semua Status</option>
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
                    </div>
                </div>

                <!-- Bagian Kanan: Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <a href="#" onclick="openAddArtikelModal()"
                        class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] focus:outline-none dark:focus:ring-[#FF6B6B] inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Artikel Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-[#FFD4D4] table-fixed dark:divide-gray-600">
                        <thead class="bg-[#FFF5F5] dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[60px]">
                                    No
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[150px]">
                                    Thumbnail
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                    Ringkasan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[250px]">
                                    Konten
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#FFD4D4] dark:bg-gray-800 dark:divide-gray-700"
                            id="table-body">
                            <!-- Data statis contoh -->
                            <tr data-id="1" data-kategori="penginapan" data-status="publish">
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">1</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">Tips Memilih Penginapan
                                    yang Tepat</td>
                                <td class="p-4 text-xs">
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Artikel 1"
                                        class="w-24 h-16 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                </td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[200px] truncate">Panduan lengkap
                                    memilih penginapan yang nyaman dan sesuai budget</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[250px] truncate">Memilih
                                    penginapan yang tepat adalah kunci kenyamanan saat berlibur. Berikut tips yang bisa Anda
                                    terapkan...</td>
                                <td class="p-4 text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="openEditArtikelModal(this.closest('tr'))"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                            Edit
                                        </button>
                                        <button
                                            class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="2" data-kategori="travel" data-status="draft">
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">2</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">10 Destinasi Wisata
                                    Terbaik 2024</td>
                                <td class="p-4 text-xs">
                                    <img src="{{ asset('landingpage/villa.jpg') }}" alt="Artikel 2"
                                        class="w-24 h-16 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                </td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[200px] truncate">Rekomendasi
                                    destinasi wisata terbaik untuk liburan Anda</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[250px] truncate">Temukan 10
                                    destinasi wisata terbaik di Indonesia yang wajib Anda kunjungi tahun ini...</td>
                                <td class="p-4 text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="openEditArtikelModal(this.closest('tr'))"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                            Edit
                                        </button>
                                        <button
                                            class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="3" data-kategori="kuliner" data-status="publish">
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">3</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">Kuliner Khas Nusantara
                                    yang Wajib Dicoba</td>
                                <td class="p-4 text-xs">
                                    <img src="{{ asset('landingpage/guesthouse.jpg') }}" alt="Artikel 3"
                                        class="w-24 h-16 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                </td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[200px] truncate">Eksplorasi
                                    kuliner khas dari berbagai daerah di Indonesia</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[250px] truncate">Indonesia
                                    memiliki kekayaan kuliner yang luar biasa. Dari Sabang sampai Merauke...</td>
                                <td class="p-4 text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="openEditArtikelModal(this.closest('tr'))"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                            Edit
                                        </button>
                                        <button
                                            class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="4" data-kategori="budaya" data-status="draft">
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">4</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">Budaya dan Tradisi Unik di
                                    Indonesia</td>
                                <td class="p-4 text-xs">
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="Artikel 4"
                                        class="w-24 h-16 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                </td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[200px] truncate">Mengenal
                                    berbagai budaya dan tradisi unik dari setiap daerah</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[250px] truncate">Indonesia
                                    dikenal dengan keberagaman budayanya. Setiap daerah memiliki tradisi yang unik...</td>
                                <td class="p-4 text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="openEditArtikelModal(this.closest('tr'))"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                            Edit
                                        </button>
                                        <button
                                            class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-id="5" data-kategori="penginapan" data-status="publish">
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">5</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">Review Villa Mewah dengan
                                    Pemandangan Laut</td>
                                <td class="p-4 text-xs">
                                    <img src="{{ asset('landingpage/villa.jpg') }}" alt="Artikel 5"
                                        class="w-24 h-16 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                </td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[200px] truncate">Review lengkap
                                    villa mewah dengan pemandangan laut yang memukau</td>
                                <td class="p-4 text-xs text-gray-900 dark:text-white max-w-[250px] truncate">Villa ini
                                    menawarkan pengalaman menginap yang tak terlupakan dengan pemandangan laut...</td>
                                <td class="p-4 text-xs">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="openEditArtikelModal(this.closest('tr'))"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                            Edit
                                        </button>
                                        <button
                                            class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-white border-t border-[#FFD4D4] dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan
                <span class="font-semibold text-gray-900 dark:text-white">1</span>
                - <span class="font-semibold text-gray-900 dark:text-white">5</span>
                dari <span class="font-semibold text-gray-900 dark:text-white">5</span>
                data
            </div>
            <div>
                <nav class="flex items-center gap-1">
                    <button
                        class="px-3 py-1 text-sm text-gray-500 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-400"
                        disabled>Sebelumnya</button>
                    <button class="px-3 py-1 text-sm text-white bg-[#E60000] rounded-lg dark:bg-[#FF6B6B]">1</button>
                    <button
                        class="px-3 py-1 text-sm text-gray-500 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400">Selanjutnya</button>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="addKategoriModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
                onclick="closeAddKategoriModal()"></div>
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-6 py-4 border-b border-[#FFD4D4] dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-[#E60000] dark:text-[#FF6B6B]">Tambah Kategori</h3>
                        <button type="button" onclick="closeAddKategoriModal()"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <form action="#" method="POST" id="addKategoriForm" onsubmit="return handleAddKategori(event)">
                        <div class="space-y-4">
                            <div>
                                <label for="addNamaKategori"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="add_nama_kategori" id="addNamaKategori"
                                    class="shadow-sm bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                    placeholder="Masukkan nama kategori" required>
                                <p id="addNamaKategoriError" class="mt-1 text-sm text-red-600 hidden">Nama kategori wajib
                                    diisi</p>
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
                            <button type="button" onclick="closeAddKategoriModal()"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#E60000] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Artikel akan di-include dari file terpisah -->
    <!-- Modal Edit Artikel akan di-include dari file terpisah -->

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== FILTER ==========
        const filterKategori = document.getElementById('filter-kategori');
        const filterStatus = document.getElementById('filter-status');
        const tableRows = document.querySelectorAll('#table-body tr');

        function filterTable() {
            const selectedKategori = filterKategori.value;
            const selectedStatus = filterStatus.value;

            tableRows.forEach(row => {
                const kategori = row.getAttribute('data-kategori') || 'semua';
                const status = row.getAttribute('data-status') || 'semua';

                const matchKategori = selectedKategori === 'semua' || kategori === selectedKategori;
                const matchStatus = selectedStatus === 'semua' || status === selectedStatus;

                row.style.display = (matchKategori && matchStatus) ? '' : 'none';
            });
        }

        filterKategori.addEventListener('change', filterTable);
        filterStatus.addEventListener('change', filterTable);

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const row = this.closest('tr');
                const name = row.querySelector('td:nth-child(2)')?.textContent || 'artikel ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus artikel "${name}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#E60000',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: `${name} berhasil dihapus`,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            row.remove();
                            updateRowNumbers();
                            updatePaginationInfo();
                        });
                    }
                });
            });
        });

        // ========== FUNGSI UPDATE ==========
        function updateRowNumbers() {
            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach((row, index) => {
                const noCell = row.querySelector('td:first-child');
                if (noCell) noCell.textContent = index + 1;
            });
        }

        function updatePaginationInfo() {
            const rows = document.querySelectorAll('#table-body tr');
            const total = rows.length;
            const infoSpan = document.querySelector('.text-sm.text-gray-500.dark\\:text-gray-400');
            if (infoSpan) {
                const parent = infoSpan.parentElement;
                if (parent) {
                    parent.innerHTML = `
                        Menampilkan
                        <span class="font-semibold text-gray-900 dark:text-white">1</span>
                        - <span class="font-semibold text-gray-900 dark:text-white">${total}</span>
                        dari <span class="font-semibold text-gray-900 dark:text-white">${total}</span>
                        data
                    `;
                }
            }
        }

        // ========== FUNGSI MODAL TAMBAH KATEGORI ==========
        window.openAddKategoriModal = function () {
            document.getElementById('addKategoriModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('addKategoriForm').reset();
            document.getElementById('addNamaKategoriError').classList.add('hidden');
            setTimeout(() => document.getElementById('addNamaKategori').focus(), 100);
        };

        window.closeAddKategoriModal = function () {
            document.getElementById('addKategoriModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        window.handleAddKategori = function (event) {
            event.preventDefault();
            const nama = document.getElementById('addNamaKategori').value.trim();

            if (!nama) {
                document.getElementById('addNamaKategoriError').classList.remove('hidden');
                return false;
            }

            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Menyimpan...';
            submitBtn.disabled = true;

            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: `Kategori "${nama}" berhasil ditambahkan`,
                    timer: 2000,
                    showConfirmButton: false
                });

                // Tambahkan opsi ke dropdown filter kategori
                const filterSelect = document.getElementById('filter-kategori');
                const option = document.createElement('option');
                option.value = nama.toLowerCase().replace(/\s+/g, '-');
                option.textContent = nama;
                filterSelect.appendChild(option);

                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                closeAddKategoriModal();
            }, 1000);

            return false;
        };

        // ========== FUNGSI MODAL ARTIKEL ==========
        // Fungsi ini akan di-override oleh modal_add_artikel dan modal_edit_artikel
        // Tapi kita definisikan sebagai fallback
        if (typeof window.openAddArtikelModal === 'undefined') {
            window.openAddArtikelModal = function () {
                alert('Fungsi openAddArtikelModal belum terdefinisi. Pastikan file modal_add_artikel sudah di-include.');
            };
        }

        if (typeof window.openEditArtikelModal === 'undefined') {
            window.openEditArtikelModal = function (row) {
                alert('Fungsi openEditArtikelModal belum terdefinisi. Pastikan file modal_edit_artikel sudah di-include.');
            };
        }
    });
</script>

<style>
    .dark .bg-\[\#FFF5F5\] {
        background-color: #1f2937 !important;
    }

    .dark .border-\[\#FFD4D4\] {
        border-color: #374151 !important;
    }

    .dark .text-\[\#E60000\] {
        color: #FF6B6B !important;
    }

    nav .rounded-lg {
        transition: all 0.2s ease;
    }

    nav button:not(:disabled):hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    #table-body tr:hover {
        background-color: #FFF5F5;
        transition: background-color 0.2s ease;
    }

    .dark #table-body tr:hover {
        background-color: #374151;
    }

    /* Modal animation */
    #addKategoriModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addKategoriModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addKategoriModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
</style>