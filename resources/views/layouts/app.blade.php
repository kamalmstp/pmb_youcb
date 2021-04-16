<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="{{ url('') }}" class="navbar-brand">
          {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8"> --}}
          <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{ url('') }}" class="nav-link">
                <i class="fas fa-home"></i> Beranda</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('program_studi') }}" class="nav-link">
                <i class="fas fa-th-list"></i> Program Studi</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('gelombang') }}" class="nav-link">
                <i class="fas fa-calendar-alt"></i> Gelombang</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('alur_pendaftaran') }}" class="nav-link">
                <i class="fas fa-capsules"></i> Alur Pendaftaran</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('agent') }}" class="nav-link">
                <i class="fas fa-users"></i> Agent</a>
            </li>

          </ul>

        </div>



        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item mr-2">
            <a class="btn btn-primary btn-sm" href="{{ url('login') }}">
              <i class="fas fa-sign-in-alt"></i> Login
            </a>
          </li>

          <li class="nav-item">
            <a class="btn btn-primary btn-sm" href="{{ url('register') }}">
              <i class="fas fa-edit"></i> Daftar
            </a>
          </li>

        </ul>
      </div>
    </nav>




    <div class="content-wrapper">

      @yield('carousel')

      <div class="content">
        <div class="container">
          @yield('content')
        </div>
      </div>
    </div>


    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        Penerimaan Mahasiswa Baru
      </div>
      <strong>Copyright &copy; {{date('Y')}} <a href="{{url('http://youcb.ac.id')}}" target="_blank">Universitas Cahaya Bangsa</a>.</strong> All rights reserved.
    </footer>
  </div>

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>