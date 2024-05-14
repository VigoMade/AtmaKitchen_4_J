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
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('penitip.update',$penitip->id_penitip)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Penitip</label>
                                        <input type="text" class="form-control @error('nama_penitip') is-invalid @enderror" name="nama_penitip" value="{{ old('nama_penitip',$penitip->nama_penitip) }}" placeholder="Masukkan Nama Penitip">
                                        @error('nama_penitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Nama Produk Penitip</label>
                                        <input type="text" class="form-control @error('nama_produk_penitip') is-invalid @enderror" name="nama_produk_penitip" value="{{old('nama_produk_penitip',$penitip->nama_produk_penitip) }}" placeholder="Masukkan Nama Produk Penitip">
                                        @error('nama_produk_penitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Jumlah Produk Penitip</label>
                                        <input type="number" class="form-control @error('jumlah_produk_penitip') is-invalid @enderror" name="jumlah_produk_penitip" value="{{old('jumlah_produk_penitip',$penitip->jumlah_produk_penitip) }}" placeholder="Masukkan Jumlah Produk Penitip">
                                        @error('jumlah_produk_penitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Jenis Produk Penitip</label>
                                        <select class="form-control @error('jenis_produk_penitip') is-invalid @enderror" name="jenis_produk_penitip">
                                            <option value="">Pilih Jenis Produk Penitip</option>
                                            <option value="bread" {{ old('jenis_produk_penitip', $penitip->jenis_produk_penitip) == 'bread' ? 'selected' : '' }}>Bread</option>
                                            <option value="cake" {{ old('jenis_produk_penitip', $penitip->jenis_produk_penitip) == 'cake' ? 'selected' : '' }}>Cake</option>
                                            <option value="drink" {{ old('jenis_produk_penitip', $penitip->jenis_produk_penitip) == 'drink' ? 'selected' : '' }}>Drink</option>
                                            <option value="Other" {{ old('jenis_produk_penitip', $penitip->jenis_produk_penitip) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('jenis_produk_penitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Foto Produk Penitip</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{old('image') }}">
                                        @error('image')
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