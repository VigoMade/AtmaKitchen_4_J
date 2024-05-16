@extends('navbarMO')
@section('content')
<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 13.5%;
    }

    .btn-tambah-resep:hover {
        transform: scale(1.1);
        background-color: white;
        color: #198754;
        border-radius: 2px solid #198754;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .btn-danger:hover {
        transform: scale(1.1);
        background-color: white;
        color: #dc3545;
        border-radius: 2px solid #dc3545;
        transition: transform 0.3s ease;
    }
</style>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color:black">Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Karyawan</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show Karyawan</li>
                </div>

                <form action="{{ route('pegawai.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Pegawai...">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>


                <!-- /.col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('error'))
                            <div id="errorAlert" class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            @if(session('success'))
                            <div id="successAlert" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                            @endif

                            <a href="{{route('pegawai.create')}}" class="btn btn-md btn-success mb-3 btn-tambah-resep">Tambah Karyawan</a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Foto Karyawan</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">No Telpon</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pegawai as $item)
                                        <tr>
                                            <td class="text-center">@if($item->foto)
                                                <img src="{{ Storage::url($item->foto) }}" width="100px" alt="profile">
                                                @else
                                                <div class="alert alert-danger">
                                                    Tidak ada foto
                                                </div>
                                                @endif
                                            </td>
                                            <td class="text-center">{{$item->nama_pegawai}}</td>
                                            <td class="text-center">{{$item->telepon_pegawai}}</td>
                                            <td class="text-center">{{$item->email_pegawai}}</td>
                                            <td class="text-center">@if($item->username)
                                                {{ $item->username }}
                                                @else
                                                Tidak Ada Username
                                                @endif
                                            </td>
                                            <td class="text-center">@if($item->jabatan)
                                                {{ $item->jabatan->role }}
                                                @else
                                                Pegawai Biasa
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('pegawai.destroy',$item->id_pegawai)}}" method="POST">
                                                    <a href="{{route('pegawai.edit',$item->id_pegawai)}}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Pegawai belum tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $pegawai->links() }}
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