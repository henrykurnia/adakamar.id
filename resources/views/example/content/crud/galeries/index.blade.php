@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">


{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-2xl font-semibold text-gray-900">
            Gallery
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Kelola foto gallery yang ditampilkan pada landing page.
        </p>
    </div>

    <a
        href="{{ route('galeries.create') }}"
        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
    >
        + Tambah Gallery
    </a>

</div>


{{-- SUCCESS MESSAGE --}}
@if(session('success'))

    <div class="p-4 mb-6 text-sm text-green-800 bg-green-50 rounded-lg">
        {{ session('success') }}
    </div>

@endif


{{-- ERROR MESSAGE --}}
@if(session('error'))

    <div class="p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-lg">
        {{ session('error') }}
    </div>

@endif


{{-- TABLE --}}
<div class="relative overflow-x-auto bg-white rounded-lg shadow-sm">

    <table class="w-full text-sm text-left text-gray-500">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50">

            <tr>

                <th class="px-6 py-3">
                    No
                </th>

                <th class="px-6 py-3">
                    Foto
                </th>

                <th class="px-6 py-3">
                    Judul
                </th>

                <th class="px-6 py-3">
                    Urutan
                </th>

                <th class="px-6 py-3">
                    Status
                </th>

                <th class="px-6 py-3">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($galeries as $gallery)

                <tr class="bg-white border-b hover:bg-gray-50">

                    {{-- NO --}}
                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>


                    {{-- IMAGE --}}
                    <td class="px-6 py-4">

                        @if($gallery->image)
                            <img
                                src="{{ asset($gallery->image) }}"
                                alt="{{ $gallery->title }}"
                                class="object-cover w-24 h-16 rounded-lg"
                            >
                        @else
                            <div class="flex items-center justify-center w-24 h-16 bg-gray-100 rounded-lg">
                                <span class="text-xs text-gray-400">
                                    Tidak ada foto
                                </span>
                            </div>
                        @endif

                    </td>


                    {{-- TITLE --}}
                    <td class="px-6 py-4 font-medium text-gray-900">

                        {{ $gallery->title ?? '-' }}

                    </td>


                    {{-- SORT ORDER --}}
                    <td class="px-6 py-4">

                        {{ $gallery->sort_order ?? 0 }}

                    </td>


                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        @if($gallery->is_active == 1)
                            <span class="px-2.5 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                Aktif
                            </span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                Tidak Aktif
                            </span>
                        @endif
                    </td>


                    {{-- ACTION --}}
                    <td class="px-6 py-4">

                        <div class="flex gap-2">

                            {{-- EDIT --}}
                            <a
                                href="{{ route('galeries.edit', $gallery->id) }}"
                                class="px-3 py-2 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200"
                            >
                                Edit
                            </a>


                            {{-- DELETE --}}
                            <form
                                action="{{ route('galeries.destroy', $gallery->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus gallery ini?');"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-red-700 bg-red-100 rounded-lg hover:bg-red-200"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="px-6 py-10 text-center text-gray-500"
                    >
                        Belum ada data gallery.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


</div>

@endsection
