@extends('navbarAdmin')
@section('content')
<style>
    body {
        background-color: #ede6e3;

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
                    <h1 class="m-0" style="color:black">Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Produk</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show Produk</li>
                </div>

                <form action="{{ route('produks.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari Produk...">
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
                            <a href="{{route('produks.create')}}"
                                class="btn btn-md btn-success mb-3 btn-tambah-resep">Tambah Produk</a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tipe Produk</th>
                                            <th class="text-center">Foto Produk</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">JenisProduk</th>
                                            <th class="text-center">Stock Produk</th>
                                            <th class="text-center">Kuota</th>
                                            <th class="text-center">Tanggal Mulai PO</th>
                                            <th class="text-center">Tanggal Selesai PO</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Resep</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($produk as $item)
                                            <tr>
                                                <td class="text-center">{{$item->tipe_produk}}</td>
                                                <td class="text-center">
                                                    @if($item->penitips != null && $item->penitips->id_penitip != null)
                                                        <img src="/images/{{ $item->penitips->image }}" width="100px">
                                                    @else
                                                        <img src="/images/{{ $item->image }}" width="100px">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->penitips != null && $item->penitips->id_penitip != null)
                                                        {{$item->penitips->nama_produk_penitip}}
                                                    @else
                                                        {{$item->nama_produk}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->penitips != null && $item->penitips->id_penitip != null)
                                                        {{$item->penitips->jenis_produk_penitip}}
                                                    @else
                                                        {{$item->jenis_produk}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->stock_produk == null)
                                                        --
                                                    @else
                                                        {{$item->stock_produk}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->kuota == null)
                                                        --
                                                    @else
                                                        {{$item->kuota}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->tanggal_mulai_po == null)
                                                        --
                                                    @else
                                                        {{$item->tanggal_mulai_po}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($item->tanggal_selesai_po == null)
                                                        --
                                                    @else
                                                        {{$item->tanggal_selesai_po}}
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$item->harga_produk}}</td>
                                                <td class="text-center">{{$item->satuan_produk}}</td>
                                                <td class="text-center">
                                                    @if($item->id_resep == null)
                                                        --
                                                    @else
                                                        {{$item->reseps->nama_resep}}
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$item->status}}</td>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{route('produks.destroy', $item->id_produk)}}"
                                                        method="POST">
                                                        <a href="{{route('produks.edit', $item->id_produk)}}"
                                                            class="btn btn-sm btn-primary">EDIT</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Produk belum tersedia
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$produk->links()}}
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