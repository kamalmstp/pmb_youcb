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
    <form class="form-horizontal" action="{{ url($url) }}" method="POST" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : null }}">
    <div class="card-body">

                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul"  required value="{{ @$data->judul ? $data->judul : '' }}" >
                      @error('judul')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                  </div>

              <div class="form-group row">
                <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" id="gambar" >
                  @error('gambar')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if(@$data->gambar)
                    <img src="{{ asset('slider/'.$data->gambar) }}" alt="" width="400px" class="mt-2">
                    @endif
                </div>

              </div>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="aktif" name="aktif" {{  $data ? ($data->aktif=='Y' ? 'checked' : ' ') : '' }}>
                    <label class="form-check-label" for="exampleCheck2">Aktif</label>
                  </div>
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
