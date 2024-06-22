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
        margin-bottom: 10px;
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
        <h2 style="text-align: center; margin-top: 20px; text-decoration: underline; text-decoration-style: solid;"><b>Developer</b></h2>
    </div>

    <div class="flex-container">
        <div class="vision-mission" id="developer-info">
            <h3>Vigo Made Prastyo - 210711303</h3>
            <ul>
                <li>Fullstack developer yang bertanggung jawab untuk membuat frontend dan backend dari Website & Mobille AtmaKitchen</li>
            </ul>
        </div>

        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner img-fluid">
                    <div class="carousel-item active" data-developer="vigo">
                        <img src="{{ asset('images/Vigo.png') }}" class="d-block w-100 smaller-image" alt="...">
                    </div>
                    <div class="carousel-item" data-developer="maharani">
                        <img src="{{ asset('images/maharani.png') }}" class="d-block w-100 smaller-image" alt="...">
                    </div>
                    <div class="carousel-item" data-developer="antonius">
                        <img src="{{ asset('images/anton.png') }}" class="d-block w-100 smaller-image" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <hr>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselElement = document.querySelector('#carouselExampleIndicators');
            const developerInfoElement = document.querySelector('#developer-info');

            const developerData = {
                vigo: {
                    name: "Vigo Made Prastyo - 210711303",
                    description: "Fullstack developer yang bertanggung jawab untuk membuat frontend dan backend dari Website & Mobille AtmaKitchen"
                },
                maharani: {
                    name: "Maharani Putri Watuwaya - 210711288",
                    description: "Frontend Developer yang bertanggung jawab memegang tampilan dari website AtmaKitchen"
                },
                antonius: {
                    name: "Antonius Malir Istia - 200710880",
                    description: "Fullstack developer yang bertanggung jawab untuk membuat frontend dan backend dari Website & Mobille AtmaKitchen"
                }
            };

            carouselElement.addEventListener('slid.bs.carousel', function(event) {
                const currentItem = event.relatedTarget.getAttribute('data-developer');
                const developerInfo = developerData[currentItem];

                developerInfoElement.innerHTML = `
                    <h3>${developerInfo.name}</h3>
                    <ul>
                        <li>${developerInfo.description}</li>
                    </ul>`;
            });
        });
    </script>

    @endsection