<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"
        rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    {{-- Ini CSS dan JS SweetAlert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/povover.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @yield('scripku')

</head>
<style>
    body {
        margin-top: 60px;
    }

    .logo {
        margin-top: -15px;
        margin-bottom: -15px
    }

    .logo-login {
        margin-top: -15px;
        margin-bottom: 5px
    }

    .navbar-dark .navbar-nav .nav-link {
        color: hsla(0, 21%, 96%, 0.78);
    }

    body {
        background: url("/images/login/bg.jpg") no-repeat center center fixed;
        /* margin-top: 40px; */
        min-height: 100%;
        min-width: 1024px;
        background-size: contain;
        background-size: cover;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand logo" href="{{ url('/home') }}">
                    <img src="images/login/logo2.png" width="120">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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

                        @else
                        @hasanyrole('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('createOrder*') ? 'active' : '' }}"
                                href="{{route('create.Order')}}"><i class="fa fa-shopping-cart"></i> Create Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('daftarOrder*') ? 'active' : '' }}"
                                href="{{route('daftarOrder')}}"><i class="fa fa-shopping-basket"></i> Orders</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('getUpload*') ? 'active' : '' }}"
                        href="{{route('getUpload')}}">Image Upload</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('daftarproduk*') ? 'active' : '' }}"
                                href="{{route('daftar.produk')}}"><i class="fa fa-tags"></i> Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('daftaruser*') ? 'active' : '' }}"
                                href="{{route('daftaruser')}}"><i class="fa fa-users"></i> User</a>
                        </li>
                        <li class="nav-item dropdown" onclick="markNotificationAsRead()">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-bell"></i> Notifikasi
                                <span class="badge">{{count(auth()->user()->unreadNotifications)}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"">
                                @forelse (auth()->user()->unreadNotifications as $notification)
                                @include('layouts.notification.'.snake_case(class_basename($notification->type)))
                                @empty
                                <a href=" #" class=" dropdown-item">Tidak ada notifikasi bosque!!!</a>
                                @endforelse

                            </div>
                        </li>
                        @endrole
                        <li class=" nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
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
            @include('sweet::alert')
            @yield('content')
        </main>

    </div>

</body>
<script>
    //     Swal.fire(
//   'The Internet?',
//   'That thing is still around?',
//   'question'
// );
</script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
{{-- Javascript Date Range Controller --}}
<script src="{{ asset('js/datarange.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datauser.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dataproduk.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datapost.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datapesanan.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/kembalian.js') }}" type="text/javascript"></script>

<script>
    $('#rolep').select2();
    // $('input.divide').number( true, 2 );
    
</script>

</html>