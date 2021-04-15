@extends('layouts.app_admin')
@section('title',$title)
@section('content')

@include('admin.dashboard')

<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="m-0">@yield('title')</h5>
    </div>

    <div class="card-body">
        Selamat Datang, <b>{{ Auth::user()->name }}</b> di Sistem {{ config('app.name') }}.
    </div>
</div>
@endsection
