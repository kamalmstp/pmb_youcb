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
    <form class="form-horizontal" action="{{ url($url) }}" method="POST" >
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : null }}">
    <div class="card-body pad">


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
                <label for="judul" class="col-sm-2 col-form-label">Isi</label>
                <div class="col-sm-10">
                  <textarea name="isi" id="isi" class="textarea" placeholder="Place some text here"
                  style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  {{ @$data->isi ? $data->isi : '' }}
                </textarea>
                  @error('isi')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="publish" name="publish" {{  $data ? ($data->publish=='Y' ? 'checked' : ' ') : '' }}>
                    <label class="form-check-label" for="exampleCheck2">Publish</label>
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
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">

$(function () {
    $('.textarea').summernote()
});

</script>
@endpush
