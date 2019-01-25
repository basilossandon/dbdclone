<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        @yield('header')
        <title>@yield('title') | Vuelaqui.com</title>
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
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/checkin" style="color:white; "><h2>Check-in</h2> </a>
            </li>
           <li class="nav-item active">
                <a class="nav-link" href="#" style="color:white">Plan and Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:white">Manage your booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:white">Travel information</a>
            </li>
            </ul>
            </div>


               
    
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                 <ul class="navbar-nav ml-auto">
                    @if(Auth::user())
                    <li class="nav-item"><button class="btn btn-primary" onclick="location.href='/logout'" type="button">Log-out</button>                        
                            <a href="/dashboard"> <img style="height: 50px;"src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="img-responsive img-thumbnail"></a>
                    </li>
                    @else
                    <li class="nav-item">
                     
                        <button class="btn btn-primary" style="margin-right: 5px;" onclick="location.href='/login'" type="button">
                        Login</button>     
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary" onclick="location.href='/register'" type="button">
                             Register
                         </button>                    
                     </li>
                     @endif

                </ul>

                
                
                


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
            <a href="/reserve/packages" style="color: white">
            <img src="/images/vacations-icon.svg">
            <a href="/packages" style="color: white">
            Vacation packages
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>

        <div class="footer-items">    
            <a  href="/reserve/rooms" style="color: white">
            <img src="/images/hotel-icon.svg">
            Shop Hotels
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>

        <div class="footer-items">    
            <a href="/reserve/vehicles" style="color: white">
            <img src="/images/car-icon.svg">
            Rent a car
            <img src="//content.delta.com/content/www/lac/en/home.damAssetRender.20180417T1339174800400.html/content/dam/fresh-air/icons/shopping-band-right-arrow.svg" alt="">
            </a>
        </div>
        </div>
    </footer>

    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('scripts')
</html>
