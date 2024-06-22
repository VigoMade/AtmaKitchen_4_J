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
                    <h1 class="m-0" style="color:black">Gaji</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Gaji</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show Gaji</li>
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
                            @if(session('error'))
                            <div id="errorAlert" class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            @if(session('success'))
                            <div id="successAlert" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Laporan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start">Laporan Penjualan Bulanan Secara Keseluruhan</td>
                                            <td class="text-center">
                                                <a href="{{route('laporanPenjualanBulanan')}}" class="btn btn-primary">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Penjualan Bulanan Per Produk</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal15">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Stok Bahan Baku</td>
                                            <td class="text-center">
                                                <a href="{{route('laporanStockBB')}}" class="btn btn-primary">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Penggunaan Bahan Baku Per Periode</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Presensi dan Gaji Pegawai Bulanan</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Pemasukan dan Pengeluaran Bulanan</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Rekap Transaksi Penitip</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Laporan Jumlah Transaksi user</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal10">Cetak Laporan</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
</body>
<!-- Modal Laporan Pemasukan Pengeluaran -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporanPemasukanPengeluaran')}}" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan:</label>
                        <input type="month" id="bulan" name="bulan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Presensi -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporanPresensi')}}" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan:</label>
                        <input type="month" id="bulan" name="bulan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Penitip -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporanPenitip')}}" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan:</label>
                        <input type="month" id="bulan" name="bulan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Laporan Modal Penggunaan BB -->

<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('laporanPenggunaanBB') }}" method="GET" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="bulan_awal" class="form-label">Pilih Bulan Awal:</label>
                        <input type="month" id="bulan_awal" name="bulan_awal" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="bulan_akhir" class="form-label">Pilih Bulan Akhir:</label>
                        <input type="month" id="bulan_akhir" name="bulan_akhir" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Laporan Modal Penjualan Produk -->

<div class="modal fade" id="exampleModal15" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Laporan Bulan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporanLaporan')}}" method="GET" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Pilih Bulan:</label>
                        <input type="month" id="bulan" name="bulan" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukan Laporan Tahunan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporanJumlahTransaksi')}}" method="GET" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Pilih Tahun:</label>
                        <input type="number" id="tahun" name="tahun" class="form-control" placeholder="Masukkan Tahun" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection