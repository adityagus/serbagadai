@extends('backend.layouts.template')

@section('pageTitle','Product')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><span>Produk</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">Daftar Produk</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <a href="{{route('admin.product.export')}}" target="_blank" class="btn btn-success">Export</a>
                                <a href="{{ route('admin.product.detail',['id'=>0]) }}" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td class="all">
                                        <input placeholder="Find Judul" type="text" class="form-control" name="s_title" onchange="filter()">
                                    </td>
                                    <td></td>
                                    <td>
                                        <input placeholder="Find Deskripsi Singkat" type="text" class="form-control" name="s_short_description" onchange="filter()">
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="form-control" name="s_status" onchange="filter()">
                                            <option value="">Pilih Status</option>
                                            @foreach(\App\Helpers\SelectHelper::getCommonStatus() as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th style="min-width: 150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('customJs')

<script src="{{url('backend/assets/global/datatable.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/datatables/datatables.min.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
    type="text/javascript"></script>
<script
    src="{{url('backend/assets/global/table-datatables-responsive.min.js')}}"
    type="text/javascript"></script>

<script type="text/javascript">
    var table = $('#myTable').DataTable({
        'processing'  : true,
        'serverSide'  : true,
        'ajax'        : {
            url: "{{ route('admin.product.data') }}",
            data: function (d) {
                d['products.title'] = $('[name=s_title]').val();
                d['products.short_description'] = $('[name=s_short_description]').val();
                d['products.status'] = $('[name=s_status]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'title', name: 'title'},
            {data:'slug', name: 'slug'},
            {data:'short_description', name: 'short_description'},
            {data:'icon', name: 'icon'},
            {data:'status', name: 'status'},
            {data:'created_at', name: 'created_at'},
            {data:'updated_at', name: 'updated_at'},
            {data:'action', name: 'aksi', orderable: false, searchable: false},
        ],
        'info'        : true,
        'order'       : ['4','desc'],
        'autoWidth'   : false
    });

    function filter() {
        table.draw();
    }

    function addData() {
        $('#myModal').modal('show');
        $('#myModal form')[0].reset();
        $('[name=id]').val(0);
        $('[name=method]').val('ADD');
        $('.modal-title').text('Tambah Data');
    }

    function deleteData(id) {
        swal({
            title: "Yakin Hapus Data?",
            text : "Data akan dihapus permanen",
            icon: "warning",
            buttons: {
                cancel:true,
                confirm: {
                    text:'Hapus!',
                    closeModal: false,
                },
              },
            })
        .then((process) => {
            if(process){
                $.ajax({
                    url: "{{ route('admin.product.delete',['id'=>'']) }}" + '/' + id,
                    type: "POST",
                    data: {
                        '_token': '{{csrf_token()}}' 
                    },
                    success: function(data) {
                        swal({
                            title: 'Berhasil Hapus Data!',
                            text: 'Data berhasil di hapus',
                            icon: 'success',
                            timer: '3000'
                        });
                        table.ajax.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        swal({
                            title: 'System Error',
                            text: errorThrown,
                            icon: 'error',
                            timer: '3000'
                        });
                    }
                });
            }else{
                swal('Data tidak jadi dihapus');
            }
        });
    }

</script>

@endpush
