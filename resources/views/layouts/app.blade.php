<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/vendors_css.css', 'resources/css/style.css', 'resources/css/skin_color.css', 'resources/css/horizontal-menu.css', 'resources/css/custom.css'])

</head>

<body class="layout-top-nav light-skin theme-primary fixed">

    <div class="wrapper">
        <div id="loader"></div>
        @include('partial/header')
        @include('partial/navbar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('partial/footer')
    </div>
</body>
<script src="{{ asset('js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>

@stack('scripts')

</html>