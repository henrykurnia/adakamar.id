@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.accomodation.modal_add_fasilitas')
    @include('example.layouts.partials.accomodation.modal_edit_fasilitas')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#E60000] lg:mt-1.5 dark:bg-gray-800 dark:border-[#FF6B6B]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#E60000] sm:text-2xl dark:text-[#FF6B6B]">Daftar Fasilitas</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('facilities.index') }}" method="GET" id="searchForm">
                            <div class="relative w-full sm:w-64 xl:w-96">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-[#FF6B6B] dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="keyword" id="search-input" value="{{ request('keyword') }}"
                                    class="bg-[#FFF5F5] border border-[#FFD4D4] text-gray-900 sm:text-sm rounded-lg focus:ring-[#E60000] focus:border-[#E60000] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#FF6B6B] dark:focus:border-[#FF6B6B]"
                                    placeholder="Cari fasilitas...">
                            </div>
                        </form>
                        @if (request('keyword'))
                            <a href="{{ route('facilities.index') }}"
                                class="text-sm text-[#E60000] hover:text-[#B71C1C] dark:text-[#FF6B6B] dark:hover:text-[#FF6B6B]">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                                Hapus Filter
                            </a>
                        @endif
                    </div>

                    <!-- Bagian Kanan: Tombol Tambah -->
                    <div class="flex items-center w-full sm:w-auto sm:justify-end">
                        <a href="#" onclick="openAddFasilitasModal()"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] focus:outline-none dark:focus:ring-[#FF6B6B] inline-flex items-center w-full sm:w-auto justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Fasilitas
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
                                        Nama Fasilitas
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                        Deskripsi
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[180px]">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#FFD4D4] dark:bg-gray-800 dark:divide-gray-700"
                                id="table-body">
                                @forelse($facilities as $index => $facility)
                                    <tr data-id="{{ $facility->id }}">
                                        <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                            {{ $facilities->firstItem() + $index }}
                                        </td>
                                        <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">
                                            {{ $facility->name }}
                                        </td>
                                        <td class="p-4 text-xs text-gray-900 dark:text-white">
                                            {{ $facility->description ?? '-' }}
                                        </td>
                                        <td class="p-4 text-xs">
                                            <div class="flex items-center gap-1.5">
                                                <button onclick="openEditFasilitasModal({{ $facility->id }})"
                                                    class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                                    Edit
                                                </button>
                                                <button
                                                    class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]"
                                                    data-id="{{ $facility->id }}" data-name="{{ $facility->name }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-6 text-gray-500 dark:text-gray-400">
                                            @if (request('keyword'))
                                                Tidak ada fasilitas dengan nama "{{ request('keyword') }}"
                                            @else
                                                Belum ada data fasilitas.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if (method_exists($facilities, 'hasPages') && $facilities->hasPages())
            <div class="p-4 bg-white border-t border-[#FFD4D4] dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Menampilkan
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $facilities->firstItem() ?? 0 }}</span>
                        - <span class="font-semibold text-gray-900 dark:text-white">{{ $facilities->lastItem() ?? 0 }}</span>
                        dari <span class="font-semibold text-gray-900 dark:text-white">{{ $facilities->total() }}</span>
                        data
                        @if (request('keyword'))
                            <span class="text-[#E60000] dark:text-[#FF6B6B]">
                                (Hasil pencarian: "{{ request('keyword') }}")
                            </span>
                        @endif
                    </div>
                    <div>
                        {{ $facilities->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif

@endsection

<!-- Script untuk fungsi -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== SEARCH ==========
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    searchForm.submit();
                }, 500);
            });

            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && this.value !== '') {
                    this.value = '';
                    searchForm.submit();
                }
            });
        }

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name || 'fasilitas ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus fasilitas "${name}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#E60000',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ route('facilities.destroy', '') }}/${id}`;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        // ========== EDIT MODAL ==========
        window.openEditFasilitasModal = function (id) {
            const url = `{{ url('/facilities') }}/${id}/edit`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    throw new Error('Data fasilitas tidak ditemukan.');
                }

                const facility = data.data;

                document.getElementById('editFasilitasId').value = facility.id;
                document.getElementById('editNamaFasilitas').value = facility.name;
                document.getElementById('editDeskripsiFasilitas').value = facility.description || '';

                document.getElementById('editFasilitasForm').action =
                    `{{ url('/facilities') }}/${facility.id}`;

                document.getElementById('editFasilitasModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data fasilitas.',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        };

        window.closeEditFasilitasModal = function () {
            document.getElementById('editFasilitasModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeEditFasilitasModal();
            }
        });

        // Click outside to close
        document.querySelector('#editFasilitasModal .fixed.inset-0')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeEditFasilitasModal();
            }
        });
    });

    // ========== NOTIFICATION ==========
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

<style>
    /* Dark mode support */
    .dark .bg-\[\#FFF5F5\] {
        background-color: #1f2937 !important;
    }

    .dark .border-\[\#FFD4D4\] {
        border-color: #374151 !important;
    }

    .dark .text-\[\#E60000\] {
        color: #FF6B6B !important;
    }

    /* Pagination styling */
    .pagination {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #E60000;
        background-color: #FFF5F5;
        border: 1px solid #FFD4D4;
        transition: all 0.2s ease;
        text-decoration: none;
        min-width: 36px;
    }

    .pagination .page-link:hover {
        background-color: #E60000;
        border-color: #E60000;
        color: #ffffff;
        text-decoration: none;
    }

    .pagination .active .page-link {
        background-color: #E60000;
        border-color: #E60000;
        color: #ffffff;
    }

    .pagination .active .page-link:hover {
        background-color: #B71C1C;
        border-color: #B71C1C;
        color: #ffffff;
    }

    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f3f4f6;
        color: #9CA3AF;
        pointer-events: none;
    }

    .dark .pagination .page-link {
        background-color: #1f2937;
        border-color: #374151;
        color: #FF6B6B;
    }

    .dark .pagination .page-link:hover {
        background-color: #FF6B6B;
        border-color: #FF6B6B;
        color: #ffffff;
    }

    .dark .pagination .active .page-link {
        background-color: #FF6B6B;
        border-color: #FF6B6B;
        color: #ffffff;
    }

    .dark .pagination .active .page-link:hover {
        background-color: #E60000;
        border-color: #E60000;
        color: #ffffff;
    }

    .dark .pagination .disabled .page-link {
        background-color: #374151;
        color: #6B7280;
    }

    @media (max-width: 640px) {
        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            padding: 4px 10px;
            font-size: 12px;
            min-width: 30px;
        }
    }

    /* Table hover effect */
    #table-body tr:hover {
        background-color: #FFF5F5;
        transition: background-color 0.2s ease;
    }

    .dark #table-body tr:hover {
        background-color: #374151;
    }

    /* Modal animation */
    #editFasilitasModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editFasilitasModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editFasilitasModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
</style>