@extends('navbarLandingPage')
@section('content')
<style>
    body {
        background-color: #ede6e3;
    }

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

        margin-bottom: 50px !important;
    }

    .box-image img {
        margin-bottom: 10px;
    }
</style>
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">

    <div class="container-isi">
        <a href="{{route('rekening.create')}}" class="btn btn-md btn-success mb-3">Tambah Rekening</a>

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

        @forelse($rekening as $rek)
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    @if ($user->image)
                    <img src="{{ Storage::url($user->image) }}" class="img-fluid" alt="..." style="max-width: 45%; height: 90%;">
                    @else
                    <img src="{{ asset('images/20240416153955.jpeg') }}" class="img-fluid " style="max-width: 45%; height: 90%;" alt="default-profile">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{$rek->nama_bank}}</strong></h5>
                        <h5 class="card-text">{{$rek->rekening_bank}}</h5>
                        <hr style="margin-top: 30px;">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('rekening.destroy',$rek->id_rekening)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Hapus Rekening
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @empty
        <div class="box-image">
            <img src="{{ asset('images/no_data.png') }}" width="40%" alt="">
            <div class="alert alert-danger w-100 text-center" role="alert">
                Kamu Belum Tambah Rekening!
            </div>
        </div>
        @endforelse
        {{$rekening->links()}}
    </div>

</div>


@endsection