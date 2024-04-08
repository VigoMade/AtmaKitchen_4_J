@extends('navbarLogin')

@section('content')
<style>
    body {
        background-color: #F9F9F7;
        background-image: url('/images/bg1.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-box {
        background-color: #F9F9F7;
        border: 1px solid #ccc;
        border-radius: 10px;
        width: 120%;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin-left: -30px;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        font-style: bold;
        font-size: 2.5rem;
        color: black;
        text-align: center;
        margin-bottom: 20px;
    }

    p,
    a {
        font-family: 'DM Sans', sans-serif;
        size: 18px;
    }

    .btn-edit {
        display: block;
        border-radius: 10px;
        background-color: #AD343E;
        margin: 20px auto 0;
        width: 70%;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        transform: scale(1.05);

    }

    .btn-edit:hover {
        background-color: transparent;
        border-color: #AD343E;
        color: #AD343E;
        transform: scale(1.05);
    }
</style>

<body>

    <div class="container center-container">
        <div class="col-md-4">
            <h2><b>Login</b></h2>
            <p style="text-align: center;">Selamat datang di Dunia Manis kami! Temukan kelezatan yang tersembunyi di setiap klik. Ayo masuk ke dalam dunia kue dan roti yang penuh cita rasa</p>
            <div class="login-box">
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>waduh!</b> {{ session('error') }}
                </div>
                @endif

                <form>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button class="btn btn-edit" type="submit">Login</button>
                    <hr>
                    <p class="text-center">Belum Punya akun? <a href="{{url('/register')}}" style="text-decoration: none; color:black; font-weight:bold;">Daftar Sekarang</a></p>
                </form>
            </div>
        </div>
    </div>
</body>




@endsection