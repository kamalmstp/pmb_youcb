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
                        <th class="text-center">GELOMBANG</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">TELP</th>
                        <th class="text-center">BUKTI</th>
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
            {data: 'gelombang', name: 'gelombang'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'telp', name: 'telp'},
            {data: 'bukti', name: 'bukti',class:'text-center'},
            {data: 'action', name: 'action', class : 'text-center', orderable: false, searchable: false},
        ],
        "order": [[ 1, "asc" ]]
    });


    $('body').on('change', '.pilihValidasi', function () {
        var t_id = $(this).data("id");
        var string = {
            id : t_id,
            status : $("#pilihValidasi_"+t_id).val(),
            _token: "{{ csrf_token() }}"
        };
        // console.log(string);
        $.ajax({
            url   : "{{ url($url) }}",
            method : 'POST',
            data : string,
            success:function(data){
                // console.log(data);
                toastr.success(data.success)
                
            }
        });
    });
    

});

</script>
@endpush
