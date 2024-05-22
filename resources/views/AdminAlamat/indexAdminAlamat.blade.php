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
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No Transaksi</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Ongkir</th>
                                            <th class="text-center">Total Harga Pesanan</th>
                                            <th class="text-center">Jarak</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        @forelse($transaksi as $trans)
                                        <tr>
                                            <td class="text-center">{{$trans->id_transaksi}}</td>
                                            <td class="text-center">{{$trans->nama_produk}}</td>
                                            <td class="text-center">{{$trans->alamat_customer}}</td>
                                            @if($trans->ongkos_kirim == null)
                                            <td class="text-center">Rp. 0</td>
                                            @else
                                            <td class="text-center">Rp. {{$trans->ongkos_kirim}}</td>
                                            @endif
                                            <td class="text-center">Rp. {{$trans->total_pembayaran}}</td>
                                            @if($trans->jarak == null)
                                            <td class="text-center">--</td>
                                            @else
                                            <th class="text-center">{{$trans->jarak}}</th>
                                            @endif
                                            <th class="text-center">
                                                <a href="{{route('createJarak',$trans->id_transaksi)}}" class="btn btn-success">
                                                    <i class="fas fa-plus"></i>Tambah Jarak
                                                </a>
                                            </th>

                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Belum ada yang belanja!
                                        </div>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            {{$transaksi->links()}}
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