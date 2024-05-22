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

        margin-bottom: 50px !important;
    }

    .box-image img {
        margin-bottom: 10px;
    }
</style>
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">

    <div class="container-isi">
        <form action="{{route('alamat.search')}}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Cari Alamat Ku....">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </div>
        </form>
        <a href="{{route('alamat.create')}}" class="btn btn-md btn-success mb-3">Tambah Alamat</a>

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

        @forelse($alamat as $address)
        <div class="card mb-3" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    @if ($user->image)
                    <img src="{{ Storage::url($user->image) }}" class="img-fluid" alt="..." style="max-width: 50%; height: 100%;">
                    @else
                    <img src="{{ asset('images/20240416153955.jpeg') }}" class="img-fluid " style="max-width: 50%; height: 100%;" alt="default-profile">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{$address->alamat_customer}}</strong></h5>
                        <hr style="margin-top: 30px;">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('alamat.delete', $address->id_alamat)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('alamat.edit', $address->id_alamat)}}" class="btn btn-primary">Edit</a>
                            <button type="submit" class="btn btn-danger">
                                Hapus Alamat
                            </button>
                        </form>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('alamat.setAktif',$address->id_alamat)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if($address->alamat_aktif == 1)
                            <button class="btn btn-secondary mt-3">
                                Nonaktifkan alamat ini
                            </button>
                            @else
                            <button class="btn btn-info mt-3" style="color:white">
                                Aktifkan alamat ini
                            </button>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>


        @empty
        <div class="box-image">
            <img src="{{ asset('images/no_data.png') }}" width="45%" alt="">
            <div class="alert alert-danger w-100 text-center" role="alert">
                Kamu Belum Tambah Alamat!
            </div>
        </div>
        @endforelse
    </div>
    {{$alamat->links()}}
</div>


@endsection