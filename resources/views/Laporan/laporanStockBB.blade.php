<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Atma Kitchen</title>
    <link rel="icon" href="{{ asset('images/logo4.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .invoice-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid black;
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
            vertical-align: top;
            /* Menjaga agar elemen tetap sejajar */
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-details">
                <h2>Atma Kitchen</h2>
                <p>Jl. Raya Abadi, Sleman, Yogyakarta</p>
            </div>
        </div>

        <div class="invoice-body">
            <div class="billing-details">
                <h3 style="display: inline-block; border-bottom: 2px solid black; padding-bottom: 1px;">Laporan
                    Penjualan Bulanan</h3>
                <div>Bulan : Februari</div>
                <div>Tahun : 2024</div>
                <div>Tanggal Cetak : 2 Februari 2024</div>
            </div>

            <table>
                <tr>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>Lapis Legis 1 Loyang</td>
                    <td>5</td>
                    <td>Rp 850.000</td>
                    <td>Rp 8.500.000</td>
                </tr>
                <tr class="total">
                    <td colspan="3" style="text-align: right;">Total</td>
                    <td>Rp. 10.000.000</td>
                </tr>
            </table>


        </div>
    </div>
</body>

</html>