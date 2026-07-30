@extends('example_admin.layouts.default.dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Edit Kategori
            </h1>
        </div>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" id="categoryForm">
            @csrf
            @method('PUT')

            <div class="col-span-full">

                <!-- Nama Kategori -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama kategori"
                        required>

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Deskripsi
                    </label>

                    <textarea name="description" id="description" rows="4" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Masukkan deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="col-span-6 sm:col-full">

                    <button type="submit" id="submitBtn" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4
                            focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5
                            text-center dark:bg-primary-600 dark:hover:bg-primary-700
                            dark:focus:ring-primary-800">

                        <span id="submitText">Simpan Perubahan</span>

                        <span id="loadingSpinner" class="hidden">
                            <svg class="inline w-4 h-4 mr-2 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373
                                        0 0 5.373 0 12h4zm2
                                        5.291A7.962 7.962 0 014
                                        12H0c0 3.042 1.135 5.824
                                        3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Menyimpan...
                        </span>

                    </button>

                    <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-900 bg-white border border-gray-300
                            focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200
                            font-medium rounded-lg text-sm px-5 py-2.5
                            dark:bg-gray-800 dark:text-white dark:border-gray-600
                            dark:hover:bg-gray-700 dark:hover:border-gray-600
                            dark:focus:ring-gray-700">
                        Batal
                    </a>

                </div>

            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('categoryForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: `{!! implode('<br>', $errors->all()) !!}`
                });
            @endif

            form.addEventListener('submit', function (e) {

                const nameInput = document.getElementById('name');
                const nameValue = nameInput.value.trim();

                if (nameValue === '') {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Nama kategori tidak boleh kosong'
                    });

                    nameInput.focus();
                    return;
                }

                if (nameValue.length < 3) {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Nama kategori minimal 3 karakter'
                    });

                    nameInput.focus();
                    return;
                }

                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                submitBtn.disabled = true;

                Swal.fire({
                    title: 'Mengupdate Data...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });

            document.getElementById('name').addEventListener('input', function () {
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
                    e.returnValue = '';
                }
            });

            form.addEventListener('submit', function () {
                formChanged = false;
            });

        });
    </script>
@endpush