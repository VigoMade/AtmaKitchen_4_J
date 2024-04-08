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
                <h1 class="m-0" style="color: black;">Tambah Hampers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Hampers</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
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
                        <form action="{{route('hampers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Hampers</label>
                                <input type="text" class="form-control @error('nama_hampers') is-invalid @enderror" name="nama_hampers" value="{{ old('nama_hampers') }}" placeholder="Masukkan Nama Hampers">
                                @error('nama_hampers')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi Hampers</label>
                                <input type="text" class="form-control @error('deskripsi_hampers') is-invalid @enderror" name="deskripsi_hampers" value="{{ old('deskripsi_hampers') }}" placeholder="Masukkan Deskripsi Hampers">
                                @error('deskripsi_hampers')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Harga</label>
                                    <input type="number" class="form-control @error('harga_hampers') is-invalid @enderror" name="harga_hampers" value="{{ old('harga_hampers') }}" placeholder="Masukkan Harga">
                                    @error('harga_hampers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weightbold">Foto Hampers</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection