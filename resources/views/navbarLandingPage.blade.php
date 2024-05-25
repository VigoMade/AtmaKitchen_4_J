<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Kitchen</title>
    <link rel="icon" href="{{ asset('images/logo4.png') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.18.0/font/bootstrap-icons.css">

    <style>
        .nav-item.active .nav-link {
            color: white !important;
            font-weight: bold;
            text-decoration: underline;
        }

        .navbar {
            padding: 0 1.5rem;
        }

        .navbar-brand {
            margin-right: 1rem;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: white;
            font-size: 2.5rem;
            margin: 0;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #FFFFFF;
        }

        .nav-item:hover .nav-link {
            transform: scale(1.1);
            color: #F59794;
        }

        .nav-item .nav-link {
            transition: transform 0.3s ease, color 0.3s ease;
        }


        .nav-item .btn {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 0.5rem 0.5rem;
            font-size: 0.8rem;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }

        .nav-item .btn:hover {
            background-color: white;
            border: 2px solid #AD343E;
            color: #AD343E;
            transform: scale(1.1);
        }

        #MDB-logo {
            height: 70px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: white;
            font-size: 2.5rem;
        }

        .footer-link {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .footer .input-group .form-control {
            background-color: #AD343E;
            border-color: #FFFFFF;
        }

        .footer .input-group .btn {
            background-color: #FFFFFF;
            color: #AD343E;
        }

        .foot {
            background-color: #AD343E;
            color: white;
            padding: 3rem 0;
            margin-left: -197px;
            width: 130.3% !important;
        }

        .nav-item.active .btn.btn-rounded {
            background-color: white;
            border-color: #AD343E;
            color: #AD343E;
        }


        @media (max-width: 720px) {

            .foot {
                margin-top: 150px;
                margin-left: -100px;

                background-color: #AD343E;
                color: white;
                padding: 3rem 0;

                width: 140% !important;
            }

        }

        @media (max-width: 1000px) {

            .foot {
                margin-top: 150px;
                margin-left: -93px;

                background-color: #AD343E;
                color: white;
                padding: 3rem 0;

                width: 140% !important;
            }

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light" style="background-color: #AD343E!important;">
        <div class="container">
            <a class="navbar-brand" href="#"><img id="MDB-logo" src="{{ asset('images/logo4.png') }}" alt="MDB Logo"
                    draggable="false" /></a>
            <h1>Atma Kitchen</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color: white;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item {{ Request::routeIs('landingPageCustomer') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{ route('landingPageCustomer') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('informasiUmum') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('informasiUmum')}}">Menu</a>
                    </li>
                    <li class="nav-item {{ Request::is('store') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('store')}}">Store</a>
                    </li>
                    <li class="nav-item {{ Request::is('aboutUs') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{ route('aboutUs') }}">About</a>
                    </li>

                    @if(auth()->guard('customer')->check())
                        <li class="nav-item {{ Request::routeIs('customer.*') ? 'active' : '' }}">
                            <a class="nav-link mx-2" href="{{route('customer.index')}}">My Profile</a>
                        </li>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <li class="nav-item {{ Request::routeIs('alamat.*') ? 'active' : '' }}">
                            <a class="nav-link mx-2" href="{{route('alamat.index')}}">My Address</a>
                        </li>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <li class="nav-item {{ Request::routeIs('historyCustomer.*') ? 'active' : '' }}">
                            <a class="nav-link mx-2" href="{{route('historyCustomer.index')}}">My Transaction</a>
                        </li>
                    @endif
                    @if(auth()->guard('customer')->check())
                        <li class="nav-item {{ Request::is('indexHistorySaldo') ? 'active' : '' }}">
                            <a class="nav-link mx-2" href="{{ url('/indexHistorySaldo') }}">History Saldo</a>
                        </li>
                    @endif


                    @if(auth()->guard('customer')->check())
                        <li class="nav-item {{ Request::routeIs('transaksi.*') ? 'active' : '' }}">
                            <a class="btn btn-rounded" href="{{route('transaksi.index')}}"> Cart <img
                                    src="{{ asset('images/cart.png') }}" alt="Deskripsi Gambar"
                                    style="margin-right: 5px; width: 20px;">
                            </a>
                        </li>
                    @endif
                    <span style="margin-right: 10px;"></span>
                    <li class="nav-item ">
                        @if(auth()->guard('customer')->check())
                            <a class="btn btn-rounded" href="{{route('actionLogout')}}">Log Out</a>
                        @else
                            <a class="btn btn-rounded" href="{{url('/login')}}">Sign in</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

<footer class="w-100 foot">
    <div class="container">
        <div class="row gy-4 gx-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="h1 text-white">Atma Kitchen</h5>
                <p class="small text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt.</p>
                <p class="small text-white mb-0">&copy; 2024. All rights reserved. <a href="#"
                        class="footer-link">Bootstrapious.com</a></p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">Quick links</h5>
                <ul class="list-unstyled text-white">
                    <li><a href="#" class="footer-link">Home</a></li>
                    <li><a href="#" class="footer-link">About</a></li>
                    <li><a href="#" class="footer-link">Get started</a></li>
                    <li><a href="#" class="footer-link">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">Services</h5>
                <ul class="list-unstyled text-white">
                    <li><a href="#" class="footer-link">Catering</a></li>
                    <li><a href="#" class="footer-link">Delivery</a></li>
                    <li><a href="#" class="footer-link">Custom Orders</a></li>
                    <li><a href="#" class="footer-link">Special Events</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Newsletter</h5>
                <p class="small text-white">Stay updated with our latest news and offers.</p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input class="form-control" type="email" placeholder="Your email" aria-label="Your email"
                            aria-describedby="button-addon2">
                        <button class="btn btn-primary" id="button-addon2" type="button"><i
                                class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
                <div class="social-icons">
                    <a href="#" class="footer-link me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-link me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-link me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>