@extends('navbarLandingPage')
@section('content')

<style>
    body {
        background-color: #F9F9F7;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .card {
        width: 500px;
        height: auto;
        background-color: #04192E;
        border: none;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        padding: 20px;
    }




    .pencil {
        width: 15px;
        height: 15px;
        cursor: pointer;
    }

    .btn-edit {
        width: 100px;
        height: 40px;
        border-radius: 8px;
        background-color: #2E86C1;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #1A5276;
    }



    .isi {
        border-radius: 15px;
        padding: 8px;
        border: 1px solid #AD343E;
    }

    .profil img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
    }

    .isi h4 {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .isi p {
        font-size: 15px;
        margin-bottom: 0;
    }
</style>

<body>
    <div class="container-fluid px-4 px-md-5 text-lg-start">
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="container-fluid mt-4 text-center">
                    <form action="{{ route('customer.update', $user->id_customer) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container-fluid mt-5 isi text-center" style="margin-top: 40px;">
                            <div class=" row mt-1 text-center mb-3">
                                <div class="col mt-5">
                                    <h3>My Profile</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    @if ($user->image == null)
                                    <div class="profil">
                                        <img src="{{ url('images/20240416153955.jpeg') }}" alt="">
                                    </div>
                                    @else
                                    <div class="profil">
                                        <img src="/images/{{ $user->image }}" alt="profile">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3 text-center">
                                <div class="col">
                                    <h4>{{$user->nama}}</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-3 ms-3">
                                    <h4>Foto Profile</h4>
                                </div>
                                <div class="col-2">
                                    <p>:</p>
                                </div>
                                <div class="col-5">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $user->image) }}">
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 ms-3">
                                    <h4>Nama</h4>
                                </div>
                                <div class="col-2">
                                    <p>:</p>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->nama) }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 ms-3">
                                    <h4>Username</h4>
                                </div>
                                <div class="col-2">
                                    <p>:</p>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 ms-3">
                                    <h4>Email</h4>
                                </div>
                                <div class="col-2">
                                    <p>:</p>
                                </div>
                                <div class="col-5">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 ms-3">
                                    <h4>No Telpon</h4>
                                </div>
                                <div class="col-2">
                                    <p>:</p>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control @error('noTelpon') is-invalid @enderror" name="noTelpon" value="{{ old('noTelpon', $user->noTelpon) }}">
                                    @error('noTelpon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="row mt-2">
                                    <div class="col text-center">
                                        <button type="submit" class="btn-edit mb-2 mt-3">Save</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top:50px;">
                <div class="card-message mb-5 mt-5">
                    <img src="{{ url('images/logo3.png') }}" class="img-fluid" alt="" width="400px">
                    <div class="card-body text-center">
                        <h1 class="card-title mr-4 ml-4">Hello, {{ $user->nama }}!</h1>
                        <p style="margin-bottom: 30px" class="card-text">Ensure Your Data is Secure!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>