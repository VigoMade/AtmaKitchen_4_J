@extends('navbarAdmin')
@section('content')

<style>
    body {
        background-color: #F9F9F7;
    }

    .content-header {
        margin-top: 14%;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: black;
        font-weight: bold;
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
                    <h1 class="m-0" style="color: black;">Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Produk</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('produks.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Produk</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_produk" id="produk_penitip" value="Produk Penitip" checked>
                                        <label class="form-check-label" for="produk_penitip">Produk Penitip</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_produk" id="produk_toko" value="Produk Toko">
                                        <label class="form-check-label" for="produk_toko">Produk Toko</label>
                                    </div>
                                </div>

                                <div class="form-group" id="penitip_fields">
                                    <label class="font-weight-bold" for="id_penitip">Nama Produk Penitip</label>
                                    <select class="form-control @error('id_penitip') is-invalid @enderror" name="id_penitip" id="id_penitip_select">
                                        <option value="">Pilih Nama Produk</option>
                                        @foreach ($penitip as $item)
                                        <option value="{{ $item->id_penitip }}">{{ $item->nama_produk_penitip }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_penitip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group" id="toko_fields" style="display: none;">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="id_resep">Nama Resep Produk</label>
                                        <select class="form-control @error('id_resep') is-invalid @enderror" name="id_resep" id="id_resep_select">
                                            <option value="">Pilih Resep Produk</option>
                                            @foreach ($resep as $item)
                                            <option value="{{ $item->id_resep }}">{{ $item->nama_resep }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_resep')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Jenis Produk Penitip</label>
                                        <select class="form-control @error('jenis_produk_penitip') is-invalid @enderror" name="jenis_produk_penitip">
                                            <option value="">Pilih Jenis Produk </option>
                                            <option value="Roti" {{ old('jenis_produk') == 'Roti' ? 'selected' : '' }}>Roti</option>
                                            <option value="Cake" {{ old('jenis_produk') == 'Cake' ? 'selected' : '' }}>Cake</option>
                                            <option value="Minuman" {{ old('jenis_produk') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                            <option value="Other" {{ old('jenis_produk') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('jenis_produk_penitip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <label class="font-weight-bold">Nama Produk Toko</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukkan Nama Produk Toko">
                                    @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label class="font-weight-bold">Kuota</label>
                                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" value="{{ old('kuota') }}" placeholder="Masukkan Kuota">
                                    @error('kuota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group" id="status_field">
                                        <label class="font-weight-bold">Status</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_ready" value="Ready" checked>
                                            <label class="form-check-label" for="status_ready">Ready</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_po" value="PO">
                                            <label class="form-check-label" for="status_po">PO (Pre-order)</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" class="form-group" id="tanggal_mulai_po" style="display: none;">
                                            <label>Tanggal Mulai PO</label>
                                            <input type="datetime-local" class="form-control @error('tanggal_mulai_po') is-invalid @enderror" name="tanggal_mulai_po" value="{{ old('tanggal_mulai_po') }}" placeholder="Masukkan Tanggal Mulai PO">
                                            @error('tanggal_mulai_po')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6" class="form-group" id="tanggal_selesai_po" style="display: none;">
                                            <label>Tanggal Selesai PO</label>
                                            <input type="datetime-local" class="form-control @error('tanggal_selesai_po') is-invalid @enderror" name="tanggal_selesai_po" value="{{ old('tanggal_selesai_po') }}" placeholder="Masukkan Tanggal Selesai PO">
                                            @error('tanggal_selesai_po')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="font-weightbold">Foto Produk</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="stock_produk_field">
                                        <label class="font-weight-bold">Stock Produk</label>
                                        <input type="number" class="form-control @error('stock_produk') is-invalid @enderror" name="stock_produk" value="{{ old('stock_produk') }}" placeholder="Masukkan Stock Produk">
                                        @error('stock_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Harga</label>
                                        <input type="number" class="form-control @error('harga_produk') is-invalid @enderror" name="harga_produk" value="{{ old('harga_produk') }}" placeholder="Masukkan Harga">
                                        @error('harga_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Satuan Produk</label>
                                        <input type="text" class="form-control @error('satuan_produk') is-invalid @enderror" name="satuan_produk" value="{{ old('satuan_produk') }}" placeholder="Masukkan Satuan Produk">
                                        @error('satuan_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('produk_penitip').addEventListener('change', function() {
            document.getElementById('penitip_fields').style.display = 'block';
            document.getElementById('stock_produk_field').style.display = 'block';
            document.getElementById('toko_fields').style.display = 'none';
        });

        document.getElementById('produk_toko').addEventListener('change', function() {
            document.getElementById('penitip_fields').style.display = 'none';
            document.getElementById('toko_fields').style.display = 'block';
            document.getElementById('stock_produk_field').style.display = 'none';
        });

        document.getElementById('status_ready').addEventListener('change', function() {
            document.getElementById('tanggal_mulai_po').style.display = 'none';
            document.getElementById('tanggal_selesai_po').style.display = 'none';
        });

        document.getElementById('status_po').addEventListener('change', function() {
            document.getElementById('tanggal_mulai_po').style.display = 'block';
            document.getElementById('tanggal_selesai_po').style.display = 'block';
        });
    });
</script>



@endsection