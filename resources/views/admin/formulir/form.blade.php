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

    <div class="card-body">

        <div class="card-body box-profile">
            <div class="text-center">
                @if($formulir->foto)
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('foto_users/'.$formulir->foto) }}" alt="User profile picture">
                </div>
                @endif
            </div>

            <h3 class="profile-username text-center">{{ $formulir->nama }}</h3>

            <p class="text-muted text-center">{{ $formulir->prodi->jenjang }} - {{ $formulir->prodi->nama }}</p>

            
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
                <strong>Program Studi</strong>
                <p class="text-muted">{{ $formulir->prodi->jenjang }} - {{ $formulir->prodi->nama }}</p>
            </div>
            <div class="col">
                <strong>Kelas</strong>
                <p class="text-muted">{{ $formulir->kelas->nama }}</p>
            </div>
            <div class="col">
                <strong>Kode Agent</strong>
                <p class="text-muted">{{ $formulir->kode_agent }}</p>
            </div>
            <div class="col">
                <strong> </strong>
                <p class="text-muted"></p>
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

        <div class="row">
            <div class="col">
            <strong>Nama Lengkap</strong>
                <p class="text-muted">{{ $formulir->nama }}</p>
            </div>
            <div class="col">
                <strong>Jenis Kelamin</strong>
                <p class="text-muted">{{ $formulir->jeniskelamin->nama }}</p>
            </div>
            <div class="col">
                <strong>Golongan Darah</strong>
                <p class="text-muted">{{ $formulir->gol_darah }}</p>
            </div>
            <div class="col">
                <strong>Agama</strong>
                <p class="text-muted">{{ $formulir->agama }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <strong>Tempat Lahir</strong>
                <p class="text-muted">{{ $formulir->tempat_lahir }}</p>
            </div>
            <div class="col">
                <strong>Tanggal Lahir</strong>
                <p class="text-muted">{{ with(new Carbon($formulir->tanggal_lahir))->format('d, M Y') }}</p>
            </div>
            <div class="col">
                <strong>Tinggi Badan</strong>
                <p class="text-muted">{{ $formulir->tinggi_badan }}</p>
            </div>
            <div class="col">
                <strong>Berat Badan</strong>
                <p class="text-muted">{{ $formulir->berat_badan }}</p>
            </div>
        </div>

        
        <div class="row">
            <div class="col">
                <strong>Alamat</strong>
                <p class="text-muted">{{ $formulir->alamat }}</p>
            </div>
            <div class="col">
                <strong>Desa / Kelurahan</strong>
                <p class="text-muted">{{ $formulir->desa }}</p>
            </div>
            <div class="col">
                <strong>Kecamatan</strong>
                <p class="text-muted">{{ $formulir->kecamatan }}</p>
            </div>
            <div class="col">
                <strong>Kabupaten / Kota</strong>
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
                <strong>Nilai Terakhir</strong>
                <p class="text-muted">{{ $formulir->nilai_terakhir }}</p>
            </div>
            <div class="col">
                <strong>SD</strong>
                <p class="text-muted">{{ $formulir->sd }}</p>
            </div>
            <div class="col">
                <strong>SMP</strong>
                <p class="text-muted">{{ $formulir->smp }}</p>
            </div>
            <div class="col">
                <strong>SMA</strong>
                <p class="text-muted">{{ $formulir->sma }}</p>
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
            <div class="col">
                <strong>Pekerjaan Ayah</strong>
                <p class="text-muted">{{ $formulir->pekerjaan_ayah }}</p>
            </div>
            <div class="col">
                <strong>Pendidikan Ayah</strong>
                <p class="text-muted">{{ $formulir->pendidikan_ayah }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>Penghasilan Ayah</strong>
                <p class="text-muted">{{ $formulir->penghasilan_ayah }}</p>
            </div>
            <div class="col">
                <strong>No Ayah</strong>
                <p class="text-muted">{{ $formulir->no_ayah }}</p>
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
            <div class="col">
                <strong>Pekerjaan Ibu</strong>
                <p class="text-muted">{{ $formulir->pekerjaan_ibu }}</p>
            </div>
            <div class="col">
                <strong>Pendidikan Ibu</strong>
                <p class="text-muted">{{ $formulir->pendidikan_ibu }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>Penghasilan Ibu</strong>
                <p class="text-muted">{{ $formulir->penghasilan_ibu }}</p>
            </div>
            <div class="col">
                <strong>No Ibu</strong>
                <p class="text-muted">{{ $formulir->no_ibu }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <strong>NIK Wali</strong>
                <p class="text-muted">{{ $formulir->nik_wali }}</p>
            </div>
            <div class="col">
                <strong>Nama Wali</strong>
                <p class="text-muted">{{ $formulir->nama_wali }}</p>
            </div>
            <div class="col">
                <strong>Pekerjaan Wali</strong>
                <p class="text-muted">{{ $formulir->pekerjaan_wali }}</p>
            </div>
            <div class="col">
                <strong>Pendidikan Wali</strong>
                <p class="text-muted">{{ $formulir->pendidikan_wali }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>Penghasilan Wali</strong>
                <p class="text-muted">{{ $formulir->penghasilan_wali }}</p>
            </div>
            <div class="col">
                <strong>No Wali</strong>
                <p class="text-muted">{{ $formulir->no_wali }}</p>
            </div>
        </div>
        <hr>

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
                                <select name="pilihValid" id="pilihValid_{{ $item->id }}" class="form-control pilihValid" data-id="{{ $item->id }}">
                                    <option value="">-Pilih-</option>
                                    <option value="Y" {{ $item->valid=='Y' ? 'selected' : ''}}>Y</option>
                                    <option value="N" {{ $item->valid=='N' ? 'selected' : ''}}>N</option>
                                </select>
                            </td>
                        </tr>                
                    @endforeach
                </tbody>
            </table>

        </div>  
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('body').on('change', '.pilihValid', function () {
        var id_dok = $(this).data("id");
        var string = {
            id_dok : id_dok,
            id_formulir : "{{ $formulir->id }}",
            valid : $("#pilihValid_"+id_dok).val(),
            _token: "{{ csrf_token() }}",
        };
        // console.log(string);
        $.ajax({
            url   : "{{ url($url) }}"+"/simpanSyaratValid",
            method : 'POST',
            data : string,
            success:function(data){
                // console.log(data);
                toastr.success(data.success)
                
            }
        });
    });
</script>
@endpush