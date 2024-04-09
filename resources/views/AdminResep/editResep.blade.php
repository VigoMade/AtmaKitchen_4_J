@extends('navbarAdmin')
@section('content')


<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }
</style>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: black;">
                        Edit Resep
                    </h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-rigt">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Resep</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit
                        </li>
                    </ol>
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- header -->
    <!-- content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('reseps.update',['id_resep' => $resep->id_resep, 'id_bahanBaku' => $resep->id_bahan_baku])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weightbold">Nama Resep</label>
                                        <input type="text" class="form-control @error('nama_resep') is-invalid @enderror" name="nama_resep" value="{{ old('nama_resep',$resep->resep->nama_resep) }}" placeholder="Masukkan Nama Resep">
                                        @error('nama_resep')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Bahan Baku yang Digunakan</label>
                                        <input type="text" class="form-control @error('nama_bahan_baku') is-invalid @enderror" name="nama_bahan_baku" value="{{old('nama_bahan_baku',$resep->bahanBaku->nama_bahan_baku) }}" placeholder="Masukkan Bahan Baku yang Digunakan">
                                        @error('nama_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weightbold">Total Penggunaan</label>
                                        <input type="number" class="form-control @error('total_penggunaan_bahan') is-invalid @enderror" name="total_penggunaan_bahan" value="{{old('total_penggunaan_bahan',$resep->total_penggunaan_bahan) }}" placeholder="Masukkan Total penggunaan">
                                        @error('total_penggunaan_bahan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Simpan Edit</button>
                            </form>
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