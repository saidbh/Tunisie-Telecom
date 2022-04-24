<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
    @auth
        @include('admin.partials._body_left_sidebar')
        <!-- Sidebar End -->
        <!-- TOP Nav Bar -->
        @include('admin.partials._app_header')
    @endauth
    <!-- TOP Nav Bar End -->
    <!-- Page Content  -->

        @yield('content')
    <!-- Content End -->
</div>
<!-- Wrapper END -->
<!-- Footer -->
@include('admin.partials._body_footer')
<!-- Footer END -->
