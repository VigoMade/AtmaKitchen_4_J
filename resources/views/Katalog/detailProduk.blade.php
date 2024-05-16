@extends('navbarlandingPage')

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

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .card {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #AD343E;
        margin-bottom: 10px;
    }

    .subtitle {
        font-size: 1rem;
        font-weight: medium;
        color: #555;
    }

    .mt-4 {
        margin-top: 20px;
    }

    .card-body {
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 1024px) {
        .grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    .image-container {
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .image {
        border-radius: 8px;
        width: 100%;
        height: auto;
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #AD343E;
    }

    .tags {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        color: #AD343E;
    }

    .tag {
        display: inline-block;
        padding: 5px 10px;
        font-size: 1rem;
        border-radius: 16px;
        background-color: #f6e9ea;
        color: #AD343E;
    }

    .price-label {
        margin-top: 20px;
        color: #555;
    }

    .price {
        font-size: 1.5rem;
        color: #AD343E;
    }

    .details {
        margin-top: 20px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
        color: #AD343E;
    }

    .detail-item {
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

    .detail-title {
        font-size: 1rem;
        color: #AD343E;
    }

    .detail-description {
        font-size: 0.875rem;
        color: #555;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1rem;
        color: white;
        background-color: #7964ef;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        margin-top: 10px;
    }

    .navbar {
        width: 100%;
        /* Tetapkan lebar 100% */
        height: 80px;
        /* Tetapkan tinggi */
        background-color: #333;
        /* Warna latar belakang */
        color: white;
        /* Warna teks */
        position: fixed;
        /* Tetapkan posisi tetap */
        top: 0;
        /* Atur posisi di bagian atas halaman */
        left: 0;
        /* Atur posisi di bagian kiri halaman */
        z-index: 1000;
        /* Tetapkan z-index agar navbar tampil di atas konten lain */
    }

    .image-container {
        background-size: cover;
        /* Untuk memastikan gambar selalu menutupi area kontainer */
        background-position: center;
        /* Untuk mengatur posisi gambar */
        background-repeat: no-repeat;
        /* Untuk menghindari pengulangan gambar */
        width: 100%;
        /* Lebar sesuai dengan parent (card) */
        height: 100%;
        /* Atur tinggi gambar sesuai kebutuhan Anda */
        border-radius: 8px;
        /* Atur sudut bulat jika diperlukan */
    }

    .btn {
        display: inline-block;

        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-buy-now {
        color: #AD343E;
        padding: 8px 485px;
        background-color: white;
        border: 2px solid #AD343E;
    }

    .btn-add-cart {
        color: white;
        padding: 8px 485px;
        background-color: #AD343E;
        border: 2px solid #AD343E;
    }

    .btn-buy-now:hover {
        background-color: #AD343E;
        color: white;
    }

    .btn-add-cart:hover {
        background-color: #FFFFFF;
        color: #AD343E;
        border-color: #AD343E;


    }
</style>

<body>

    <div class="container">
        <div class="center-container">
            <h2 style="text-decoration: underline;"><b>Our Menu</b></h2>
            <div class="container">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="grid">
                            <div class="image-container"
                                style="background-image: url('{{ asset('images/mandarin.jpeg') }}');">
                            </div>

                            <div>
                                <h2 class="product-title">Detail Produk</h2>
                                <div class="tags">
                                    <span class="tag">Status</span>
                                    <span class="tag">Open Order</span>
                                </div>
                                <p class="price-label">Harga Produk</p>
                                <p class="price"><b>Rp. 1.000.000</b></p>
                                <dl class="details">
                                    <div class="detail-item">
                                        <dt class="detail-title">Nama Produk</dt>
                                        <dd class="detail-description">Mandarin Cake</dd>
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Tanggal Pre Order </dt>
                                        <dd class="detail-description"> Open : 01-01-2023</dd>
                                        <dd class="detail-description"> Close : 01-01-2023</dd>
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Deskripsi</dt>
                                        <dd class="detail-description">kue enak mantal nanti munucl resep di sini</dd>
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Satuan</dt>
                                        <dd class="detail-description">1 Loyang</dd>
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Stock</dt>
                                        <dd class="detail-description">10</dd>
                                    </div>


                                </dl>
                            </div>
                        </div>


                    </div>
                    <div class="detail-item">
                        <a href="#" class="btn btn-buy-now">Buy Now</a>
                    </div>

                    <div class="detail-item">
                        <a href="#" class="btn btn-add-cart">Add Cart</a>
                    </div>
                </div>
            </div>

</body>
</div>






@endsection