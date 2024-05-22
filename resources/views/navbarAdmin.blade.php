<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="{{ asset('images/logo4.png') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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

        .dropdown-toggle.active {
            background-color: white !important;
            border: 2px solid #AD343E !important;
            color: #AD343E !important;
            transform: scale(1.1);
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light" style="background-color: #AD343E!important;">
        <div class="container">
            <a class="navbar-brand" href="#"><img id="MDB-logo" src="{{ asset('images/logo4.png') }}" alt="MDB Logo" draggable="false" /></a>
            <h1>Atma Kitchen</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color: white;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item {{ Request::routeIs('landingPageAdmin') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{ route('landingPageAdmin') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('produks.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('produks.index')}}">Produk</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('reseps.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('reseps.index')}}">Resep</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('bahanBaku.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('bahanBaku.index')}}">Bahan Baku</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('hampers.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('hampers.index')}}">Hampers</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('dataCust.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('dataCust.index')}}">Data Customer</a>
                    </li>


                    <li class="nav-item {{ Request::routeIs('history.*') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{route('history.index')}}">History Customer</a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="btn btn-rounded dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Konfirmasi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('indexJarak')}}">Jarak</a></li>
                                <li><a class="dropdown-item" href="{{route('konfirmasiPembayaran.index')}}">Pembayaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <span style="margin-right: 10px;"></span>
                    <li class="nav-item ">
                        @if(auth()->guard('pegawai')->check())
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var dropdownToggle = document.querySelector('.dropdown-toggle');

        dropdownToggle.addEventListener('click', function() {
            var btn = this;
            if (!btn.classList.contains('active')) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    });
</script>

</html>