<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun</title>
</head>

<body>
    <p>
        Halo <b>{{$details['username']}}</b>
    </p>
    <p>
        Anda akan melakukan reset password dengan menggunakan email ini.
    </p>
    <p>
        berikut adalah data anda:
    </p>

    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>{{$details['username']}}</td>
        </tr>
        <tr>
            <td>Website</td>
            <td>:</td>
            <td>{{$details['website']}}</td>
        </tr>
        <tr>
            <td>Tanggal Register</td>
            <td>:</td>
            <td>{{$details['datetime']}}</td>
        </tr>
    </table>

    <center>
        <h3>
            Buka link dibawah untuk melakukan reset password akun.
        </h3>
        <a href="" class="btn btn-primary">Reset Password</a>
        <b style="color:blue;">{{$details['url']}}</b>
    </center>
    <p>
        Terima kasih telah percaya
    </p>
</body>

</html>