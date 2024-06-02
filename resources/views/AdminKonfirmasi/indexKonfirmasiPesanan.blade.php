@extends('navbarAdmin')
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
                                                @if($data->status == 'Diproses')
                                                @if($data->ongkos_kirim == null)
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('pickUp',$data->id_pemasukan)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-primary">
                                                        Pick Up
                                                    </button>
                                                </form>
                                                @else
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('send',$data->id_pemasukan)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success">
                                                        Send
                                                    </button>
                                                </form>
                                                @endif
                                                @elseif($data->status == 'Sedang dikirim kurir' || $data->status == 'Siap dipickup')
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST" action="{{route('pickUpDone',$data->id_pemasukan)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-warning">
                                                        Done
                                                    </button>
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
</body>

@endsection