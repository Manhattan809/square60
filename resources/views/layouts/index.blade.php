<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
    <title>Hypo Real Estate</title>
</head>
<body>
    <div></div>
    <header>
        <nav class="navbar is-info is-bold">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <img src="{{ asset('images/logo-white.svg') }}" alt="LOGO" width="160" >
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-start"></div>
                <div class="navbar-end">
                    <a class="navbar-item" href="{{ url('/') }}">Home</a>
                    <a class="navbar-item" href="{{ url('membership') }}">Membership</a>
                    @guest
                        <a class="navbar-item" href="{{ url('login') }}">Sign in</a>
                        <div class="navbar-item">/</div>
                        <a class="navbar-item" href="{{ url('register') }}">Sign up</a>
                        <a class="navbar-item" href="{{ url('register') }}">Submit listing</a>
                    @else
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="/documentation/overview/start/">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="navbar-dropdown is-boxed">
                                <a class="navbar-item" href="{{ url('dashboard') }}">
                                    <i class="fas fa-user-cog"></i> &nbsp;
                                    Dashboard
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="{{ route('logout') }}"
                                    onclick = "event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> &nbsp;
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <div style="min-width: 100px;">&nbsp;</div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer></footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
</body>
</html>
