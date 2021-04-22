@extends('layouts.app')
<style>
    img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    }
</style>

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
                <h1> <i class="fas fa-info"></i> Pendaftaran Sebagai Agent yoUCB</h1>
            </div>
        </div>
    </div>
</section>

<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-success card-outline">
            <!-- <div class="card-header">Header</div> -->
                <div class="card-body">
                <h5>Terimakasih telah bergabung sebagai agent bersama kampus yoUCB
                <br> Silahkan menunggu konfirmasi di Email yang telah didaftarkan</h5>
                    <div class="image">
                        <img src="{{ asset('img/undraw_done_a34v.svg') }}" class="center" width="75%" alt="Success">
                    </div>
                    <br>
                </div>
        </div>
        <!-- <div class="card text-white bg-success mb-3">
            <div class="card-header">Header</div>
            <div class="card-body">
                <p class="card-text">Terimkasih telah bergabung sebagai agent bersama kampus yoUCB.</p>
            </div>
        </div> -->
    </div>
</div>

@endsection