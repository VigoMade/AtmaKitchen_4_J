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
                    <h1 class="m-0" style="color:black">History Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">History All Customer</a>
                        </li>
                    </ol>
                    <li class="breadcrumb-item active">Show History</li>
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
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Status Pesanan Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($history as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->customer->nama }}</td>
                                            <td class="text-center">
                                                @if($item->produk->nama_produk != null)
                                                {{ $item->produk->nama_produk }}
                                                @else
                                                {{$item->produk->penitips->nama_produk_penitip}}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->status == 'Selesai')
                                                <span class="badge badge-success">{{ $item->status }}</span>
                                                @else
                                                <span class="badge badge-secondary">{{ $item->status }}</span>
                                                @endif
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
                            {{$history->links()}}
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