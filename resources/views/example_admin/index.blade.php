@extends('example_admin.layouts.default.dashboard')
@section('content')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Filter Tanggal -->
      <!-- <div class="p-4 bg-white border-b border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
          <form method="GET" action="{{ route('dashboard.admin') }}" class="flex items-center gap-3">
              <input type="date" 
                     name="date" 
                     value="{{ request('date') }}"
                     class="bg-[#F5F0FF] border border-[#E8D5F5] text-gray-900 text-sm rounded-lg focus:ring-[#1B4EF5] focus:border-[#1B4EF5] block px-3 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#3874FF] dark:focus:border-[#3874FF]">

              <button type="submit"
                  class="text-white bg-[#1B4EF5] hover:bg-[#3874FF] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-4 py-2 dark:bg-[#3874FF] dark:hover:bg-[#1B4EF5] dark:focus:ring-[#5996FF]">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                      </path>
                  </svg>
                  Filter
              </button>

              @if(request('date'))
                <a href="{{ route('dashboard.admin') }}"
                    class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#1B4EF5] focus:ring-4 focus:ring-[#D4E0FF] font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reset
                </a>
              @endif
          </form>
      </div> -->

      <div class="p-6">

          {{-- Card Statistik --}}
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

              <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <div class="flex items-center">
                      <div class="p-3 bg-[#F5F0FF] rounded-xl dark:bg-gray-700">
                          <svg class="w-6 h-6 text-[#1B4EF5] dark:text-[#3874FF]" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Produk</p>
                          <p class="text-2xl font-bold text-gray-900 dark:text-white">
                              {{ number_format($totalProducts, 0, ',', '.') }}
                          </p>
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <div class="flex items-center">
                      <div class="p-3 bg-green-50 rounded-xl dark:bg-green-900/20">
                          <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                              Barang Masuk
                              @if(request('date'))
                                <span class="text-xs text-gray-400">({{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }})</span>
                              @endif
                          </p>
                          <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                              {{ number_format($totalStockIn, 0, ',', '.') }}
                          </p>
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <div class="flex items-center">
                      <div class="p-3 bg-red-50 rounded-xl dark:bg-red-900/20">
                          <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                              Barang Keluar
                              @if(request('date'))
                                <span class="text-xs text-gray-400">({{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }})</span>
                              @endif
                          </p>
                          <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                              {{ number_format($totalStockOut, 0, ',', '.') }}
                          </p>
                      </div>
                  </div>
              </div>

              <div class="bg-white rounded-xl shadow p-5 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <div class="flex items-center">
                      <div class="p-3 bg-blue-50 rounded-xl dark:bg-blue-900/20">
                          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                          </svg>
                      </div>
                      <div class="ml-4">
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Stok</p>
                          <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                              {{ number_format($totalStockIn - $totalStockOut, 0, ',', '.') }}
                          </p>
                      </div>
                  </div>
              </div>

          </div>

          {{-- Grafik Stok --}}
          <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
              <div class="xl:col-span-2 bg-white rounded-xl shadow p-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <h2 class="text-lg font-semibold mb-5 text-[#1B4EF5] dark:text-[#3874FF]">
                      Grafik Stok Barang
                  </h2>
                  <div id="stock-chart"></div>
              </div>

              {{-- Aktivitas Terbaru --}}
              <div class="bg-white rounded-xl shadow p-6 border border-[#E8D5F5] dark:bg-gray-800 dark:border-gray-700">
                  <h2 class="text-lg font-semibold mb-5 text-[#1B4EF5] dark:text-[#3874FF]">
                      <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      Aktivitas Terbaru
                  </h2>
                  <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                      @forelse($latestActivities as $activity)
                        <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-[#F5F0FF] dark:hover:bg-gray-700 transition-colors duration-200 border border-[#E8D5F5] dark:border-gray-700">
                            <div class="flex-shrink-0">
                                @if($activity->type == 'Masuk')
                                  <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center dark:bg-green-900/30">
                                      <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                      </svg>
                                  </div>
                                @else
                                  <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center dark:bg-red-900/30">
                                      <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                      </svg>
                                  </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $activity->product->name ?? 'Produk tidak ditemukan' }}
                                </p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs px-2 py-0.5 rounded-full {{ $activity->type == 'Masuk' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ ucfirst($activity->type) }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ number_format($activity->quantity, 0, ',', '.') }} unit
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                    {{ $activity->user->name ?? 'User tidak ditemukan' }}
                                    <span class="mx-1">•</span>
                                    {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs px-2 py-0.5 rounded-full {{ $activity->status == 'Diterima' || $activity->status == 'Dikeluarkan' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : ($activity->status == 'Pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300') }}">
                                    {{ ucfirst($activity->status) }}
                                </span>
                            </div>
                        </div>
                      @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas</p>
                        </div>
                      @endforelse
                  </div>
              </div>
          </div>

      </div>

      <script>
          document.addEventListener("DOMContentLoaded", function () {
              // Data untuk grafik dari controller
              const stockChartData = @json($stockChart);

              // Siapkan data untuk chart
              const categories = stockChartData.map(item => item.name);
              const data = stockChartData.map(item => item.stock);

              var options = {
                  chart: {
                      type: 'bar',
                      height: 350,
                      background: 'transparent',
                      toolbar: {
                          show: true
                      }
                  },
                  theme: {
                      mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                  },
                  series: [
                      {
                          name: 'Jumlah Stok',
                          data: data
                      }
                  ],
                  xaxis: {
                      categories: categories,
                      labels: {
                          style: {
                              colors: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
                              fontSize: '11px'
                          },
                          trim: true,
                          maxHeight: 100
                      }
                  },
                  yaxis: {
                      labels: {
                          style: {
                              colors: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                          }
                      }
                  },
                  grid: {
                      borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB'
                  },
                  colors: [
                      '#1B4EF5'
                  ],
                  plotOptions: {
                      bar: {
                          borderRadius: 4,
                          columnWidth: '50%',
                          distributed: false
                      }
                  },
                  dataLabels: {
                      enabled: false
                  },
                  tooltip: {
                      y: {
                          formatter: function (val) {
                              return new Intl.NumberFormat('id-ID').format(val) + ' unit';
                          }
                      }
                  }
              };

              let chart = new ApexCharts(
                  document.querySelector("#stock-chart"),
                  options
              );
              chart.render();
          });

          // ========== RELOAD PAGE WHEN BACK FROM CACHE ==========
          window.addEventListener("pageshow", function (event) {
              if (event.persisted) {
                  window.location.reload();
              }
          });
      </script>

@endsection