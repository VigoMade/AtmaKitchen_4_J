@extends('navbarAdmin')
@section('content')

<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: black;">Edit Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Produk</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input type="text" class="form-control @error('namaProduk') is-invalid @enderror" name="namaProduk" value="{{ old('namaProduk') }}" placeholder="Masukkan Nama Produk">
                                @error('namaProduk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Produk</label>
                                <input type="text" class="form-control @error('jenisProduk') is-invalid @enderror" name="jenisProduk" value="{{ old('jenisProduk') }}" placeholder="Masukkan Jenis Produk">
                                @error('jenisProduk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Stock Produk</label>
                                    <input type="number" class="form-control @error('stockProduk') is-invalid @enderror" name="stockProduk" value="{{ old('stockProduk') }}" placeholder="Masukkan Stock Produk">
                                    @error('stockProduk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Kuota</label>
                                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" value="{{ old('kuota') }}" placeholder="Masukkan Kuota">
                                    @error('kuota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Tanggal Mulai PO</label>
                                    <input type="date" class="form-control @error('tanggalMulaiPo') is-invalid @enderror" name="tanggalMulaiPo" value="{{ old('tanggalMulaiPo') }}" placeholder="Masukkan Tanggal Mulai PO">
                                    @error('tanggalMulaiPo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Tanggal Selesai PO</label>
                                    <input type="date" class="form-control @error('tanggalSelesaiPo') is-invalid @enderror" name="tanggalSelesaiPo" value="{{ old('tanggalSelesaiPo') }}" placeholder="Masukkan Tanggal Selesai PO">
                                    @error('tanggalSelesaiPo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga">
                                    @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Satuan Produk</label>
                                    <input type="text" class="form-control @error('satuanProduk') is-invalid @enderror" name="satuanProduk" value="{{ old('satuanProduk') }}" placeholder="Masukkan Satuan Produk">
                                    @error('satuanProduk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weightbold">Foto Produk</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">Simpan Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection