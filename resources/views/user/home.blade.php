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
        <i class="fas fa-user bg-blue"></i>
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
        <h5 class="m-0">FORMULIR CALON MAHASISWA <small>Isi dengan Lengkap</small></h5>
      </div>

      <form role="form" action="{{ url('user/formulir') }}" method="POST" name="form-input" id="form-input" enctype="multipart/form-data">
        @csrf
        <div class="card-body">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tahun Akademik</label>
                <input type="text" class="form-control @error('th_akademik') is-invalid @enderror" name="th_akademik" readonly value="{{ $gelombang->thakademik->kode }}" required>
                @error('th_akademik')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Gelombang</label>
                <input type="text" class="form-control @error('gelombang') is-invalid @enderror" name="gelombang" readonly value="{{ $gelombang->gelombang }}" required>
                @error('gelombang')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kode Agent</label><sup>* jika ada</sup>
                <input type="text" class="form-control @error('kode_agent') is-invalid @enderror" name="kode_agent" id="kode_agent">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="listSearch form-group">
                <label>Nama Agent</label>
                <input type="text" id="nama_agent" class="form-control" disabled value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Program Studi</label>
                <select class="form-control select2bs4  @error('prodi_id') is-invalid @enderror" style="width: 100%;" name="prodi_id" id="prodi_id" required>
                  <option value="">-Pilih-</option>
                  @foreach ($list_prodi as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} - {{ $prodi->nama }}</option>
                  @endforeach
                </select>
                @error('prodi_id')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kelas</label>
                <select class="form-control select2bs4  @error('kelas_id') is-invalid @enderror" style="width: 100%;" name="kelas_id" id="kelas_id" required>
                  <option value="">-Pilih-</option>
                  @foreach ($list_kelas as $kelas)
                  <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                  @endforeach
                </select>
                @error('kelas_id')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>NIK</label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" name="nik" id="nik" value="{{ old('nik') }}" required>
                @error('nik')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>NISN</label>
                <input type="text" class="form-control" placeholder="NISN" name="nisn" id="nisn" value="{{ $daftar->nisn }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" name="nama" id="nama" value="{{ $daftar->name }}" required>
                @error('nama')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control @error('jk_id') is-invalid @enderror" name="jk_id" id="jk_id" required>
                  <option value="">-Pilih-</option>
                  @foreach ($list_jk as $jk)
                  <option value="{{ $jk->id }}">{{ $jk->nama }}</option>
                  @endforeach
                </select>
                @error('jk_id')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" name="tempat_lahir" id="tempat_lahir" required>
                @error('tempat_lahir')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" required>
                @error('tanggal_lahir')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Agama</label>
                <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama" required>
                  <option value="">-Pilih-</option>
                  <option value="Islam">Islam</option>
                  <option value="Protestan">Protestan</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Khonghucu">Khonghucu</option>
                </select>
                @error('agama')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Golongan Darah</label>
                <select class="form-control @error('gol_darah') is-invalid @enderror" name="gol_darah" id="gol_darah" required>
                  <option value="">-Pilih-</option>
                  <option value="O">O</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                </select>
                @error('gol_darah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tinggi Badan (cm)</label>
                <input type="number" class="form-control  @error('tinggi_badan') is-invalid @enderror" placeholder="Tinggi Badan" name="tinggi_badan" id="tinggi_badan" required>
                @error('tinggi_badan')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Berat Badan (kg)</label>
                <input type="number" class="form-control  @error('berat_badan') is-invalid @enderror" placeholder="Berat Badan" name="berat_badan" id="berat_badan" required>
                @error('berat_badan')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Desa / Kelurahan</label>
                <input type="text" class="form-control  @error('desa') is-invalid @enderror" placeholder="Desa / Kelurahan" name="desa" id="desa" required>
                @error('desa')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" class="form-control  @error('kecamatan') is-invalid @enderror" placeholder="Kecamatan" name="kecamatan" id="kecamatan" required>
                @error('kecamatan')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kabupaten / Kota</label>
                <select name="kota_id" id="kota_id" class="form-control select2bs4  @error('kota_id') is-invalid @enderror" style="width: 100%;" required>
                  <option value="">-Pilih-</option>
                  @foreach ($list_kota as $kota)
                  <option value="{{ $kota->id }}">{{ $kota->name }}</option>
                  @endforeach
                </select>
                @error('kota_id')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control  @error('provinsi') is-invalid @enderror" placeholder="Provinsi" name="provinsi" id="provinsi" required>
                @error('provinsi')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control  @error('alamat') is-invalid @enderror"></textarea>
                @error('alamat')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>HP</label>
                <input type="text" class="form-control  @error('hp') is-invalid @enderror" name="hp" id="hp" value="{{ $daftar->telp }}" required>
                @error('hp')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" value="{{ $daftar->email }}" required>
                @error('email')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nilai Terakhir</label>
                <input type="text" class="form-control  @error('nilai_terakhir') is-invalid @enderror" placeholder="Nilai Terakhir" name="nilai_terakhir" id="nilai_terakhir" required>
                @error('nilai_terakhir')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <h5>Riwayat Pendidikan</h5>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>SD / MI</label>
                <input type="text" class="form-control  @error('sd') is-invalid @enderror" placeholder="SD / MI" name="sd" id="sd" required>
                @error('sd')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>SMP / MTs</label>
                <input type="text" class="form-control  @error('smp') is-invalid @enderror" placeholder="SMP / MTs" name="smp" id="smp" required>
                @error('smp')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>SMA / SMK / MA</label>
                <input type="text" class="form-control  @error('sma') is-invalid @enderror" placeholder="SMA / SMK / MA" name="sma" id="sma" required>
                @error('sma')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <hr>
          <h5>Identitas Orangtua / Wali</h5>
          <hr>
          <label>Ayah</label>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>NIK Ayah</label>
                <input type="text" class="form-control  @error('nik_ayah') is-invalid @enderror" placeholder="NIK Ayah" name="nik_ayah" id="nik_ayah" required>
                @error('nik_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Ayah</label>
                <input type="text" class="form-control  @error('nama_ayah') is-invalid @enderror" placeholder="Nama Ayah" name="nama_ayah" id="nama_ayah" required>
                @error('nama_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pekerjaan Ayah</label>
                <input type="text" class="form-control  @error('pekerjaan_ayah') is-invalid @enderror" placeholder="Pekerjaan Ayah" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
                @error('pekerjaan_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pendidikan Terakhir Ayah</label>
                <input type="text" class="form-control  @error('pendidikan_ayah') is-invalid @enderror" placeholder="Pendidikan Terakhir Ayah" name="pendidikan_ayah" id="pendidikan_ayah" required>
                @error('pendidikan_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Penghasilan Bulanan</label>
                <input type="text" class="form-control  @error('penghasilan_ayah') is-invalid @enderror" placeholder="Penghasilan Bulanan" name="penghasilan_ayah" id="penghasilan_ayah" required>
                @error('penghasilan_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>No. HP Ayah</label>
                <input type="text" class="form-control  @error('no_ayah') is-invalid @enderror" placeholder="No. HP Ayah" name="no_ayah" id="no_ayah" required>
                @error('no_ayah')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Alamat Ayah</label>
                <textarea name="alamat_ayah" id="alamat_ayah" cols="30" rows="2" class="form-control  @error('alamat_ayah') is-invalid @enderror"></textarea>
                @error('alamat_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <hr>

          <label>Ibu</label>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>NIK Ibu</label>
                <input type="text" class="form-control  @error('nik_ibu') is-invalid @enderror" placeholder="NIK Ibu" name="nik_ibu" id="nik_ibu" required>
                @error('nik_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Ibu</label>
                <input type="text" class="form-control  @error('nama_ibu') is-invalid @enderror" placeholder="Nama Ibu" name="nama_ibu" id="nama_ibu" required>
                @error('nama_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pekerjaan Ibu</label>
                <input type="text" class="form-control  @error('pekerjaan_ibu') is-invalid @enderror" placeholder="Pekerjaan Ibu" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
                @error('pekerjaan_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pendidikan Terakhir Ibu</label>
                <input type="text" class="form-control  @error('pendidikan_ibu') is-invalid @enderror" placeholder="Pendidikan Terakhir Ibu" name="pendidikan_ibu" id="pendidikan_ibu" required>
                @error('pendidikan_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Penghasilan Bulanan</label>
                <input type="text" class="form-control  @error('penghasilan_ibu') is-invalid @enderror" placeholder="Penghasilan Bulanan" name="penghasilan_ibu" id="penghasilan_ibu" required>
                @error('penghasilan_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>No. HP Ibu</label>
                <input type="text" class="form-control  @error('no_ibu') is-invalid @enderror" placeholder="No. HP Ibu" name="no_ibu" id="no_ibu" required>
                @error('no_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Alamat Ibu</label>
                <textarea name="alamat_ibu" id="alamat_ibu" cols="30" rows="2" class="form-control  @error('alamat_ibu') is-invalid @enderror"></textarea>
                @error('alamat_ibu')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <hr>
          <label>Wali <sup>*jika ada</sup></label>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>NIK Wali</label>
                <input type="text" class="form-control  @error('nik_wali') is-invalid @enderror" placeholder="NIK Wali" name="nik_wali" id="nik_wali">
                @error('nik_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Wali</label>
                <input type="text" class="form-control  @error('nama_wali') is-invalid @enderror" placeholder="Nama Wali" name="nama_wali" id="nama_wali">
                @error('nama_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pekerjaan Wali</label>
                <input type="text" class="form-control  @error('pekerjaan_wali') is-invalid @enderror" placeholder="Pekerjaan Wali" name="pekerjaan_wali" id="pekerjaan_wali">
                @error('pekerjaan_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Pendidikan Terakhir Wali</label>
                <input type="text" class="form-control  @error('pendidikan_wali') is-invalid @enderror" placeholder="Pendidikan Terakhir Wali" name="pendidikan_wali" id="pendidikan_wali">
                @error('pendidikan_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Penghasilan Bulanan</label>
                <input type="text" class="form-control  @error('penghasilan_wali') is-invalid @enderror" placeholder="Penghasilan Bulanan" name="penghasilan_wali" id="penghasilan_wali">
                @error('penghasilan_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>No. HP Wali</label>
                <input type="text" class="form-control  @error('no_wali') is-invalid @enderror" placeholder="No. HP Wali" name="no_wali" id="no_wali">
                @error('no_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Alamat Wali</label>
                <textarea name="alamat_wali" id="alamat_wali" cols="30" rows="2" class="form-control  @error('alamat_wali') is-invalid @enderror"></textarea>
                @error('alamat_wali')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>File Pas Photo</label>
                <input type="file" class="form-control" name="foto" id="foto" required>
                <span class="text-danger">File Gambar. Ukuran File Maksimal 2Mb.</span>
                @error('foto')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

        </div>

        <div class="card-footer text-center">
          <button type="submit" class="btn btn-primary btn-sm" name="simpan" id="simpan">
            <i class="fa fa-save"></i> SIMPAN
          </button>
        </div>
      </form>

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
  $(function() {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    $("#form-input").submit(function(e) {
      $("#simpan").attr("disabled", true);
    });
  });
</script>
<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#kode_agent').change(function() { // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
      var kodeAgent = $('#kode_agent').val(); // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
      $.ajax({ // Memulai ajax
          method: "POST",
          url: "{{ route('get_agent') }}", // file PHP yang akan merespon ajax
          data: {
            kode_agent: kodeAgent
          } // data POST yang akan dikirim
        })
        .done(function(hasilajax) { // KETIKA PROSES Ajax Request Selesai
          $('#nama_agent').val(hasilajax); // Isikan hasil dari ajak ke field 'nama' 
        });
    })
  });
</script>
@endpush