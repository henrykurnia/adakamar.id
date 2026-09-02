@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Artikel
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola artikel website.
            </p>
        </div>

        <a href="{{ route('artikel.create') }}"
           class="px-5 py-2.5 text-sm font-medium text-white
                  bg-primary-600 rounded-lg hover:bg-primary-700">
            + Tambah Artikel
        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="p-4 mb-5 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="w-full min-w-max text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                    <tr>
                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Thumbnail
                        </th>

                        <th class="px-6 py-4">
                            Judul
                        </th>

                        <th class="px-6 py-4">
                            Kategori
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4">
                            Published
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <body>
                    @forelse($artikel as $index => $article)

                        <tr class="bg-white border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">

                                @if($article->thumbnail)

                                    <img
                                        src="{{ asset($article->thumbnail) }}"
                                        alt="{{ $article->title }}"
                                        class="w-20 h-14 object-cover rounded-lg"
                                    >

                                @else

                                    <div class="w-20 h-14 flex items-center justify-center
                                                bg-gray-100 rounded-lg text-xs text-gray-400">
                                        No Image
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $article->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $article->category->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($article->status == 'Published')

                                    <span class="px-2.5 py-1 text-xs font-medium
                                                 text-green-700 bg-green-100 rounded-full">
                                        Published
                                    </span>

                                @elseif($article->status == 'Draft')

                                    <span class="px-2.5 py-1 text-xs font-medium
                                                 text-yellow-700 bg-yellow-100 rounded-full">
                                        Draft
                                    </span>

                                @else

                                    <span class="px-2.5 py-1 text-xs font-medium 
                                                 text-gray-800 bg-gray-100 rounded-full">
                                        {{ ucfirst($article->status) }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                 {{ $article->created_at->locale('id')->translatedFormat('d F Y, H:i') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('artikel.edit', $article->id) }}"
                                    class="px-3 py-2 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('artikel.destroy', $article->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-2 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="px-6 py-8 text-center text-gray-500">
                                Belum ada artikel.
                            </td>
                        </tr>

                    @endforelse

                </body>

            </table>

        </div>

    </div>

</div>

@endsection