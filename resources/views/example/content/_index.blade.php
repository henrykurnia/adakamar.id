@extends('example.layouts.default.dashboard')

@section('content')

<div class="w-full">

    {{-- ================= HEADER DASHBOARD ================= --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
        </h1>

        <p class="mt-2 text-gray-500">
            Selamat datang kembali, Admin!
        </p>

    </div>


    {{-- ================= STATISTIK ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

        {{-- Statistik Kategori --}}
        @foreach($kategori as $item)

            <div class="bg-white border border-gray-200 rounded-lg p-6">

                <p class="text-sm text-gray-500">
                    {{ $item->name }} Aktif
                </p>

                <div class="flex items-center justify-between mt-3">

                    <h2 class="text-3xl font-bold text-gray-900">
                        {{ $akomodasis->filter(function ($akomodasi) use ($item) {
                            return $akomodasi->category_id == $item->id
                                && $akomodasi->status === 'Available';
                        })->count() }}
                    </h2>

                    <div class="w-12 h-12 flex items-center justify-center
                                bg-blue-100 rounded-lg text-2xl">
                        🏠
                    </div>

                </div>

            </div>

        @endforeach


        


        {{-- Artikel Terbit --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <p class="text-sm text-gray-500">
                Artikel Terbit
            </p>

            <div class="flex items-center justify-between mt-3">

                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $artikelTerbit }}
                </h2>

                <div class="w-12 h-12 flex items-center justify-center
                            bg-purple-100 rounded-lg text-2xl">
                    📝
                </div>

            </div>

        </div>

    </div>


    {{-- ================= JUMLAH AKOMODASI + ARTIKEL ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">


        {{-- Jumlah Akomodasi --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-semibold text-gray-900">
                    Jumlah Akomodasi
                </h2>

            </div>


            <div class="grid grid-cols-2 gap-4">

                @forelse($kategori as $item)

                    <div class="bg-gray-50 rounded-lg p-5">

                        <p class="text-sm text-gray-500">
                            {{ $item->name }}
                        </p>

                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ $akomodasis->where('category_id', $item->id)->count() }}
                        </p>

                    </div>

                @empty

                    <div class="col-span-2">

                        <p class="text-gray-500">
                            Belum ada kategori.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Artikel Terbaru --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-semibold text-gray-900">
                    Artikel Terbaru
                </h2>

                <a href="#"
                   class="text-sm text-blue-600 hover:underline">
                    Lihat Semua
                </a>

            </div>


            @forelse($artikel as $artikels)

                <div class="flex items-center gap-4 py-3 border-b last:border-0">

                    <div>

                        <p class="font-medium text-gray-900">
                            {{ $artikels->title }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $artikels->published_at ?? '-' }}
                        </p>

                    </div>

                </div>

            @empty

                <p class="text-gray-500">
                    Belum ada artikel.
                </p>

            @endforelse

        </div>

    </div>


    {{-- ================= AKOMODASI TERBARU ================= --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-xl font-semibold text-gray-900">
                Akomodasi Terbaru
            </h2>

            <a href="#"
               class="text-sm text-blue-600 hover:underline">
                Lihat Semua
            </a>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                    <tr>

                        <th class="px-6 py-4">
                            Foto
                        </th>

                        <th class="px-6 py-4">
                            Nama
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Harga
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($akomodasiTerbaru as $akomodasi)

                        <tr class="border-b">

                            {{-- Foto --}}
                            <td class="px-6 py-4">

                                @if($akomodasi->thumbnail)

                                    <img
                                        src="{{ asset($akomodasi->thumbnail) }}"
                                        alt="Gambar {{ $akomodasi->title }}"
                                        class="w-14 h-14 object-cover rounded-lg"
                                    >

                                @else

                                    <div class="w-14 h-14 bg-gray-100 rounded-lg
                                                flex items-center justify-center">
                                        🏠
                                    </div>

                                @endif

                            </td>


                            {{-- Nama --}}
                            <td class="px-6 py-4 font-medium text-gray-900">

                                {{ $akomodasi->title }}

                            </td>


                            {{-- Kategori --}}
                            <td class="px-6 py-4">

                                {{ $akomodasi->category->name ?? '-' }}

                            </td>


                            {{-- Harga --}}
                            <td class="px-6 py-4">

                                Rp {{ number_format($akomodasi->price, 0, ',', '.') }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                <span class="px-3 py-1 text-xs font-medium
                                             rounded-full
                                             bg-green-100 text-green-800">

                                    {{ $akomodasi->status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-12 text-center text-gray-500">

                                Belum ada data akomodasi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


   
</div>

@endsection