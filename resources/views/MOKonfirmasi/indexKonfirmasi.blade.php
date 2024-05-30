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

    .btn-outline-success:hover {
        transform: scale(1.1);
        background-color: #198754;
        color: white;
        border-radius: 2px solid #198754;
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color:black">Konfirmasi Pesanan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Konfirmasi Pesanan</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show List Pesanan</li>
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
                            <script>
                                setTimeout(function() {
                                    document.getElementById('errorAlert').style.display = 'none';
                                }, 5000);
                            </script>
                            @endif

                            @if(session('success'))
                            <div id="successAlert" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('successAlert').style.display = 'none';
                                }, 5000);
                            </script>
                            @endif
                            <a href="#" class="btn btn-md btn-success mb-3 btn-tambah-resep" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Cek Bahan Baku</a>
                            <a href="#" class="btn btn-md btn-outline-success mb-3 btn-tambah-resep" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Cek Pemakain Bahan baku</a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover textnowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No Transaksi</th>
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Alamat Customer</th>
                                            <th class="text-center">Foto Produk</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Jumlah </th>
                                            <th class="text-center">Total Bayar</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($transaksi as $data)
                                            <td class="text-center">{{$data->id_transaksi}}</td>
                                            <td class="text-center">{{$data->nama_customer}}</td>
                                            <td class="text-center">{{$data->alamat_customer}}</td>
                                            <td class="text-center">
                                                @if($data->id_hampers != null)
                                                <img src="/images/{{ $data->image }}" alt="Iklan 3" style="width: 150px; height: auto;" />
                                                @else
                                                <img src="{{ Storage::url($data->image) }}" alt="Iklan 3" style="width: 150px; height: auto;" />
                                                @endif
                                            </td>
                                            <td class="text-center">{{$data->nama_produk}}</td>
                                            <td class="text-center">{{$data->jumlah_produk}}</td>
                                            <td class="text-center">Rp. {{$data->total_pemasukan}}</td>
                                            <td class="text-center">
                                                @if($data->status == 'Pembayaran Valid')
                                                <span class="badge text-bg-info">{{$data->status}}</span>
                                                @else
                                                <span class="badge text-bg-success">{{$data->status}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($data->status == 'Diterima')
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('prosses', ['id' => $data->id_pemasukan, 'deskripsi' => $data->deskripsi_resep_produk ?? 'tidak', 'id_bahan_baku' => $data->id_bahan_baku ?? 0])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-primary">
                                                        Mulai Proses
                                                    </button>
                                                </form>
                                                @else
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('accept',$data->id_pemasukan)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-primary">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('reject',$data->id_pemasukan)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Belum ada Pembeli tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{$transaksi->links()}}
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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dc3545;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Bahan Baku Hampir Habis & Habis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-0">
                        <table class="table table-hover textnowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Bahan Baku</th>
                                    <th class="text-center">Jumlah Bahan Baku</th>
                                    <th class="text-center">Satuan Bahan Baku</th>
                                    <th class="text-centee">Status Bahan Baku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bahanBaku as $data)
                                <tr>
                                    <td class="text-center">{{$data->nama_bahan_baku}}</td>
                                    <td class="text-center">{{$data->takaran_bahan_baku_tersedia}}</td>
                                    <td class="text-center">{{$data->satuan_bahan_baku}}</td>
                                    <td class="text-center">
                                        <span class="badge text-bg-danger">{{$data->status_bb}}</span>
                                    </td>
                                    @empty
                                    <div class="alert alert-danger">
                                        Bahan Baku Masih Lengkap
                                    </div>
                                    @endforelse
                                </tr>
                            </tbody>
                        </table>
                        {{$bahanBaku->links()}}
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('pembelianBB.index')}}" onsubmit="return confirm('Anda Akan ke page pembelian baku')">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Beli Bahan Baku</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal 2 -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dc3545;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Penggunaan Bahan Baku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive p-0">
                        <table class="table table-hover textnowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Bahan Baku</th>
                                    <th class="text-center">Jumlah Bahan Baku</th>
                                    <th class="text-center">Total Pemakaian Bahan Baku</th>
                                    <th class="text-center">Satuan Bahan Baku</th>
                                    <th class="text-center">Tanggal Pemakaian</th>
                                    <th class="text-centee">Status Bahan Baku</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemakaian as $data)
                                <tr>
                                    <td class="text-center">{{$data->bahanBaku->nama_bahan_baku}}</td>
                                    <td class="text-center">{{$data->bahanBaku->takaran_bahan_baku_tersedia}}</td>
                                    <td class="text-center">{{$data->total_pemakaian}}</td>
                                    <td class="text-center">{{$data->bahanBaku->satuan_bahan_baku}}</td>
                                    <td class="text-center">{{$data->tanggal_pemakaian}}</td>
                                    <td class="text-center">
                                        <span class="badge text-bg-danger">{{$data->bahanBaku->status_bb}}</span>
                                    </td>
                                    @empty
                                    <div class="alert alert-danger">
                                        Bahan Baku Masih Lengkap
                                    </div>
                                    @endforelse
                                </tr>
                            </tbody>
                        </table>
                        {{$pemakaian->links()}}
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('pembelianBB.index')}}" onsubmit="return confirm('Anda Akan ke page pembelian baku')">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Beli Bahan Baku</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection