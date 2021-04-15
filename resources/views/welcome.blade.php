@extends('layouts.app')

@section('carousel')
    @include('carousel')
@endsection



@section('content')

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
            <h1> <i class="fas fa-info"></i>nformasi  {{ $gelombang->thakademik->kode }} {{ $gelombang->gelombang }}</h1>
            </div>
        </div>
        </div>
    </section>

    @foreach ($info as $item)
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title m-0">{{ $item->judul }}</h3>
        </div>

        <div class="card-body">
            {!! $item->isi !!}
            
        </div>
    </div>

    @endforeach
@endsection
