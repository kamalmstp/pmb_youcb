@extends('layouts.app')


@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col">
                <h1> <i class="fas fa-info"></i>Pendaftaran Sebagai Agent yoUCB</h1>
            </div>
        </div>
    </div>
</section>

<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-th-list"> Formulir Pendaftaran Lembaga</i>
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('lembagaSave') }}">
                    @csrf
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5 class="text-primary">Data diri Penanggung Jawab</h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nama">{{ __('Nama') }}</label>
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nik">{{ __('NIK') }}</label>
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" autocomplete="nik" autofocus>

                                @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="tempat_lahir">{{ __('Tempat Lahir') }}</label>
                                <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" autocomplete="tempat_lahir" autofocus>

                                @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="tanggal_lahir">{{ __('Tanggal Lahir') }}</label>
                                <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required autocomplete="tanggal_lahir" autofocus>

                                @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="telepon">{{ __('Nomor Telepon') }}</label>
                                <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon') }}" required autocomplete="telepon" autofocus>

                                @error('telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">-Pilih-</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="agama">{{ __('Agama') }}</label>
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="jabatan">{{ __('Jabatan') }}</label>
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required autocomplete="jabatan" autofocus>

                                @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="status_perkawinan">{{ __('Status Perkawinan') }}</label>
                                <select class="form-control @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan" id="status_perkawinan" required>
                                    <option value="">-Pilih-</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Sudah Menikah">Sudah Menikah</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5 class="mt-3 mb-2 text-primary">Alamat Penanggung Jawab</h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="provinsi">{{ __('Provinsi') }}</label>
                                <select id="provinsi" type="provinsi" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" required>
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($prov as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="kabupaten">{{ __('Kabupaten') }}</label>
                                <select id="kabupaten" type="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" name="kabupaten" required>
                                    <option value="">--Pilih Kabupaten--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="kecamatan">{{ __('Kecamatan') }}</label>
                                <select id="kecamatan" type="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="kelurahan">{{ __('Kelurahan') }}</label>
                                <select id="kelurahan" type="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" required>
                                    <option value="">--Pilih Kelurahan--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="alamat">{{ __('Alamat') }}</label>
                                <textarea id="alamat" type="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"></textarea>

                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5 class="mt-3 mb-2 text-primary">Lembaga</h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nama_lembaga">{{ __('Nama Lembaga') }}</label>
                                <input id="nama_lembaga" type="text" class="form-control @error('nama_lembaga') is-invalid @enderror" name="nama_lembaga" value="{{ old('nama_lembaga') }}" required autocomplete="nama_lembaga" autofocus>

                                @error('nama_lembaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="telepon_kantor">{{ __('No. Telepon Kantor') }}</label>
                                <input id="telepon_kantor" type="text" class="form-control @error('telepon_kantor') is-invalid @enderror" name="telepon_kantor" value="{{ old('telepon_kantor') }}" required autocomplete="telepon_kantor" autofocus>

                                @error('telepon_kantor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="alamat">{{ __('Alamat Kantor') }}</label>
                                <textarea id="alamat" type="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"></textarea>

                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5 class="mt-3 mb-2 text-primary">Dokumen</h5>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ __('Upload KTP Penanggung Jawab') }}</label>
                                <input type="file" class="form-control" name="ktp" id="ktp" required>
                                <span class="text-danger">File Gambar. Ukuran File Maksimal 2Mb.</span>
                                @error('ktp')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" id="validasi" name="validasi" value="Valid" required>
                    <label for="validasi"> Saya menyetujui syarat dan ketentuan kebijakan privasi yang berlaku</label><br>
                    <hr>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{ __('Daftar') }}</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- 
        <div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-th-list"> Formulir Pendaftaran Lembaga</i>
        </h3>
    </div><div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p><strong>*Note : </strong>Pastikan gunakan E-mail yang aktif, kode Agent anda yang terdaftar akan dikirimkan melalui E-mail,</p>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('lembagaSave') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lembaga') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" autocomplete="nama" autofocus>

                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telepon" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                                <div class="col-md-6">
                                    <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon') }}" required autocomplete="telepon" autofocus>

                                    @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Lembaga') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea id="alamat" type="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat"></textarea>

                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_pj" class="col-md-4 col-form-label text-md-right">{{ __('Nama Penanggung Jawab') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_pj" type="text" class="form-control @error('nama_pj') is-invalid @enderror" name="nama_pj" value="{{ old('nama_pj') }}" autocomplete="nama_pj" autofocus>

                                    @error('nama_pj')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nomor_pj" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Penanggung Jawab') }}</label>

                                <div class="col-md-6">
                                    <input id="nomor_pj" type="text" class="form-control @error('nomor_pj') is-invalid @enderror" name="nomor_pj" value="{{ old('nomor_pj') }}" required autocomplete="nomor_pj" autofocus>

                                    @error('nomor_pj')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> -->
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#provinsi').on('change', function() {
            $.ajax({
                url: "{{ route('get_kab') }}",
                method: 'POST',
                data: {
                    id: $(this).val()
                },
                success: function(response) {
                    $('#kabupaten').empty();

                    $.each(response, function(id, name) {
                        $('#kabupaten').append(new Option(name, id))
                    })
                }
            })
        });

        $('#kabupaten').on('change', function() {
            $.ajax({
                url: "{{ route('get_kec') }}",
                method: 'POST',
                data: {
                    id: $(this).val()
                },
                success: function(response) {
                    $('#kecamatan').empty();

                    $.each(response, function(id, name) {
                        $('#kecamatan').append(new Option(name, id))
                    })
                }
            })
        });

        $('#kecamatan').on('change', function() {
            $.ajax({
                url: "{{ route('get_kel') }}",
                method: 'POST',
                data: {
                    id: $(this).val()
                },
                success: function(response) {
                    $('#kelurahan').empty();

                    $.each(response, function(id, name) {
                        $('#kelurahan').append(new Option(name, id))
                    })
                }
            })
        });
    });
</script>

@endsection