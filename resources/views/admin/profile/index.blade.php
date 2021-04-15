@extends('layouts.app_admin')
@section('title',$title)
@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title mt-1">
            <i class="fas fa-clipboard-list "></i>
            @yield('title')
        </h3>
    </div>
    <form class="form-horizontal" action="{{ url($url) }}" method="POST" >
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : null }}">
    <div class="card-body">

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"  required value="{{ @$data->name ? $data->name : '' }}" readonly>
                  @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"  required >
                  @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password-confirm"  required >
                  @error('password_confirmation')
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
    $('.textarea').summernote()
});

</script>
@endpush
