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
        <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : null }}">
        <div class="card-body pad">


            <div class="form-group row">
                <label for="kepada" class="col-sm-2 col-form-label">Kepada</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('kepada') is-invalid @enderror" name="kepada" id="kepada" required value="{{ @$data->kepada ? $data->kepada : '' }}">
                    @error('kepada')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject" required value="{{ @$data->subject ? $data->subject : '' }}">
                    @error('subject')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
                <div class="col-sm-10">
                    <textarea name="pesan" id="pesan" class="textarea" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    {{ @$data->pesan ? $data->pesan : '' }}
                    </textarea>
                    @error('pesan')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success float-left">
                <i class="fas fa-paper-plane"></i> KIRIM</button>
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
    $(function() {
        $('.textarea').summernote()
    });
</script>
@endpush