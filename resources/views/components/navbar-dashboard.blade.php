@php
  $user = auth()->user();
@endphp
<nav class="fixed z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
          <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">
            <img src="{{ asset('static/images/logo.svg')}}" class="h-8 mr-3" alt="FlowBite Logo" />
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Adakamar.id</span>
          </a>
          
        </div>
        <div class="flex items-center">
           
            <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                Toggle dark mode
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
           <!-- Profile -->
<div class="flex items-center ml-3">
    <div>
        <button type="button"
            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            id="user-menu-button-2"
            data-dropdown-toggle="dropdown-2">

            <span class="sr-only">Open user menu</span>

            <img class="w-8 h-8 rounded-full"
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff"
                alt="{{ $user->name }}">
        </button>
    </div>

    <!-- Dropdown -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-2">

        <div class="px-4 py-3">
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ $user->name }}
            </p>

            <p class="text-sm text-gray-500 truncate dark:text-gray-300">
                {{ $user->email }}
            </p>

            <p class="text-xs mt-1 text-blue-600 dark:text-blue-400">
                {{ $user->role }}
            </p>
        </div>

        <ul class="py-1">

            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                    Pengaturan Akun
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-gray-600">
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>
          </div>
      </div>
    </div>
  </nav>
