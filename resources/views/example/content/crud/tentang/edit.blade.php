@extends('example.layouts.default.dashboard')

@section('content')

    <div class="p-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-semibold text-gray-900">
            Edit Pengaturan Website
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui informasi website.
        </p>

    </div>


    {{-- ERROR --}}
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
        action="{{ route('tentang.update', $setting->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- INFORMASI WEBSITE --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Informasi Website
            </h2>

            <div class="space-y-5">

                {{-- SITE NAME --}}
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
                        value="{{ old('site_name', $setting->site_name) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- TAGLINE --}}
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
                        value="{{ old('tagline', $setting->tagline) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- ABOUT --}}
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
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('about', $setting->about) }}</textarea>

                </div>

            </div>

        </div>


        {{-- BRANDING --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Branding
            </h2>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                {{-- LOGO --}}
                <div>

                    <label
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Logo Saat Ini
                    </label>


                    {{-- LOGO PREVIEW --}}
                    @if($setting->logo)

                        <img
                            id="logoPreview"
                            src="{{ asset($setting->logo) }}"
                            class="object-contain w-40 h-20 p-2 mb-3 border rounded-lg"
                            alt="Logo"
                        >

                    @else

                        <p class="mb-3 text-sm text-gray-400">
                            Belum ada logo.
                        </p>

                    @endif


                    <label
                        for="logo"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Ganti Logo
                    </label>


                    <input
                        type="file"
                        name="logo"
                        id="logo"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Kosongkan jika tidak ingin mengganti logo.
                    </p>

                </div>


                {{-- FAVICON --}}
                <div>

                    <label
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Favicon Saat Ini
                    </label>


                    {{-- FAVICON PREVIEW --}}
                    @if($setting->favicon)

                        <img
                            id="faviconPreview"
                            src="{{ asset($setting->favicon) }}"
                            class="object-contain w-20 h-20 p-2 mb-3 border rounded-lg"
                            alt="Favicon"
                        >

                    @else

                        <p class="mb-3 text-sm text-gray-400">
                            Belum ada favicon.
                        </p>

                    @endif


                    <label
                        for="favicon"
                        class="block mb-2 text-sm font-medium text-gray-900"
                    >
                        Ganti Favicon
                    </label>


                    <input
                        type="file"
                        name="favicon"
                        id="favicon"
                        accept=".ico,.png,.jpg,.jpeg,.webp"
                        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        Kosongkan jika tidak ingin mengganti favicon.
                    </p>

                </div>

            </div>

        </div>


        {{-- KONTAK --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Kontak
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- ADDRESS --}}
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
                    >{{ old('address', $setting->address) }}</textarea>

                </div>


                {{-- PHONE --}}
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
                        value="{{ old('phone', $setting->phone) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- WHATSAPP --}}
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
                        value="{{ old('whatsapp', $setting->whatsapp) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- EMAIL --}}
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
                        value="{{ old('email', $setting->email) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- LOKASI --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Lokasi
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                


                {{-- MAPS --}}
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
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >{{ old('maps_embed', $setting->maps_embed) }}</textarea>

                </div>

            </div>

        </div>


        {{-- SOSIAL MEDIA --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Sosial Media
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- FACEBOOK --}}
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
                        value="{{ old('facebook', $setting->facebook) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- INSTAGRAM --}}
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
                        value="{{ old('instagram', $setting->instagram) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- YOUTUBE --}}
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
                        value="{{ old('youtube', $setting->youtube) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- TIKTOK --}}
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
                        value="{{ old('tiktok', $setting->tiktok) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- SEO --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                SEO Default
            </h2>

            <div class="space-y-5">

                {{-- META TITLE --}}
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
                        value="{{ old('meta_title', $setting->meta_title) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>


                {{-- META DESCRIPTION --}}
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
                    >{{ old('meta_description', $setting->meta_description) }}</textarea>

                </div>


                {{-- META KEYWORDS --}}
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
                        value="{{ old('meta_keywords', $setting->meta_keywords) }}"
                        class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg"
                    >

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="p-6 mb-6 bg-white rounded-lg shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Footer
            </h2>

            <div class="space-y-5">

                {{-- FOOTER DESCRIPTION --}}
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
                    >{{ old('footer_description', $setting->footer_description) }}</textarea>

                </div>


                {{-- COPYRIGHT --}}
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
                        value="{{ old('copyright', $setting->copyright) }}"
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
                Update
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

    {{-- PREVIEW LOGO & FAVICON --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | Preview Logo
        |--------------------------------------------------------------------------
        */
        document.getElementById('logo').addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (file) {

                const preview = document.getElementById('logoPreview');

                preview.src = URL.createObjectURL(file);

                preview.classList.remove('hidden');

                const empty = document.getElementById('logoEmpty');

                if (empty) {
                    empty.classList.add('hidden');
                }
            }

        });


        /*
        |--------------------------------------------------------------------------
        | Preview Favicon
        |--------------------------------------------------------------------------
        */
        document.getElementById('favicon').addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (file) {

                const preview = document.getElementById('faviconPreview');

                preview.src = URL.createObjectURL(file);

                preview.classList.remove('hidden');

                const empty = document.getElementById('faviconEmpty');

                if (empty) {
                    empty.classList.add('hidden');
                }
            }

        });

    </script>

    @endsection
