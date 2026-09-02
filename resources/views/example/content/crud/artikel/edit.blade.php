@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Artikel
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Edit artikel.
        </p>

    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

        <form action="{{ route('artikel.update', $artikel->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-8">

                {{-- INFORMASI ARTIKEL --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Informasi Artikel
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Judul --}}
                        <div class="md:col-span-2">

                            <label for="title"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Judul Artikel
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $artikel->title) }}"
                                placeholder="Masukkan judul artikel"
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
                                value="{{ old('slug', $artikel->slug) }}"
                                placeholder="judul-artikel"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
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

                            <select name="category_id"
                                    class="bg-gray-50 border border-gray-300
                                        text-gray-900 text-sm rounded-lg
                                        block w-full p-2.5">

                                @foreach($kategoris as $kategori)

                                    <option
                                        value="{{ $kategori->id }}"
                                        {{ old('category_id', $artikel->category_id) == $kategori->id
                                            ? 'selected'
                                            : '' }}>

                                        {{ $kategori->name }}

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
                        <div class="md:col-span-2">

                            <label
                                for="thumbnail"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Thumbnail
                            </label>

                            {{-- Preview Thumbnail --}}
                            <div class="mb-3">
                                <p class="text-sm text-gray-500 mb-2">
                                    Thumbnail:
                                </p>

                                <img
                                    id="thumbnail-preview"
                                    src="{{ $artikel->thumbnail ? asset($artikel->thumbnail) : '' }}"
                                    alt="{{ $artikel->title }}"
                                    class="{{ $artikel->thumbnail ? '' : 'hidden' }} w-40 h-28 object-cover rounded-lg border"
                                >
                            </div>

                            {{-- Upload Thumbnail Baru --}}
                            <input
                                type="file"
                                id="thumbnail"
                                name="thumbnail"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="block w-full text-sm text-gray-900
                                    border border-gray-300 rounded-lg
                                    cursor-pointer bg-gray-50">

                            <p class="mt-1 text-xs text-gray-500">
                                JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
                            </p>

                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>
                        </div>

                    </div>

                </div>


                {{-- EXCERPT --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Ringkasan
                    </h2>

                    <label for="excerpt"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Excerpt
                    </label>

                    <textarea
                        id="excerpt"
                        name="excerpt"
                        rows="4"
                        placeholder="Ringkasan singkat artikel..."
                        class="bg-gray-50 border border-gray-300
                               text-gray-900 text-sm rounded-lg
                               block w-full p-2.5">{{ old('excerpt', $artikel->excerpt) }}</textarea>

                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- CONTENT --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Isi Artikel
                    </h2>

                    <label for="content"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Konten
                    </label>

                    <textarea
                    name="content"
                    rows="12"
                    class="bg-gray-50 border border-gray-300
                        text-gray-900 text-sm rounded-lg
                        block w-full p-2.5">{{ old('content', $artikel->content) }}</textarea>

                    @error('content')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Publikasi
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label for="status"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Status
                             </label>

                            <select name="status"
                                    class="bg-gray-50 border border-gray-300
                                        text-gray-900 text-sm rounded-lg
                                        block w-full p-2.5">

                                <option value="Draft"
                                    {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>

                                <option value="Published"
                                    {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>
                                    Published
                                </option>
 
                            </select>

                        </div>


                        <div>

                            <label for="published_at"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Tanggal Publikasi
                            </label>

                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                value="{{ old('publised_at', $artikel->published_at) }}"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       block w-full p-2.5">

                        </div>

                    </div>

                </div>


                {{-- SEO --}}
                <div>

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        SEO
                    </h2>

                    <div class="space-y-6">

                        <div>

                            <label for="meta_title"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Meta Title
                            </label>

                            <input
                                type="text"
                                id="meta_title"
                                name="meta_title"
                                 value="{{ old('meta_title', $artikel->meta_title) }}"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       block w-full p-2.5">

                        </div>


                        <div>

                            <label for="meta_description"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Meta Description
                            </label>

                            <input
                                id="meta_description"
                                name="meta_description"
                                value="{{ old('meta_description', $artikel->meta_description) }}"
                                rows="4"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       block w-full p-2.5">

                        </div>


                        <div>

                            <label for="meta_keywords"
                                   class="block mb-2 text-sm font-medium text-gray-900">
                                Meta Keywords
                            </label>

                            <input
                                type="text"
                                id="meta_keywords"
                                name="meta_keywords"
                                value="{{ old('meta_keywords', $artikel->meta_keywords) }}"
                                placeholder="villa, wisata, penginapan"
                                class="bg-gray-50 border border-gray-300
                                       text-gray-900 text-sm rounded-lg
                                       block w-full p-2.5">

                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex items-center justify-end gap-3
                        px-6 py-4 bg-gray-50
                        border-t border-gray-200">

                <a href="{{ route('artikel.index') }}"
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
                    Simpan Artikel
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    document.getElementById('thumbnail').addEventListener('change', function(event) {

        const file = event.target.files[0];
        const preview = document.getElementById('thumbnail-preview');

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };

            reader.readAsDataURL(file);

        }
    });
</script>

@endsection