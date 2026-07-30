@extends('example_admin.layouts.default.dashboard')

@section('content')
    <!-- Tambahkan SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="grid grid-cols-1 px-4 pt-6 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <h1 class="text-xl font-semibold text-[#1B4EF5] sm:text-2xl dark:text-[#3874FF]">Tambah User</h1>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
            @csrf

            <div class="col-span-full">
                <div
                    class="p-4 mb-4 bg-white border border-[#E8D5F5] rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">

                    <!-- Informasi User -->
                    <div>
                        <h3 class="mb-4 text-xl font-semibold text-[#1B4EF5] dark:text-[#3874FF]">Informasi User</h3>

                        <div class="grid grid-cols-6 gap-6">
                            <!-- Nama User -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama User <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan nama user" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Masukkan email user" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                        placeholder="Minimal 6 karakter" required>
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Password minimal 6 karakter</p>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Konfirmasi Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]"
                                    placeholder="Konfirmasi password" required>
                            </div>

                            <!-- Role (Admin tidak ditampilkan) -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Role <span class="text-red-500">*</span>
                                </label>
                                <select name="role" id="role"
                                    class="shadow-sm bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 sm:text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $roleKey => $roleName)
                                        @if($roleKey != 'Admin')
                                            <option value="{{ $roleKey }}" {{ old('role') == $roleKey ? 'selected' : '' }}>
                                                {{ $roleName }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <div class="col-span-6">
                                <button type="submit" id="submitBtn"
                                    class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                                    <span id="submitText">Simpan User</span>
                                    <span id="loadingSpinner" class="hidden">
                                        <svg class="inline w-4 h-4 mr-2 text-white animate-spin"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Menyimpan...
                                    </span>
                                </button>
                                <a href="{{ route('admin.users.index') }}"
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('userForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const passwordInput = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const togglePassword = document.getElementById('togglePassword');

            // Toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Update icon
                const icon = this.querySelector('svg');
                if (type === 'text') {
                    icon.innerHTML = `
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            `;
                } else {
                    icon.innerHTML = `
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            `;
                }
            });

            // Validasi form sebelum submit
            form.addEventListener('submit', function (e) {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = passwordInput.value;
                const passwordConfirm = passwordConfirmation.value;
                const role = document.getElementById('role').value;

                // Validasi nama
                if (name === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Nama user tidak boleh kosong',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('name').focus();
                    document.getElementById('name').classList.add('border-red-500');
                    return false;
                }

                // Validasi email
                if (email === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Email tidak boleh kosong',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('email').focus();
                    document.getElementById('email').classList.add('border-red-500');
                    return false;
                }

                // Validasi format email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Format email tidak valid',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('email').focus();
                    document.getElementById('email').classList.add('border-red-500');
                    return false;
                }

                // Validasi password
                if (password === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Password tidak boleh kosong',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    passwordInput.focus();
                    passwordInput.classList.add('border-red-500');
                    return false;
                }

                if (password.length < 6) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Password minimal 6 karakter',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    passwordInput.focus();
                    passwordInput.classList.add('border-red-500');
                    return false;
                }

                // Validasi konfirmasi password
                if (password !== passwordConfirm) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Konfirmasi password tidak cocok',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    passwordConfirmation.focus();
                    passwordConfirmation.classList.add('border-red-500');
                    return false;
                }

                // Validasi role
                if (role === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Role harus dipilih',
                        confirmButtonColor: '#1B4EF5',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('role').focus();
                    document.getElementById('role').classList.add('border-red-500');
                    return false;
                }

                // Jika validasi lulus, tampilkan loading
                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';

                // Tampilkan loading SweetAlert
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

            // Hapus border merah saat input diisi
            document.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('input', function () {
                    this.classList.remove('border-red-500');
                });
                element.addEventListener('change', function () {
                    this.classList.remove('border-red-500');
                });
            });

            // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
            let formChanged = false;
            const formInputs = form.querySelectorAll('input, select');
            formInputs.forEach(input => {
                input.addEventListener('input', function () {
                    formChanged = true;
                });
                input.addEventListener('change', function () {
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

        // Tampilkan notifikasi sukses jika ada session success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor: '#1B4EF5',
                confirmButtonText: 'OK',
                timerProgressBar: true
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = '{{ route('admin.users.index') }}';
                }
            });
        @endif

        // Tampilkan notifikasi error jika ada session error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif

        // Tampilkan notifikasi error dari validasi
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Perbaiki'
            });
        @endif
    </script>
@endpush