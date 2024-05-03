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
                    <h1 class="m-0" style="color:black">Pembelian Bahan Baku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Pembelian Bahan Baku</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Pembelian Bahan Baku</li>
                </div>
                <form action="{{route('pembelianBB.search')}}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Bahan Baku....">
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('pembelianBB.create')}}" class="btn btn-md btn-success mb-3 btn-tambah-resep">Tambah Pembelian Bahan Baku </a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Bahan Baku</th>
                                            <th class="text-center">Harga Bahan Baku</th>
                                            <th class="text-center">Jumlah Stock Baku</th>
                                            <th class="text-center">Tanggal Pembelian Bahan Baku</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($pembelianBB as $item)
                                            <td class="text-center">{{$item->bahanBaku->nama_bahan_baku}}</td>
                                            <td class="text-center">{{$item->harga_bahan_baku}}</td>
                                            <td class="text-center">{{$item->bahanBaku->takaran_bahan_baku_tersedia}}</td>
                                            <td class="text-center">{{$item->tanggal_pembelian}}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('pembelianBB.destroy',$item->id_pembelian)}}" method="POST">
                                                    <a href="{{route('pembelianBB.edit',$item->id_pembelian)}}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Pembelian BB belum tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$pembelianBB->links()}}
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