@extends('navbarLandingPage')
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

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: black;">Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Transaksi</a>
                    </li>
                    <li class="breadcrumb-item active">Pembayaran</li>
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
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" disabled>
                                <input type="hidden" name="nama" value="{{ $user->nama }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Alamat Ku</label>
                                <input type="text" class="form-control" name="alamat_customer" value="{{ $alamat->alamat_customer }}" disabled>
                                <input type="hidden" name="jumlah_produk" value="{{ $alamat->alamat_customer }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" value="{{ $transaksi->nama_produk }}" disabled>
                                <input type="hidden" name="nama_produk" value="{{ $transaksi->nama_produk }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Produk</label>
                                <input type="number" class="form-control" name="jumlah_produk" value="{{ $transaksi->jumlah_produk }}" disabled>
                                <input type="hidden" name="jumlah_produk" value="{{ $transaksi->jumlah_produk }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Total Harga</label>
                                    <input type="number" class="form-control" id="total_pembayaran" name="total_pembayaran" value="{{ $transaksi->total_pembayaran }}" readonly>
                                    <input type="hidden" id="total_pembayaran_asli" value="{{ $transaksi->total_pembayaran }}">
                                </div>
                            </div>
                            @if($transaksi->status != 'Menunggu Pembayaran')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" disabled selected>Pilih tipe pengiriman</option>
                                        <option value="pickup">Pickup</option>
                                        <option value="send">Send</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            @if($transaksi->status == 'Menunggu Pembayaran')
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">Poin Kamu Sekarang : {{ $user->poin_customer }}</label>
                                <input type="number" class="form-control @error('poin_digunakan') is-invalid @enderror" name="poin_digunakan" id="poin_digunakan" value="{{ old('poin_digunakan') }}" placeholder="Masukkan Poin yang mau kamu gunakan">
                                @error('poin_digunakan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @endif
                            @if($transaksi->status == 'Menunggu Pembayaran')
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">Upload Bukti Bayar</label>
                                <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar" onchange="previewImage(event)">
                                <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                            </div>
                            @endif
                            @if($transaksi->status == 'Di Keranjang' || $transaksi->status == 'Perlu Jarak')
                            <button type="submit" class="btn btn-md btn-primary d-block mx-auto">Beli</button>
                            @else
                            <button type="submit" class="btn btn-md btn-primary d-block mx-auto">Bayar</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('poin_digunakan').addEventListener('input', function() {
        const poin = parseInt(this.value) || 0;
        const totalPembayaranAsli = parseInt(document.getElementById('total_pembayaran_asli').value);
        const totalPembayaran = totalPembayaranAsli - (poin * 100);
        document.getElementById('total_pembayaran').value = totalPembayaran;
    });
</script>

@endsection