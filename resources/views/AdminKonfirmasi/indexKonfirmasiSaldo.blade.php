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
                    <h1 class="m-0" style="color:black">Konfirmasi Penarikan Saldo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Konfirmasi Penarikan Saldo</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show List Penarikan Saldo</li>
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
                                            <th class="text-center">Profile</th>
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Tanggal Penarikan</th>
                                            <th class="text-center">Jumlah Penarikan</th>
                                            <th class="text-center">Rekening Penarikan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @forelse($penarikan_saldo as $data)
                                            <td class="text-center">
                                                @if ($data->image)
                                                <img src="{{ Storage::url($data->image) }}" width="100px" alt="profile">
                                                @else
                                                <img src="{{ asset('images/20240416153955.jpeg') }}" width="100px" alt="profile">
                                                @endif
                                            </td>
                                            <td class="text-center">{{$data->nama_customer}}</td>
                                            <td class="text-center">
                                                {{$data->tanggal_penarikan}}
                                            </td>
                                            <td class="text-center">
                                                Rp.{{$data->total_penarikan}}
                                            </td>
                                            <td class="text-center">
                                                {{$data->nama_bank}} - {{$data->rekening_bank}}
                                            </td>
                                            <td class="text-center">
                                                @if($data->status_penarikan == 'Menunggu Konfirmasi')
                                                <span class="badge text-bg-info">{{$data->status_penarikan}}</span>
                                                @elseif($data->status_penarikan == 'Selesai')
                                                <span class="badge text-bg-success">{{$data->status_penarikan}}</span>
                                                @else
                                                <span class="badge text-bg-danger">{{$data->status_penarikan}}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($data->status_penarikan == 'Menunggu Konfirmasi')
                                                <form action="{{route('konfirmasiSaldo.terima',$data->id_penarikan)}}" onsubmit="return confirm('Apakah Anda Yakin?');" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('konfirmasiSaldo.tolak', ['id' => $data->id_penarikan, 'id_customer' => $data->id_customer]) }}" onsubmit="return confirm('Apakah Anda Yakin?');" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger">
                                                        Tolak
                                                    </button>
                                                </form>
                                                @else
                                                <button class="btn btn-secondary" disabled>
                                                    Nothing..
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data History Penarikan belum tersedia
                                    </div>
                                    @endforelse
                                </table>
                            </div>
                            {{$penarikan_saldo->links()}}
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