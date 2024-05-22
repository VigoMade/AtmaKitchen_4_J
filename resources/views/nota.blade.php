<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
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
                <p>No Nota : 12345</p>
                <p>Tanggal Pesan : 2024-05-19</p>
                <p>Lunas Pada : 2024-06-19</p>
                <p>Tanggal ambil : 2024-06-19</p>

            </div>
        </div>

        <div class="invoice-body">
            <div class="billing-details">
                <h3>Customer: maharaniwatuwaya@gmail/maharanie</h3>
                <p>Jl. Raya Janti No. 34, Caturtunggal, Depok, Sleman</p>
                <p>Deliver : Kurir Yummy</p>


            </div>
            <div class="item">
                <div>1 Hampers Paket A</div>
                <div>: 650.000</div>
                <div>1 Keripik Kentang</div>
                <div>: 200.000</div>
            </div>
            <div class="item">
                <div>Total</div>
                <div>: 850.000</div>
                <div>Ongkos Kirim (rad.5 Km)</div>
                <div>: 10.000</div>
                <div>Total</div>
                <div>: 860.000</div>
                <div>Potongan 120 poin </div>
                <div>: -12.000</div>
                <div>Total </div>
                <div>: 858.000</div>
            </div>

            <div class="item">
                <div>Poin dari pesanan ini</div>
                <div>: 106</div>
                <div>Total Poin Customer</div>
                <div>: 210</div>
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