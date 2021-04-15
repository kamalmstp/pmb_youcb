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
            <a href="{{ url($url.'/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50" class="text-center">NO</th>
                        <th class="text-center">JUDUL</th>
                        <th class="text-center">PUBLISH</th>
                        <th width="100" class="text-center">AKSI</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript">

$(function () {


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

var table = $('.data-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ url($url) }}",
  columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',class : 'text-center', orderable: false, searchable: false},
      {data: 'judul', name: 'judul'},
      {data: 'lblaktif', name: 'lblaktif',class:'text-center'},
      {data: 'action', name: 'action', class : 'text-center', orderable: false, searchable: false},
  ],
  "order": [[ 1, "asc" ]]
});



$('body').on('click', '.deleteBtn', function () {
var id = $(this).data("id");
Swal.fire({
  title: 'Data @yield('title') ID : '+id,
  text: "Anda yakin akan menghapus data ini ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus!'
}).then((result) => {
  if (result.value) {

    $.ajax({
      type: "DELETE",
      url: "{{ url($url) }}"+'/'+id,
      success: function (data) {
        toastr.success(data.success)
        table.draw();
      },
      error: function (data) {
        toastr.error('Silahkan hubungi Administrator');
      }
    });
  }
})


});

});

</script>
@endpush
