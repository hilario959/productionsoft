<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>mrpbase | {{ config('app.name', 'mrpbase') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fafad05c14.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="/modules/tabulator-tables/dist/css/bootstrap/tabulator_bootstrap4.min.css" rel="stylesheet">

    @stack('styles')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/modules/tabulator-tables/dist/js/tabulator.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-tachometer-alt text-primary"></i>
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('production.index') }}">
                                <i class="fas fa-industry text-secondary"></i>
                                {{ __('Productions') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.index') }}">
                                <i class="fas fa-list text-success"></i>
                                {{ __('Orders') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.index') }}">
                                <i class="fas fa-users text-info"></i>
                                {{ __('Clients') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">
                                <i class="fas fa-layer-group text-warning"></i>
                                {{ __('Products') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('material.index') }}">
                                <i class="fas fa-box text-danger"></i>
                                {{ __('Materials') }}
                            </a>
                        </li>
                        <li class="nav-item">
                    @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="btn-group mr-2">
                              <button class="btn btn-primary py-0 btn-sm" onclick="location.href='{{ url('home/order/create') }}'" type="button">
                                {{ __('Add Order') }}
                              </button>
                              <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only"></span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" onclick="location.href='{{ url('home/production/create') }}'" type="button">{{ __('Create Production') }}</button>
                                <button class="dropdown-item" onclick="location.href='{{ url('home/client/create') }}'" type="button">{{ __('Add Client') }}</button>
                                <button class="dropdown-item" onclick="location.href='{{ url('home/product/create') }}'" type="button">{{ __('Add Product') }}</button>
                              </div>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')

    <script>
      window.addEventListener("load", function() {
        if(document.getElementById('tabulator') != null){
          var table = new Tabulator("#tabulator", {
            layout:"fitColumns",
            movableColumns:true,
            pagination:"local",
            paginationSize:10,
            initialSort:[
              {column:"code", dir:"desc"},
            ]
          });
        }
      },false);
    </script>

    @stack('scripts')
</body>
</html>
