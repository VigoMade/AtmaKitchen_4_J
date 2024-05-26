<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Atma Kitchen</title>
    <link rel="icon" href="{{ asset('images/logo4.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .invoice-container {
            max-width: 380px;
            /* Mengurangi lebar maksimum */
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid black;
            /* Garis pinggir merah */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header,
        .invoice-body,
        .invoice-footer {
            margin-bottom: 20px;
        }

        .company-details,
        .invoice-details,
        .billing-details {
            margin-bottom: 20px;
        }

        .company-details h2,
        .invoice-details h2,
        .billing-details h3 {
            margin: 0 0 10px 0;
        }

        .item,
        .total {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .item:last-child,
        .total:last-child {
            border-bottom: none;
        }


        .item div,
        .total div {
            display: inline-block;
            width: 49%;
        }

        .total div {
            font-weight: bold;
        }

        .total div:last-child {
            text-align: right;
        }

        .invoice-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-details">
                <h2>Atma Kitchen</h2>
                <p>Jl. Raya Abadai, Sleman, Yogyakarta</p>
            </div>
            <div class="invoice-details">
                <p>No Nota : {{$transaksi->id_transaksi}}</p>
                <p>Tanggal Pesan : {{$transaksi->tanggal_transaksi}}</p>
                <p>Lunas Pada : {{$transaksi->tanggal_pembayaran}}</p>
                <p>Tanggal ambil : {{$transaksi->tanggal_selesai}}</p>

            </div>
        </div>

        <div class="invoice-body">
            <div class="billing-details">
                <h3>Customer: {{$user->email}}/{{$user->nama}}</h3>
                <p>{{$alamat->alamat_customer}}</p>
                <p>Deliver : Kurir Yummy</p>


            </div>
            <div class="item">
                <div>{{$transaksi->nama_produk}}</div>
                <div>: Rp. {{$transaksi->harga_produk}}</div>
                <div>Jumlah</div>
                <div>: {{$transaksi->jumlah_produk}} Produk</div>
            </div>
            <div class="item">
                <div>Total</div>
                <div>: Rp. {{$transaksi->total_seluruh}}</div>
                <div>Ongkos Kirim (rad.5 Km)</div>
                <div>: Rp. {{$transaksi->ongkos_kirim}}</div>
                <div>Total + Ongkir</div>
                <div>: Rp. {{$transaksi->total_pembayaran_baru}}</div>
                <div>
                    @if($transaksi->poin_digunakan == 0)
                    Potongan 0 poin
                    @else
                    Potongan {{$transaksi->poin_digunakan}} poin
                    @endif
                </div>
                <div>:
                    @if($transaksi->poin_digunakan == null)
                    0
                    @else
                    - Rp. {{$transaksi->poin_dipake}}
                    @endif
                </div>
                <div>Total </div>
                <div>:
                    @if($transaksi->poin_digunakan == null)
                    0
                    @else
                    Rp. {{$transaksi->total_setelah_diskon}}
                    @endif
                </div>
            </div>

            <div class="item">
                <div>Poin dari pesanan ini</div>
                <div>: @if($transaksi->poin_bonus == null)
                    0
                    @else
                    {{$transaksi->poin_bonus}}
                    @endif
                </div>
                <div>Total Poin Customer</div>
                <div>: {{$user->poin_customer}}</div>
            </div>

            <div class="invoice-footer">
                <p>Thank you for spending your money at Atma Kitchen!</p>
                <p>If you have any questions about this invoice, please contact us at info@atmakirchen.com or (123)
                    456-7890.
                </p>
            </div>
        </div>
</body>

</html>