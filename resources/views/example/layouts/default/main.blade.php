@extends('example.layouts.default.baseof')

@section('main')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@include('example.layouts.partials.navbar-main')

<main class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="w-full px-6 py-8">
        @yield('content')
    </div>
</main>

@include('example.layouts.partials.footer-main')
@endsection
