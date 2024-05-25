@extends('navbarLandingPage')
@section('content')

<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .card {
        margin-top: 2rem;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: black;">Tarik Saldo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Saldo</a></li>
                    <li class="breadcrumb-item active">Tarik Saldo</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Customer</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Penarikan</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Rekening Tujuan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Rekening Tujuan">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Penarikan</label>
                                <input type="number" class="form-control" placeholder="Masukkan Jumlah Penarikan">
                            </div>


                            <button type="submit" class="btn btn-md btn-primary d-block mx-auto">Tarik Saldo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection