@extends('navbarAdmin')
@section('content')
<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 13.5%;
    }

    .btn-tambah-resep:hover {
        transform: scale(1.1);
        background-color: white;
        color: #198754;
        border-radius: 2px solid #198754;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .btn-danger:hover {
        transform: scale(1.1);
        background-color: white;
        color: #dc3545;
        border-radius: 2px solid #dc3545;
        transition: transform 0.3s ease;
    }
</style>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color:black">Alamat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Alamat</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show Alamat</li>
                </div>
                <!-- /.col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{url('/createJarak')}}" class="btn btn-md btn-success mb-3 btn-tambah-resep">Input
                                Jarak</a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No Transaksi</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Total Harga Pesanan</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Jarak</th>
                                            <th class="text-center">Ongkir</th>
                                            <th class="text-center">Tota Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">10</td>
                                            <td class="text-center">Paket C</td>
                                            <td class="text-center">Rp. 100.000</td>
                                            <td class="text-center">Jl. Pemuda Indah</td>
                                            <td class="text-center">10 km</td>
                                            <td class="text-center">Rp. 15.000</td>
                                            <td class="text-center">Rp. 115.000</td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- body -->
                    </div>
                    <!-- card -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
</body>

@endsection