@extends('navbarMO')
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
                        Edit Pengeluaran
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Pengeluaran Lainnya</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit
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
                            <form action="{{route('pengeluaranLainnya.update',$pengeluaran->id_pengeluaran)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Pengeluaran Lainnya</label>
                                        <input type="text" class="form-control @error('nama_pengeluaran_lainnya') is-invalid @enderror" name="nama_pengeluaran_lainnya" value="{{ old('nama_pengeluaran_lainnya',$pengeluaran->nama_pengeluaran_lainnya) }}" placeholder="Masukkan nama_pengeluaran_lainnya">
                                        @error('nama_pengeluaran_lainnya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Biaya Pengeluaran Lainnya</label>
                                        <input type="text" class="form-control @error('biaya_pengeluaran_lainnya') is-invalid @enderror" name="biaya_pengeluaran_lainnya" value="{{old('biaya_pengeluaran_lainnya',$pengeluaran->biaya_pengeluaran_lainnya) }}" placeholder="Masukkan Nama Produk Penitip">
                                        @error('biaya_pengeluaran_lainnya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Tanggal Pengeluaran Lainnya</label>
                                        <input type="datetime-local" class="form-control @error('tanggal_pengeluaran_lainnya') is-invalid @enderror" name="tanggal_pengeluaran_lainnya" value="{{old('tanggal_pengeluaran_lainnya',$pengeluaran->tanggal_pengeluaran_lainnya) }}" placeholder="Masukkan Jumlah Produk Penitip">
                                        @error('tanggal_pengeluaran_lainnya')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
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