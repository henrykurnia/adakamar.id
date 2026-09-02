@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Detail Akomodasi
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Informasi lengkap mengenai akomodasi.
            </p>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('akomodasi.index') }}"
               class="px-5 py-2.5 text-sm font-medium
                      text-gray-700 bg-white
                      border border-gray-300
                      rounded-lg hover:bg-gray-100">
                Kembali
            </a>

        </div>

    </div>


    {{-- Konten --}}
    <div class="bg-white border border-gray-200
                rounded-xl shadow-sm overflow-hidden">

        {{-- Thumbnail --}}
        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                Foto Akomodasi
            </h2>

            @if($akomodasi->thumbnail)

                <img
                    src="{{ asset($akomodasi->thumbnail) }}"
                    alt="Gambar {{ $akomodasi->title }}"
                    class="w-full max-w-xl h-72 object-cover
                           rounded-lg border border-gray-200">

            @else

                <div class="w-full max-w-xl h-72
                            bg-gray-100 rounded-lg
                            flex items-center justify-center">

                    <span class="text-5xl">
                        🏠
                    </span>

                </div>

            @endif

        </div>


        {{-- Informasi Utama --}}
        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900 mb-5">
                Informasi Akomodasi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Nama Akomodasi
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->title }}
                    </p>
                </div>


                {{-- Slug --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Slug
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->slug }}
                    </p>
                </div>


                {{-- Kategori --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Kategori
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->category->name ?? '-' }}
                    </p>
                </div>


                {{-- Harga --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Harga per Malam
                    </p>

                    <p class="mt-1 text-lg font-bold text-primary-600">
                        Rp {{ number_format($akomodasi->price, 0, ',', '.') }}
                    </p>
                </div>


                {{-- Status --}}
                <div>
                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    @if($akomodasi->status === 'Available')

                        <span class="inline-flex mt-1 px-3 py-1
                                     text-xs font-medium
                                     text-green-700 bg-green-100
                                     rounded-full">
                            Available
                        </span>

                    @elseif($akomodasi->status === 'Full')

                        <span class="inline-flex mt-1 px-3 py-1
                                     text-xs font-medium
                                     text-red-700 bg-red-100
                                     rounded-full">
                            Full
                        </span>

                    @else

                        <span class="inline-flex mt-1 px-3 py-1
                                     text-xs font-medium
                                     text-yellow-700 bg-yellow-100
                                     rounded-full">
                            {{ $akomodasi->status ?? '-' }}
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- Detail Penginapan --}}
        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900 mb-5">
                Detail Penginapan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Alamat --}}
                <div class="md:col-span-2">

                    <p class="text-sm text-gray-500">
                        Alamat
                    </p>

                    <p class="mt-1 text-sm text-gray-900">
                        {{ $akomodasi->address ?? '-' }}
                    </p>

                </div>

                <div class="md:col-span-2">

                    <p class="text-sm text-gray-500">
                        Link_Gmaps
                    </p>

                    <p class="mt-1 text-sm text-gray-900">
                        {{ $akomodasi->link_gmaps ?? '-' }}
                    </p>

                </div>
                

                {{-- Kapasitas --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Kapasitas
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->capacity ?? 0 }} Orang
                    </p>

                </div>


                {{-- Bedroom --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Kamar Tidur
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->bedroom ?? 0 }} Kamar
                    </p>

                </div>


                {{-- Bathroom --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Kamar Mandi
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->bathroom ?? 0 }} Kamar
                    </p>

                </div>


                {{-- Size --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Luas
                    </p>

                    <p class="mt-1 text-sm font-medium text-gray-900">
                        {{ $akomodasi->size ?? '-' }} m²
                    </p>

                </div>

            </div>

        </div>


        {{-- Deskripsi --}}
        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                Deskripsi
            </h2>

            <div class="text-sm text-gray-700 leading-relaxed">
                {!! nl2br(e($akomodasi->description ?? '-')) !!}
            </div>

        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- ATURAN --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    Aturan
                </h2>

                @forelse($akomodasi->rules as $rule)
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-gray-900">
                            {{ $rule->name }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada aturan.</p>
                @endforelse
            </div>


            {{-- FASILITAS --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    Fasilitas
                </h2>

                @forelse($akomodasi->facilities as $facility)
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-gray-900">
                            {{ $facility->name }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada fasilitas.</p>
                @endforelse
            </div>

        </div>


        {{-- SEO --}}
        <div class="p-6">

            <h2 class="text-lg font-semibold text-gray-900 mb-5">
                Informasi SEO
            </h2>

            <div class="space-y-5">

                {{-- Meta Title --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Meta Title
                    </p>

                    <p class="mt-1 text-sm text-gray-900">
                        {{ $akomodasi->meta_title ?? '-' }}
                    </p>

                </div>


                {{-- Meta Description --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Meta Description
                    </p>

                    <p class="mt-1 text-sm text-gray-900">
                        {{ $akomodasi->meta_description ?? '-' }}
                    </p>

                </div>

                        {{-- Gallery Foto --}}
                {{-- Gallery Foto --}}
                <div class="mt-6">

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">
                        Galeri Foto
                    </h2>

                    @if($akomodasi->images->count() > 0)

                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">

                            @foreach($akomodasi->images as $image)

                                <div class="overflow-hidden rounded-lg border border-gray-200">

                                    <img
                                        src="{{ asset($image->image) }}"
                                        alt="{{ $akomodasi->title }}"
                                        class="w-full h-40 object-cover"
                                    >

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p class="text-sm text-gray-500">
                            Belum ada foto galeri.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection