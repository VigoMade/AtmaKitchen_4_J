@extends('navbarMO')
@section('content')

<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .form-group {
        margin-bottom: 20px;
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
                <h1 class="m-0" style="color: black;">Tambah Presensi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Presensi</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Create
                    </li>
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
                           
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Status Presensi</label>
                                    <select class="form-control @error('status_presensi') is-invalid @enderror" name="status_presensi">
                                        <option value="">Pilih Status Presensi</option>
                                        <option value="Hadir" {{ old('status_presensi') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Bolos" {{ old('status_presensi') == 'Bolos' ? 'selected' : '' }}>Bolos</option>
                                    </select>
                                    @error('status_presensi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
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
