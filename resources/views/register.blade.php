@extends('navbarLogin')

@section('content')
<style>
    body {
        background-color: #F9F9F7;
        background-image: url('/images/bg1.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100vh;
        /* Mengatur tinggi body sesuai tinggi layar */
        overflow-y: auto;
        /* Membuat body dapat di-scroll jika konten melebihi tinggi layar */
    }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin-top: 80px;
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
            <h2><b>Register</b></h2>
            <p style="text-align: center;">Selamat datang di Dunia Manis kami! Temukan kelezatan yang tersembunyi di setiap klik. Ayo masuk ke dalam dunia kue dan roti yang penuh cita rasa</p>
            <div class="login-box">
                @if(session('error'))
                <div class="alert alert-danger">
                    <b>waduh!</b> {{ session('error') }}
                </div>
                @endif

                <form action="{{url('/login')}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="Nama" name="Nama" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="Email" name="Email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" type="Phone Number" name="Phone Number" placeholder="Enter your phone number" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button class="btn btn-edit" type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection