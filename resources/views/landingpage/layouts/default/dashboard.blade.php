@extends('landingpage.layouts.default.baseof')

@section('main')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @include('landingpage.layouts.partials.navbar-dashboard')

    <!-- Main Content -->
    <main class="pt-16 bg-gray-50 dark:bg-gray-900">
        @yield('content')
    </main>

    @include('landingpage.layouts.partials.footer-dashboard')
@endsection