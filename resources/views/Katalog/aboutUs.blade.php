@extends('navbarLandingPage')

@section('content')
<style>
  body {
    background-color: #ede6e3;
    background-size: cover;
    background-repeat: no-repeat;
  }

  .flex-container {
    display: flex;
  }

  .vision-mission ul {
    color: black;
    /* Mengubah warna teks menjadi hitam */
  }

  .vision-mission {
    flex: 1;
    color: #AD343E;
    /* Membagi ruang secara merata dengan gambar */
  }

  .container {
    flex: 1;
    /* Membagi ruang secara merata dengan elemen visi dan misi */
  }

  .smaller-image {
    max-width: 200px;
    margin-bottom: 10PX;
    /* Ukuran maksimum gambar */
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

  .smaller-image {
    max-width: 300px;
    max-height: 600px;
    margin-left: 180px;
    /* Jarak ke kanan dari elemen lain */

  }
</style>

<div class="container">
  <div class="center-container">
    <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;"><b>About
        Us</b></h2>
  </div>

  <div class="flex-container">
    <div class="vision-mission">
      <h3>Visi Kami</h3>
      <ul>
        <li>Membuat produk-produk Atma Kitchen menjadi pilihan utama masyarakat Indonesia dalam memenuhi kebutuhan
          sehari-hari mereka di dapur.</li>
      </ul>
      <h3>Misi Kami</h3>
      <ul>
        <li>Terus mengembangkan produk-produk berkualitas tinggi, bergizi, dan sehat yang sesuai dengan selera
          Indonesia.</li>
        <li>Terus membuka toko baru untuk dapat diakses secara luas di seluruh wilayah.</li>
        <li>Terus meningkatkan kualitas sumber daya manusia dengan meningkatkan kesejahteraan dan kompetensi untuk
          memberikan pelayanan yang prima kepada pelanggan.</li>
      </ul>
    </div>

    <div class="container">
      <img src="{{ asset('images/store 1.jpeg') }}" class="d-block w-100 smaller-image" alt="...">
    </div>
  </div>


  @endsection