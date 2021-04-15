@extends('layouts.app')


@section('content')

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
            <h1> <i class="fas fa-info"></i>nformasi {{ $gelombang->thakademik->kode }} {{ $gelombang->gelombang }}</h1>
            </div>
        </div>
        </div>
    </section>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-th-list"></i> {{ $title }}
            </h3>
        </div>

        <div class="card-body">
            
            <img src="{{ asset('alur/'.$alur->gambar) }}" class="rounded img-fluid" alt="{{ $title }}">     
            
        </div>
    </div>

    
@endsection
