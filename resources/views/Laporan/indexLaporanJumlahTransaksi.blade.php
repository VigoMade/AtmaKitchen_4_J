<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jumlah Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Jumlah Transaksi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Customer</th>
                    <th>Nama Customer</th>
                    <th>Jumlah Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $data)
                <tr>
                    <td>{{ $data->id_customer }}</td>
                    <td>{{ $data->nama_customer }}</td>
                    <td>{{ $data->jumlah_transaksi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>