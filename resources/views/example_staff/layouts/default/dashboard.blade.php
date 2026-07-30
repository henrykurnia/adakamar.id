@extends('example_staff.layouts.default.baseof')

@section('main')
@vite(['resources/css/app.css','resources/js/app.js'])

@include('example_staff.layouts.partials.navbar-dashboard')

<div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

    @include('example_staff.layouts.partials.sidebar')

    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
            @yield('content')
        </main>

        @include('example_staff.layouts.partials.footer-dashboard')
    </div>
</div>

{{-- Tempat seluruh javascript halaman --}}
@stack('scripts')

@endsection