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
                    <h1 class="m-0" style="color: black;">Tambah Pembelian Bahan Baku</h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Pembelian Bahan Baku</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
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
                                    <label class="font-weight-bold">Nama Bahan Baku</label>
                                    <select class="form-control @error('namaPenitip') is-invalid @enderror" name="namaPenitip">
                                        <option value="">Pilih Nama Bahan Baku</option>
                                        <option value="bahan1" {{ old('namaPenitip') == 'bahan1' ? 'selected' : '' }}>Butter</option>
                                        <option value="bahan2" {{ old('namaPenitip') == 'bahan2' ? 'selected' : '' }}>Tepung</option>
                                            </select>
                                    @error('namaPenitip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Harga Bahan Baku</label>
                                        <input type="text" class="form-control @error('harga_bahan_baku') is-invalid @enderror" name="harga_bahan_baku" value="{{ old('harga_bahan_baku') }}" placeholder="Masukkan Harga Bahan Baku">
                                        @error('produkPenitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Jumlah Pembelian Bahan Baku</label>
                                        <input type="number" class="form-control @error('jumlah_bahan_baku') is-invalid @enderror" name="jumlah_bahan_baku" value="{{ old('jumlah_bahan_baku') }}" placeholder="Masukkan Jumlah Bahan Baku">
                                        @error('jumlah_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Tanggal Pembelian</label>
                                        <input type="date" class="form-control @error('tanggal_pembelian') is-invalid @enderror" name="tanggal_pembelian" value="{{ old('tanggal_pembelian') }}" placeholder="Masukkan Tanggal Pembelian">
                                        @error('tanggal_pembelian')
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
