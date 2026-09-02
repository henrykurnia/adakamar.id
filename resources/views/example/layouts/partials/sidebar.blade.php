@php
    $url = explode('/', request()->url());
    $page_slug = $url[count($url) - 2];
@endphp

<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
  <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
        <ul class="pb-2 space-y-2">
          <li>
            <form action="#" method="GET" class="lg:hidden">
              <label for="mobile-search" class="sr-only">Search</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" name="email" id="mobile-search" class="bg-gray-50 border border-gray-300 text-green-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5" placeholder="Search">
              </div>
            </form>
          </li>
          <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-base text-green-900 rounded-lg hover:bg-green-100 group">
              <svg class="w-6 h-6 text-green-900 transition duration-75 group-hover:text-green-1000" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
              <span class="ml-3" sidebar-toggle-item>Dashboard</span>
            </a>
          </li>
                {{-- Akomodasi --}}
                <li>

                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-green-900 rounded-lg hover:bg-green-100"
                        aria-controls="dropdown-akomodasi"
                        data-collapse-toggle="dropdown-akomodasi">

                        {{-- Icon --}}
                        <svg class="flex-shrink-0 w-6 h-6 text-green-900"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path d="M10 2L2 8v10h5v-6h6v6h5V8l-8-6z"/>

                        </svg>

                        <span class="flex-1 ml-3 text-left whitespace-nowrap">
                            Akomodasi
                        </span>

                        {{-- Arrow --}}
                        <svg class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>

                        </svg>

                    </button>


                    {{-- SUBMENU AKOMODASI --}}
                    <ul id="dropdown-akomodasi"
                        class="space-y-2 py-2
                        {{ Request::routeIs('akomodasi.*') ||
                          Request::routeIs('kategori.*') ||
                          Request::routeIs('fasilitas.*') ||
                          Request::routeIs('aturan.*')
                          ? ''
                          : 'hidden' }}">

                        {{-- Semua Akomodasi --}}
                        <li>
                            <a href="{{ route('akomodasi.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Semua Akomodasi

                            </a>
                        </li>


                        {{-- Kategori --}}
                        <li>
                            <a href="{{ route('kategori.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Kategori

                            </a>
                        </li>


                        {{-- Fasilitas --}}
                        <li>
                            <a href="{{ route('fasilitas.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Fasilitas

                            </a>
                        </li>


                        {{-- Aturan --}}
                        <li>
                            <a href="{{ route('aturan.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Aturan

                            </a>
                        </li>

                    </ul>

                </li>


                {{-- Artikel --}}
                <li>

                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-green-900 rounded-lg hover:bg-green-100"
                        aria-controls="dropdown-artikel"
                        data-collapse-toggle="dropdown-artikel">

                        {{-- Icon --}}
                        <svg class="flex-shrink-0 w-6 h-6 text-green-900"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path d="M10 2L2 8v10h5v-6h6v6h5V8l-8-6z"/>

                        </svg>

                        <span class="flex-1 ml-3 text-left whitespace-nowrap">
                            Artikel
                        </span>

                        {{-- Arrow --}}
                        <svg class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>

                        </svg>

                    </button>


                    {{-- SUBMENU ARTIKEL --}}
                    <ul id="dropdown-artikel"
                        class="space-y-2 py-2
                        {{ Request::routeIs('artikel.*') ||
                          Request::routeIs('kategori artikel.*') 
                          ? ''
                          : 'hidden' }}">

                        {{-- Artikel --}}
                        <li>
                            <a href="{{ route('artikel.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Artikel

                            </a>
                        </li>


                        {{-- Kategori Artikel --}}
                        <li>
                            <a href="{{ route('artikel_kategori.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Kategori Artikel

                            </a>
                        </li>

                    </ul>

                </li>

                <li>

                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-green-900 rounded-lg hover:bg-green-100"
                        aria-controls="dropdown-pengaturan"
                        data-collapse-toggle="dropdown-pengaturan">

                        {{-- Icon --}}
                        <svg class="flex-shrink-0 w-6 h-6 text-green-900"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path d="M10 2L2 8v10h5v-6h6v6h5V8l-8-6z"/>

                        </svg>

                        <span class="flex-1 ml-3 text-left whitespace-nowrap">
                            Pengaturan
                        </span>

                        {{-- Arrow --}}
                        <svg class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 20 20">

                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>

                        </svg>

                    </button>


                    {{-- SUBMENU PENGATURAN --}}
                    <ul id="dropdown-pengaturan"
                        class="space-y-2 py-2
                        {{ Request::routeIs('banner.*') ||
                          Request::routeIs('tentang.*') ||
                          Request::routeIs('galeries.*') 
                          ? ''
                          : 'hidden' }}">

                        {{-- Semua Akomodasi --}}
                        <li>
                            <a href="{{ route('banner.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Banner

                            </a>
                        </li>


                        {{-- Tentang --}}
                        <li>
                            <a href="{{ route('tentang.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Tentang

                            </a>
                        </li>


                        {{-- Galeri --}}
                        <li>
                            <a href="{{ route('galeries.index') }}"
                                class="flex items-center w-full p-2 pl-11 text-green-900 rounded-lg hover:bg-green-100">

                                Galeri

                            </a>
                        </li>

                    </ul>

                </li>

          
        </ul>
        
      </div>
    </div>
    </div>
  </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>
