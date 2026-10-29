<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    
    <meta name="google-site-verification" content="rOf6HHPxB8aYPysF3E1Hjyzijxk53xWGB-UY79Y-vJM" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BQJ6LKFGJZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-BQJ6LKFGJZ');
    </script>    
    
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
