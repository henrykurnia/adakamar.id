@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

```
{{-- HEADER --}}
<div class="mb-6">

    <h1 class="text-2xl font-semibold text-gray-900">
        Edit Gallery
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Perbarui foto dan informasi gallery.
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
    action="{{ route('galeries.update', $galeries->id) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    @method('PUT')


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
                    value="{{ old('title', $galeries->title) }}"
                    placeholder="Contoh: Tampak Depan Villa"
                    class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                >

                @error('title')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- CURRENT IMAGE --}}
            <div>

                <label
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Foto Gallery
                </label>


                {{-- IMAGE PREVIEW --}}
                <div class="mb-3">

                    @if($galeries->image)

                        <img
                            src="{{ asset($galeries->image) }}"
                            alt="{{ $galeries->title }}"
                            class="object-cover w-48 h-32 mb-3 rounded-lg border"
                        >

                    @else

                        <p class="mb-3 text-sm text-gray-400">
                            Belum ada foto.
                        </p>

                    @endif

                </div>


                {{-- INPUT FILE --}}
                <label
                    for="image"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Ganti Foto
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    accept="image/jpeg,image/png,image/webp"
                    class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Kosongkan jika tidak ingin mengganti foto.
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
                    value="{{ old('sort_order', $galeries->sort_order) }}"
                    min="0"
                    class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                >

                <p class="mt-1 text-xs text-gray-500">
                    Semakin kecil angka, semakin awal foto ditampilkan.
                </p>

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

                    <option
                        value="1"
                        {{ old('is_active', $galeries->is_active) == 1 ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        {{ old('is_active', $galeries->is_active) == 0 ? 'selected' : '' }}
                    >
                        Tidak Aktif
                    </option>

                </select>

            </div>

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="flex gap-3">

        <button
            type="submit"
            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
        >
            Update
        </button>

        <a
            href="{{ route('galeries.index') }}"
            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
        >
            Batal
        </a>

    </div>

</form>
```

</div>

{{-- PREVIEW FOTO BARU --}}

<script>

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const noImage = document.getElementById('noImage');

    imageInput.addEventListener('change', function(event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {

            imagePreview.src = e.target.result;

            imagePreview.classList.remove('hidden');

            if (noImage) {
                noImage.classList.add('hidden');
            }

        };

        reader.readAsDataURL(file);

    });

</script>

@endsection
