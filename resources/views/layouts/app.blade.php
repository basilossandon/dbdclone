<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="/css/navbar.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <title>@yield('title') | LATAM.com</title>
        <style>
            .heading {
                background-color: #1b0088; 
                padding: 15px 0;
                box-shadow: 0 7px 0 0 #ed1650; 
                margin-bottom: 50px;
            }
            body {
                background-image: radial-gradient(#fff, #FFFFFF, #FFFFFF);
                margin: 0px;
             }
            .container input[type=submit], .container button, a.btn {
                background-color: #FFFFFF;
            }
            a.btn {
                color: #212529;
            }
            a {
                color: #57a09a;
            }
            .carousel img {
                border-radius: .375rem;
            }
            .content {
                padding-bottom: 25vh;
            }
            .formulario {
                padding: 15px;
                border: 1px solid #ced4da;
                border-radius: .375rem;
            }
            .formulario .form-control:focus {
                border-color: #74b4af;
                box-shadow: 0 0 0 .2rem #04998d4d;
            }
            .error {
                color: #d15757;
            }
        </style>
    </head>
    <body>
        <div class="heading">
            <div class="container">
                @include('navbar.navbar')
            </div>
        </div>
        <div class="container content">
            <h1 class="titulo">@yield('title')</h1>
            @yield('contenido')
        </div>
    </body>

    <script src="/js/jquery-slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</html>