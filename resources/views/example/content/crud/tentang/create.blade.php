@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-gray-900">
            Tambah Pengaturan Website
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Tambahkan informasi website.
        </p>

    </div>

    {{-- Validation --}}
    @if($errors->any())

        <div class="p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-lg">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('tentang.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- ===================================================== --}}
        {{-- INFORMASI WEBSITE --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Informasi Website
            </h2>

            <div class="space-y-5">

                {{-- Site Name --}}
                <div>

                    <label
                        for="site_name"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Nama Website
                    </label>

                    <input
                        type="text"
                        name="site_name"
                        id="site_name"
                        value="{{ old('site_name') }}"
                        placeholder="Contoh: AdaKamar"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                    @error('site_name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tagline --}}
                <div>

                    <label
                        for="tagline"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Tagline
                    </label>

                    <input
                        type="text"
                        name="tagline"
                        id="tagline"
                        value="{{ old('tagline') }}"
                        placeholder="Contoh: Tempat Nyaman untuk Menginap"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- About --}}
                <div>

                    <label
                        for="about"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Tentang
                    </label>

                    <textarea
                        name="about"
                        id="about"
                        rows="5"
                        placeholder="Deskripsi tentang website"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('about') }}</textarea>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- BRANDING --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Branding
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Logo --}}
                <div>

                    <label
                        for="logo"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        id="logo"
                        accept="image/*"
                        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, JPEG, PNG, atau WEBP.
                    </p>

                </div>


                {{-- Favicon --}}
                <div>

                    <label
                        for="favicon"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Favicon
                    </label>

                    <input
                        type="file"
                        name="favicon"
                        id="favicon"
                        accept="image/*,.ico"
                        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan gambar persegi untuk favicon.
                    </p>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- KONTAK --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Kontak
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Address --}}
                <div class="md:col-span-2">

                    <label
                        for="address"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        id="address"
                        rows="3"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('address') }}</textarea>

                </div>


                {{-- Phone --}}
                <div>

                    <label
                        for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Telepon
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- WhatsApp --}}
                <div>

                    <label
                        for="whatsapp"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        id="whatsapp"
                        value="{{ old('whatsapp') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- Email --}}
                <div class="md:col-span-2">

                    <label
                        for="email"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- LOKASI --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Lokasi
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                


                {{-- Maps Embed --}}
                <div class="md:col-span-2">

                    <label
                        for="maps_embed"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Google Maps Embed
                    </label>

                    <textarea
                        name="maps_embed"
                        id="maps_embed"
                        rows="5"
                        placeholder="Masukkan kode iframe Google Maps"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('maps_embed') }}</textarea>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SOSIAL MEDIA --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Sosial Media
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Facebook --}}
                <div>

                    <label
                        for="facebook"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Facebook
                    </label>

                    <input
                        type="url"
                        name="facebook"
                        id="facebook"
                        value="{{ old('facebook') }}"
                        placeholder="https://facebook.com/..."
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- Instagram --}}
                <div>

                    <label
                        for="instagram"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Instagram
                    </label>

                    <input
                        type="url"
                        name="instagram"
                        id="instagram"
                        value="{{ old('instagram') }}"
                        placeholder="https://instagram.com/..."
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- YouTube --}}
                <div>

                    <label
                        for="youtube"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        YouTube
                    </label>

                    <input
                        type="url"
                        name="youtube"
                        id="youtube"
                        value="{{ old('youtube') }}"
                        placeholder="https://youtube.com/..."
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- TikTok --}}
                <div>

                    <label
                        for="tiktok"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        TikTok
                    </label>

                    <input
                        type="url"
                        name="tiktok"
                        id="tiktok"
                        value="{{ old('tiktok') }}"
                        placeholder="https://tiktok.com/@..."
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- SEO --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                SEO Default
            </h2>

            <div class="space-y-5">

                <div>

                    <label
                        for="meta_title"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        id="meta_title"
                        value="{{ old('meta_title') }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                <div>

                    <label
                        for="meta_description"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        id="meta_description"
                        rows="4"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('meta_description') }}</textarea>

                </div>


                <div>

                    <label
                        for="meta_keywords"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Meta Keywords
                    </label>

                    <input
                        type="text"
                        name="meta_keywords"
                        id="meta_keywords"
                        value="{{ old('meta_keywords') }}"
                        placeholder="villa, penginapan, hotel"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- FOOTER --}}
        {{-- ===================================================== --}}

        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Footer
            </h2>

            <div class="space-y-5">

                <div>

                    <label
                        for="footer_description"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Deskripsi Footer
                    </label>

                    <textarea
                        name="footer_description"
                        id="footer_description"
                        rows="4"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('footer_description') }}</textarea>

                </div>


                <div>

                    <label
                        for="copyright"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Copyright
                    </label>

                    <input
                        type="text"
                        name="copyright"
                        id="copyright"
                        value="{{ old('copyright') }}"
                        placeholder="© 2026 Nama Website"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

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
                href="{{ route('tentang.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection