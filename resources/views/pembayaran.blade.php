@extends('navbarLandingPage')

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

<div class="container">
    <div class="center-container">
        <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;">
            <b>List Cart</b>
        </h2>
    </div>

    <table class="table" style="margin-bottom:100px;">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Total</th>
                <th scope="col">Bayar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><img src="{{ asset('images/hampers2.jpg') }}" alt="Iklan 3"
                        style="width: 150px; height: auto;" /></th>
                <td>Hampers</td>
                <td>1 Paket A</td>
                <td>Rp. 700.000</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">Pay Now</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Bank</label>
                                            <input type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="photo-upload" class="col-form-label">Upload Photo:</label>
                                            <input type="file" class="form-control" id="photo-upload" name="photo"
                                                accept="image/*">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

    </table>



    @endsection