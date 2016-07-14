<!DOCTYPE html>
    <html lang="en">
    <head>
        @yield('title')
        @include('layouts.head')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            @include('layouts.header')
            <div class="page-container">
                <div class="'page-container">
                  @include('layouts.sidebar')
                  @yield('content')
                  @include('layouts.quick-sidebar')
                </div>
            @include('layouts.footer')
            </div>
        <div>
        @include('layouts.scripts')
    </body>
</html>
