@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_setting')
    @include('example.layouts.partials.konten.modal_edit_setting')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#E60000] lg:mt-1.5 dark:bg-gray-800 dark:border-[#FF6B6B]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#E60000] sm:text-2xl dark:text-[#FF6B6B]">
                    <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd" />
                    </svg>
                    Pengaturan Website
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola pengaturan website secara terpusat</p>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Informasi -->
                <div class="flex items-center w-full sm:w-auto">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Total <span class="font-semibold text-gray-900 dark:text-white">{{ $settings->count() }}</span>
                        pengaturan
                        @if($settings->count() >= 1)
                            <span
                                class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Maksimal 1 Pengaturan
                            </span>
                        @endif
                    </span>
                </div>

                <!-- Bagian Kanan: Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    @if($settings->count() < 1)
                        <button onclick="openAddSettingModal()"
                            class="text-white bg-[#E60000] hover:bg-[#B71C1C] focus:ring-4 focus:ring-[#FFD4D4] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#FF6B6B] dark:hover:bg-[#E60000] focus:outline-none dark:focus:ring-[#FF6B6B] inline-flex items-center w-full sm:w-auto justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Pengaturan
                        </button>
                    @else
                        <div class="text-sm text-gray-500 dark:text-gray-400 italic">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pengaturan sudah ada (maksimal 1)
                        </div>
                    @endif
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
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[80px]">
                                    Logo
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                    Nama Website
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                    Tagline
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B]">
                                    Email
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#E60000] uppercase dark:text-[#FF6B6B] w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#FFD4D4] dark:bg-gray-800 dark:divide-gray-700"
                            id="table-body">
                            @forelse($settings as $index => $setting)
                                <tr data-id="{{ $setting->id }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($setting->logo)
                                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}"
                                                class="w-12 h-12 object-cover rounded-lg border border-[#FFD4D4] dark:border-gray-600">
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">
                                        {{ $setting->site_name }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[150px] truncate">
                                        {{ $setting->tagline ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $setting->email ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditSettingModal({{ $setting->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#3B82F6] hover:bg-[#2563EB] focus:ring-4 focus:ring-[#93C5FD] rounded-lg dark:bg-[#3B82F6] dark:hover:bg-[#2563EB] dark:focus:ring-[#93C5FD] min-w-[55px]">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]"
                                                data-id="{{ $setting->id }}" data-name="{{ $setting->site_name }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-3 text-gray-300 dark:text-gray-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <p class="text-base font-medium text-gray-700 dark:text-gray-300">Belum ada
                                                pengaturan</p>
                                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Klik tombol "Tambah
                                                Pengaturan" untuk menambahkan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    <!-- Info Pengaturan Maksimal 1 -->
    @if($settings->count() >= 1)
        <div class="fixed bottom-4 right-4 z-50">
            <div
                class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-lg dark:bg-yellow-900/30 dark:border-yellow-500 dark:text-yellow-300 max-w-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">
                            Hanya 1 pengaturan yang diperbolehkan
                        </p>
                        <p class="text-xs opacity-75">Edit pengaturan yang ada atau hapus untuk menambah yang baru</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name || 'pengaturan ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus pengaturan "${name}" secara permanen!`,
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
                        // PERBAIKAN: Gunakan route dengan parameter yang benar
                        form.action = '{{ route('pengaturan.destroy', ':id') }}'.replace(':id', id);
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

        console.log('Halaman pengaturan siap digunakan.');
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

    #table-body tr:hover {
        background-color: #FFF5F5;
        transition: background-color 0.2s ease;
    }

    .dark #table-body tr:hover {
        background-color: #374151;
    }

    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .fixed.bottom-4.right-4.z-50 {
        animation: slideInUp 0.5s ease-out;
    }
</style>