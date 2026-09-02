@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Kategori Artikel
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Ubah informasi kategori artikel.
        </p>

    </div>


    {{-- Form --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

        <form action="{{ route('artikel_kategori.update', $artikel_kategori->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">


                {{-- Nama --}}
                <div>

                    <label for="name"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $artikel_kategori->name) }}"
                        placeholder="Contoh: Tips Liburan"
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500
                               focus:border-primary-500
                               block w-full p-2.5">

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Slug --}}
                <div>

                    <label for="slug"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Slug
                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug', $artikel_kategori->slug) }}"
                        placeholder="tips-liburan"
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500
                               focus:border-primary-500
                               block w-full p-2.5">

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan huruf kecil dan tanda strip (-).
                    </p>

                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label for="description"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Masukkan deskripsi kategori..."
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500
                               focus:border-primary-500
                               block w-full p-2.5">{{ old('description', $artikel_kategori->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label for="is_active"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Status
                    </label>

                    <select
                        id="is_active"
                        name="is_active"
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500
                               focus:border-primary-500
                               block w-full p-2.5">

                        <option value="1"
                            {{ old('is_active', $artikel_kategori->is_active) == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0"
                            {{ old('is_active', $artikel_kategori->is_active) == '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>

                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3
                        px-6 py-4 bg-gray-50
                        border-t border-gray-200">

                <a href="{{ route('artikel_kategori.index') }}"
                   class="px-5 py-2.5 text-sm font-medium
                          text-gray-700 bg-white border
                          border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium
                           text-white bg-primary-600 rounded-lg
                           hover:bg-primary-700">
                    Update Kategori
                </button>

            </div>

        </form>

    </div>

</div>

@endsection