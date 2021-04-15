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
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Validasi</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Mengisi Formulir</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-user bg-blue"></i>
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
        <form action="{{ url('user/uploadbukti/'.$formulir->id) }}" method="POST" enctype="multipart/form-data" name="form-input" id="form-input">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Nama File</label>
                            <input type="text" class="form-control" name="nama_berkas" id="nama_berkas" required placeholder="File Ijazah/File Nilai/Sertifikat Kejuruan">
                            @error('nama_berkas')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>File Gambar</label>
                            <input type="file" class="form-control" name="berkas" id="berkas" required>
                            @error('berkas')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <ol>
                    <li>Ijazah terakhir beserta daftar nilai (Legalisir) <strong>(Wajib)</strong></li>
                    <li>Ijazah SD, SLTP, dan SLTA (tidak perlu legalisir) <strong>(Wajib)</strong></li>
                    <li>Surat Keterangan Sehat dan Tidak Buta Warna dari Dokter/Puskesmas <strong>(Wajib)</strong></li>
                    <li>Akta Kelahiran <strong>(Wajib)</strong></li>
                    <li>Kartu Tanda Penduduk <strong>(Wajib)</strong></li>
                    <li>Kartu Keluarga <strong>(Wajib)</strong></li>
                    <li>Sertifikat Kejuaraan (opsional)</li>
                </ol>

                @if ($persyaratan)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($persyaratan as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_berkas }}</td>
                                    <td>
                                        <img src="{{ asset('dokumen_syarat/'.$item->berkas) }}" alt="" width="150">
                                    </td>
                                </tr>
                            @endforeach    
                        </tbody>
                    </table>
                    
                @endif
                
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary btn-sm" id="simpan">
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

