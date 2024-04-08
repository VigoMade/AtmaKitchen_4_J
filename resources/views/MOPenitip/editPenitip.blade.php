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
                        Edit Penitip
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Penitip</a>
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
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Penitip</label>
                                        <input type="text" class="form-control @error('namaPenitip') is-invalid @enderror" name="namaPenitip" value="{{ old('namaPenitip') }}" placeholder="Masukkan Nama Penitip">
                                        @error('namaPenitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Nama Produk Penitip</label>
                                        <input type="text" class="form-control @error('produkPenitip') is-invalid @enderror" name="produkPenitip" value="{{old('produkPenitip') }}" placeholder="Masukkan Nama Produk Penitip">
                                        @error('produkPenitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Jumlah Produk Penitip</label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{old('jumlah') }}" placeholder="Masukkan Jumlah Produk Penitip">
                                        @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Jenis Produk Penitip</label>
                                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis" value="{{old('jenis') }}" placeholder="Masukkan Jenis Produk Penitip">
                                        @error('jenis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Foto Produk Penitip</label>
                                        <input type="file" class="form-control @error('fotoProdukPenitip') is-invalid @enderror" name="fotoProdukPenitip" value="{{old('fotoProdukPenitip') }}">
                                        @error('fotoProdukPenitip')
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