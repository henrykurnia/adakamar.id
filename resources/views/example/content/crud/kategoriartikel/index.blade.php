@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Kategori Artikel
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola kategori artikel website.
            </p>
        </div>

        <a href="{{ route('artikel_kategori.create') }}"
           class="px-5 py-2.5 text-sm font-medium text-white
                  bg-primary-600 rounded-lg hover:bg-primary-700">
            + Tambah Kategori
        </a>

    </div>


    {{-- Alert Success --}}
    @if(session('success'))
        <div class="p-4 mb-5 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif


    {{-- Alert Error --}}
    @if(session('error'))
        <div class="p-4 mb-5 text-sm text-red-800 rounded-lg bg-red-50">
            {{ session('error') }}
        </div>
    @endif


    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="w-full text-sm text-left text-gray-500">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                <tr>

                    <th class="px-6 py-4">
                        No
                    </th>

                    <th class="px-6 py-4">
                        Nama
                    </th>

                    <th class="px-6 py-4">
                        Slug
                    </th>

                    <th class="px-6 py-4">
                        Deskripsi
                    </th>

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($kategoris as $index => $kategori)

                    <tr class="bg-white border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>


                        {{-- Nama --}}
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $kategori->name }}
                        </td>


                        {{-- Slug --}}
                        <td class="px-6 py-4">
                            {{ $kategori->slug }}
                        </td>


                        {{-- Description --}}
                        <td class="px-6 py-4 max-w-md">
                            <div class="line-clamp-2">
                                {{ $kategori->description ?? '-' }}
                            </div>
                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if($kategori->is_active)

                                <span class="px-2.5 py-1 text-xs font-medium
                                             text-green-800 bg-green-100
                                             rounded-full">
                                    Aktif
                                </span>

                            @else

                                <span class="px-2.5 py-1 text-xs font-medium
                                             text-red-800 bg-red-100
                                             rounded-full">
                                    Tidak Aktif
                                </span>

                            @endif

                        </td>


                        {{-- Aksi --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('artikel_kategori.edit', $kategori->id) }}"
                                   class="px-3 py-2 text-xs font-medium
                                          text-white bg-blue-600 rounded-lg
                                          hover:bg-blue-700">
                                    Edit
                                </a>


                                {{-- Delete --}}
                                <form action="{{ route('artikel_kategori.destroy', $kategori->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori {{ $kategori->name }}?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-2 text-xs font-medium
                                                   text-white bg-red-600 rounded-lg
                                                   hover:bg-red-700">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="px-6 py-8 text-center text-gray-500">
                            Belum ada kategori artikel.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection