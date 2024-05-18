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
        height: 80px;
        background-color: #333;
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .image-container {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;
        border-radius: 8px;
        background-image: url('{{ Storage::url($produk->image) }}');
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

    .counter {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .counter button {
        padding: 10px 20px;
        font-size: 1rem;
        margin: 0 10px;
        background-color: #AD343E;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .counter span {
        font-size: 1.5rem;
        min-width: 30px;
        text-align: center;
    }

    .counter button:hover {
        background-color: #8b282f;
    }

    .modal .btn-primary {
        background-color: #AD343E;
    }

    .modal .btn-primary:hover {
        background-color: #8b282f;
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
                            <div class="image-container">
                            </div>

                            <div>
                                <h2 class="product-title">Detail Produk</h2>
                                <div class="tags">
                                    <span class="tag">Status</span>
                                    <span class="tag">{{$produk->status}}</span>
                                </div>
                                <p class="price-label">Harga Produk</p>
                                <p class="price"><b>Rp.{{$produk->harga_produk}}0</b></p>
                                <dl class="details">
                                    <div class="detail-item">
                                        <dt class="detail-title">Nama Produk</dt>
                                        <dd class="detail-description">{{$produk->nama_produk}}</dd>
                                    </div>
                                    <div class="detail-item">
                                        @if($produk->status == 'PO')
                                        <dt class="detail-title">Tanggal Pre Order </dt>
                                        <dd class="detail-description"> Open : {{$produk->tanggal_mulai_po}}</dd>
                                        <dd class="detail-description"> Close : {{$produk->tanggal_selesai_po}}</dd>
                                        @endif
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Deskripsi</dt>
                                        <dd class="detail-description">kue enak mantal nanti munucl resep di sini</dd>
                                    </div>
                                    <div class="detail-item">
                                        <dt class="detail-title">Satuan</dt>
                                        <dd class="detail-description">{{$produk->satuan_produk}}</dd>
                                    </div>
                                    @if($produk->tipe_produk == 'Produk Penitip')
                                    <div class="detail-item">
                                        <dt class="detail-title">Stock</dt>
                                        <dd class="detail-description">{{$produk->stock_produk}}</dd>
                                    </div>
                                    @endif
                                    @if($produk->tipe_produk == 'Produk Toko')
                                    <div class="detail-item">
                                        <dt class="detail-title">Kuota</dt>
                                        <dd class="detail-description">{{$produk->kuota}}</dd>
                                    </div>
                                    @endif
                                    <div class="detail-item">
                                        <dt class="detail-title">Total Bayar</dt>
                                        <dd class="detail-description">Rp. 1.000.000</dd>
                                        <div class="counter" style="margin-right: 10px;">
                                            <button onclick="decrement()">-</button>
                                            <span id="count">0</span>
                                            <button onclick="increment()">+</button>
                                        </div>
                                    </div>
                            </div>
                            </dl>
                        </div>
                        <div class="detail-item">
                            <a href="#" class="btn btn-add-cart">Add Cart</a>
                        </div>
                        <div class="detail-item">
                            <a href="#" class="btn btn-buy-now">Buy Now</a>
                        </div>
                    </div>
                </div>


            </div>

        </div>

</body>
</div>

<script>
    let count = 0;

    function increment() {
        count++;
        document.getElementById('count').innerText = count;
    }

    function decrement() {
        if (count > 0) {
            count--;
            document.getElementById('count').innerText = count;
        }
    }
</script>






@endsection