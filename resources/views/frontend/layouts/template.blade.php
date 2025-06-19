<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $CONF->title }} || @yield('pageTitle')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('storage/'.$CONF->icon) }}" rel="icon">
    <link href="{{ url('storage/'.$CONF->icon) }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    @include('frontend.layouts.css')

    <style>
        .text-justify{
            text-align: justify !important;
        }
    </style>

    @stack('customCss')
</head>
<body class="animsition">

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    @include('frontend.layouts.js')

    @stack('customJs')
</body>
</html>
