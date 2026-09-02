@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Banner
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola banner yang ditampilkan pada website.
            </p>
        </div>

        <a href="{{ route('banner.create') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
            + Tambah Banner
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="relative overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">
                        No
                    </th>

                    <th class="px-6 py-3">
                        Banner
                    </th>

                    <th class="px-6 py-3">
                        Judul
                    </th>

                    <th class="px-6 py-3">
                        Subtitle
                    </th>

                    <th class="px-6 py-3">
                        Button
                    </th>

                    <th class="px-6 py-3">
                        Urutan
                    </th>

                    <th class="px-6 py-3">
                        Status
                    </th>

                    <th class="px-6 py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse($banners as $banner)

                    <tr class="bg-white border-b hover:bg-gray-50">

                        {{-- No --}}
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Image --}}
                        <td class="px-6 py-4">

                           @if($banner->image)
                                <img
                                    src="{{ asset($banner->image) }}"
                                    alt="{{ $banner->title }}"
                                    class="w-32 h-20 object-cover rounded-lg border border-gray-200"
                                >
                           @else
                                <div class="w-32 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">
                                        Tidak ada gambar
                                    </span>
                                </div>
                           @endif

                        </td>

                        {{-- Title --}}
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $banner->title }}
                        </td>

                        {{-- Subtitle --}}
                        <td class="px-6 py-4 max-w-xs">
                            <div class="truncate">
                                {{ $banner->subtitle ?? '-' }}
                            </div>
                        </td>

                        {{-- Button --}}
                        <td class="px-6 py-4">
                            @if($banner->button_text)

                                <div class="font-medium text-gray-900">
                                    {{ $banner->button_text }}
                                </div>

                                @if($banner->button_link)
                                    <div class="text-xs text-gray-500 truncate max-w-[180px]">
                                        {{ $banner->button_link }}
                                    </div>
                                @endif

                            @else
                                -
                            @endif
                        </td>

                        {{-- Sort Order --}}
                        <td class="px-6 py-4">
                            {{ $banner->sort_order }}
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if($banner->is_active)

                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                    Aktif
                                </span>

                            @else

                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                    Tidak Aktif
                                </span>

                            @endif

                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('banner.edit', $banner->id) }}"
                                   class="px-3 py-2 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('banner.destroy', $banner->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus banner ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-2 text-xs font-medium text-red-700 bg-red-100 rounded-lg hover:bg-red-200">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                            Belum ada data banner.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>

</div>

@endsection