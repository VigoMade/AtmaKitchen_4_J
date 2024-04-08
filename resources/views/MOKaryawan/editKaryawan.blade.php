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
                        Edit Karyawan
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Karyawan</a>
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
                            <form action="{{route('pegawai.update',$pegawai->id_pegawai)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Karyawan</label>
                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai',$pegawai->nama_pegawai) }}" placeholder="Masukkan Nama Karyawan">
                                        @error('nama_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">No Telpon Karyawan</label>
                                        <input type="text" class="form-control @error('telepon_pegawai') is-invalid @enderror" name="telepon_pegawai" value="{{old('telepon_pegawai',$pegawai->telepon_pegawai) }}" placeholder="Masukkan No Telepon Karyawan">
                                        @error('telepon_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Email Karyawan</label>
                                        <input type="text" class="form-control @error('email_pegawai') is-invalid @enderror" name="email_pegawai" value="{{old('email_pegawai',$pegawai->email_pegawai) }}" placeholder="Masukkan Email Karyawan">
                                        @error('email_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="id_role">Jabatan</label>
                                        <div class="position-relative">
                                            <select class="form-control @error('id_role') is-invalid @enderror" name="id_role" id="id_role_select">
                                                <option value="">Pilih Jabatan</option>
                                                <option value="" {{ old('id_role', isset($pegawai) ? $pegawai->id_role : '') === null ? 'selected' : '' }}>
                                                    Pegawai Biasa
                                                </option>
                                                @foreach ($jabatan as $item)
                                                <option value="{{ $item->id_role }}" {{ old('id_role', isset($pegawai) ? $pegawai->id_role : '') == $item->id_role ? 'selected' : '' }}>
                                                    {{ $item->role }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="position-absolute bottom-0 end-0 pointer-events-none" style="top: 50%; transform: translateY(-50%); right: 12px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" />
                                                    <polyline points="6 9 12 15 18 9" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('id_role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-6" id="username_field" style="display: none;">
                                        <label class="font-weightbold">Username Karyawan</label>
                                        <input type="text" class="form-control @error('username_pegawai') is-invalid @enderror" name="username_pegawai" value="{{old('username_pegawai',$pegawai->username_pegawai) }}" placeholder="Masukkan UserName (tidak wajib)">
                                        @error('username_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6" id="password_field" style="display: none;">
                                        <label class="font-weightbold">Password Karyawan</label>
                                        <input type="password" class="form-control @error('password_pegawai') is-invalid @enderror" name="password_pegawai" value="{{old('password_pegawai',$pegawai->password_pegawai) }}" placeholder="Masukkan Password Karyawan(tidak wajib)">
                                        @error('password_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Gaji Karyawan</label>
                                        <input type="number" class="form-control @error('gaji') is-invalid @enderror" name="gaji" value="{{old('gaji',$pegawai->gaji) }}">
                                        @error('gaji')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Foto Karyawan</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{old('foto') }}">
                                        @error('foto')
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
<script>
    document.getElementById('id_role_select').addEventListener('change', function() {
        var selectedValue = this.value;
        var usernameField = document.getElementById('username_field');
        var passwordField = document.getElementById('password_field');

        if (selectedValue === '') {
            usernameField.style.display = 'none';
            passwordField.style.display = 'none';
        } else {
            usernameField.style.display = 'block';
            passwordField.style.display = 'block';
        }
    });
</script>

@endsection