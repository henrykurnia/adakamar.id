@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-gray-900">
            Tambah Gallery
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Tambahkan foto yang akan ditampilkan pada landing page.
        </p>

    </div>


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-lg">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('galeries.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- CARD --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Informasi Gallery
            </h2>


            <div class="space-y-5">


                {{-- TITLE --}}
                <div>

                    <label
                        for="title"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Judul Gallery
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Tampak Depan Villa"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                    @error('title')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- IMAGE --}}
                <div>

                    <label
                        for="image"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Foto Gallery
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>

                    @error('image')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SORT ORDER --}}
                <div>

                    <label
                        for="sort_order"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Urutan Tampilan
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        placeholder="0"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Semakin kecil angka, semakin awal foto ditampilkan.
                    </p>

                    @error('sort_order')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div>

                    <label
                        for="is_active"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Status
                    </label>

                    <select
                        name="is_active"
                        id="is_active"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                        <option value="1"
                            {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
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

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="flex gap-3">

            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
            >
                Simpan
            </button>

            <a
                href="{{ route('galeries.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection