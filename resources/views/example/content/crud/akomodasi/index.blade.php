@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header halaman --}}
    <div class="flex items-start justify-between w-full mb-6">

        {{-- Judul --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Semua Akomodasi
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola data akomodasi penginapan.
            </p>
        </div>

        {{-- Tombol Tambah --}}
        <div>
            <button
                type="button"
                onclick="window.location='{{ route('akomodasi.create') }}'"
                class="text-white bg-primary-600
                    hover:bg-primary-700
                    focus:ring-4 focus:ring-primary-300
                    font-medium rounded-lg text-sm
                    px-5 py-2.5">

                Tambah Akomodasi

            </button>
        </div>

    </div>


    {{-- Notifikasi berhasil --}}
    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800
                    bg-green-50 border border-green-200
                    rounded-lg">

            {{ session('success') }}

        </div>

    @endif


    {{-- Card tabel --}}
    <div class="bg-white border border-gray-200
                rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left text-gray-700">

                {{-- Header tabel --}}
                <thead class="text-xs text-gray-700
                              uppercase bg-gray-50
                              border-b border-gray-200">

                    <tr>

                        <th scope="col"
                            class="px-6 py-4">
                            Foto
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Nama
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Kategori
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Harga
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Kapasitas
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Kamar
                        </th>

                        <th scope="col"
                            class="px-6 py-4">
                            Status
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                {{-- Isi tabel --}}
                <tbody>

                    @forelse($akomodasi as $akomodasi)

                        <tr class="bg-white border-b
                                   border-gray-100
                                   hover:bg-gray-50">

                            {{-- FOTO --}}
                            <td class="px-6 py-4">

                                @if($akomodasi->thumbnail)

                                    <img
                                        src="{{ asset($akomodasi->thumbnail) }}"
                                        alt="{{ $akomodasi->title }}"
                                        class="w-16 h-16
                                               object-cover
                                               rounded-lg
                                               border border-gray-200"
                                    >

                                @else

                                    <div class="w-16 h-16
                                                bg-gray-100
                                                rounded-lg
                                                flex items-center
                                                justify-center
                                                text-2xl">

                                        🏠

                                    </div>

                                @endif

                            </td>


                            {{-- NAMA --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-900">
                                    {{ $akomodasi->title }}
                                </div>

                                @if($akomodasi->address)

                                    <div class="mt-1 text-xs text-gray-500">
                                        {{ $akomodasi->address }}
                                    </div>

                                @endif

                            </td>


                            {{-- KATEGORI --}}
                            <td class="px-6 py-4">

                                @if($akomodasi->category)

                                    <span class="px-3 py-1
                                                 text-xs font-medium
                                                 text-blue-700
                                                 bg-blue-50
                                                 rounded-full">

                                        {{ $akomodasi->category->name }}

                                    </span>

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- HARGA --}}
                            <td class="px-6 py-4 whitespace-nowrap">

                                <span class="font-medium text-gray-900">
                                    Rp {{ number_format($akomodasi->price, 0, ',', '.') }}
                                </span>

                                <span class="text-xs text-gray-500">
                                    / malam
                                </span>

                            </td>


                            {{-- KAPASITAS --}}
                            <td class="px-6 py-4">

                                {{ $akomodasi->capacity ?? '-' }}
                                orang

                            </td>


                            {{-- KAMAR --}}
                            <td class="px-6 py-4">

                                <div class="text-sm">
                                    {{ $akomodasi->bedroom ?? 0 }} kamar
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $akomodasi->bathroom ?? 0 }} kamar mandi
                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-6 py-4">

                                @if($akomodasi->status === 'Available')

                                    <span class="inline-flex items-center
                                                 px-3 py-1
                                                 text-xs font-medium
                                                 text-green-700
                                                 bg-green-100
                                                 rounded-full">

                                        Available

                                    </span>

                                @elseif($akomodasi->status === 'Unavailable')

                                    <span class="inline-flex items-center
                                                 px-3 py-1
                                                 text-xs font-medium
                                                 text-red-700
                                                 bg-red-100
                                                 rounded-full">

                                        Unavailable

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-3 py-1
                                                 text-xs font-medium
                                                 text-gray-700
                                                 bg-gray-100
                                                 rounded-full">

                                        {{ $akomodasi->status ?? '-' }}

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center
                                            justify-center gap-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('akomodasi.show', $akomodasi->id) }}"
                                       class="px-3 py-2
                                              text-xs font-medium
                                              text-blue-700
                                              bg-blue-50
                                              rounded-lg
                                              hover:bg-blue-100">

                                        Detail

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('akomodasi.edit', $akomodasi->id) }}"
                                       class="px-3 py-2
                                              text-xs font-medium
                                              text-yellow-700
                                              bg-yellow-50
                                              rounded-lg
                                              hover:bg-yellow-100">

                                        Edit

                                    </a>


                                    {{-- Hapus --}}
                                    <form
                                        action="{{ route('akomodasi.destroy', $akomodasi->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus akomodasi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-2
                                                       text-xs font-medium
                                                       text-red-700
                                                       bg-red-50
                                                       rounded-lg
                                                       hover:bg-red-100">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="px-6 py-12 text-center">

                                <div class="text-gray-400 text-4xl mb-3">
                                    🏠
                                </div>

                                <h3 class="text-sm font-semibold
                                           text-gray-900">
                                    Belum ada akomodasi
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Silakan tambahkan data akomodasi baru.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection