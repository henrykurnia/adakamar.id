@extends('example_admin.layouts.default.dashboard')

@section('content')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">
                Edit Supplier
            </h1>
        </div>

        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" id="supplierForm">
            @csrf
            @method('PUT')

            <div class="col-span-full">
                <div class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Nama Supplier -->
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Supplier <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}"
                            class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg
                                    focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                            placeholder="Masukkan nama supplier" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-5">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Alamat
                        </label>
                        <textarea name="address" id="address" rows="4"
                            class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg
                                    focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                            placeholder="Masukkan alamat supplier">{{ old('address', $supplier->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telepon -->
                    <div class="mb-5">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. Telepon
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $supplier->phone) }}"
                            class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg
                                    focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                            placeholder="081234567890">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $supplier->email) }}"
                            class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg
                                    focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                            placeholder="supplier@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6">
                        <button type="submit" id="submitBtn"
                            class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4
                                    focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5
                                    text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5]
                                    dark:focus:ring-[#5996FF] w-full sm:w-auto">
                            <span id="submitText">Simpan Perubahan</span>
                            <span id="loadingSpinner" class="hidden">
                                <svg class="inline w-4 h-4 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                    </circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>

                        <a href="{{ route('admin.suppliers.index') }}"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none
                                    hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF]
                                    font-medium rounded-lg text-sm px-5 py-2.5 text-center
                                    dark:bg-gray-800 dark:text-white dark:border-gray-600
                                    dark:hover:bg-gray-700 dark:hover:border-gray-600
                                    dark:focus:ring-gray-700 w-full sm:w-auto">
                            Batal
                        </a>
                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('supplierForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const nameInput = document.getElementById('name');

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: true,
                    confirmButtonColor: '#1B4EF5',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Perbaiki'
                });
            @endif

            form.addEventListener('submit', function (e) {
                const nameValue = nameInput.value.trim();

                if (nameValue === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Nama supplier wajib diisi',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    nameInput.focus();
                    nameInput.classList.add('border-red-500');
                    return false;
                }

                if (nameValue.length < 3) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Nama supplier minimal 3 karakter',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    nameInput.focus();
                    nameInput.classList.add('border-red-500');
                    return false;
                }

                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';

                Swal.fire({
                    title: 'Menyimpan Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });

            nameInput.addEventListener('input', function () {
                this.classList.remove('border-red-500');
            });

            let formChanged = false;
            form.querySelectorAll('input, textarea').forEach(function (el) {
                el.addEventListener('input', function () {
                    formChanged = true;
                });
            });

            window.addEventListener('beforeunload', function (e) {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
                }
            });

            form.addEventListener('submit', function () {
                formChanged = false;
            });
        });
    </script>
@endpush