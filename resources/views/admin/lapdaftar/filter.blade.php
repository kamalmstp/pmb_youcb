<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title mt-1">
            <i class="fas fa-filter"></i>
            Filter @yield('title')
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
    </div>
  
    <div class="card-body">
        <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Tahun Akademik</label>
                <select name="th_akademik_id" id="th_akademik_id" class="select2bs4" style="width: 100%;">
                    <option value="">-Pilih-</option>
                    @foreach ($list_thakademik as $thakademik)
                        <option value="{{ $thakademik->id }}">{{ $thakademik->kode }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Gelombang</label>
                <select name="pmb_gelombang_id" id="pmb_gelombang_id"  class="select2bs4" style="width: 100%;">

                </select>
              </div>
            </div>
        </div>


    </div>

    <div class="card-footer text-center">
        <button name="lihat" id="lihat" type="button" class="btn btn-primary btn-sm">
            <i class="fas fa-eye"></i> Lihat
        </button>
    </div>
  
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });


        $("#th_akademik_id").on('change',function(){
            var th_akademik_id = $("#th_akademik_id").val();
            var url = "{{url($url)}}";
            $.get(url + '/' + th_akademik_id, function (data) {
                $("#pmb_gelombang_id").html(data);
            });
        });
    });
</script>
@endpush