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
            width: 33%;
            /* Setiap kolom membagi 1/3 dari lebar */
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

        .total td {
            text-align: right;
        }

        .chart-container {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <div>Tahun : 2024</div>
                <div>Tanggal Cetak :{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            </div>

            <div class="invoice-body">
                <table>
                    <tr>
                        <th>Bulan</th>
                        <th>Jumlah Transaksi</th>
                        <th>Jumlah Uang</th>
                    </tr>
                    @forelse($laporan as $data)
                    <tr>
                        <td>
                            @if($data->bulan === 'Total Keseluruhan')
                            {{ $data->bulan }}
                            @else
                            {{ \Carbon\Carbon::parse($data->bulan)->locale('id')->isoFormat('MMMM') }}
                            @endif
                        </td>

                        <td>{{$data->jumlah_transaksi}}</td>
                        <td>Rp {{$data->total_pemasukan_bulanan}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">Tidak ada data</td>
                    </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const labels = <?php echo json_encode($chartData->pluck('bulan')); ?>;
        const data = <?php echo json_encode($chartData->pluck('total_pemasukan_bulanan')); ?>;

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Uang (Rp)',
                    data: data,
                    backgroundColor: 'rgba(60, 179, 113, 0.7)', // Warna hijau solid
                    borderColor: 'rgba(60, 179, 113, 1)', // Warna hijau solid
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>