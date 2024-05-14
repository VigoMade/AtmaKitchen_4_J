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
                    <h1 class="m-0" style="color: black;">Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Produk</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('produks.update',$produk->id_produk)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Produk</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_produk" id="produk_penitip" value="Produk Penitip" {{ old('tipe_produk', $produk->tipe_produk) == 'Produk Penitip' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="produk_penitip">Produk Penitip</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_produk" id="produk_toko" value="Produk Toko" {{ old('tipe_produk', $produk->tipe_produk) == 'Produk Toko' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="produk_toko">Produk Toko</label>
                                    </div>
                                </div>

                                <div class="form-group" id="penitip_fields">
                                    <label class="font-weight-bold" for="id_penitip">Nama Produk Penitip</label>
                                    <select class="form-control @error('id_penitip') is-invalid @enderror" name="id_penitip" id="id_resep_select">
                                        <option value="">Pilih Nama Produk</option>
                                        @foreach ($penitip as $item)
                                        <option value="{{ $item->id_penitip }}" {{ old('id_penitip', isset($produk) ? $produk->id_penitip : '') == $item->id_penitip ? 'selected' : '' }}>
                                            {{ $item->nama_produk_penitip }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="toko_fields" style="display: none;">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Jenis Produk</label>
                                        <select class="form-control @error('jenis_produk_penitip') is-invalid @enderror" name="jenis_produk_penitip">
                                            <option value="">Pilih Jenis Produk </option>
                                            <option value="Bread" {{ old('jenis_produk', $produk->jenis_produk) == 'bread' ? 'selected' : '' }}>Bread</option>
                                            <option value="Cake" {{ old('jenis_produk', $produk->jenis_produk) == 'cake' ? 'selected' : '' }}>Cake</option>
                                            <option value="Drink" {{ old('jenis_produk', $produk->jenis_produk) == 'drink' ? 'selected' : '' }}>Drink</option>
                                            <option value="Other" {{ old('jenis_produk', $produk->jenis_produk) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="id_resep">Nama Resep Produk</label>
                                        <select class="form-control @error('id_resep') is-invalid @enderror" name="id_resep" id="id_resep_select">
                                            <option value="">Pilih Resep</option>
                                            @foreach ($resep as $item)
                                            <option value="{{ $item->id_resep }}" {{ old('id_resep', isset($produk) ? $produk->id_resep : '') == $item->id_resep ? 'selected' : '' }}>
                                                {{ $item->nama_resep }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="font-weight-bold">Nama Produk Toko</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk',$produk->nama_produk) }}" placeholder="Masukkan Nama Produk Toko">
                                    @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <label class="font-weight-bold">Kuota</label>
                                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" value="{{ old('kuota',$produk->kuota) }}" placeholder="Masukkan Kuota">
                                    @error('kuota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group" id="status_field">
                                        <label class="font-weight-bold">Status</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_ready" value="Ready" {{ old('status', $produk->status) == 'Ready' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_ready">Ready</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_po" value="PO" {{ old('status', $produk->status) == 'PO' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_po">PO (Pre-order)</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" id="tanggal_mulai_po" style="display: none;">
                                            <label>Tanggal Mulai PO</label>
                                            <input type="datetime-local" class="form-control @error('tanggal_mulai_po') is-invalid @enderror" name="tanggal_mulai_po" value="{{ old('tanggal_mulai_po',$produk->tanggal_mulai_po) }} placeholder=" Masukkan Tanggal Mulai PO">
                                            @error('tanggal_mulai_po')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6" id="tanggal_selesai_po" style="display: none;">
                                            <label>Tanggal Selesai PO</label>
                                            <input type="datetime-local" class="form-control @error('tanggal_selesai_po') is-invalid @enderror" name="tanggal_selesai_po" value="{{ old('tanggal_selesai_po',$produk->tanggal_selesai_po) }}" placeholder="Masukkan Tanggal Selesai PO">
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
                                        <input type="number" class="form-control @error('stock_produk') is-invalid @enderror" name="stock_produk" value="{{ old('stock_produk',$produk->stock_produk) }}" placeholder="Masukkan Stock Produk">
                                        @error('stock_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Harga</label>
                                        <input type="number" class="form-control @error('harga_produk') is-invalid @enderror" name="harga_produk" value="{{ old('harga_produk',$produk->harga_produk) }}" placeholder="Masukkan Harga">
                                        @error('harga_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Satuan Produk</label>
                                        <input type="text" class="form-control @error('satuan_produk') is-invalid @enderror" name="satuan_produk" value="{{ old('satuan_produk',$produk->satuan_produk) }}" placeholder="Masukkan Satuan Produk">
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
        function toggleFields() {
            if (document.getElementById('produk_penitip').checked) {
                document.getElementById('penitip_fields').style.display = 'block';
                document.getElementById('toko_fields').style.display = 'none';
                document.getElementById('stock_produk_field').style.display = 'block';
            } else if (document.getElementById('produk_toko').checked) {
                document.getElementById('penitip_fields').style.display = 'none';
                document.getElementById('toko_fields').style.display = 'block';
                document.getElementById('stock_produk_field').style.display = 'none';
            }
        }
        document.getElementById('produk_penitip').addEventListener('change', function() {
            toggleFields();
        });

        document.getElementById('produk_toko').addEventListener('change', function() {
            toggleFields();
        });


        toggleFields();
    });
</script>

@endsection