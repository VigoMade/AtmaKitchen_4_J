@extends('navbarHome')

@section('content')
<style>
  body {
    background-color: #FFFFFF;
    background-size: cover;
    background-repeat: no-repeat;
  }

  .flex-container {
  display: flex;
}

.vision-mission {
  flex: 1; /* Membagi ruang secara merata dengan gambar */
}

.container {
  flex: 1; /* Membagi ruang secara merata dengan elemen visi dan misi */
}

.smaller-image {
  max-width: 200px; /* Ukuran maksimum gambar */
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

  /* CSS */
.smaller-image {
  max-width: 400px; 
  max-height: 800px; 
    margin-left: 180px; /* Jarak ke kanan dari elemen lain */

}

  .carousel-item img {
    width: 100%;
    height: 300px; 
    object-fit: cover; 
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
<h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;"><b>About Us</b></h2>
</div>

<div class="flex-container">
  <div class="vision-mission">
    <h3>Visi Kami</h3>
    <ul>
      <li>Membuat produk-produk Atma Kitchen menjadi pilihan utama masyarakat Indonesia dalam memenuhi kebutuhan sehari-hari mereka di dapur.</li>
    </ul>
    <h3>Misi Kami</h3>
    <ul>
      <li>Terus mengembangkan produk-produk berkualitas tinggi, bergizi, dan sehat yang sesuai dengan selera Indonesia.</li>
      <li>Terus membuka toko baru untuk dapat diakses secara luas di seluruh wilayah.</li>
      <li>Terus meningkatkan kualitas sumber daya manusia dengan meningkatkan kesejahteraan dan kompetensi untuk memberikan pelayanan yang prima kepada pelanggan.</li>
    </ul>
  </div>

  <div class="container">
    <img src="{{ asset('images/store 1.jpeg') }}" class="d-block w-100 smaller-image" alt="...">
  </div>
</div>


  @endsection