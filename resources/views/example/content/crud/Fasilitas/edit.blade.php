@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 lg:mt-1.5">

<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
        Edit Fasilitas
    </h1>

    <p class="text-sm text-gray-500">
        Perbarui data fasilitas.
    </p>
</div>

<div class="p-6 bg-white rounded-lg shadow">

    <form
        action="{{ route('fasilitas.update', $fasilitas->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">

            {{-- Nama --}}
            <div>
                <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Nama Fasilitas
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $fasilitas->name) }}"
                    class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg"
                    required
                >

                @error('name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label
                    for="description"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg"
                >{{ old('description', $fasilitas->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label
                    for="is_active"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Status
                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg"
                >
                    <option
                        value="1"
                        {{ old('is_active', $fasilitas->is_active) == 1 ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        {{ old('is_active', $fasilitas->is_active) == 0 ? 'selected' : '' }}
                    >
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

        <div class="flex justify-end gap-3 mt-6">

            <a
                href="{{ route('fasilitas.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800"
            >
                Update
            </button>

        </div>

    </form>

</div>


</div>

@endsection
