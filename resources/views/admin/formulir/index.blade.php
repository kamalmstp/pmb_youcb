@extends('layouts.app_admin')
@section('title',$title)
@section('content')

@include($folder.'.filter')

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title mt-1">
            <i class="fas fa-clipboard-list "></i>
            @yield('title')
        </h3>
        {{-- <div class="card-tools">
            <a href="{{ url($url.'/create') }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div> --}}
    </div>

    <div class="card-body">


        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50" class="text-center">NO</th>
                        <th class="text-center">NOMOR</th>
                        <th class="text-center">FOTO</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">TELP</th>
                        <th class="text-center">PRODI</th>
                        <th class="text-center">KELAS</th>
                        <th class="text-center">GELOMBANG</th>
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
  ajax      : {
        url : "{{url($url)}}",
       data : function (d) {
              d.th_akademik_id = $("#th_akademik_id").val();
              d.pmb_gelombang_id = $("#pmb_gelombang_id").val();
              d.prodi_id = $("#prodi_id").val();
              d.kelas_id = $("#kelas_id").val();
        }
   },
  columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',class : 'text-center', orderable: false, searchable: false},
      {data: 'nomor', name: 'nomor',class:'text-center'},
      {data: 'file_foto', name: 'file_foto',class:'text-center'},
      {data: 'nama', name: 'nama'},
      {data: 'email', name: 'email'},
      {data: 'hp', name: 'hp'},
      {data: 'prodi', name: 'prodi'},
      {data: 'kelas', name: 'kelas'},
      {data: 'gelombang', name: 'gelombang'},
      {data: 'action', name: 'action', class : 'text-center', orderable: false, searchable: false},
  ],
  "order": [[ 1, "desc" ]]
});

$("#lihat").on('click',function(){
  table.draw();
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
