<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">

    <title>SIMULATOR JANGKAUAN GEMPA BUMI</title><!--SIJAPAI-->
    <link rel="stylesheet" href="{{asset('polished/polished.min.css')}}">
    <link rel="stylesheet" href="{{asset('polished/iconic/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <style>
        body{
            background-image: url("images/bg-min4.jpg");
            height: 100%; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
        }
        .container{
            background: rgba(0,0,0,.35);
            height:100%;
        }
        #app {
            height: 100%;
        }
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- <main class="py-4"> -->
            @yield('content')
        <!-- </main> -->
    </div>
</body>
</html>
