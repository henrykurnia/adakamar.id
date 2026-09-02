@extends('example.layouts.default.dashboard')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Aturan
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola aturan penggunaan akomodasi.
            </p>
        </div>

        <a href="{{ route('aturan.create') }}"
           class="px-5 py-2.5 text-sm font-medium
                  text-white bg-primary-600
                  rounded-lg hover:bg-primary-700
                  focus:ring-4 focus:ring-primary-300">

            + Tambah Aturan

        </a>

    </div>


    {{-- Alert Success --}}
    @if(session('success'))

        <div class="p-4 mb-6 text-sm text-green-800
                    rounded-lg bg-green-50">

            {{ session('success') }}

        </div>

    @endif


    {{-- Table --}}
    <div class="bg-white border border-gray-200
                rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-700 uppercase
                              bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4">
                            No
                        </th>

                        <th class="px-6 py-4">
                            Nama Aturan
                        </th>

                        <th class="px-6 py-4">
                            Deskripsi
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($rules as $rule)

                        <tr class="bg-white border-b
                                   hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>


                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $rule->name }}
                            </td>


                            <td class="px-6 py-4">

                                {{ $rule->description ?? '-' }}

                            </td>


                            <td class="px-6 py-4">

                                @if($rule->is_active)

                                    <span class="px-2.5 py-1 text-xs
                                                 font-medium
                                                 text-green-800
                                                 bg-green-100
                                                 rounded-full">

                                        Aktif

                                    </span>

                                @else

                                    <span class="px-2.5 py-1 text-xs
                                                 font-medium
                                                 text-red-800
                                                 bg-red-100
                                                 rounded-full">

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center
                                            justify-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('aturan.edit', $rule->id) }}"
                                       class="px-3 py-2 text-xs font-medium
                                              text-yellow-700
                                              bg-yellow-50
                                              rounded-lg
                                              hover:bg-yellow-100">

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('aturan.destroy', $rule->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus aturan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2 text-xs font-medium
                                                   text-red-700
                                                   bg-red-100
                                                   rounded-lg
                                                   hover:bg-red-200">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-8 text-center
                                       text-gray-500">

                                Belum ada aturan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection