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
    </div>

    <div class="card-body">


        <div class="table-responsive">
            <table class="table data-table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50" class="text-center">NO</th>
                        <th class="text-center">TH AKADEMIK</th>
                        <th class="text-center">GELOMBANG</th>
                        <th class="text-center">NOMOR</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">TELP</th>
                        <th class="text-center">PRODI</th>
                        <th class="text-center">KELAS</th>
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
            {data: 'thakademik', name: 'thakademik',class:'text-center'},
            {data: 'gelombang', name: 'gelombang'},
            {data: 'nomor', name: 'nomor',class:'text-center'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'hp', name: 'hp'},
            {data: 'prodi', name: 'prodi'},
            {data: 'kelas', name: 'kelas'},
            {data: 'action', name: 'action', class : 'text-center', orderable: false, searchable: false},
        ],
        "order": [[ 1, "asc" ]]
    });

    $("#lihat").on('click',function(){
        table.draw();
    });


    $('body').on('change', '.pilihLulus', function () {
        var t_id = $(this).data("id");
        var string = {
            id : t_id,
            status : $("#pilihLulus_"+t_id).val(),
            _token: "{{ csrf_token() }}"
        };
        console.log(string);
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
