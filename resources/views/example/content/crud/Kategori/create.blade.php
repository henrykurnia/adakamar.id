@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 lg:mt-1.5">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
            Tambah Kategori Akomodasi
        </h1>


    <p class="text-sm text-gray-500">
        Tambahkan kategori akomodasi baru.
    </p>
</div>

<div class="p-6 bg-white rounded-lg shadow">

    <form
        action="{{ route('kategori.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="grid grid-cols-1 gap-6">

            {{-- Nama --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Villa"
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                    required
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug') }}"
                    placeholder="Contoh: villa"
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                    required
                >

                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Masukkan deskripsi kategori..."
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Gambar
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                >

                <p class="mt-1 text-xs text-gray-500">
                    JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
                </p>

                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            

        </div>

        <div class="flex justify-end gap-3 mt-6">

            <a
                href="{{ route('kategori.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800"
            >
                Simpan
            </button>

        </div>

    </form>

</div>


</div>

@endsection
