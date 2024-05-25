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

    .btn-green {
        background-color: green;
        color: white;
        border: none;
    }


    .isi {
        border-radius: 15px;
        padding: 8px;
        background-color: #AD343E;
        color: white;
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
    <div class="container-fluid px-4 px-md-5 text-lg-start" style="margin-bottom: 5px;">
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="container-fluid mt-4 text-center">
                    <div class="container-fluid mt-5 isi text-center" style="margin-top: 40px;">
                        <div class=" row mt-1 text-center mb-3">
                            <div class="col mt-5">
                                <h3>My Profile</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <div class="profil">
                                    @if ($user->image)
                                        <img src="{{ Storage::url($user->image) }}" alt="profile">
                                    @else
                                        <img src="{{ asset('images/20240416153955.jpeg') }}" alt="default-profile">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 text-center">
                            <div class="col">
                                <h4>{{$user->nama}}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>Username</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                <p>{{$user->username}}</p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>Email</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>No Telpon</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                <p>{{$user->noTelpon}}</p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>Poin Ku</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                @if ($user->poin_customer == null)
                                    <p>0</p>
                                @else
                                    <p>{{$user->poin_customer}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>Saldo Ku</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                @if ($user->saldo_customer == null)
                                    <p>Rp . 0</p>
                                @else
                                    <p>Rp. {{$user->saldo_customer}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3 ms-3">
                                <h4>Alamat Ku</h4>
                            </div>
                            <div class="col-2">
                                <p>:</p>
                            </div>
                            <div class="col-5">
                                @if (!$alamat)
                                    <div class="alert alert-danger" style="width: 380px; height:40px" role="alert">
                                        <p class="text-center">Silahkan Set Alamat Aktif Terlebih Dahulu!</p>
                                    </div>
                                @else
                                    <p>{{$alamat->alamat_customer}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                                <a class="btn btn-primary" style="text-decoration: none; color: white"
                                    href="{{route('customer.edit', $user->id_customer)}}">Edit</a>
                                <a class="btn btn-success" style="text-decoration: none; color: white"
                                    href="{{ url('/narikSaldo') }}">Tarik Saldo</a>



                            </div>

                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('message'))
                            <div class="alert alert-success" role="alert">
                                {{session('message')}}
                            </div>
                        @endif
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