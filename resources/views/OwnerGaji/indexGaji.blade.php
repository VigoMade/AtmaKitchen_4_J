@extends('navbarOwner')
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
                    <h1 class="m-0" style="color:black">Gaji</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Gaji</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show Gaji</li>
                </div>
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
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Foto Karyawan</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Bonus Gaji Karyawan</th>
                                            <th class="text-center">Total Gaji Karyawan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pegawai as $item)
                                        <tr>
                                            <td class="text-center">@if($item->foto)
                                                <img src="/images/{{$item->foto}}" width="100px" alt="foto">
                                                @else
                                                <div class="alert alert-danger" role="alert">
                                                    Tidak ada foto!
                                                </div>
                                                @endif
                                            </td>
                                            <td class="text-center">{{$item->nama_pegawai}}</td>
                                            <td class="text-center">{{$item->bonus_gaji}}</td>
                                            <td class="text-center">{{$item->gaji}}</td>
                                            <td class="text-center">
                                                <a href="{{route('gaji.edit',$item->id_pegawai)}}" class="btn btn-sm btn-primary">EDIT</a>
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
                        </div>
                        {{$pegawai->links()}}
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