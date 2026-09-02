<nav class="fixed z-50 w-full bg-white shadow-lg dark:bg-[#1a1a1a] dark:shadow-xl">
  <div class="px-4 py-3 lg:px-6 lg:pl-4">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
          class="p-2 text-[#666666] rounded cursor-pointer lg:hidden hover:text-[#E60000] hover:bg-[#F2F2F2] focus:bg-[#F2F2F2] dark:focus:bg-gray-700 focus:ring-2 focus:ring-[#FF6B6B] dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <a href="#" class="flex ml-2 md:mr-24 items-center pl-4"> <!-- Added pl-4 for left padding -->
          <img src="{{ asset('landingpage/home.png') }}" class="h-8 mr-3" alt="adakamar.id Logo" />
          <span
            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[#E60000] dark:text-[#FF6B6B]">adakamar.id</span>
        </a>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-8">
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Beranda</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Penginapan</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Fasilitas</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Galeri</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Artikel</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">FaQ</a>
        <a href="#"
          class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors">Kontak</a>
      </div>

      <div class="flex items-center">
        <!-- Mobile Menu Button -->
        <button id="mobileMenuButton" type="button"
          class="p-2 text-[#666666] rounded-lg lg:hidden hover:text-[#E60000] hover:bg-[#F2F2F2] dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <span class="sr-only">Menu</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Theme Toggle -->
        <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
          class="text-[#666666] dark:text-gray-400 hover:bg-[#F2F2F2] dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-[#FF6B6B] dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
          <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>
        <div id="tooltip-toggle" role="tooltip"
          class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
          Toggle dark mode
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <!-- Login/Register Buttons -->
        <div class="flex items-center ml-3 space-x-3 pr-4"> <!-- Added pr-4 for right padding -->
          <a href="#"
            class="text-[#E60000] hover:text-[#B71C1C] dark:text-[#FF6B6B] dark:hover:text-[#E60000] font-medium transition-colors">
            Login
          </a>

        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu Dropdown -->
  <div id="mobileMenu" class="hidden lg:hidden bg-white dark:bg-[#1a1a1a] shadow-lg">
    <div class="flex flex-col space-y-2 px-4 py-3">
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Beranda</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Penginapan</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Fasilitas</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Galeri</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Artikel</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">FaQ</a>
      <a href="#"
        class="text-[#333333] hover:text-[#E60000] dark:text-gray-300 dark:hover:text-[#FF6B6B] font-medium transition-colors py-2 border-b border-[#F2F2F2] dark:border-gray-700">Kontak</a>

      <!-- Mobile Login/Register -->
      <div class="flex flex-col space-y-2 pt-3 mt-2 border-t border-[#F2F2F2] dark:border-gray-700">
        <a href="#" class="text-[#E60000] dark:text-[#FF6B6B] font-medium text-center py-2">Login</a>
        <a href="#"
          class="bg-[#E60000] text-white rounded-lg py-2 text-center hover:bg-[#B71C1C] dark:bg-[#E60000] dark:hover:bg-[#B71C1C] transition-colors">Daftar</a>
      </div>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ========== MOBILE MENU TOGGLE ==========
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');
      });

      // Close mobile menu when clicking outside
      document.addEventListener('click', function (event) {
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
          mobileMenu.classList.add('hidden');
        }
      });
    }
  });
</script>