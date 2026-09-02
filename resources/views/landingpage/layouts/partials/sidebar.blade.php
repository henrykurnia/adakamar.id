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
            <a href="{{ url('/dashboard') }}"
              class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-[#F5F0FF] group dark:text-gray-200 dark:hover:bg-gray-700 {{ $page_slug == 'dashboard' ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
              <svg
                class="w-6 h-6 text-[#5996FF] transition duration-75 group-hover:text-[#1B4EF5] dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
              <span class="ml-3" sidebar-toggle-item>Dashboard</span>
            </a>
          </li>

          <!-- MENU PRODUK -->
          <li>
            <button type="button"
              class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700"
              aria-controls="dropdown-produk" data-collapse-toggle="dropdown-produk">
              <svg
                class="flex-shrink-0 w-6 h-6 text-[#5996FF] transition duration-75 group-hover:text-[#1B4EF5] dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M4 3a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V3zM4 9a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V9zM4 15a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1v-2zM12 3a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1V3zM12 9a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1V9zM12 15a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2z" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap">Produk</span>
              <svg class="w-6 h-6 text-[#5996FF] group-hover:text-[#1B4EF5]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-produk"
              class="space-y-2 py-2 {{ Request::routeIs('products.*') || Request::routeIs('suppliers.*') ? 'block' : 'hidden' }}">
              <li>
                <a href="{{ route('products.index') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('products.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                  </svg>
                  Daftar Produk
                </a>
              </li>
              <li>
                <a href="{{ route('suppliers.index') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('suppliers.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                  </svg>
                  Supplier Produk
                </a>
              </li>
            </ul>
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
              class="space-y-2 py-2 {{ Request::routeIs('stock-transactions.*') ? 'block' : 'hidden' }}">
            <li>
              <a href="{{ route('stock-transactions.index') }}"
                class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('stock-transactions.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                    clip-rule="evenodd" />
                </svg>
                Transaksi
              </a>
            </li>
            <li>
              <a href="{{ route('stock-opnames.index') }}"
                class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('stock-opnames.*') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
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

          <!-- Laporan -->
          <!-- MENU LAPORAN -->
          <li>
            <button type="button"
              class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700"
              aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
              <svg
                class="flex-shrink-0 w-6 h-6 text-[#5996FF] transition duration-75 group-hover:text-[#1B4EF5] dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                  clip-rule="evenodd" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap">Laporan</span>
              <svg class="w-6 h-6 text-[#5996FF] group-hover:text-[#1B4EF5]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-laporan" class="space-y-2 py-2 {{ Request::routeIs('reports.*') ? 'block' : 'hidden' }}">
              <li>
                <a href="{{ route('reports.stock') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('reports.stock') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd"
                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                      clip-rule="evenodd" />
                  </svg>
                  Laporan Stok Barang
                </a>
              </li>
              <li>
                <a href="{{ route('reports.stock-in') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('reports.stock-in') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                      clip-rule="evenodd" />
                  </svg>
                  Laporan Barang Masuk
                </a>
              </li>
              <li>
                <a href="{{ route('reports.stock-out') }}"
                  class="flex items-center p-2 pl-11 text-base rounded-lg hover:bg-[#F5F0FF] dark:text-gray-200 dark:hover:bg-gray-700 {{ Request::routeIs('reports.stock-out') ? 'bg-[#F5F0FF] dark:bg-gray-700' : '' }}">
                  <svg class="w-5 h-5 mr-2 text-[#5996FF]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                      clip-rule="evenodd" />
                  </svg>
                  Laporan Barang Keluar
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