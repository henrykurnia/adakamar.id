@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">
            Tambah Banner
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan banner baru.
        </p>
    </div>

    {{-- Validation Error --}}
    @if($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6">

        <form action="{{ route('banner.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            {{-- Title --}}
            <div class="mb-5">

                <label for="title"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Judul Banner
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    placeholder="Masukkan judul banner"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                >

                @error('title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Subtitle --}}
            <div class="mb-5">

                <label for="subtitle"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Subtitle
                </label>

                <textarea
                    name="subtitle"
                    id="subtitle"
                    rows="3"
                    placeholder="Masukkan subtitle banner"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                >{{ old('subtitle') }}</textarea>

                @error('subtitle')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Image --}}
            <div class="mb-5">

                <label for="image"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Gambar Banner
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                </p>

                @error('image')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Button --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                {{-- Button Text --}}
                <div>

                    <label for="button_text"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Teks Tombol
                    </label>

                    <input
                        type="text"
                        name="button_text"
                        id="button_text"
                        value="{{ old('button_text') }}"
                        placeholder="Contoh: Selengkapnya"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                    >

                    @error('button_text')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Button Link --}}
                <div>

                    <label for="button_link"
                           class="block mb-2 text-sm font-medium text-gray-900">
                        Link Tombol
                    </label>

                    <input
                        type="text"
                        name="button_link"
                        id="button_link"
                        value="{{ old('button_link') }}"
                        placeholder="Contoh: /akomodasi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                    >

                    @error('button_link')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Sort Order --}}
            <div class="mb-5">

                <label for="sort_order"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Urutan Banner
                </label>

                <input
                    type="number"
                    name="sort_order"
                    id="sort_order"
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                >

                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Status --}}
            <div class="mb-6">

                <label for="is_active"
                       class="block mb-2 text-sm font-medium text-gray-900">
                    Status
                </label>

                <select
                    name="is_active"
                    id="is_active"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                >

                    <option value="1"
                        {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ old('is_active') === '0' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

                </select>

                @error('is_active')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Button --}}
            <div class="flex items-center gap-3">

                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('banner.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection