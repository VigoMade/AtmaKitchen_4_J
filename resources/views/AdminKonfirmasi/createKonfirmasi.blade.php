@extends('navbarAdmin')
@section('content')


<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }
</style>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: black;">
                        Konfirmasi Pembayaran
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Pembayaran</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Konfirmasi
                        </li>
                    </ol>
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- header -->
    <!-- content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('konfirmasiPembayaran.store',$transaksi->id_transaksi)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12 d-flex justify-content-center">
                                        <label class="font-weight-bold">Bukti Bayar Customer</label>
                                    </div>
                                    <div class="form-group col-md-12 d-flex justify-content-center">
                                        <img class="form-control" src="{{ Storage::url($transaksi->bukti_bayar) }}" alt="Iklan 3" style="max-width: 50%; height: auto;" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Nama Customer</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama',$transaksi->nama) }}" placeholder="Masukkan Nama" disabled>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Alamat Customer</label>
                                        <input type="text" class="form-control @error('alamat_customer') is-invalid @enderror" name="alamat" value="{{ old('nama',$transaksi->alamat_customer) }}" placeholder="Masukkan Alamat" disabled>
                                        @error('alamat_customer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Nama Produk</label>
                                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk',$transaksi->nama_produk) }}" placeholder="Masukkan Nama" disabled>
                                        @error('nama_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Jumlah Pembelian Produk</label>
                                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="jumlah_produk" value="{{ old('jumlah_produk',$transaksi->jumlah_produk) }}" placeholder="Masukkan Nama" disabled>
                                        @error('jumlah_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Harga total Produk</label>
                                        <input type="text" class="form-control @error('total_pembayaran') is-invalid @enderror" name="total_pembayaran" value="{{ old('total_pembayaran',$transaksi->total_pembayaran) }}" placeholder="Masukkan Total" disabled>
                                        @error('total_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Total Pembayaran Customer</label>
                                        <input type="number" class="form-control @error('total_pemasukan') is-invalid @enderror" name="total_pemasukan" value="{{ old('total_pemasukan') }}" placeholder="Masukkan Total Pemasukkan">
                                        @error('total_pemasukan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-block btn-primary">Konfirmasi</button>
                                </div>
                            </form>
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