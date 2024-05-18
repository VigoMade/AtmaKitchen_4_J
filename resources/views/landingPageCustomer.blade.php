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
</style>

<div class="container">
  <div class="center-container">
    <h2><b>W E L C O M E</b></h2>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{ asset('images/customer3.png') }}" class="img-fluid rounded-start"
                style="width: 250px; height: 200px; margin-right:80px;" alt="...">

            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title" style="color: #AD343E; font-weight: bold;">Customer</h5>
                <p class="card-text" style="color: #AD343E;"> Salam hangat dari toko roti kami! Temukan kelezatan tiada
                  tara dari koleksi roti segar kami. Mari nikmati setiap gigitan dengan kepuasan yang tak terlupakan.
                  Selamat berbelanja!</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3" style="color: #AD343E; font-family: 'Playfair Display', serif;">Our Menu</h3>
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-primary mb-3 mr-1" style="background-color: #AD343E; border-color: #AD343E;"
            href="#carouselExampleIndicators2" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
          </a>
          <a class="btn btn-primary mb-3" style="background-color: #AD343E; border-color: #AD343E;"
            href="#carouselExampleIndicators2" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
        <div class="col-12">
          <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @php
        $chunks = $produk->chunk(3);
      @endphp
              @foreach($chunks as $chunkIndex => $chunk)
        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
          <div class="row">
          @foreach($chunk as $item)
      <div class="col-md-4 mb-3">
        <div class="card">
        <img class="img-fluid" alt="100%x280" src="{{ Storage::url($item->image) }}"
        style="width: 100%; height: 280px;" />

        <div class="card-body">
        <h4 class="card-title" style="color: #AD343E;">{{ $item->nama_produk }}</h4>
        </div>
        </div>
      </div>
    @endforeach
          </div>
        </div>
      @endforeach
              @if($produk->isEmpty())
        <div class="carousel-item active">
          <p>No data</p>
        </div>
      @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>







  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

  @endsection