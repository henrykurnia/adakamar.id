<nav class="bg-white border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4">

        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}"
               class="text-xl font-bold text-gray-900">
                ADAKAMAR
            </a>


            {{-- Admin --}}
            <div class="flex items-center gap-4">

                <a href="{{ route('users.index') }}"
                  class="text-sm text-gray-700 hover:text-gray-900">
                    Admin
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="text-sm text-red-600 hover:text-red-800">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>
<!-- Tambahkan SweetAlert2 CDN jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ========== LOGOUT CONFIRMATION ==========
    const logoutButton = document.getElementById('logout-button');
    const logoutForm = document.getElementById('logout-form');

    if (logoutButton && logoutForm) {
      logoutButton.addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
          title: 'Konfirmasi Logout',
          html: `
            <div class="text-left">
              <p class="mb-2">Apakah Anda yakin ingin logout dari akun?</p>
              <div class="bg-yellow-50 dark:bg-yellow-900/30 p-3 rounded-lg border border-yellow-200 dark:border-yellow-700">
                <p class="text-sm text-yellow-700 dark:text-yellow-300">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>
                  Anda akan keluar dari sistem dan perlu login kembali untuk mengakses halaman ini.
                </p>
              </div>
            </div>
          `,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#1B4EF5',
          confirmButtonText: 'Ya, Logout!',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          focusCancel: true,
          timerProgressBar: true
        }).then((result) => {
          if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
              title: 'Logout...',
              text: 'Anda sedang keluar dari sistem',
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });

            // Submit form logout
            logoutForm.submit();
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              icon: 'info',
              title: 'Dibatalkan',
              text: 'Anda tetap login',
              timer: 2000,
              showConfirmButton: false,
              timerProgressBar: true
            });
          }
        });
      });
    }
  });
</script>