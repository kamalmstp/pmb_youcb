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
                        <th class="text-center">TH AKADEMIK</th>
                        <th class="text-center">GELOMBANG</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">TELP</th>
                        <th class="text-center">ASAL SEKOLAH</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection


@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
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
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    processing: true,
    serverSide: true,
    ajax      : {
            url : "{{url($url)}}",
        data : function (d) {
                d.th_akademik_id = $("#th_akademik_id").val();
                d.pmb_gelombang_id = $("#pmb_gelombang_id").val();
            }
    },
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex',class : 'text-center', orderable: false, searchable: false},
        {data: 'thakademik', name: 'thakademik',class:'text-center'},
        {data: 'gelombang', name: 'gelombang'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'telp', name: 'telp'},
        {data: 'asal_sekolah', name: 'asal_sekolah'},
    ],
    "order": [[ 1, "asc" ]]
});

$("#lihat").on('click',function(){
  table.draw();
});




});

</script>
@endpush
