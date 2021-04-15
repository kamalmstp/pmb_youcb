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
                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-8">
                  <input type="nisn" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" placeholder="NISN" value="{{ $data ? $data->nisn : '' }}">
                  @error('nisn')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-8">
                  <input type="telp" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" placeholder="Telepon" value="{{ $data ? $data->telp : '' }}">
                  <span>Akan dijadikan Password.</span>
                  @error('telp')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="asal_sekolah" class="col-sm-2 col-form-label">Asal Sekolah</label>
                <div class="col-sm-10">
                  <input type="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" name="asal_sekolah" id="asal_sekolah" placeholder="Asal Sekolah" value="{{ $data ? $data->asal_sekolah : '' }}">
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

$(function () {



});

</script>
@endpush
