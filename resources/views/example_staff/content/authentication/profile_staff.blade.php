@extends('example_staff.layouts.default.dashboard')
@section('content')
    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Edit Profile</h1>
        </div>

        <form action="{{ route('staff.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-span-full">
                <div
                    class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Upload Foto Profile -->
                    <div
                        class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4 pb-6 mb-6 border-b border-[#E8D5F5] dark:border-gray-700">
                        <div class="flex items-center space-x-6">
                            <!-- Preview Image -->
                            <img id="profileImage"
                                src="{{ $user->photo ? asset('static/images/users/' . $user->photo) : asset('static/images/default-avatar.png') }}"
                                class="w-32 h-32 rounded-full object-cover border-2 border-[#E8D5F5] dark:border-gray-600">

                            <div>
                                <label
                                    class="cursor-pointer px-4 py-2 bg-[#1B4EF5] text-white rounded-lg hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF] inline-flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                        </path>
                                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                                    </svg>
                                    Upload Foto
                                    <input type="file" id="imageUpload" name="photo" accept="image/*" class="hidden">
                                </label>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                    JPG, GIF atau PNG. Maksimal ukuran 800K
                                </p>

                                <button type="button" id="removeButton"
                                    class="mt-2 py-1 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-[#1B4EF5] focus:z-10 focus:ring-4 focus:ring-[#D4E0FF] dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Profile -->
                    <div>
                        <h3 class="mb-4 text-xl font-semibold text-[#1B4EF5] dark:text-[#3874FF]">Informasi Profile</h3>

                        <div class="grid grid-cols-6 gap-6">
                            <input type="hidden" name="profile_image" id="profileImageData">

                            <!-- Nama -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Lama (tidak digunakan di controller, tapi tetap ada untuk keamanan) -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="current_password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password Lama
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan password lama untuk mengganti password">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password Baru
                                </label>
                                <input type="password" name="password" id="password"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan password baru (minimal 8 karakter)">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Konfirmasi password baru">
                            </div>

                            <!-- Info Password -->
                            <div class="col-span-6">
                                <div
                                    class="p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-700">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">
                                                Password hanya akan diubah jika Anda mengisi password baru dan konfirmasi
                                                password
                                            </p>
                                            <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">
                                                Password baru minimal 8 karakter dan harus dikonfirmasi
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-span-6 sm:col-full">
                                <button type="submit"
                                    class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('dashboard.staff') }}"
                                    class="ml-2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')

@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== PREVIEW IMAGE ==========
        const profileImage = document.getElementById('profileImage');
        const imageUpload = document.getElementById('imageUpload');
        const removeButton = document.getElementById('removeButton');
        const profileImageData = document.getElementById('profileImageData');
        const placeholderImage = '{{ asset("static/images/default-avatar.png") }}';

        function previewImage(file) {
            if (!file) return;

            if (file.size > 800 * 1024) {
                alert('Ukuran file maksimal 800K. Silakan pilih file yang lebih kecil.');
                imageUpload.value = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Format file harus JPG, GIF atau PNG.');
                imageUpload.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                profileImage.src = event.target.result;
                if (profileImageData) {
                    profileImageData.value = event.target.result;
                }
            };
            reader.readAsDataURL(file);
        }

        imageUpload.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file);
            }
        });

        if (removeButton) {
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();
                profileImage.src = placeholderImage;
                imageUpload.value = '';
                if (profileImageData) {
                    profileImageData.value = '';
                }
            });
        }

        // Drag and drop support
        const imageContainer = document.querySelector('.flex.items-center.space-x-6');
        if (imageContainer) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                imageContainer.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            imageContainer.addEventListener('dragover', function () {
                this.classList.add('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
            });

            imageContainer.addEventListener('dragleave', function () {
                this.classList.remove('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
            });

            imageContainer.addEventListener('drop', function (e) {
                this.classList.remove('ring-4', 'ring-[#1B4EF5]', 'ring-offset-2', 'rounded-lg');
                const file = e.dataTransfer.files[0];
                if (file) {
                    previewImage(file);
                }
            });
        }

        if (profileImage) {
            profileImage.addEventListener('click', function () {
                imageUpload.click();
            });
            profileImage.style.cursor = 'pointer';
        }
    });
</script>