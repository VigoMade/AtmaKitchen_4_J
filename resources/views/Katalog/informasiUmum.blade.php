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
    <!-- <h2><b>OUR MENU</b></h2> -->
  </div>

  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/iklan 4.png') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/iklan 2.jpeg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/iklan 3.jpeg') }}" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;"><b>OUR
      CATEGORIES</b></h2>

  <div class="container">
    <div class="d-flex justify-content-center">
      <div id="breadCard" class="card mx-2" style="width: 20rem; cursor: pointer;">
        <div class="card-body">
          <img src="{{ asset('images/milkbun.jpeg') }}" class="d-block w-100" alt="...">
          <p style="text-align: center;"><b>Breads</b></p>
        </div>
      </div>
      <div id="cakesCard" class="card mx-2" style="width: 20rem;">
        <div class="card-body">
          <img src="{{ asset('images/spikoe.jpeg') }}" class="d-block w-100" alt="...">
          <p style="text-align: center;"><b>Cakes</b></p>
        </div>
      </div>
      <div id="drinkCard" class="card mx-2" style="width: 20rem;">
        <div class="card-body">
          <img src="{{ asset('images/minuman2.jpg') }}" class="d-block w-100" alt="...">
          <p style="text-align: center;"><b>Drinks</b></p>
        </div>
      </div>
      <div id="drinkCard" class="card mx-2" style="width: 20rem;">
        <div class="card-body">
          <img src="{{ asset('images/hampers3.jpg') }}" class="d-block w-100" alt="...">
          <p style="text-align: center;"><b>Hampers</b></p>
        </div>
      </div>
      <div id="otherCard" class="card mx-2" style="width: 20rem;">
        <div class="card-body">
          <img src="{{ asset('images/kentang1.jpg') }}" class="d-block w-100" alt="...">
          <p style="text-align: center;"><b>Others</b></p>
        </div>
      </div>

    </div>
  </div>





  <script>
    document.getElementById('breadCard').addEventListener('click', function () {
      window.location.href = "{{ route('informasiProduk.show', ['jenis_produk' => 'Bread']) }}";
    });

    document.getElementById('cakesCard').addEventListener('click', function () {
      window.location.href = "{{ route('informasiProduk.show', ['jenis_produk' => 'cake']) }}";
    });

    document.getElementById('drinkCard').addEventListener('click', function () {
      window.location.href = "{{ route('informasiProduk.show', ['jenis_produk' => 'drink']) }}";
    });

    document.getElementById('otherCard').addEventListener('click', function () {
      window.location.href = "{{ route('informasiProduk.show', ['jenis_produk' => 'other']) }}";
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-2EEThxCer39xQ+lfDX6PCYdMWihzD8xwQ/pG2QCX7+FXerLZ6l6bSQpD1FzvQZ3Y"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-D3GUgXaIue2jK3+8vooaP9Xo+R3qDjq0ydNyoE8i7eIcTZ98HYdy9vP27f5L " crossorigin=" anonymous"></script>

  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-G4Ffs47F3JGVmGvNJxha7PEWiIBkLlFge1rOMu0fYbVoFhYK0z35qW1aaG1xaxMz"
    crossorigin="anonymous"></script>


  @endsection