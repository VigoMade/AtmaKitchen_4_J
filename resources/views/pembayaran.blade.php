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
</style>

<div class="container">
    <div class="center-container">
        <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;">
            <b>About
                Us</b>
        </h2>
    </div>

    <div style="border-bottom: 1px solid #EBE9F6">
        <div class="bg-white">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 md:grid-cols-4 gap-x-8 gap-y-8  px-6 py-8 lg:max-w-7xl lg:px-8 items-center">
                <div class="grid grid-cols-1 grid-rows-1">
                    <img src="{{ asset('images/store 1.jpeg') }}" class="bg-gray-100 rounded-lg">
                </div>
                <div class="col-span-3">
                    </h2>
                    <div class="mt-2">
                        <span
                            class="inline-block rounded-full px-3 py-1 text-base bg-[#F1FCFF] mr-2 mb-2 text-[#64CEEF]">Penjual
                            : Gabriel Allba</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                        <div>
                            <p>Tanggal Mulai Lelang</p>
                            <p class="text-gray-500">17 Mei 2023 10.00</p>
                        </div>
                        <div>
                            <p>Tanggal Lelang Berakhir</p>
                            <p class="text-gray-500">17 Mei 2023 10.00</p>
                        </div>
                        <div>
                            <p>Harga dasar</p>
                        </div>
                        <div>
                            <p>Pemenang</p>
                            <p class="text-gray-500">Kamu</p>
                            <p class="text-[#7964EF]">Rp. 660.000.000</p>
                        </div>
                        <div>
                            <p>Penawaran tertinggi kamu</p>
                            <p class="text-gray-500">Rp. 250.000.000</p>
                        </div>
                        <div>
                            <p style="cursor: pointer"
                                class="text-center flex w-full justify-center rounded-md bg-[#7964EF] p-2 text-white hover:shadow-lg hover:shadow-[#7964EF] transition-all upload-button">
                                Upload Bukti Transfer</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection