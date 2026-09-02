@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-4 bg-white border-b border-gray-200 lg:mt-1.5">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
            Fasilitas
        </h1>

        <p class="text-sm text-gray-500">
            Kelola fasilitas yang tersedia pada akomodasi.
        </p>
    </div>

    <a
        href="{{ route('fasilitas.create') }}"
        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800"
    >
        + Tambah Fasilitas
    </a>

</div>


</div>

<div class="p-4">

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
        {{ session('success') }}
    </div>
@endif

<div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left text-gray-500">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Deskripsi</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($data as $fasilitasItem)

                <tr class="bg-white border-b hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $fasilitasItem->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $fasilitasItem->description ?? '-' }}
                    </td>

                    <td class="px-6 py-4">

                        @if($fasilitasItem->is_active)
                            <span class="px-2.5 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                Aktif
                            </span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                Tidak Aktif
                            </span>
                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-2">

                            <a
                                href="{{ route('fasilitas.edit', $fasilitasItem->id) }}"
                                class="px-3 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 rounded-lg hover:bg-yellow-100"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('fasilitas.destroy', $fasilitasItem->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td
                        colspan="6"
                        class="px-6 py-8 text-center text-gray-500"
                    >
                        Belum ada data fasilitas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>


</div>

@endsection
