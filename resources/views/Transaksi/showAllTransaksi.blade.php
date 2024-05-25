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
        @forelse($transaksi as $trans)
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
                @if($trans->id_hampers != null)
                <div class="col-md-4">
                    <img src="/images/{{ $trans->image }}" class=" img-fluid rounded-start" alt="..." style="width: 200px; height: auto;">
                </div>
                <div class="col-md-8">
                    <form action="{{route('transaksi.edit',$trans->id_transaksi)}}" onsubmit="return confrim('Anda akan ke page pembayaran, silahkan upload bukti pembayaran anda!')">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{$trans->nama_produk}}</strong></h5>
                            <p class="card-text"><strong>Jumlah:</strong> {{$trans->jumlah_produk}} </p>
                            <p class="card-text"><strong>Total Harga:</strong> {{$trans->total_pembayaran}} </p>
                            <hr>
                            <button type="submit" class="btn btn-primary">
                                Pay
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="col-md-4">
                    <img src="{{ Storage::url($trans->image) }}" class="img-fluid rounded-start" alt="..." style="width: 200px; height: auto;">
                </div>
                <div class="col-md-8">
                    <form action="{{route('transaksi.edit',$trans->id_transaksi)}}" onsubmit="return confrim('Anda akan ke page pembayaran, silahkan upload bukti pembayaran anda!')">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{$trans->nama_produk}}</strong></h5>
                            <p class="card-text"><strong>Jumlah:</strong> {{$trans->jumlah_produk}} </p>
                            <p class="card-text"><strong>Total Harga:</strong> {{$trans->total_pembayaran}} </p>
                            <hr>
                            @if($trans->status == 'Menunggu Pembayaran')
                            <button type="submit" class="btn btn-primary">
                                Pay
                            </button>
                            @else
                            <button type="submit" class="btn btn-primary">
                                Detail
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
                @endif

            </div>
        </div>
        @empty
        <div class="box-image">
            <img src="{{ asset('images/no_data.png') }}" width="50%" alt="">
            <div class="alert alert-danger w-100 text-center" role="alert">
                Kamu Belum Beli Apa-apa!
            </div>
        </div>
        @endforelse
        {{$transaksi->links()}}
    </div>
</div>
@endsection