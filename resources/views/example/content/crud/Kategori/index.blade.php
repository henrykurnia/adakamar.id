@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
                Kategori Akomodasi
            </h1>
            <p class="text-sm text-gray-500">
                Kelola kategori akomodasi yang tersedia.
            </p>
        </div>


    <div class="sm:flex sm:justify-end">
        <a href="{{ route('kategori.create') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800">
            + Tambah Kategori
        </a>
    </div>
</div>


</div>

<div class="p-4">
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif


@if($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Gambar</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Slug</th>
                <th class="px-6 py-3">Deskripsi</th>
               
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kategoris as $kategori)
                <tr class="bg-white border-b hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4">
                        @if($kategori->image)
                            <img
                                src="{{ asset($kategori->image) }}"
                                alt="{{ $kategori->name }}"
                                class="w-16 h-16 object-cover rounded-lg"
                            >
                        @else
                            <div class="w-16 h-16 flex items-center justify-center bg-gray-100 rounded-lg">
                                <span class="text-xs text-gray-400">
                                    No Image
                                </span>
                            </div>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $kategori->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $kategori->slug }}
                    </td>

                    <td class="px-6 py-4 max-w-xs">
                        <p class="truncate">
                            {{ $kategori->description ?? '-' }}
                        </p>
                    </td>

                    

                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                               class="px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 rounded-lg hover:bg-yellow-100">
                                Edit
                            </a>

                            <form
                                action="{{ route('kategori.destroy', $kategori->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        Belum ada kategori akomodasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
