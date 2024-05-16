@extends('navbarlandingPage')

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

  /* Menyesuaikan lebar dan tinggi gambar dalam carousel */
  .carousel-item img {
    width: 100%;
    height: 300px;
    /* Sesuaikan tinggi sesuai kebutuhan */
    object-fit: cover;
    /* Mengatur gambar agar tetap sesuai dengan ukuran carousel */
  }

  .btn-edit:hover {
    background-color: transparent;
    border-color: #AD343E;
    color: #AD343E;
    transform: scale(1.05);
  }
</style>

<div class="container">
  <div class="center-container">
    <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;"><b>Our
        Store</b></h2>
    <p style="text-align: justify;">Selamat datang di Atma Kitchen, destinasi utama bagi para pecinta kue dan roti di
      Yogyakarta. Di sini, kami menghadirkan pengalaman berbelanja yang unik dengan fokus pada kualitas dan kelezatan.
      Dari kue-kue klasik yang melekat di kenangan hingga kreasi inovatif yang memikat lidah, kami memiliki berbagai
      pilihan yang cocok untuk semua selera. Setiap hari, kami menyajikan roti segar dan kue-kue yang dipanggang dengan
      cinta oleh para ahli kami, memberikan Anda kesempatan untuk merasakan kelezatan yang tak terlupakan.</p>

  </div>

  <div class="container">
  </div>


  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <img src="{{ asset('images/store 1.jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;"
            alt="...">
          <p style="text-align: center;"><b>Atma Kitchen Store</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <img src="{{ asset('images/store 5.jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;"
            alt="...">
          <p style="text-align: center;"><b>Atma Kitchen Store</b></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <img src="{{ asset('images/store 4.jpeg') }}" class="d-block w-100" style="height: 300px; object-fit: cover;"
            alt="...">
          <p style="text-align: center;"><b>Atma Kitchen Store</b></p>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection