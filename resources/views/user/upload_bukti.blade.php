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
                <i class="fas fa-user bg-blue"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Upload Bukti</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-clock bg-gray"></i>
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
        <form action="{{ url('user/uploadbukti') }}" method="POST" enctype="multipart/form-data" name="form-input" id="form-input">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="col">
                    <p>Lakukan Pembayaran dengan Transfer ke Rekening <strong>Bank Kalsel</strong><br>
                    Nomor Rekening : <strong>016.00.08.00004.3</strong> <br>Atas Nama : <strong>Yayasan Cahaya Bangsa</strong><br>
                    </p>
                    <p>*Hanya menerima bukti transfer berupa kertas, seperti melalui Teller dan ATM</p>
                    <div class="form-group">
                        <label>File Gambar</label>
                        <input type="file" class="form-control" name="file_bukti" id="file_bukti" required>
                        <span class="text-danger">File Gambar. Ukuran File Maksimal 2Mb.</span>
                        @error('file_bukti')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                </div>
       
                <!-- <a><strong>Tekan download dibawah sebagai bukti pembayaran</strong></a><br>
                       <a href="https://drive.google.com/file/d/17VduWocICgjl950FAqbdN0FMqi85yDnD/view?usp=sharing" target="blank" class="btn btn-success">Download</a> -->
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary btn-sm" id="simpan>
                    <i class="fas fa-upload"></i> Upload
                </button>
                
            </div>
        </form>    
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

