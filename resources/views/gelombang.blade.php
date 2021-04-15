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
            
            @foreach ($list_gelombang as $item)
                <div class="callout {{ $item->aktif=='Y' ? 'callout-success' : 'callout-danger' }}">
                    <h5>{{ $item->gelombang }}</h5>

                    <dl class="row">
                        <dt class="col-sm-3">Biaya</dt>
                        <dd class="col-sm-8">Rp. {{ number_format($item->biaya) }}</dd>
                        
                        <dt class="col-sm-3">Tanggal Mulai</dt>
                        <dd class="col-sm-8">{{ Carbon\Carbon::parse($item->tgl_mulai)->format('d, M Y') }}</dd>
                        
                        <dt class="col-sm-3">Tanggal Selesai</dt>
                        <dd class="col-sm-8">{{ Carbon\Carbon::parse($item->tgl_selesai)->format('d, M Y') }}</dd>
                        
                        <dt class="col-sm-3">Ketua Panitia</dt>
                        <dd class="col-sm-8">{{ $item->ketua_panitia }}</dd>
                    </dl>
              </div>
            @endforeach        
            
        </div>
    </div>

    
@endsection
