<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.page.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="manifest" href="{{ asset('/manifest.json') }}" />
        {{-- <script src="{{ asset('/OneSignalSDKWorker.js') }}"></script> --}}
        {{-- <script src="/OneSignalSDKUpdaterWorker.js"></script> --}}

        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

        <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
            appId: "dcf7e430-338b-40b7-89e1-a824b1626662",
            autoRegister: false,
            notifyButton: {
                enable: true,
            },
            allowLocalhostAsSecureOrigin: true,
            });

            OneSignal.on('notificationDisplay', function(event) {
                console.warn('OneSignal notification displayed:', event);
            });

            @auth
            OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                if (isEnabled) {
                    // user has subscribed
                    OneSignal.getUserId( function(userId) {
                        // console.log('player_id of the subscribed user is : ' + userId);
                        // Make a POST call to your server with the user ID
                        let url = "{{ URL::to('') }}/user/onesignal_id";
                        let form = new FormData()
                        form.append('_token', "{{ csrf_token() }}")
                        form.append('id', userId)

                        fetch(url, {
                            method: "POST",
                            body: form
                        })
                        .then(res => {
                            // console.log(res)
                        })
                    });
                }
            });
            @endauth
        });
        </script>
        <script>

        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="d-flex container" style="padding:5px;margin-left:35px;">
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


                <a href="{{ url('/') }}"><img src="{{ asset('a.gif') }}" style="padding:10px;border-radius:35px;"></a>
                <div class="menu">
                    <div class="flex-center position-ref full-height">
                        <div class="top-right links">
                            <a href="{{ url('/category/adat-istiadat') }}"> {{ __('default.adat-istiadat') }} </a>
                            <a href="{{ url('/category/direktori-usaha') }}"> {{ __('default.direktori-usaha') }} </a>
                            <a href="{{ url('/category/info-jabar') }}"> {{ __('default.info-jabar') }} </a>
                            <a href="{{ url('/category/kuliner') }}"> {{ __('default.kuliner') }} </a>
                            <a href="{{ url('/category/museum') }}"> {{ __('default.meseum') }} </a>
                            <a href="{{ url('/category/pariwisata') }}"> {{ __('default.pariwisata') }} </a>
                            <a href="{{ url('/category/sanggar-dan-organisasi') }}"> {{ __('default.sanggar-dan-organisasi') }} </a>
                            <a href="{{ url('/category/seni-budaya') }}"> {{ __('default.seni-budaya') }} </a>
                            <a href="{{ url('/category/tokoh') }}"> {{ __('default.tokoh') }} </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>


       <!-- Footer -->
	<section id="footer" style="margin-top:50px;">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p class="h6">Copyright © 2011 Centerpoint Technologies</p>
				</div>
			</div>
		</div>
	</section>
    <!-- ./Footer -->

    @yield('addon')

    </body>
</html>
