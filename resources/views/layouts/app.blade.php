<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BoolBnB') }}</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    
    @yield('scripts')
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <header> 
        <div class="container-fluid header">
            <div class="header__left">
                <a class="header__logo" href="{{ url('/') }}">
                    {{ config('app.name', 'BoolBnB') }}
                </a>
            </div>
            <div class="header__right">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item">
                            <a class="navigation__link"  href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="navigation__item">
                            <a class="navigation__link" href="{{ route('search') }}">Ricerca</a>
                        </li>

                        @guest
                            <li class="navigation__item">
                                <a class="navigation__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="navigation__item">
                                    <a class="navigation__link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul> 

                        @else
                            <li class="navigation__item">
                                <a href="{{ route('admin.apt.index') }}" class="navigation__link">Appartamenti</a>
                            </li>
                            <li class="navigation__item">
                                <a href="{{ route('logout') }}" class="navigation__link" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul> 

                        @php
                            // taking logged in user initials
                            $user_name = Auth::user()->name;
                            $user_name_array = explode(" ", $user_name);
                            $initials = '';

                            if ( count($user_name_array) > 0 ) {
                                foreach ($user_name_array as $word) {
                                    $initials = $initials . $word[0];
                                }
                            }

                        @endphp

                        <div class="navigation__user">
                            <span class="navigation__user--name">{{ $initials }}</span>
                        </div>

                        @endguest

                    <div class="spaghetti">
                        <span class="spaghetti__center"></span>
                    </div>
                </nav>               
            </div>
        </div>

        <div class="phone-menu">
            <ul class="phone-menu__list">
                <li class="phone-menu__item">
                    <a class="phone-menu__link" href="{{ route('search') }}">Ricerca</a>
                </li>

                @guest
                    <li class="phone-menu__item">
                        <a class="phone-menu__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="phone-menu__item">
                            <a class="phone-menu__link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
                @else
                    <li class="phone-menu__item">
                        <a href="{{ route('admin.apt.index') }}" class="phone-menu__link">Appartamenti</a>
                    </li>
                    <li class="phone-menu__item">
                        <a href="{{ route('logout') }}" class="phone-menu__link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul> 
                @endguest
        </div>  


    </header>

    <div class="overlay"></div>

        <main>
            @yield('content')
        </main>
    </div>
    <footer class="footer page-footer">

        <div class="footer-copyright text-center py-3">© 2019 Copyright 
          <a href="https://mdbootstrap.com/education/bootstrap/"> BoolBnB</a>
        </div>
      
      </footer>
</body>
</html>
