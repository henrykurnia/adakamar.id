@extends('example_admin.layouts.default.dashboard')

@section('content')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Edit Supplier
            </h1>
        </div>

        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST" id="supplierForm">
            @csrf
            @method('PUT')

            <div class="col-span-full">

                <!-- Nama Supplier -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Supplier <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan nama supplier"
                        required>

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat
                    </label>

                    <textarea name="address" id="address" rows="4" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Masukkan alamat supplier">{{ old('address', $supplier->address) }}</textarea>

                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        No. Telepon
                    </label>

                    <input type="text" name="phone" id="phone" value="{{ old('phone', $supplier->phone) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="081234567890">

                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-3 mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>

                    <input type="email" name="email" id="email" value="{{ old('email', $supplier->email) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="supplier@email.com">

                    @error('email')
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
                                        12H0c0 3.042 1.135
                                        5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                            Menyimpan...
                        </span>
                    </button>

                    <a href="{{ route('admin.suppliers.index') }}" class="ml-2 text-gray-900 bg-white border border-gray-300
                            focus:outline-none hover:bg-gray-100 focus:ring-4
                            focus:ring-gray-200 font-medium rounded-lg text-sm
                            px-5 py-2.5 dark:bg-gray-800 dark:text-white
                            dark:border-gray-600 dark:hover:bg-gray-700
                            dark:hover:border-gray-600 dark:focus:ring-gray-700">

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

            const form = document.getElementById('supplierForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            form.addEventListener('submit', function (e) {

                const name = document.getElementById('name').value.trim();

                if (name === '') {
                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Nama supplier wajib diisi'
                    });

                    return;
                }

                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');

                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

            });

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: '{!! implode("<br>", $errors->all()) !!}'
                });
            @endif

    });
    </script>
@endpush