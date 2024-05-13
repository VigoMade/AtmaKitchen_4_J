@extends('navbarMO')
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
                    <h1 class="m-0" style="color: black;">Tambah Pembelian Bahan Baku</h1>
                </div>
                <!-- col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Pembelian Bahan Baku</a>
                        </li>
                        <li class="breadcrumb-item active">Ediy</li>
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
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('pembelianBB.update',['id_pembelian' =>$pembelianBB->id_pembelian, 'id_bahanBaku' => $pembelianBB->id_bahan_baku])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="id_bahan_baku">Masukkan Bahan Baku</label>
                                        <input type="hidden" name="id_bahan_baku" value="{{ old('id_bahan_baku', $pembelianBB->id_bahan_baku) }}">
                                        <select class="form-control @error('id_bahan_baku') is-invalid @enderror" disabled>
                                            <option value="">Pilih Bahan Baku</option>
                                            @foreach ($bahanBaku as $item)
                                            <option value="{{ $item->id_bahan_baku }}" {{ old('id_bahan_baku', isset($pembelianBB) ? $pembelianBB->id_bahan_baku : '') == $item->id_bahan_baku ? 'selected' : '' }}>
                                                {{ $item->nama_bahan_baku }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_bahan_baku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Harga Bahan Baku</label>
                                        <input type="text" class="form-control @error('harga_bahan_baku') is-invalid @enderror" name="harga_bahan_baku" value="{{ old('harga_bahan_baku',$pembelianBB->harga_bahan_baku) }}" placeholder="Masukkan Harga Bahan Baku">
                                        @error('produkPenitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Jumlah Pembelian Bahan Baku</label>
                                        <input type="number" class="form-control @error('jumlah_bb_dibeli') is-invalid @enderror" name="jumlah_bb_dibeli" value="{{ old('jumlah_bb_dibeli',$pembelianBB->jumlah_bb_dibeli) }}" placeholder="Masukkan Jumlah Bahan Baku">
                                        @error('jumlah_bb_dibeli')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Tanggal Pembelian</label>
                                        <input type="datetime-local" class="form-control @error('tanggal_pembelian') is-invalid @enderror" name="tanggal_pembelian" value="{{ old('tanggal_pembelian',$pembelianBB->tanggal_pembelian) }}" placeholder="Masukkan Tanggal Pembelian">
                                        @error('tanggal_pembelian')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
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