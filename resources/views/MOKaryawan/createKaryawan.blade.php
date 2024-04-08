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
                        Tambah Karyawan
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Karyawan</a>
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
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Karyawan</label>
                                        <input type="text" class="form-control @error('namaKaryawan') is-invalid @enderror" name="namaKaryawan" value="{{ old('namaKaryawan') }}" placeholder="Masukkan Nama Karyawan">
                                        @error('namaKaryawan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">No Telpon Karyawan</label>
                                        <input type="text" class="form-control @error('noTelpKaryawan') is-invalid @enderror" name="noTelpKaryawan" value="{{old('noTelpKaryawan') }}" placeholder="Masukkan No Telepon Karyawan">
                                        @error('noTelpKaryawan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Username Karyawan</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username') }}" placeholder="Masukkan UserName">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Password Karyawan</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password') }}" placeholder="Masukkan Password Karyawan">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Jabatan</label>
                                        <input type="text" class="form-control @error('jabatanKaryawan') is-invalid @enderror" name="jabatanKaryawan" value="{{old('jabatanKaryawan') }}" placeholder="Masukkan Jabatan Karyawan">
                                        @error('jabatanKaryawan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Foto Karyawan</label>
                                        <input type="file" class="form-control @error('fotoKaryawan') is-invalid @enderror" name="fotoKaryawan" value="{{old('fotoKaryawan') }}">
                                        @error('fotoKaryawan')
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