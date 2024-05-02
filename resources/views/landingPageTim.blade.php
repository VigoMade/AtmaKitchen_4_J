@extends('navbarMO')

@section('content')
<style>
    body {
        background-color: #F9F9F7;
        background-image: url('/images/bg1.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .center-container {
        display: flex;
        justify-content: space-around; /* Untuk menjaga agar kotak sejajar */
        align-items: flex-start; /* Untuk memposisikan kotak ke atas */
        flex-wrap: wrap; /* Untuk membuat kotak wrap ke baris baru */
        padding-top: 100px; /* Menambahkan sedikit ruang di atas */
        padding-bottom: 50px; /* Menambahkan sedikit ruang di bawah */
    }

    .welcome-box {
        width: 300px;
        margin-bottom: 200px; /* Menambahkan jarak antar kotak */
    }

    h2 {
        font-family: 'Playfair Display', serif;
        font-style: bold;
        font-size: 2.5rem;
        color: #AD343E; /* Menggunakan warna yang sama dengan navbar */
        text-align: center;
        margin-bottom: 20px;
    }

    p {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        text-align: center;
        padding: 20px;
        border-radius: 30px; /* Menambah sudut melengkung */
        background-color: rgba(173, 52, 62, 0.8); /* Warna semi-transparan seperti warna navbar */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Menambah bayangan */
        color: #FFFFFF;
    }

    .btn-edit {
        display: block;
        border-radius: 10px;
        background-color: #AD343E;
        margin: 0 auto; /* Pusatkan tombol secara horizontal */
        width: 70%;
        color: white;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        transform: scale(1.05);
    }

    .btn-edit:hover {
        background-color: transparent;
        border-color: #AD343E;
        color: #AD343E;
        transform: scale(1.05);
    }
</style>

<body>
    <div class="container center-container">
        <h2><b>Manajemen Pegawai</b></h2>
    </div>
    
    <div class="container center-container">
        <div class="welcome-box">
            <h2><b>MO</b></h2>
            <p>Jobdesc: Melakukan manajemen operasional.</p>
            <button class="btn btn-edit" type="submit"> &#127856; TES</button>
        </div>

        <div class="welcome-box">
            <h2><b>ADMIN</b></h2>
            <p>Jobdesc: Mengelola administrasi perusahaan.</p>
            <button class="btn btn-edit" type="submit"> &#127856; TES</button>
        </div>

        <div class="welcome-box">
            <h2><b>OWNER</b></h2>
            <p>Jobdesc: Bertanggung jawab atas kepemilikan dan keberhasilan perusahaan.</p>
            <button class="btn btn-edit" type="submit"> &#127856; TES</button>
        </div>
    </div>
</body>

@endsection
