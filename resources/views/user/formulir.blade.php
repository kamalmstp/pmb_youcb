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
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">Upload Persyaratan</h3>
                  </div>
              </div>

              <div>
                <i class="fas fa-user bg-blue"></i>
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
            <h5 class="m-0">BIODATA CALON MAHASISWA</h5> 
            </div>

            <div class="card-body">

                <div class="card-body box-profile">
                    @if($formulir->foto)
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('foto_users/'.$formulir->foto) }}" alt="User profile picture">
                        </div>
                    @endif
    
                    <h3 class="profile-username text-center">{{ $formulir->nama }}</h3>
    
                    <p class="text-muted text-center">{{ $formulir->prodi->jenjang }} - {{ $formulir->prodi->nama }}</p>
                    <p class="text-muted text-center">{{ $formulir->kelas->nama }}</p>
                    <p class="text-muted text-center">Kode Agent: {{ $formulir->kode_agent }}</p>
    
                </div>
                <hr>
                  
                <div class="row">
                    <div class="col">
                        <strong>Nomor Formulir</strong>
                        <p class="text-muted">
                        {{ $formulir->nomor }}
                        </p>
                    </div>
                    <div class="col">
                        <strong>Tanggal</strong>
                        <p class="text-muted">
                            @php
                            use Carbon\Carbon;    
                            \Carbon\Carbon::setLocale('id');
                            @endphp
                        {{ with(new Carbon($formulir->tanggal))->format('d, M Y') }}
                        </p>
                    </div>
                    <div class="col">
                        <strong>Tahun Akademik</strong>
                        <p class="text-muted">
                        {{ $formulir->thakademik->kode }}
                        </p>
                    </div>
                    <div class="col">
                        <strong>Gelombang</strong>
                        <p class="text-muted">
                        {{ $formulir->gelombang->gelombang }}
                        </p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>NIK</strong>
                        <p class="text-muted">
                        {{ $formulir->nik }}
                        </p>
                    </div>
                    <div class="col">
                        <strong>NISN</strong>
                        <p class="text-muted">
                        {{ $formulir->nisn }}
                        </p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>Nama Lengkap</strong>
                        <p class="text-muted">{{ $formulir->nama }}</p>
                    </div>
                    <div class="col">
                        <strong>Jenis Kelamin</strong>
                        <p class="text-muted">{{ $formulir->jeniskelamin->nama }}</p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>Tempat Lahir</strong>
                        <p class="text-muted">{{ $formulir->tempat_lahir }}</p>
                    </div>
                    <div class="col">
                        <strong>Tanggal Lahir</strong>
                        <p class="text-muted">{{ with(new Carbon($formulir->tanggal_lahir))->format('d, M Y') }}</p>
                    </div>
                </div>
                <hr>

                
                <div class="row">
                    <div class="col">
                        <strong>Alamat</strong>
                        <p class="text-muted">{{ $formulir->alamat }}</p>
                    </div>
                    <div class="col">
                        <strong>Kota</strong>
                        <p class="text-muted">{{ $formulir->kota->name }}</p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>Email</strong>
                        <p class="text-muted">{{ $formulir->email }}</p>
                    </div>
                    <div class="col">
                        <strong>HP</strong>
                        <p class="text-muted">{{ $formulir->hp }}</p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>NIK Ayah</strong>
                        <p class="text-muted">{{ $formulir->nik_ayah }}</p>
                    </div>
                    <div class="col">
                        <strong>Nama Ayah</strong>
                        <p class="text-muted">{{ $formulir->nama_ayah }}</p>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col">
                        <strong>NIK Ibu</strong>
                        <p class="text-muted">{{ $formulir->nik_ibu }}</p>
                    </div>
                    <div class="col">
                        <strong>Nama Ibu</strong>
                        <p class="text-muted">{{ $formulir->nama_ibu }}</p>
                    </div>
                </div>
                <hr>
                @if ($formulir->syarat)
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-bordered table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Berkas</th>
                                <th class="text-center">Berkas</th>
                                <th class="text-center">Valid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($formulir->syarat as $item)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>    
                                    <td>{{ $item->nama_berkas }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('dokumen_syarat/'.$item->berkas) }}" alt="" width="150">
                                    </td>
                                    <td class="text-center">
                                        {{ $item->valid }}
                                    </td>
                                </tr>                
                            @endforeach
                        </tbody>
                    </table>
                </div>  
                @endif
                
                

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

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>
@endpush