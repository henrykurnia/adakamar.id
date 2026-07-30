@extends('example_admin.layouts.default.baseof')
@section('main')
@include('example_admin.layouts.partials.navbar-stacked-layout')
<div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
  <div id="main-content" class="relative w-full max-w-screen-2xl mx-auto h-full overflow-y-auto bg-gray-50 dark:bg-gray-900">
    <main>
      @yield('content')
    </main>
      @include('example_admin.layouts.partials.footer-stacked-layout')
  </div>
</div>
@endsection
