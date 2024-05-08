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
                        Tambah Resep
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Resep</a>
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
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('reseps.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Resep</label>
                                        <input type="text" class="form-control @error('nama_resep') is-invalid @enderror" name="nama_resep" value="{{ old('nama_resep') }}" placeholder="Masukkan Nama Resep">
                                        @error('nama_resep')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Deskripsi Resep</label>
                                        <input type="text" class="form-control @error('deskripsi_resep_produk') is-invalid @enderror" name="deskripsi_resep_produk" value="{{ old('deskripsi_resep_produk') }}" placeholder="Masukkan Deskripsi Resep">
                                        @error('deskripsi_resep_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold" for="id_bahan_baku">Masukkan Bahan Baku</label>
                                        <select class="form-control @error('id_bahan_baku') is-invalid @enderror" name="id_bahan_baku">
                                            <option value="">Pilih Bahan Baku</option>
                                            @foreach ($bahanBaku as $item)
                                            <option value="{{ $item->id_bahan_baku }}" {{ old( isset($resep) ? $resep->id_bahan_baku : '') == $item->id_bahan_baku ? 'selected' : '' }}>
                                                {{ $item->nama_bahan_baku }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Total Penggunaan</label>
                                        <input type="number" class="form-control @error('total_penggunaan_bahan') is-invalid @enderror" name="total_penggunaan_bahan" value="{{old('total_penggunaan_bahan') }}" placeholder="Masukkan Total penggunaan">
                                        @error('total_penggunaan_bahan')
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