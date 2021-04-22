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
    <form class="form-horizontal" action="{{ url($url) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : '' }}">
        <div class="card-body">


            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Lengkap" required value="{{ $data ? $data->name : '' }}">
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="Nama Lengkap" required value="{{ $data ? $data->nik : '' }}">
                    @error('nik')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required value="{{ $data ? $data->email : '' }}">
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-8">
                    <input type="telepon" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon" placeholder="NISN" value="{{ $data ? $data->telepon : '' }}">
                    @error('telepon')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="asal_sekolah" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" cols="30" rows="5">{{ $data ? $data->alamat : '' }}</textarea>
                    @error('asal_sekolah')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info float-left">
                <i class="fas fa-save"></i> SIMPAN</button>
            @if(!$data)
            <button type="reset" class="btn btn-default float-right">
                <i class="fas fa-reply-all "></i> RESET</button>
            @endif
        </div>
    </form>
</div>
@endsection


@push('css')

@endpush

@push('scripts')
<script type="text/javascript">
    $(function() {



    });
</script>
@endpush