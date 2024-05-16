@extends('navbarLandingPage')

@section('content')
<style>
    body {
        background-color: #ede6e3;
        background-size: cover;
        background-repeat: no-repeat;
    }



    .center-container {
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-wrap: wrap;
        padding-top: 100px;
        padding-bottom: 50px;
    }

    h2 {
        font-style: bold;
        font-size: 2.5rem;
        color: #AD343E;
        text-align: center;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #AD343E;
        color: #ffffff;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-weight: bold;
        text-align: center;
    }

    .blockquote p {
        font-size: 15px;
    }

    .card-body {
        padding: 10px;
        font-size: 15px;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
    }

    .card-text {
        font-family: 'Playfair Display', serif;
    }

    .carousel-inner img {
        width: 100%;
        /* Menggunakan lebar gambar yang sesuai dengan tinggi */
        height: 100%;
        /* Mengisi tinggi carousel dengan gambar */
    }

    /* Menyesuaikan lebar dan tinggi gambar dalam carousel */
    .carousel-item img {
        width: 100%;
        height: 500px;
        /* Sesuaikan tinggi sesuai kebutuhan */

    }

    .btn-edit {
        display: block;
        border-radius: 10px;
        background-color: #AD343E;
        margin: 0 auto;
        width: 70%;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        transform: scale(1.05);
        font-family: 'Playfair Display', serif;
    }

    .btn-edit:hover {
        background-color: transparent;
        border-color: #AD343E;
        color: #AD343E;
        transform: scale(1.05);
    }

    .card {
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 10px 10px rgba(173, 52, 62, 20);
    }
</style>

<div class="container">
    <div class="center-container">
        <h2><b>OUR MENU</b></h2>
    </div>


    <div class="container">
        <div class="row">
            @forelse($jenis as $item)
            <div class="col-md-4 mb-3">
                <div class="card mx-auto" style="width: 20rem; cursor: pointer; padding: 10px;">
                    <div class="card-body">
                        <img src="{{ Storage::url($item->image) }}" class="d-block w-100" alt="profile">
                        <p style="text-align: center;"><b>{{$item->nama_produk}}</b></p>
                        <p class="card-text text-center">Rp. {{$item->harga_produk}}</p>
                        <a href="{{route('detailProduk.showById', $item->id_produk)}}" class="btn btn-block" style="background-color: #AD343E; color: white;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-4 mb-3">
                <div class="alert alert-danger">
                    Produk Yang Kamu Cari belum Tersedia
                </div>
            </div>
            @endforelse
        </div>
    </div>










    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-2EEThxCer39xQ+lfDX6PCYdMWihzD8xwQ/pG2QCX7+FXerLZ6l6bSQpD1FzvQZ3Y" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-D3GUgXaIue2jK3+8vooaP9Xo+R3qDjq0ydNyoE8i7eIcTZ98HYdy9vP27f5L " crossorigin=" anonymous"></script>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-G4Ffs47F3JGVmGvNJxha7PEWiIBkLlFge1rOMu0fYbVoFhYK0z35qW1aaG1xaxMz" crossorigin="anonymous"></script>


    @endsection