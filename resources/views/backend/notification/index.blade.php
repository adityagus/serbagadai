@extends('backend.layouts.template')

@section('pageTitle','Daftar Notifikasi')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Beranda</a> <i class="fa fa-circle"></i></li>
                <li><span>Notifikasi</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">Daftar Notifikasi</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <button onclick="clearNotification()" class="btn btn-primary">Kosongkan Notifikasi</button>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td class="all" >
                                        <input placeholder="Find Judul" type="text" class="form-control" name="s_subject" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Deskripsi" type="text" class="form-control" name="s_description" onchange="filter()">
                                    </td>
                                    <td>
                                        <select class="form-control" name="s_type" onchange="filter()">
                                            <option value="">Pilih Tipe</option>
                                            @foreach(\App\Util\Constant::NOTIFICATION_TYPE as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="s_status" onchange="filter()">
                                            <option value="">Pilih Status</option>
                                            @foreach(\App\Util\Constant::NOTIFICATION_STATUS as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.notification.modal')
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
            url: "{{ route('admin.notification.data') }}",
            data: function (d) {
                d.subject = $('[name=s_subject]').val();
                d.description = $('[name=s_description]').val();
                d.type = $('[name=s_type]').val();
                d.status = $('[name=s_status]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'created_at', name: 'created_at'},
            {data:'subject', name: 'subject'},
            {data:'description', name: 'description'},
            {data:'type', name: 'type'},
            {data:'status', name: 'status'},
        ],
        order:[0,'desc'],
        'info'        : true,
        'autoWidth'   : false
    });

    function filter() {
        table.draw();
    }

</script>

@endpush
