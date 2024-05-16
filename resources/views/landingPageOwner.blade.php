@extends('navbarOwner')

@section('content')
<style>
  body {
    background-color: #ede6e3;
    background-size: cover;
    font-family: 'Playfair Display', serif;
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

  .btn-primary {
    background-color: #AD343E;
    /* Ubah warna latar belakang tombol */
    border-color: #AD343E;
    /* Ubah warna pinggiran tombol */
    color: #fff;
    /* Sesuaikan warna teks dengan kebutuhan Anda */
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
    <h2><b>MANEJEMEN PEGAWAI</b></h2>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{ asset('images/owner3.png') }}" class="img-fluid rounded-start"
                style="width: 200px; height: 200px; margin-right:80px;" alt="...">

            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title" style="color: #AD343E; font-weight: bold;">O W N E R</h5>
                <p class="card-text" style="color: #AD343E;"> Sebagai owner atma kitchen, tugasnya meliputi berbagai
                  aspek manajemen, pengembangan bisnis, dan meliputi proses pengajian dalam toko.</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- <div style="display: flex;">
    <div style="flex: 1; display: flex; justify-content: center;">
        <img src="{{ asset('images/admin2.png') }}" class="img-fluid rounded-start" alt="Admin Image" style="max-width: 300px; height: 400px; margin-left:200px" />
    </div>

    <div style="flex: 1;">
        <div class="card" style="margin-top:90px;">
            <div class="card-body">
                <h5 class="card-title" style="color: #AD343E; font-weight: bold;">A D M I N</h5>
                <p class="card-text" style="color: #AD343E;">Sebagai admin di toko roti online, tanggung jawab Anda meliputi manajemen pesanan, pengelolaan stok, pemeliharaan situs web, pelayanan pelanggan, keuangan, pengemasan dan pengiriman, pemasaran, administrasi, dan pemeliharaan database pelanggan. Anda perlu memiliki keterampilan multitasking, komunikasi yang baik, ketelitian dalam detail, dan pemahaman tentang industri roti dan belanja online.</p>
                
            </div>
        </div>
    </div>
</div> -->



  <section class="pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h3 class="mb-3" style="color: #AD343E;">Jobdesc Detail</h3>
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
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Pencatatan Pengeluaran Lainnya</div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan penambahan pencatatan pengeluaran
                          lainnya, mengubah pencatatan pengeluaran lainnya ,menghapus pencatatan pengeluaran lainnya,
                          menampilkan pencatatan pengeluaran lainnya, mencari pencatatan pengeluaran lainnya.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Pencatan Pembelian Bahan Baku</div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan penambahan pembelian bahan baku, mengubah
                          pembelian bahan baku, menghapus pembelian bahan baku, menampilkan pembelian bahan baku,
                          mencari pembelian bahan baku.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Mengelola Data Karyawan </div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan penambahan data karyawan, mengubah data
                          karyawan,menghapus data karyawan, menampilkan data karyawan, mencari data karyawan.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Mencari Data Customer</div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan pengubahan pada presensi serta
                          menampilkan presensi karyawan.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Mengelola Data Jabatan</div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan penambahan data jabatan, mengubah data
                          jabatan, menghapus data jabatan, menampilkan data jabatan, mencari data jabatan.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="card text-white bg-white mb-3" style="max-width: 18rem;">
                      <div class="card-header">Mengelola Data Penitip</div>
                      <div class="card-body">
                        <p class="card-text" style="color: #AD343E;">Melakukan penambahan penitip, mengubah penitip,
                          menghapus penitip, menampilkan penitip, mencari penitip.
                        <p>
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
</div>
</section>









<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

@endsection