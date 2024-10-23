<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head-meta')
    @include('layouts.partials.head-style')
    @yield('style')
	@stack('styles')
</head>

<body>
    <script src="{{ asset('Tabler/dist/js/demo-theme.min.js') }}"></script>
    <div class="page">
        {{-- @include('layouts.partials.sidebar') --}}
        @include('layouts.partials.header')
        <!-- Content Wrapper. Contains page content -->
        <div class="page-wrapper">
            @yield('content')
            @include('layouts.partials.footer')
        </div>
        <!-- Content Wrapper. -->
    </div>
    <!-- ./wrapper -->
    @include('layouts.partials.foot-script')
    @yield('script')
    @stack('scripts')
</body>

</html>
