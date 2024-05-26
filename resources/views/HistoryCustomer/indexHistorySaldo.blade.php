@extends('navbarLandingPage')
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
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Tanggal Penarikan</th>
                                        <th class="text-center">Rekening Penarikan</th>
                                        <th class="text-center">Jumlah Penarikan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="text-center">Maharanie</td>

                                        <td class="text-center">
                                            2024-10-10
                                        </td>
                                        <td class="text-center">
                                            Rp.100000
                                        </td>
                                        <td class="text-center">
                                            Bank Mandiri - 123412234
                                        </td>
                                        <td class="text-center">
                                            <span class="badge text-bg-info">Sedang Diajukan</span>

                                        </td>

                                        <td class="text-center">
                                            <a href="#" class="btn btn-primary">Tarik Saldo</a>
                                        </td>


                                    </tr>
                                </tbody>


                            </table>
                        </div>

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