<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Universitas Cahaya Bangsa</title>
    <style>
        body {
            background-color: #bdc3c7;
            margin: 0;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin: 20%;
            text-align: center;
            margin: 0px auto;
            width: 580px;
            max-width: 580px;
            margin-top: 10%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .garis {
            width: 75%;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="">Selamat Datang di yoUCB</h3>
        <hr class="garis">
        <p style="text-align: justify;">
        <table style="border: 0px;">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td>{{$nisn}}</td>
            </tr>
            <tr>
                <td>No Telpon</td>
                <td>:</td>
                <td>{{ $telp }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>:</td>
                <td>{{ $asal_sekolah }}</td>
            </tr>
            <tr>
                <td>Gelombang Pendaftaran</td>
                <td>:</td>
                <td>{{ $gelombang }}</td>
            </tr>
        </table>
        </p>
        <p>Silahkan Melakukan Login di <a href="https://pmb.youcb.ac.id">https://pmb.youcb.ac.id</a> dengan menggunakan email anda</p><br>
        <table style="border: 0px;">
            <tr>
                <td>Username/Email</td>
                <td>:</td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><strong>{{ $password }}</strong></td>
            </tr>
        </table>
        <br>
        <h4>Terima kasih telah melakukan registrasi</h4>
        <p>Silahkan melakukan pembayaran</p>
    </div>
</body>

</html>