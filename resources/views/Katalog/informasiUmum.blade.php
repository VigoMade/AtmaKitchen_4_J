@extends('navbarHome')

@section('content')
<style>
  body {
    background-color: #FFFFFF;
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
        width: 100%; /* Menggunakan lebar gambar yang sesuai dengan tinggi */
        height: 100%; /* Mengisi tinggi carousel dengan gambar */
    }

    /* Menyesuaikan lebar dan tinggi gambar dalam carousel */
  .carousel-item img {
    width: 100%;
    height: 300px; /* Sesuaikan tinggi sesuai kebutuhan */
    object-fit: cover; /* Mengatur gambar agar tetap sesuai dengan ukuran carousel */
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
    <!-- <h2><b>OUR MENU</b></h2> -->
</div>

<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/iklan 4.png') }}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/iklan 2.jpeg') }}"  class="d-block w-100" alt="...">
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

  <h2 style="text-align: center; margin-top: 20px;"><b>OUR MENU</b></h2>


<div class="container">
  <div class="d-flex justify-content-center">
    <div class="card mx-2" style="width: 20rem;">
      <div class="card-body">
        <img src="{{ asset('images/brownies.jpeg') }}" class="d-block w-100" alt="...">
        <p style="text-align: center;"><b>OUR MENU</b></p>
      </div>
    </div>
    <div class="card mx-2" style="width: 20rem;">
      <div class="card-body">
        <img src="{{ asset('images/brownies.jpeg') }}" class="d-block w-100" alt="...">
        <p style="text-align: center;"><b>OUR MENU</b></p>
      </div>
    </div>
    <div class="card mx-2" style="width: 20rem;">
      <div class="card-body">
        <img src="{{ asset('images/brownies.jpeg') }}" class="d-block w-100" alt="...">
        <p style="text-align: center;"><b>OUR MENU</b></p>
      </div>
    </div>
    <div class="card mx-2" style="width: 20rem;">
      <div class="card-body">
        <img src="{{ asset('images/brownies.jpeg') }}" class="d-block w-100" alt="...">
        <p style="text-align: center;"><b>OUR MENU</b></p>
      </div>
    </div>
    <div class="card mx-2" style="width: 20rem;">
      <div class="card-body">
        <img src="{{ asset('images/brownies.jpeg') }}" class="d-block w-100" alt="...">
        <p style="text-align: center;"><b>OUR MENU</b></p>
      </div>
    </div>
  </div>
</div>




 


<!-- 
  <section class="pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3" style="color: #AD343E; font-family: 'Playfair Display', serif;"></h3>

        </div>
        <div class="col-6 text-right">
          <a class="btn btn-primary mb-3 mr-1" style="background-color: #AD343E; border-color: #AD343E;" href="#carouselExampleIndicators2" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
          </a>
          <a class="btn btn-primary mb-3" style="background-color: #AD343E; border-color: #AD343E;" href="#carouselExampleIndicators2" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>
        <div class="col-12">
          <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <a href="#">
                        <img class="img-fluid" alt="100%x280" src="{{ asset('images/lapislegit.jpeg') }}" />
                      </a>

                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Lapis Legit</h4>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/brownies.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Brownies</h4>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/lapisurabaya.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Lapis Surabaya</h4>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/mandarin.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Mandarin Cake</h4>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/brownies.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Brownies</h4>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/lapisurabaya.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Lapis Surabaya</h4>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/roti sosis.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Roti Sosis</h4>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/roti keju.jpeg') }}" />
                      <div class="card-body">
                       

                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <img class="img-fluid" alt="100%x280" src="{{ asset('images/milkbun.jpeg') }}" />
                      <div class="card-body">
                        <h4 class="card-title" style="color: #AD343E;">Milkbun</h4>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>





 -->


  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-2EEThxCer39xQ+lfDX6PCYdMWihzD8xwQ/pG2QCX7+FXerLZ6l6bSQpD1FzvQZ3Y" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-D3GUgXaIue2jK3+8vooaP9Xo+R3qDjq0ydNyoE8i7eIcTZ98HYdy9vP27f5L

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-G4Ffs47F3JGVmGvNJxha7PEWiIBkLlFge1rOMu0fYbVoFhYK0z35qW1aaG1xaxMz" crossorigin="anonymous"></script>


  @endsection