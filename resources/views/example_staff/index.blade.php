@extends('example_staff.layouts.default.dashboard')
@section('content')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <div class="p-6">

    {{-- Daftar Transaksi Pending dengan 2 Tab --}}
    <div class="bg-white rounded-xl shadow mt-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">

      <div class="p-5 border-b border-[#E8D5F5] dark:border-gray-700">
        <h2 class="font-semibold text-[#1B4EF5] dark:text-[#3874FF]">
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          Transaksi Menunggu Konfirmasi
        </h2>
      </div>

      {{-- Tab Navigation --}}
      <div class="border-b border-[#E8D5F5] dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="pendingTabs" role="tablist">
          <li class="mr-2" role="presentation">
            <button
              class="inline-block p-4 border-b-2 rounded-t-lg text-[#1B4EF5] border-[#1B4EF5] dark:text-[#3874FF] dark:border-[#3874FF] active"
              onclick="switchTab('content-masuk', this)" id="tab-masuk" type="button" role="tab"
              aria-controls="content-masuk" aria-selected="true">
              <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
              </svg>
              Barang Masuk
              <span
                class="ml-2 px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full dark:bg-green-900 dark:text-green-300">
                {{ $pendingMasukCount ?? 0 }}
              </span>
            </button>
          </li>
          <li class="mr-2" role="presentation">
            <button
              class="inline-block p-4 border-b-2 rounded-t-lg text-gray-500 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
              onclick="switchTab('content-keluar', this)" id="tab-keluar" type="button" role="tab"
              aria-controls="content-keluar" aria-selected="false">
              <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
                </path>
              </svg>
              Barang Keluar
              <span
                class="ml-2 px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full dark:bg-red-900 dark:text-red-300">
                {{ $pendingKeluarCount ?? 0 }}
              </span>
            </button>
          </li>
        </ul>
      </div>

      {{-- Tab Content --}}
      <div id="tabContents">

        <!-- Tab Barang Masuk (aktif) -->
        <div class="p-4" id="content-masuk" role="tabpanel" aria-labelledby="tab-masuk" style="display:block;">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead class="bg-[#F5F0FF] dark:bg-gray-700">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Tanggal
                  </th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Produk
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Jumlah
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse($pendingMasukList ?? [] as $transaction)
                  <tr
                    class="border-b border-[#E8D5F5] hover:bg-[#F5F0FF] transition-colors duration-200 dark:border-gray-700 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                      {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                      {{ $transaction->product->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                      {{ number_format($transaction->quantity, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm">
                      <span
                        class="px-2 py-1 text-xs font-semibold rounded-lg bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                        Pending
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-5 text-gray-500 text-sm dark:text-gray-400">
                      <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      Tidak ada transaksi masuk yang menunggu konfirmasi
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Tab Barang Keluar (hidden default) -->
        <div class="p-4" id="content-keluar" role="tabpanel" aria-labelledby="tab-keluar" style="display:none;">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead class="bg-[#F5F0FF] dark:bg-gray-700">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Tanggal
                  </th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Produk
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Jumlah
                  </th>
                  <th class="px-4 py-3 text-center text-xs font-medium text-[#1B4EF5] uppercase dark:text-[#3874FF]">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse($pendingKeluarList ?? [] as $transaction)
                  <tr
                    class="border-b border-[#E8D5F5] hover:bg-[#F5F0FF] transition-colors duration-200 dark:border-gray-700 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                      {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                      {{ $transaction->product->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                      {{ number_format($transaction->quantity, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-center text-sm">
                      <span
                        class="px-2 py-1 text-xs font-semibold rounded-lg bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                        Pending
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-5 text-gray-500 text-sm dark:text-gray-400">
                      <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      Tidak ada transaksi keluar yang menunggu konfirmasi
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script>
    // ========== TAB SWITCH FUNCTION ==========
    function switchTab(tabId, button) {
      // Sembunyikan semua konten
      document.querySelectorAll('[role="tabpanel"]').forEach(content => {
        content.style.display = 'none';
      });

      // Tampilkan konten yang dipilih
      const target = document.getElementById(tabId);
      if (target) {
        target.style.display = 'block';
      }

      // Update class tab
      document.querySelectorAll('[role="tab"]').forEach(tab => {
        tab.classList.remove('text-[#1B4EF5]', 'border-[#1B4EF5]', 'dark:text-[#3874FF]', 'dark:border-[#3874FF]');
        tab.classList.add('text-gray-500', 'border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
        tab.setAttribute('aria-selected', 'false');
      });

      // Aktifkan tab yang dipilih
      if (button) {
        button.classList.remove('text-gray-500', 'border-transparent', 'hover:text-gray-600', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
        button.classList.add('text-[#1B4EF5]', 'border-[#1B4EF5]', 'dark:text-[#3874FF]', 'dark:border-[#3874FF]');
        button.setAttribute('aria-selected', 'true');
      }
    }

    // ========== CEK DATA DI CONSOLE ==========
    document.addEventListener("DOMContentLoaded", function () {
      console.log('Pending Masuk:', @json($pendingMasukList ?? []));
      console.log('Pending Keluar:', @json($pendingKeluarList ?? []));
      console.log('Pending Masuk Count:', {{ $pendingMasukCount ?? 0 }});
      console.log('Pending Keluar Count:', {{ $pendingKeluarCount ?? 0 }});
    });

    // ========== RELOAD PAGE WHEN BACK FROM CACHE ==========
    window.addEventListener("pageshow", function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    });
  </script>
@endsection