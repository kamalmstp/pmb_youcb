@extends('layouts.app_admin')
@section('title',$title)
@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title mt-1">
            <i class="fas fa-clipboard-list "></i>
            @yield('title')
        </h3>
        <div class="card-tools">
            <a href="{{ url($url) }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-backward "></i> Kembali</a>
        </div>
    </div>

    <form role="form" action="{{ url('admin/formulir') }}" method="POST" name="form-input" id="form-input">    
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $formulir->id }}">
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
                <label>Program Studi</label>
                <select class="form-control select2bs4  @error('prodi_id') is-invalid @enderror" style="width: 100%;" name="prodi_id" id="prodi_id" required>
                    <option value="">-Pilih-</option>
                    @foreach ($list_prodi as $prodi)
                        {{ $selected = $formulir->prodi_id==$prodi->id ? 'selected' : '' }}
                        <option value="{{ $prodi->id }}"  {{ $selected }}>{{ $prodi->jenjang }} - {{ $prodi->nama }}</option>
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
                        {{ $selected = $formulir->kelas_id==$kelas->id ? 'selected' : '' }}
                        <option value="{{ $kelas->id }}" {{ $selected }}>{{ $kelas->nama }}</option>
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
        <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kode Agent</label><sup>* jika ada</sup>
                <input type="text" class="form-control  @error('kode_agent') is-invalid @enderror" name="kode_agent" id="kode_agent" value="{{ $formulir->kode_agent }}">
                @error('kode_agent')
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
                <input type="text" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" name="nik" id="nik" required value="{{ $formulir->nik }}">
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
                <input type="text" class="form-control" placeholder="NISN" name="nisn" id="nisn" value="{{ $formulir->nisn }}">
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" name="nama" id="nama" value="{{ $formulir->nama }}" required>
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
                        {{ $selected = $formulir->jk_id==$jk->id ? 'selected' : '' }}
                        <option value="{{ $jk->id }}" {{ $selected }}>{{ $jk->nama }}</option>
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
                <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" name="tempat_lahir" id="tempat_lahir" required value="{{ $formulir->tempat_lahir }}">
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
                <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" required value="{{ $formulir->tanggal_lahir }}">
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
                  <input type="text" class="form-control  @error('agama') is-invalid @enderror" placeholder="Agama" name="agama" id="agama" value="{{ $formulir->agama }}" required>
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
                  <select class="form-control @error('gol_darah') is-invalid @enderror" name="gol_darah" id="gol_darah" value="{{ $formulir->gol_darah}}" required>
                        <option value="">-Pilih-</option>
                        <option value="O" @if($formulir->gol_darah == 'O') selected @endif>O</option>
                        <option value="A" @if($formulir->gol_darah == 'A') selected @endif>A</option>
                        <option value="B" @if($formulir->gol_darah == 'B') selected @endif>B</option>
                        <option value="AB" @if($formulir->gol_darah == 'AB') selected @endif>AB</option>
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
                  <input type="number" class="form-control  @error('tinggi_badan') is-invalid @enderror" placeholder="tinggi_badan" name="tinggi_badan" id="tinggi_badan" value="{{ $formulir->tinggi_badan }}" required>
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
                  <input type="number" class="form-control  @error('berat_badan') is-invalid @enderror" placeholder="Agama" name="berat_badan" id="berat_badan" value="{{ $formulir->berat_badan }}" required>
                  @error('berat_badan')
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
                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control  @error('alamat') is-invalid @enderror">{{ $formulir->alamat }}</textarea>  
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
                <label>Desa / Kelurahan</label>
                <input type="text" class="form-control  @error('desa') is-invalid @enderror" name="desa" id="desa" value="{{ $formulir->desa }}" required>
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
                <input type="text" class="form-control  @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" value="{{ $formulir->kecamatan }}" required>
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
                <label>Desa / Kelurahan</label>
                <input type="text" class="form-control  @error('desa') is-invalid @enderror" name="desa" id="desa" value="{{ $formulir->desa }}" required>
                @error('desa')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kabupaten / Kota</label>
                <select name="kota_id" id="kota_id" class="form-control select2bs4  @error('kota_id') is-invalid @enderror" style="width: 100%;" required>
                    <option value="">-Pilih-</option>
                    @foreach ($list_kota as $kota)
                        {{ $selected = $formulir->kota_id == $kota->id ? 'selected' : '' }}
                        <option value="{{ $kota->id }}" {{ $selected }}>{{ $kota->name }}</option>
                    @endforeach
                </select>
                @error('kota_id')
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
                <input type="text" class="form-control  @error('hp') is-invalid @enderror" name="hp" id="hp" value="{{ $formulir->hp }}" required>
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
                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" value="{{ $formulir->email }}" required>
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
                    <input type="text" class="form-control  @error('nilai_terakhir') is-invalid @enderror"  name="nilai_terakhir" id="nilai_terakhir" value="{{ $formulir->nilai_terakhir }}" required>
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
                    <input type="text" class="form-control  @error('sd') is-invalid @enderror"  name="sd" id="sd" value="{{ $formulir->sd }}" required>
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
                    <input type="text" class="form-control  @error('smp') is-invalid @enderror"  name="smp" id="smp" value="{{ $formulir->smp }}" required>
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
                    <input type="text" class="form-control  @error('sma') is-invalid @enderror" name="sma" id="sma" value="{{ $formulir->sma }}" required>
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
                    <input type="text" class="form-control  @error('nik_ayah') is-invalid @enderror" name="nik_ayah" id="nik_ayah" value="{{ $formulir->nik_ayah }}" required>
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
                    <input type="text" class="form-control  @error('nama_ayah') is-invalid @enderror" name="nama_ayah" id="nama_ayah" value="{{ $formulir->nama_ayah }}" required>
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
                    <input type="text" class="form-control  @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ $formulir->pekerjaan_ayah }}" required>
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
                    <input type="text" class="form-control  @error('pendidikan_ayah') is-invalid @enderror" name="pendidikan_ayah" id="pendidikan_ayah" value="{{ $formulir->pendidikan_ayah }}" required>
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
                    <input type="text" class="form-control  @error('penghasilan_ayah') is-invalid @enderror" name="penghasilan_ayah" id="penghasilan_ayah" value="{{ $formulir->penghasilan_ayah }}" required>
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
                    <input type="text" class="form-control  @error('no_ayah') is-invalid @enderror" name="no_ayah" id="no_ayah" value="{{ $formulir->no_ayah }}" required>
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
                        <textarea name="alamat_ayah" id="alamat_ayah" cols="30" rows="2" class="form-control  @error('alamat_ayah') is-invalid @enderror">{{ $formulir->alamat_ayah }}</textarea>  
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
                    <input type="text" class="form-control  @error('nik_ibu') is-invalid @enderror" name="nik_ibu" id="nik_ibu" value="{{ $formulir->nik_ibu }}" required>
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
                    <input type="text" class="form-control  @error('nama_ibu') is-invalid @enderror" name="nama_ibu" id="nama_ibu" value="{{ $formulir->nama_ibu }}" required>
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
                    <input type="text" class="form-control  @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ $formulir->pekerjaan_ibu }}" required>
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
                    <input type="text" class="form-control  @error('pendidikan_ibu') is-invalid @enderror" name="pendidikan_ibu" id="pendidikan_ibu" value="{{ $formulir->pendidikan_ibu }}" required>
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
                    <input type="text" class="form-control  @error('penghasilan_ibu') is-invalid @enderror" name="penghasilan_ibu" id="penghasilan_ibu" value="{{ $formulir->penghasilan_ibu }}" required>
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
                    <input type="text" class="form-control  @error('no_ibu') is-invalid @enderror" name="no_ibu" id="no_ibu" value="{{ $formulir->no_ibu }}" required>
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
                        <textarea name="alamat_ibu" id="alamat_ibu" cols="30" rows="2" class="form-control  @error('alamat_ibu') is-invalid @enderror">{{ $formulir->alamat_ibu }}</textarea>  
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
                    <input type="text" class="form-control  @error('nik_wali') is-invalid @enderror" name="nik_wali" id="nik_wali" value="{{ $formulir->nik_wali }}">
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
                    <input type="text" class="form-control  @error('nama_wali') is-invalid @enderror" name="nama_wali" id="nama_wali" value="{{ $formulir->nama_wali }}">
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
                    <input type="text" class="form-control  @error('pekerjaan_wali') is-invalid @enderror" name="pekerjaan_wali" id="pekerjaan_wali" value="{{ $formulir->pekerjaan_wali }}">
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
                    <input type="text" class="form-control  @error('pendidikan_wali') is-invalid @enderror" name="pendidikan_wali" id="pendidikan_wali" value="{{ $formulir->pendidikan_wali }}">
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
                    <input type="text" class="form-control  @error('penghasilan_wali') is-invalid @enderror" name="penghasilan_wali" id="penghasilan_wali" value="{{ $formulir->penghasilan_wali }}">
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
                    <input type="text" class="form-control  @error('no_wali') is-invalid @enderror"  name="no_wali" id="no_wali" value="{{ $formulir->no_wali }}">
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
    </div>

    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary btn-sm" name="simpan" id="simpan">
            <i class="fa fa-save"></i> SIMPAN
        </button>
    </div>
</form>
</div>
@endsection
