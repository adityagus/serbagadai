<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?: 'id' }}">
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

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$CONF->title ?? 'Gadai Mulia' }} — @yield('pageTitle', 'Solusi Keuangan Premium & Terpercaya')</title>
    <meta name="description" content="{{ @$CONF->about ?? 'Gadai Mulia memberikan solusi finansial cepat, aman, dan terpercaya dengan jaminan emas, logam mulia, dan barang elektronik resmi di bawah pengawasan OJK.' }}">

    <!-- Favicons -->
    <link href="{{ !empty($CONF->icon) ? url('storage/'.$CONF->icon) : url('serbamulia/assets/logo_shield.png') }}" rel="icon">
    <link href="{{ !empty($CONF->icon) ? url('storage/'.$CONF->icon) : url('serbamulia/assets/logo_shield.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @include('frontend.layouts.css')

    <script>
        window.GADAI_WA_PHONE = "{{ preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771') }}";
    </script>
    <script src="{{ url('serbamulia/theme.js') }}"></script>

    @stack('customCss')
</head>
<body>

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    @include('frontend.layouts.js')

    @stack('customJs')
</body>
</html>
