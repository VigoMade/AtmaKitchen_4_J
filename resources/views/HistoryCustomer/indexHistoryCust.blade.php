@extends('navbarLandingPage')
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

    .btn-success:hover {
        transform: scale(1.1);
        background-color: white;
        color: #198754;
        border-radius: 2px solid #198754;
        transition: transform 0.3s ease;
    }

    .btn-warning:hover {
        transform: scale(1.1);
        background-color: white;
        color: #ffc107;
        border-radius: 2px solid #ffc107;
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color:black">My History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">My History</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show My History</li>
                </div>
                <form action="{{route('historyCustomer.search')}}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari History....">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table class="table table-hover textnowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No Produk</th>
                                        <th class="text-center">Foto Produk</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Jumlah Produk</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th class="text-center">Tanggal Selesai</th>
                                        <th class="text-center">Total Pembayaran Ku</th>
                                        <th class="text-center">Status Pesanan Ku</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse($user as $item)
                                        <td class="text-center">{{$item->id_transaksi}}</td>
                                        <td class="text-center">
                                            @if($item->id_penitip_fk != null)
                                            <img src="{{ Storage::url($item->penitip->image) }}" width="100px">
                                            @elseif($item->id_hampers != null)
                                            <img src="/images/{{ $item->hampers->image }}" width=" 100px">
                                            @else
                                            <img src="{{ Storage::url($item->produk->image) }}" width="100px">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->id_penitip_fk != null)
                                            {{ $item->penitip->nama_produk_penitip}}
                                            @elseif($item->id_hampers != null)
                                            {{ $item->hampers->nama_hampers}}
                                            @else
                                            {{ $item->produk->nama_produk}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{$item->jumlah_produk}}
                                        </td>
                                        <td class="text-center">
                                            @if($item->tanggal_transaksi == null)
                                            --
                                            @else
                                            {{$item->tanggal_transaksi}}
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($item->tanggal_selesai == null)
                                            --
                                            @else
                                            {{$item->tanggal_selesai}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{$item->total_pembayaran}}
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == 'Diterima')
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                            @elseif($item->status == 'Ditolak')
                                            <span class="badge badge-danger">{{ $item->status }}</span>
                                            @elseif($item->status == 'Pembayaran Valid')
                                            <span class="badge badge-secondary">{{ $item->status }}</span>
                                            @else
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        @if($item->status == 'Menunggu Pembayaran')
                                        <td class="text-center">
                                            <a href="{{route('transaksi.edit',$item->id_transaksi)}}" class="btn btn-primary">Bayar</a>
                                        </td>
                                        @elseif($item->status == 'Sudah dipickup')
                                        <td class="text-center">
                                            <form action="{{route('done',$item->id_transaksi)}}" onsubmit="return confirm('Apakah anda yakin?')" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">
                                                    Pesanan Diterima
                                                </button>
                                            </form>
                                        </td>
                                        @elseif($item->status == 'Selesai')
                                        <td class="text-center">
                                            <a href="{{ route('nota', $item->id_transaksi) }}" class="btn btn-warning" onclick="return confirm('Anda akan ke page Cetak Nota Yakin?')">Cetak Nota</a>
                                        </td>
                                        @elseif($item->status == 'Ditolak')
                                        <td class="text-center">
                                            <form action="{{route('historyCustomer.destroy',$item->id_transaksi)}}" onsubmit="return confirm('Apakah anda yakin?')" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                        @else
                                        <td class="text-center">
                                            <a href="#" class="btn btn-secondary btn-sm">Menunggu Update...</a>
                                        </td>
                                        @endif
                                    </tr>
                                </tbody>
                                @empty
                                <div class="alert alert-danger">
                                    Data History Customer belum tersedia
                                </div>
                                @endforelse
                            </table>
                        </div>
                        {{$user->links()}}
                    </div>
                    <!-- body -->
                </div>
                <!-- card -->
            </div>
            <!-- col -->
        </div>
        <!-- row -->
    </div>
    <hr style="margin-top: 50px;">
    <!-- container -->
    </div>
</body>

@endsection