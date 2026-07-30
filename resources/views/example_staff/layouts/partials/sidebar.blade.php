@php
  $url = explode('/', request()->url());
  $page_slug = $url[count($url) - 2];
@endphp

<aside id="sidebar"
  class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
  aria-label="Sidebar">
  <div
    class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-[#1B4EF5] dark:bg-gray-800 dark:border-[#3874FF]">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-[#E8D5F5] dark:bg-gray-800 dark:divide-gray-700">
        <ul class="pb-2 space-y-2">

          <!-- Dashboard -->
          <li>
            <a href="{{ route('dashboard.staff') }}"
              class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-[#F5F0FF] group dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard.staff') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
              <svg
                class="w-6 h-6 text-[#5996FF] transition duration-75 group-hover:text-[#1B4EF5] dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
              <span class="ml-3" sidebar-toggle-item>Dashboard</span>
            </a>
          </li>

          <!-- MENU STOK -->
          <li>
            <button type="button"
              class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700"
              aria-controls="dropdown-stok" data-collapse-toggle="dropdown-stok">
              <svg
                class="flex-shrink-0 w-6 h-6 text-[#5996FF] transition duration-75 group-hover:text-[#1B4EF5] dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M4 3a1 1 0 00-1 1v5a1 1 0 001 1h4a1 1 0 001-1V4a1 1 0 00-1-1H4zM4 13a1 1 0 00-1 1v2a1 1 0 001 1h4a1 1 0 001-1v-2a1 1 0 00-1-1H4zM13 3a1 1 0 00-1 1v5a1 1 0 001 1h4a1 1 0 001-1V4a1 1 0 00-1-1h-4zM13 13a1 1 0 00-1 1v2a1 1 0 001 1h4a1 1 0 001-1v-2a1 1 0 00-1-1h-4z"
                  clip-rule="evenodd" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap">Stok</span>
              <svg class="w-6 h-6 text-[#5996FF] group-hover:text-[#1B4EF5]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-stok"
              class="space-y-2 py-2 {{ request()->routeIs('stock-confirmation.*') || request()->routeIs('staff.stock-opnames.*') ? 'block' : 'hidden' }}">
              <!-- Konfirmasi -->
              <li>
                <a href="{{ route('stock-confirmation.index') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('stock-confirmation.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.707 5.707a1 1 0 00-1.414-1.414L9 9.586 6.707 7.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  Konfirmasi
                </a>
              </li>
              <!-- Stock Opname -->
              <li>
                <a href="{{ route('staff.stock-opnames.index') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->routeIs('staff.stock-opnames.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd" />
                  </svg>
                  Stock Opname
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>