<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('includes.css_links')
    <!-- Scripts -->

    {{-- <!-- Fonts -->--}}
    <link media="all" type="text/css" rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.8.55/css/materialdesignicons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @toastr_css
    @yield('extra_css')
</head>

<body>
    <div id="app" class="wrapper">
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
    </div>

    @include('includes.js_links')
    @yield('extra_js')

    @toastr_js
    @toastr_render
</body>

</html>
