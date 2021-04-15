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
                <label for="mst_th_akademik_id" class="col-sm-2 col-form-label">Th Akademik</label>
                <div class="col-sm-2">
                  <select name="mst_th_akademik_id" id="mst_th_akademik_id" class="form-control @error('mst_th_akademik_id') is-invalid @enderror" required>
                    @foreach ($list_thakademik as $thakademik)
                        <option value="{{ $thakademik->id }}" {{ @$data->mst_th_akademik_id==$thakademik->id ? 'selected' : '' }} >{{ $thakademik->kode }}</option>
                    @endforeach
                  </select>
                    @error('mst_th_akademik_id')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="gelombang" class="col-sm-2 col-form-label">Gelombang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('gelombang') is-invalid @enderror" name="gelombang" id="gelombang" placeholder="Gelombang" required value="{{ $data ? $data->gelombang : '' }}">
                  @error('gelombang')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control @error('biaya') is-invalid @enderror" name="biaya" id="biaya" placeholder="Biaya" required value="{{ $data ? $data->biaya : '' }}">
                  @error('biaya')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" name="tgl_mulai" id="tgl_mulai" required value="{{ $data ? $data->tgl_mulai : '' }}">
                  @error('tgl_mulai')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <label for="tgl_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" name="tgl_selesai" id="tgl_selesai" required value="{{ $data ? $data->tgl_selesai : '' }}">
                  @error('tgl_selesai')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="ketua_panitia" class="col-sm-2 col-form-label">Ketua Panitia</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('ketua_panitia') is-invalid @enderror" name="ketua_panitia" id="ketua_panitia" placeholder="Ketua Panitia" required value="{{ $data ? $data->ketua_panitia : '' }}">
                  @error('ketua_panitia')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
