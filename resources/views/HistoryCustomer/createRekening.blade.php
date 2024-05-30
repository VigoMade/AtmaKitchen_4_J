@extends('navbarLandingPage')
@section('content')

<style>
    body {
        background-color: #ede6e3;
    }

    .content-header {
        margin-top: 14%;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border: 2px solid #0d6efd;
        border-radius: 2px;
        transition: transform 0.3s ease;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: black;">Tambah Rekening</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#" style="text-decoration: none; color:black; font-weight: bold;">Rekening</a>
                    </li>
                    <li class="breadcrumb-item active">Rekening</li>
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
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('rekening.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Masukkan Nama Bank</label>
                                    <select class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" id="nama_bank" onchange="toggleOtherInput()">
                                        <option value="" disabled selected>Pilih Nama Bank</option>
                                        <option value="BRI" {{ old('nama_bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                        <option value="BCA" {{ old('nama_bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                        <option value="BNI" {{ old('nama_bank') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                        <option value="Mandiri" {{ old('nama_bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                        <option value="Other" {{ old('nama_bank') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('nama_bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12" id="other_bank_div" style="display: none;">
                                    <label class="font-weight-bold">Masukkan Nama Bank Lainnya</label>
                                    <input type="text" class="form-control @error('other_bank') is-invalid @enderror" name="other_bank" value="{{ old('other_bank') }}" placeholder="Masukkan Nama Bank Lainnya">
                                    @error('other_bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Masukkan No Rekening</label>
                                    <input type="text" class="form-control @error('rekening_bank') is-invalid @enderror" name="rekening_bank" value="{{ old('rekening_bank') }}" placeholder="Masukkan Rekening">
                                    @error('rekening_bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleOtherInput() {
        var bankSelect = document.getElementById('nama_bank');
        var otherBankDiv = document.getElementById('other_bank_div');
        if (bankSelect.value === 'Other') {
            otherBankDiv.style.display = 'block';
        } else {
            otherBankDiv.style.display = 'none';
        }
    }
    window.onload = function() {
        toggleOtherInput();
    };
</script>

@endsection