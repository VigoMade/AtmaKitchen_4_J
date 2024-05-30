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
        border: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .card {
        margin-top: 2rem;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: black;">Tarik Saldo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Saldo</a></li>
                    <li class="breadcrumb-item active">Tarik Saldo</li>
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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('penarikanSaldo.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Ku</label>
                                <input type="text" class="form-control" value="{{$user->nama}}" placeholder="Masukkan Nama" disabled>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="id_rekening">Pilih Rekening</label>
                                <select class="form-control @error('id_rekening') is-invalid @enderror" name="id_rekening">
                                    <option value="">Pilih Rekening</option>
                                    @foreach ($rekening as $item)
                                    <option value="{{ $item->id_rekening }}" {{ old( isset($penarikan_saldo) ? $penarikan_saldo->id_rekening : '') == $item->id_rekening ? 'selected' : '' }}>
                                        {{ $item->rekening_bank }} - {{ $item->nama_bank }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_rekening')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Penarikan</label>
                                <input type="number" class="form-control" value="{{ old('total_penarikan') }}" name="total_penarikan" placeholder="Masukkan Jumlah Penarikan">
                                @error('total_penarikan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-md btn-primary d-block mx-auto">Tarik Saldo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection