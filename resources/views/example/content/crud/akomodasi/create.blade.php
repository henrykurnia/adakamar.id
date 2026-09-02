@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Tambah Akomodasi
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Tambahkan data akomodasi baru.
        </p>

    </div>


    {{-- Form --}}
    <div class="bg-white border border-gray-200
                rounded-xl shadow-sm">

        <form action="{{ route('akomodasi.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="p-6 space-y-8">

                {{-- ================= INFORMASI UTAMA ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Informasi Akomodasi
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Nama --}}
                        <div>
                            <label for="title"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Nama Akomodasi
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Villa Melati"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                            @error('title')
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
                                value="{{ old('slug') }}"
                                placeholder="villa-melati"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Kategori --}}
                        <div>
                            <label for="category_id"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Kategori
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                                <option value="">
                                    Pilih Kategori
                                </option>

                                @foreach($kategoris as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Thumbnail --}}
                        <div>
                            <label for="thumbnail"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Thumbnail
                            </label>

                            <input
                                type="file"
                                id="thumbnail"
                                name="thumbnail"
                                accept="image/*"
                                class="block w-full text-sm text-gray-900
                                       border border-gray-300 rounded-lg
                                       cursor-pointer bg-gray-50">

                            <p class="mt-1 text-xs text-gray-500">
                                JPG, JPEG, PNG atau WEBP.
                            </p>

                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ================= HARGA ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Harga
                    </h2>

                    <div class="max-w-md">

                        <label for="price"
                               class="block mb-2 text-sm font-medium text-gray-900">
                            Harga per Malam
                        </label>

                        <div class="flex">

                            <span class="inline-flex items-center px-3
                                         text-sm text-gray-900
                                         bg-gray-200 border border-r-0
                                         border-gray-300 rounded-l-lg">
                                Rp
                            </span>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                oninput="this.value=this.value.replace(0-9)"
                                value="{{ old('price') }}"
                                min="0"
                                class="rounded-none rounded-r-lg
                                       bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                        </div>

                        @error('price')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- ================= DETAIL PENGINAPAN ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Detail Penginapan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Alamat --}}
                        <div class="md:col-span-2">

                            <label for="address"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Alamat
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Masukkan alamat lengkap akomodasi"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">{{ old('address') }}</textarea>

                            @error('address')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Link Google Maps --}}
                            <div class="md:col-span-2">

                                <label
                                    for="link_gmaps"
                                    class="block mb-2 text-sm font-medium text-gray-900">

                                    Link Google Maps

                                </label>

                                <input
                                    type="url"
                                    name="link_gmaps"
                                    id="link_gmaps"
                                    value="{{ old('link_gmaps') }}"
                                    placeholder="https://maps.google.com/..."
                                    class="bg-gray-50 border border-gray-300
                                        text-gray-900 text-sm rounded-lg
                                        block w-full p-2.5">

                                <p class="mt-1 text-xs text-gray-500">
                                    Masukkan link lokasi Google Maps akomodasi.
                                </p>

                                @error('link_gmaps')
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        

                        {{-- Kapasitas --}}
                        <div>

                            <label for="capacity"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Kapasitas
                            </label>

                            <input
                                type="number"
                                id="capacity"
                                name="capacity"
                                value="{{ old('capacity') }}"
                                min="1"
                                placeholder="4"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                        </div>


                        {{-- Bedroom --}}
                        <div>

                            <label for="bedroom"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Jumlah Kamar Tidur
                            </label>

                            <input
                                type="number"
                                id="bedroom"
                                name="bedroom"
                                value="{{ old('bedroom') }}"
                                min="0"
                                placeholder="2"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                        </div>


                        {{-- Bathroom --}}
                        <div>

                            <label for="bathroom"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Jumlah Kamar Mandi
                            </label>

                            <input
                                type="number"
                                id="bathroom"
                                name="bathroom"
                                value="{{ old('bathroom') }}"
                                min="0"
                                placeholder="1"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                        </div>


                        {{-- Size --}}
                        <div>

                            <label for="size"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Luas
                            </label>

                            <input
                                type="number"
                                id="size"
                                name="size"
                                value="{{ old('size') }}"
                                min="0"
                                placeholder="100"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                            <p class="mt-1 text-xs text-gray-500">
                                Satuan m²
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <label for="status"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                                <option value="">
                                    Pilih Status
                                </option>

                                <option value="Available"
                                    {{ old('status') == 'Available' ? 'selected' : '' }}>
                                    Available
                                </option>

                                <option value="Full"
                                    {{ old('status') == 'Full' ? 'selected' : '' }}>
                                    Full
                                </option>

                                <option value="Maintenance"
                                    {{ old('status') == 'Maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                {{-- ================= DESKRIPSI ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Deskripsi
                    </h2>

                    <label for="description"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Deskripsi Akomodasi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        placeholder="Jelaskan mengenai akomodasi..."
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500
                               focus:border-primary-500
                               block w-full p-2.5">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class=" grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">
                        Aturan
                    </label>

                    <div class="space-y-3">
                        @foreach($rules as $rule)
                            <label class="flex items-center gap-3">
                                <input
                                    type="checkbox"
                                    name="rules[]"
                                    value="{{ $rule->id }}"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded"
                                >

                                <span class="text-sm text-gray-700">
                                    {{ $rule->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    </div>
                    {{-- FASILITAS --}}
                    <div>
                        <label class="block mb-4 text-sm font-semibold text-gray-900">
                            Fasilitas
                        </label>
                        <div class="space-y-3">
                        @foreach($fasilitas as $facility)
                            <label class="flex items-center gap-3">

                                <input
                                    type="checkbox"
                                    name="facilities[]"
                                    value="{{ $facility->id }}"
                                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded 0"
                                >

                                <span class="text-sm text-gray-700">
                                    {{ $facility->name }}
                                </span>

                            </label>
                        @endforeach
                        </div>
                    </div>


                </div>


                {{-- ================= SEO ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        SEO
                    </h2>

                    <div class="space-y-6">

                        {{-- Meta Title --}}
                        <div>

                            <label for="meta_title"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Meta Title
                            </label>

                            <input
                                type="text"
                                id="meta_title"
                                name="meta_title"
                                value="{{ old('meta_title') }}"
                                placeholder="Judul untuk SEO"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">

                        </div>


                        {{-- Meta Description --}}
                        <div>

                            <label for="meta_description"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Meta Description
                            </label>

                            <textarea
                                id="meta_description"
                                name="meta_description"
                                rows="4"
                                placeholder="Deskripsi untuk SEO"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       focus:ring-primary-500
                                       focus:border-primary-500
                                       block w-full p-2.5">{{ old('meta_description') }}</textarea>

                        </div>

                    </div>

                </div>

                {{-- ================= GALERI FOTO ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Galeri Foto
                    </h2>

                    <div>
                        <label for="gallery"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Foto Galeri
                        </label>

                        <input
                            type="file"
                            id="gallery"
                            name="gallery[]"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            multiple
                            class="block w-full text-sm text-gray-900
                                border border-gray-300 rounded-lg
                                cursor-pointer bg-gray-50">

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih minimal 2 dan maksimal 10 foto.
                            Format: JPG, JPEG, PNG, WEBP.
                        </p>

                        @error('gallery')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        @error('gallery.*')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <div id="gallery-preview"
                            class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
                        </div>
                    </div>

                </div>

            </div>


            {{-- Footer Form --}}
            <div class="flex items-center justify-end gap-3
                        px-6 py-4 bg-gray-50
                        border-t border-gray-200">

                <a href="{{ route('akomodasi.index') }}"
                   class="px-5 py-2.5 text-sm font-medium
                          text-gray-700 bg-white
                          border border-gray-300
                          rounded-lg hover:bg-gray-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium
                           text-white bg-primary-600
                           rounded-lg hover:bg-primary-700
                           focus:ring-4 focus:ring-primary-300">

                    Simpan Akomodasi

                </button>

            </div>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const galleryInput = document.getElementById('gallery');
    const galleryPreview = document.getElementById('gallery-preview');

    if (!galleryInput || !galleryPreview) {
        console.log('Element gallery tidak ditemukan');
        return;
    }

    galleryInput.addEventListener('change', function () {

        galleryPreview.innerHTML = '';

        const files = Array.from(this.files);

        console.log('Jumlah file:', files.length);

        if (files.length < 2) {
            alert('Minimal pilih 2 foto.');
            this.value = '';
            return;
        }

        if (files.length > 10) {
            alert('Maksimal pilih 10 foto.');
            this.value = '';
            return;
        }

        files.forEach(function (file) {

            const reader = new FileReader();

            reader.onload = function (event) {

                const div = document.createElement('div');

                div.className =
                    'w-full h-32 rounded-lg overflow-hidden border border-gray-300';

                const img = document.createElement('img');

                img.src = event.target.result;
                img.alt = 'Preview Galeri';
                img.className = 'w-full h-full object-cover';

                div.appendChild(img);
                galleryPreview.appendChild(div);
            };

            reader.readAsDataURL(file);

        });

    });

});
</script>

@endsection