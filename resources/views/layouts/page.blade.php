<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        section {
            padding: 60px 0;
        }

        section .section-title {
            text-align: center;
            color: #007b5e;
            margin-bottom: 50px;
            text-transform: uppercase;
        }
        #footer {
            background: #007b5e !important;
        }
        #footer h5{
            padding-left: 10px;
            border-left: 3px solid #eeeeee;
            padding-bottom: 6px;
            margin-bottom: 20px;
            color:#ffffff;
        }
        #footer a {
            color: #ffffff;
            text-decoration: none !important;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        #footer ul.social li{
            padding: 3px 0;
        }
        #footer ul.social li a i {
            margin-right: 5px;
            font-size:25px;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #footer ul.social li:hover a i {
            font-size:30px;
            margin-top:-10px;
        }
        #footer ul.social li a,
        #footer ul.quick-links li a{
            color:#ffffff;
        }
        #footer ul.social li a:hover{
            color:#eeeeee;
        }
        #footer ul.quick-links li{
            padding: 3px 0;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #footer ul.quick-links li:hover{
            padding: 3px 0;
            margin-left:5px;
            font-weight:700;
        }
        #footer ul.quick-links li a i{
            margin-right: 5px;
        }
        #footer ul.quick-links li:hover a i {
            font-weight: 700;
        }

        @media (max-width:767px){
            #footer h5 {
            padding-left: 0;
            border-left: transparent;
            padding-bottom: 0px;
            margin-bottom: 10px;
        }
        }
            html, body {
                background-color: #fff;
                /* color: #636b6f; */
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                /* height: 100vh; */
            }

            .menu {
                background-color:#00A388;
                padding: 10px 0;
            }

            .menu a {
                color:white;
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
                /* position: absolute; */
                /* right: 10px; */
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: white;
                padding: 0 10px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            h1 {
                padding:0;
                margin:0;
            }

            .sheader {
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: baseline;
                text-align: center;
                font-size:2em;
            }
            .sheader::after {
                content: '';
                border-top: 1px solid;
                margin: 0 20px 0 10px;
                flex: 1 0 20px;
            }
            .simage > img {
                display: block;
                /* max-width:230px; */
                /* max-height:200px; */
                width: 200px;
                height: 200px;
            }
            .simage {
                width:100%;
            }
            /* .sbody > .card > .card-body {
                width:80%;
            } */
            .scontent {
                margin-top:10px;
                width: 200px;
            }
        </style>
    </head>
    <body>

        <div class="d-flex container-fluid">
            <div class="flex-fill">

            </div>
            <div class="flex-fill" style="text-align:right;">
                <div>
                    {{ __('default.lang') }} :
                    <a href="{{ route('locale', ['locale' => 'id']) }}">{{ __('default.indonesia') }}</a> ,
                    <a href="{{ route('locale', ['locale' => 'sunda']) }}">{{ __('default.sunda') }}</a>
                    |
                    <span>
                        @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">
                                {{ __('default.home') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                {{ __('default.login') }}
                            </a>,

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    {{ __('default.register') }}
                                </a>
                            @endif
                        @endauth
                    @endif
                    </span>
                </div>
            </div>
        </div>
        <div style="text-align:center;position:relative;height:250px;overflow:hidden;">
            <a href="{{ url('/') }}"><img src="{{ asset('a.gif') }}" style="width:110%;height:250px;position:absolute;top:0;left:-10px;"></a>
        </div>
        <div class="menu">
            <div class="flex-center position-ref full-height">
                <div class="top-right links">
                    <a href="{{ url('/category/adat-istiadat') }}"> {{ __('default.adat-istiadat') }} </a>
                    <a href="{{ url('/category/direktori-usaha') }}"> {{ __('default.direktori-usaha') }} </a>
                    <a href="{{ url('/category/info-jabar') }}"> {{ __('default.info-jabar') }} </a>
                    <a href="{{ url('/category/kuliner') }}"> {{ __('default.kuliner') }} </a>
                    <a href="{{ url('/category/meseum') }}"> {{ __('default.meseum') }} </a>
                    <a href="{{ url('/category/pariwisata') }}"> {{ __('default.pariwisata') }} </a>
                    <a href="{{ url('/category/sanggar-dan-organisasi') }}"> {{ __('default.sanggar-dan-organisasi') }} </a>
                    <a href="{{ url('/category/seni-budaya') }}"> {{ __('default.seni-budaya') }} </a>
                    <a href="{{ url('/category/tokoh') }}"> {{ __('default.tokoh') }} </a>
                </div>


            </div>
        </div>

        <div>
            @yield('content')
        </div>


<!-- Footer -->
	<section id="footer" style="margin-top:50px;">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p class="h6">Copyright © 2011 Centerpoint Technologies</p>
				</div>
				</hr>
			</div>
		</div>
	</section>
    <!-- ./Footer -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });

    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });


    //Do not include! This prevents the form from submitting for DEMO purposes only!
    $('form').submit(function(event) {
        event.preventDefault();
        return false;
    })
});
</script>
    </body>
</html>
