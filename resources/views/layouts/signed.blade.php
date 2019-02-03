<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('texteditor')

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

</head>
<body>
    <div id="app">
        @if (!isset($hide_header))
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('default.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('default.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('default.dashboard') }}</a>
                            </li>

                            @if (auth()->user()->role == 1)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        User <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('index-user') . '?key=all&sort=desc' }}">
                                            {{ __('default.all') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-user') . '?key=confirmation&sort=desc' }}">
                                            {{ __('default.confirmation') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-user') . '?key=active&sort=desc' }}">
                                            {{ __('default.active') }}
                                        </a>
                                    </div>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('default.article') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('index-article') . '?key=all&sort=desc' }}">
                                        {{ __('default.all') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('index-article') . '?sort=desc' }}">
                                        {{ __('default.index-article') }}
                                    </a>
                                    @if (auth()->user()->role == 1)
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=publish&sort=desc' }}">
                                            {{ __('default.publish') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=confirmation&sort=desc' }}">
                                            {{ __('default.confirmation') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=not_approved&sort=desc' }}">
                                            {{ __('default.not_approved') }}
                                        </a>
                                    @endif
                                    @if (auth()->user()->role == 2)
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=published&sort=desc' }}">
                                            {{ __('default.published') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=send&sort=desc' }}">
                                            {{ __('default.send') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=rejected&sort=desc' }}">
                                            {{ __('default.rejected') }}
                                        </a>
                                    @endif
                                        <a class="dropdown-item" href="{{ route('index-article') . '?key=draft&sort=desc' }}">
                                            {{ __('default.draft') }}
                                        </a>
                                    <a class="dropdown-item" href="{{ route('create-article') }}">
                                        {{ __('default.create-article') }}
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('default.lang') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('locale', ['locale' => 'id']) }}">{{ __('default.indonesia') }}</a>
                                    <a class="dropdown-item" href="{{ route('locale', ['locale' => 'sunda']) }}">{{ __('default.sunda') }}</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown" id="notifikasi">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Notifikasi <span id="notifikasiNumber">0</span> <span class="caret"></span>
                                </a>

                                <div id="notifikasiItems" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width:100px;">
                                    <img src="{{ Auth::user()->detail->avatar }}"
                                        class="img-fluid mx-auto d-block"
                                        style="height:100px;border-radius:100px;width:100px">
                                    <div style="text-align:center;font-size:11px;">
                                        @if (Auth::user()->role == 1)
                                            {{ __('default.role_admin') }}
                                        @endif
                                        @if (Auth::user()->role == 2)
                                            {{ __('default.role_member') }}
                                        @endif
                                    </div>
                                    <a class="dropdown-item" href="{{ route('profile-user', ['id' => Auth::user()->id]) }}">
                                        {{ __('default.profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('default.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

@yield('texteditor_run')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script type="text/javascript">

    let notifikasi = document.getElementById('notifikasi')
    let notifikasiNum = 0;

    var pusher = new Pusher('4b0e34629203c8e2309c', {
        encrypted: true,
        cluster: 'ap1'
    });

    @auth
        @if (Auth()->user()->role == 1)
            // Subscribe to the channel we specified in our Laravel Event
            var channelCreatedArticle = pusher.subscribe('user-created-article');

            // Bind a function to a Event (the full Laravel class)
            channelCreatedArticle.bind('App\\Events\\UserCreatedArticle', function(data) {
                let notifikasiNumber = document.getElementById('notifikasiNumber')

                notifikasiNum++;
                notifikasiNumber.innerHTML = notifikasiNum

                let notifikasiItems = document.getElementById('notifikasiItems')
                let notifikasiItem = document.createElement('a');
                notifikasiItem.classList.add('dropdown-item')
                // edit article
                notifikasiItem.href = "{{ URL::to('/article/edit') }}/" + data.id
                notifikasiItem.innerHTML = data.message

                notifikasiItems.appendChild(notifikasiItem)

            });
        @elseif (Auth()->user()->role != 1)
            // Subscribe to the channel we specified in our Laravel Event
            var channelUser = pusher.subscribe('channel_{{ Auth()->user()->id }}');

            // Bind a function to a Event (the full Laravel class)
            channelUser.bind('App\\Events\\AdminConfirmationArticle', function(data) {
                let notifikasiNumber = document.getElementById('notifikasiNumber')

                notifikasiNum++;
                notifikasiNumber.innerHTML = notifikasiNum

                let notifikasiItems = document.getElementById('notifikasiItems')
                let notifikasiItem = document.createElement('a');
                notifikasiItem.classList.add('dropdown-item')
                // edit article
                notifikasiItem.href = "{{ URL::to('/article') }}/" + data.id
                notifikasiItem.innerHTML = data.message

                notifikasiItems.appendChild(notifikasiItem)
            });
        @endif
    @endauth
</script>

</html>
