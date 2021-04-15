@extends('layouts.app_user')

@section('content')
<div class="row">
    <div class="col-2">
    
            <div class="timeline">
              <div class="time-label">
                <span class="bg-red">Alur Penerimaan</span>
              </div>
              <div>
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header">Daftar</h3>
                </div>
              </div>
              
              <div>
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Upload Bukti</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-user bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Validasi</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Mengisi Formulir</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Upload Persyaratan</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Biodata</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Kelulusan</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>

            </div>
          
    </div>

    <div class="col-10">
        

        <div class="card card-primary">
            <div class="card-header">
            <h5 class="m-0">{{ $title }}</h5> 
            </div>
        
            <div class="card-body">

                <div class="row">
                    <img src="{{ asset('file_bukti/'.$validasi->file_bukti) }}" class="img-fluid">                    
                </div>
                
            </div>

            <div class="card-footer text-center">
                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-in-alt"></i> LOGOUT
                </a>
            </div>
        
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function () {

        $("#form-input").submit(function (e) {
          $("#simpan").attr("disabled", true);
        });
    });
</script>
@endpush

