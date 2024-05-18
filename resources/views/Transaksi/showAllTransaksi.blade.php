@extends('navbarLandingPage')
@section('content')
<style>
    .container-isi {
        width: 80%;
        height: 75%;
        margin-top: 50px;
    }

    .box-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .box-image img {
        margin-bottom: 10px;
    }
</style>
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="container-isi">
        @forelse($transaksi as $trans)
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ Storage::url($trans->image) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{$trans->nama_produk}}</strong></h5>
                        <p class="card-text"><strong>Jumlah:</strong> {{$trans->jumlah_produk}} </p>
                        <p class="card-text"><strong>Total Harga:</strong> {{$trans->total_pembayaran}} </p>
                        <hr>
                        <button type="submit" class="btn btn-primary">
                            Pay
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="box-image" style="border: 3px solid black;">
            <img src="{{ asset('images/no_data.png') }}" width="50%" alt="">
            <div class="alert alert-danger w-100 text-center" role="alert">
                Kamu Belum Beli Apa-apa!
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection