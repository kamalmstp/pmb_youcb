@extends('layouts.app')


@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
                <h1> <i class="fas fa-info"></i>Agent PMB yoUCB</h1>
            </div>
        </div>
    </div>
</section>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-th-list"> Pendaftaran Sebagai Agent yoUCB</i>
        </h3>
    </div>

    <div class="card-body">
        <dd class="col-sm-8">
            Bagi kalian yang ingin tetap menghasilkan profit di tengah kondisi pandemi ini,
            kami ada caranya untuk kalian. Yaitu dengan cara menjadi Agent di yoUCB.
            Program ini memberikan kesempatan bagi anda untuk meraup keuntungan hingga jutaan rupiah.
            Tujuan diberlakukan penghargaan berjenjang bagi pemberi referensi melalui program yoUCB Mencari Agent,
            untuk lebih mengapresiasi pemberi referensi dan sebagai informasi positif bagi calon mahasiswa/i agar
            mengambil studi di Universitas Cahaya Bangsa. Program ini adalah program yang memberikan penghargaan
            berupa dana tunai kepada setiap pemberi referensi yang berhasil mengajak calon mahasiswa/i sehingga
            menjadi mahasiswa/i di salah satu program studi di Universitas Cahaya Bangsa. Berikut adalah Program Agent yang Tersedia :</dd>
        <br>

        <div class="callout callout-info">
            <h5><strong>Agent yoUCB Lembaga</strong></h5>

            <dl class="row">
                <dd class="col-sm-8">Agent yoUCB Lembaga adalah </dd>
                <dd>
                    <a class="btn btn-info" href="{{ url('agent_lembaga') }}">
                        <i class="fas fa-sign-in-alt"></i> Daftar Sekarang
                    </a>
                </dd>
            </dl>
        </div>

        <div class="callout callout-warning">
            <h5><strong>Agent yoUCB Perseorangan</strong></h5>

            <dl class="row">
                <dd class="col-sm-8">Agent yoUCB Perseorangan adalah ................</dd>
                <dd>
                    <a class="btn btn-warning" href="{{ url('agent_individu') }}">
                        <i class="fas fa-sign-in-alt"></i> Daftar Sekarang
                    </a>
                </dd>
            </dl>
        </div>

    </div>
</div>


@endsection