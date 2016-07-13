<!DOCTYPE html>
    <html lang="en">
    <head>
        @yield('title')
        @include('layouts.head')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            @yield('content')
        <div>
        @include('layouts.scripts')
    </body>
</html>
