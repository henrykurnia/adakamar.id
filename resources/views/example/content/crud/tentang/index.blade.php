@extends('example.layouts.default.dashboard')

@section('content')

    <div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Pengaturan Website
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola informasi dan pengaturan website.
            </p>
        </div>

        {{-- TOMBOL TAMBAH HANYA JIKA BELUM ADA DATA --}}
        @if(!$tentang)

            <a
                href="{{ route('tentang.create') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
            >
                + Tambah Setting
            </a>

        @endif

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    {{-- TABEL --}}
    <div class="relative overflow-x-auto bg-white rounded-lg shadow-sm">

        <table class="w-full text-sm text-left text-gray-500">

            {{-- HEADER --}}
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                <tr>

                    <th class="px-6 py-3">
                        NO
                    </th>

                    <th class="px-6 py-3">
                        LOGO
                    </th>

                    <th class="px-6 py-3">
                        NAMA WEBSITE
                    </th>

                    <th class="px-6 py-3">
                        TAGLINE
                    </th>

                    <th class="px-6 py-3">
                        EMAIL
                    </th>

                    <th class="px-6 py-3">
                        TELEPON
                    </th>

                    <th class="px-6 py-3">
                        AKSI
                    </th>

                </tr>

            </thead>


            {{-- BODY --}}
            <tbody>

                @if($tentang)

                    <tr class="bg-white border-b hover:bg-gray-50">

                        {{-- NO --}}
                        <td class="px-6 py-4">
                            1
                        </td>


                        {{-- LOGO --}}
                        <td class="px-6 py-4">

                            @if($tentang->logo)

                                <img
                                    src="{{ asset($tentang->logo) }}"
                                    alt="{{ $tentang->site_name }}"
                                    class="object-contain w-24 h-12 p-1 border rounded-lg"
                                >

                            @else

                                <span class="text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- NAMA WEBSITE --}}
                        <td class="px-6 py-4 font-medium text-gray-900">

                            {{ $tentang->site_name ?? '-' }}

                        </td>


                        {{-- TAGLINE --}}
                        <td class="px-6 py-4">

                            {{ $tentang->tagline ?? '-' }}

                        </td>


                        {{-- EMAIL --}}
                        <td class="px-6 py-4">

                            {{ $tentang->email ?? '-' }}

                        </td>


                        {{-- TELEPON --}}
                        <td class="px-6 py-4">

                            {{ $tentang->phone ?? '-' }}

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-4">

                            <a
                                href="{{ route('tentang.edit', $tentang->id) }}"
                                class="px-3 py-2 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                @else

                    {{-- BELUM ADA DATA --}}
                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-10 text-center text-gray-500"
                        >
                            Belum ada pengaturan website.
                        </td>

                    </tr>

                @endif

            </tbody>

        </table>

    </div>


    </div>

    @endsection
