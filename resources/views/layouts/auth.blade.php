<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/vendors_css.css', 'resources/css/style.css', 'resources/css/skin_color.css'])

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url('{{ asset('images/auth-bg/bg-9.jpg') }}'">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            @yield('content')
        </div>
    </div>
</body>
<script src="{{ asset('js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

@stack('scripts')

</html>