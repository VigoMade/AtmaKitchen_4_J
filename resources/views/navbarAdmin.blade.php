<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.18.0/font/bootstrap-icons.css">

    <style>
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

        body {
            background-image: url('/images/bg1.jpg');
        }

        .nav-item.active .nav-link {
            color: white !important;
            font-weight: bold;
            text-decoration: underline;
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
                    <li class="nav-item {{ Request::is('indexProduk') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{url('/indexProduk')}}">Produk</a>
                    </li>
                    <li class="nav-item {{ Request::is('indexResep') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{url('/indexResep')}}">Resep</a>
                    </li>
                    <li class="nav-item {{ Request::is('indexBahan') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{url('/indexBahan')}}">Bahan Baku</a>
                    </li>
                    <li class="nav-item {{ Request::is('hampers') ? 'active' : '' }}">
                        <a class="nav-link mx-2" href="{{url('hampers')}}">Hampers</a>
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

</html>