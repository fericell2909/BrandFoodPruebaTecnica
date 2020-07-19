<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test BrandFood</title>
        <link rel="shortcut icon" href="{{{ asset('favicon.png') }}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: #2f3233;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            body {
                background-image: url('/img/background.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 15px;
            }
            .label-autor
            {
                font-size : 20px;
                font-weight: 900;
            }
            .welcome__image
            {
                width: 25px;
                height: 25px;
            }
            body::before{
                content: "";
                display: block;
                position: absolute;
                z-index: 0;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: #005bea;
                background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
                background: -o-linear-gradient(bottom, #005bea, #00c6fb);
                background: -moz-linear-gradient(bottom, #005bea, #00c6fb);
                background: linear-gradient(bottom, #005bea, #00c6fb);
                opacity: 0.9;
            }
        </style>
    </head>
    <body >
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ url('/login') }}">Iniciar Sesion</a>
                        <a href="{{ url('/register') }}">Registrarse</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Test BrandFood
                </div>
                <label class="label-autor"> Marco Estrada Lopez</label>
                <div class="links">
                    <a href="https://www.linkedin.com/in/marcoestradalopez" target="_blank"><img src="https://static-exp1.licdn.com/sc/h/al2o9zrvru7aqj8e1x2rzsrca" class="welcome__image" /></a>
                    <a href="https://github.com/fericell2909" target="_blank"><img src="https://github.com/fluidicon.png" class="welcome__image" /></a>
                </div>
            </div>
        </div>
    </body>
</html>
