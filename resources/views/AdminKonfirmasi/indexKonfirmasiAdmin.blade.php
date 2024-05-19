@extends('navbarMO')
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
                    <h1 class="m-0" style="color:black">Konfirmasi Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Konfirmasi Pesanan</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show List Pesanan</li>
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
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No Transaksi</th>

                                            <th class="text-center">Foto Produk</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Jumlah </th>
                                            <th class="text-center">Total Bayar</th>
                                            <th class="text-center">Bukti Transfer</th>
                                            <th class="text-center">Pembayaran</th>

                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center">101</td>

                                            <td class="text-center"><img src="{{ asset('images/hampers2.jpg') }}"
                                                    alt="Iklan 3" style="width: 150px; height: auto;" /></th>
                                            </td>
                                            <td class="text-center">Hampers</td>
                                            <td class="text-center">1 Paket A</td>
                                            <td class="text-center">Rp. 1.000.000</td>
                                            <td class="text-center"><img src="{{ asset('images/buktiTF.jpg') }}"
                                                    alt="Iklan 3" style="width: 150px; height: auto;" /></th>
                                            </td>
                                            <td class="text-center">Rp. 2.000.000</td>

                                            <td class="text-center"><span
                                                    class="badge rounded-pill text-bg-danger"></span>

                                                <span class="badge text-bg-secondary">Secondary</span>
                                                <span class="badge text-bg-success">Success</span>
                                            </td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#"
                                                    method="POST">
                                                    <a href="#" class="btn btn-sm btn-primary">Terima</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                                </form>
                                            </td>
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