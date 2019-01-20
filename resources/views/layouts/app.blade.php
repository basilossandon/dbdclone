<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        @yield('header')
        <title>@yield('title') | LATAM.com</title>
        <style>
        </style>
    </head>
    <body>
        <div class="header">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
            <nav class="navbar navbar-expand-lg fixed-top">
            <a href="{!! URL::to('/') !!}">
               <img src="/images/logosimple-min2.png" />
            </a><button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#" style="color:white">Destinations & Offers </a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" style="color:white">Plan and Book <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:white">Manage your booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:white">Travel information</a>
                        </li>
                    </ul>
                <div class="d-flex justify-content-center h-100">
                    <div class="searchbar">
                      <input class="search_input" type="text" name="" placeholder="Search...">
                      <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                <div class="top-right links">
                @if(Auth::user())
                <button class="btn btn-primary" onclick="location.href='/logout'" type="button">Log-out</button>
                @else
                <button class="btn btn-primary" onclick="location.href='/login'" type="button">
                 Login</button> 
                <button class="btn btn-primary" onclick="location.href='/register'" type="button">
                 Register</button>
                @endif


                </div>
            </div>
            </nav>
        </div>
         @include('carousel.carousel')
        <div class="container content">
            @yield('content')
        </div>
    </body>
    <footer id="sticky">
        <div class="columns mx-auto">
        <div class="footer-items">    
            <a href="/reserve" style="color: white">
            <img src="/images/plane-icon.png">
            <a href="/reserve" style="color: white">
            Book a flight
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>

        <div class="footer-items">    
            <a href="/packages" style="color: white">
            <img src="/images/vacations-icon.svg">
            <a href="/packages" style="color: white">
            Vacation packages
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>

        <div class="footer-items">    
            <a  href="/hotels" style="color: white">
            <img src="/images/hotel-icon.svg">
            Shop Hotels
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>

        <div class="footer-items">    
            <a href="/vehicles" style="color: white">
            <img src="/images/car-icon.svg">
            Rent a car
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>
        </div>
    </footer>

    <script src="/js/jquery-slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('scripts')
</html>
