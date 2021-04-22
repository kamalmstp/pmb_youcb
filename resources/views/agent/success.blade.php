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
            <div class="card-header text-center">
                <h2>Selamat Bergabung Sebagai Agent !</h2>
            </div>
            <div class="card-body">
                <div class="image">
                    <img src="{{ asset('img/success.ico') }}" class="center" width="15%" alt="Success">
                </div>
                <br>
                <div class="text-center">
                    <h1>Terima Kasih Atas Pendaftarannya!</h1>
                    <h5>Tim PMB yoUCB Akan Melakukan Verifikasi Terhadap Formulir Anda, <br> Anda Akan Menerima Email Dari Tim PMB yoUCB, <br> Kode Agent Akan Dikirimkan Melalui Email.</h5>
                </div>
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="text-center">
                            <a href="{{ url('') }}" type="button" class="btn btn-primary">{{ __('Kembali') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection