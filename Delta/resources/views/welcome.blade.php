<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>





<div style="padding :100px;"><?php

use \Milon\Barcode\DNS1D;

$d = new DNS1D();
$d->setStorPath(__DIR__."/cache/");
echo $d->getBarcodeHTML("123456", "C39");
echo "</br> </br> </br>";echo "</br> </br> </br>";echo "</br> </br> </br>";echo "</br> </br> </br>";

echo DNS1D::getBarcodeHTML("441", "C39"); echo "</br>";
echo DNS1D::getBarcodeHTML("442", "C39+"); echo "</br>";
echo DNS1D::getBarcodeHTML("443", "C39E"); echo "</br>";
echo DNS1D::getBarcodeHTML("444", "C39E+"); echo "</br>";
echo DNS1D::getBarcodeHTML("445", "C93");
echo DNS1D::getBarcodeHTML("446", "S25");
echo DNS1D::getBarcodeHTML("447", "S25+");
echo DNS1D::getBarcodeHTML("468", "I25");
echo DNS1D::getBarcodeHTML("46", "I25+"); 
echo DNS1D::getBarcodeHTML("4446", "C128");
echo DNS1D::getBarcodeHTML("4656", "C128A"); 
echo DNS1D::getBarcodeHTML("4445", "C128B"); 
echo DNS1D::getBarcodeHTML("4445645656", "C128C"); 
echo DNS1D::getBarcodeHTML("44455656", "EAN2");
echo DNS1D::getBarcodeHTML("4445656", "EAN5");
echo DNS1D::getBarcodeHTML("4445", "EAN8");
echo DNS1D::getBarcodeHTML("4445", "EAN13");
echo DNS1D::getBarcodeHTML("4445645656", "UPCA");
echo DNS1D::getBarcodeHTML("4445645656", "UPCE");
echo DNS1D::getBarcodeHTML("4445645656", "MSI");
echo DNS1D::getBarcodeHTML("4445645656", "MSI+");
echo DNS1D::getBarcodeHTML("4445645656", "POSTNET");
echo DNS1D::getBarcodeHTML("4445645656", "PLANET");
echo DNS1D::getBarcodeHTML("4445645656", "RMS4CC");
echo DNS1D::getBarcodeHTML("4445645656", "KIX");
echo DNS1D::getBarcodeHTML("4445645656", "IMB");
echo DNS1D::getBarcodeHTML("4445645656", "CODABAR");
echo DNS1D::getBarcodeHTML("4445645656", "CODE11");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA");
echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");


?>
</div>


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
