@extends('navbarLandingPage')

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
        justify-content: center;
        align-items: center;
        min-height: 100vh;
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
    font-family:'Playfair Display', serif;
    font-size: 20px;
    text-align: center;
    padding: 20px;
    border-radius: 30px; /* Menambah sudut melengkung */
    background-color: rgba(173, 52, 62, 0.8); /* Warna semi-transparan seperti warna navbar */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Menambah bayangan */
    color: #FFFFFF;
    display: flex; /* Membuat teks berada di tengah secara horizontal */
    align-items: center; /* Membuat teks berada di tengah secara vertikal */
}


    .btn-edit {
        display: block;
        border-radius: 10px;
        background-color: #AD343E;
        margin: 20px auto 0;
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
        <div class="col-md-4">
<h2 style="font-size: 3rem; margin-bottom: 20px;"><b>W E L C O M E </b></h2>

<p style="margin-bottom: 20px;">Selamat datang di Dunia Manis kami! Temukan kelezatan yang tersembunyi di setiap klik. Ayo masuk ke dalam dunia kue dan roti yang penuh cita rasa</p>

<button class="btn btn-edit" type="submit"> &#127856; Find Out More &#127838;</button>

</body>

@endsection
