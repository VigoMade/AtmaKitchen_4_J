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
                        Tambah Bahan Baku
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Bahan Baku</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Create
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
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('bahanBaku.update',$bahanBaku->id_bahan_baku)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Bahan Baku</label>
                                        <input type="text" class="form-control @error('nama_bahan_baku') is-invalid @enderror" name="nama_bahan_baku" value="{{ old('nama_bahan_baku',$bahanBaku->nama_bahan_baku) }}" placeholder="Masukkan Nama Bahan Baku">
                                        @error('nama_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Stock Bahan Baku</label>
                                        <input type="number" class="form-control @error('takaran_baahan_baku_tersedia') is-invalid @enderror" name="takaran_bahan_baku_tersedia" value="{{old('takaran_bahan_baku_tersedia', $bahanBaku->takaran_bahan_baku_tersedia) }}" placeholder="Masukkan stock Bahan Baku">
                                        @error('takaran_bahan_baku_tersedia')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Satuan Bahan Baku</label>
                                        <input type="text" class="form-control @error('satuan_bahan_baku') is-invalid @enderror" name="satuan_bahan_baku" value="{{old('satuan_bahan_baku', $bahanBaku->satuan_bahan_baku) }}" placeholder="Masukkan satuan Bahan Baku">
                                        @error('satuan_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Simpan Edit</button>
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