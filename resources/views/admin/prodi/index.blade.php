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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50" class="text-center">NO</th>
                        <th class="text-center">KODE</th>
                        <th class="text-center">JENJANG</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">AKREDITASI</th>
                        <th class="text-center">AKTIF</th>
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



var table = $('.data-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ url($url) }}",
  columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',class : 'text-center', orderable: false, searchable: false},
      {data: 'kode', name: 'kode',class:'text-center'},
      {data: 'jenjang', name: 'jenjang',class:'text-center'},
      {data: 'nama', name: 'nama'},
      {data: 'akreditasi', name: 'akreditasi',class:'text-center'},
      {data: 'lblaktif', name: 'lblaktif',class:'text-center'},
      {data: 'action', name: 'action', class : 'text-center', orderable: false, searchable: false},
  ],
  "order": [[ 1, "asc" ]]
});





});

</script>
@endpush
