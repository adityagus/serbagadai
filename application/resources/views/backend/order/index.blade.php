@extends('backend.layouts.template')

@section('pageTitle','Order')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><span>Daftar Pesanan</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">Daftar Pesanan</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <a href="{{route('admin.order.export')}}" target="_blank" class="btn btn-success">Export</a>
                                @if(@\Auth::user()->role == \App\Util\Constant::USER_ROLE_DESIGNER || @\Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
                                <a href="{{ route('admin.order.get',0) }}" class="btn btn-primary">Tambah</a>
                                @endif
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td class="all">
                                        <input placeholder="Find code" type="text" class="form-control" name="s_code" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Pelanggan" type="text" class="form-control" name="s_name" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Telepon" type="text" class="form-control" name="s_phone" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <input placeholder="Find Deadline" type="text" class="form-control" name="s_deadline" onchange="filter()">
                                    </td>
                                    <td class="all" >
                                        <select class="form-control" name="s_status" onchange="filter()">
                                            <option value="">Pilih Status</option>
                                            @foreach(\App\Util\Constant::ORDER_STATUS_LIST as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="all" >
                                        <select class="form-control" name="s_payment_status" onchange="filter()">
                                            <option value="">Pilih Status</option>
                                            @foreach(\App\Util\Constant::STATUS_PAYMENT_LIST as $value => $label)
                                                <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="min-width: 100px;">Kode Pesanan</th>
                                    <th style="min-width: 100px;">Pelanggan</th>
                                    <th style="min-width: 100px;">Telepon</th>
                                    <th style="min-width: 100px;">Deadline</th>
                                    <th style="min-width: 100px;">Status</th>
                                    <th style="min-width: 100px;">Payment</th>
                                    <th style="min-width: 100px;">Created</th>
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
@include('backend.order.detail-part.machine')
@include('backend.order.detail-part.cancel')
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
            url: "{{ route('admin.order.data') }}",
            data: function (d) {
                d.name = $('[name=s_name]').val();
                d.tmp_name = $('[name=s_name]').val();
                d.code = $('[name=s_code]').val();
                d.deadline = $('[name=s_deadline]').val();
                d.phone = $('[name=s_phone]').val();
                d.status = $('[name=s_status]').val();
                d.payment_status = $('[name=s_payment_status]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'code', name: 'code'},
            {data:'name', name: 'name'},
            {data:'phone', name: 'phone'},
            {data:'deadline', name: 'deadline'},
            {data:'status', name: 'status'},
            {data:'payment_status', name: 'payment_status'},
            {data:'created_at', name: 'created_at'},
            {data:'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        'info'        : true,
        'order'       : ['0','desc'],
        'autoWidth'   : false
    });

    function filter() {
        table.draw();
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
                    url: "{{ route('admin.order.delete',['id'=>'']) }}" + '/' + id,
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

    function paidData(id) {
        swal({
            title: "Yakin Set Lunas?",
            text : "Data pembayaran akan menjadi lunas",
            icon: "warning",
            buttons: {
                cancel:true,
                confirm: {
                    text:'Lunas!',
                    closeModal: false,
                },
            },
        })
            .then((process) => {
                if(process){
                    $.ajax({
                        url: "{{ route('admin.order.payment',['id'=>'']) }}",
                        type: "POST",
                        data: {
                            '_token': '{{csrf_token()}}',
                            'id':id
                        },
                        success: function(data) {
                            swal({
                                title: 'Berhasil Set Lunas!',
                                text: 'Data pesanan sudah lunas',
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
                    swal('Data tidak jadi set lunas');
                }
            });
    }

    function processData(id){
        $('#machineModal form')[0].reset();
        $.ajax({
            url: "{{route('admin.order.machine',['id'=>''])}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#machineModal').modal('show');
                $('.modal-title').text('Proses Pesanan');

                $('[name=id]').val(data.id);
                $('[name=code]').val(data.code);
                $('[name=remark]').val(data.remark);
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
    }

    function setProgress(){

        $('#machineModal').modal('hide');

        swal({
            title: "Yakin Proses Pesanan?",
            text : "Data pesanan akan di proses dan stock akan berkurang!",
            icon: "warning",
            buttons: {
                cancel:true,
                confirm: {
                    text:'Proses!',
                    closeModal: false,
                },
            },
        })
        .then((process) => {
            if(process){
                $.ajax({
                    url:"{{route('admin.order.status')}}",
                    type:'POST',
                    // data: $('#myModal form').serialize(),
                    data: $('#machineModal form').serialize(),
                    success: function(data){
                        if(data.status){
                            table.ajax.reload();
                            swal({
                                title: 'Berhasil Proses pesanan',
                                text: data.message,
                                icon: 'success',
                                timer: '3000'
                            });
                        }else{
                            swal({
                                title: 'Gagal Proses Pesanan!',
                                text: data.message,
                                icon: 'error',
                                timer: '3000'
                            }).then(()=>{
                                processData($('#machineModal [name=id]').val());
                            });
                        }
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
                swal('Data tidak jadi diproses');
            }
        });
    }

    function completeData(id){
        swal({
            title: "Yakin Selesaikan Pesanan?",
            text : "Data pesanan akan di selesaikan!",
            icon: "warning",
            buttons: {
                cancel:true,
                confirm: {
                    text:'Selesaikan!',
                    closeModal: false,
                },
            },
        })
        .then((process) => {
            if(process){
                $.ajax({
                    url:"{{route('admin.order.status')}}",
                    type:'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id':id,
                        'status':'{{ \App\Util\Constant::ORDER_STATUS_COMPLETED }}',
                    },
                    success: function(data){
                        if(data.status){
                            table.ajax.reload();
                            swal({
                                title: 'Berhasil Proses pesanan',
                                text: data.message,
                                icon: 'success',
                                timer: '3000'
                            });
                        }else{
                            swal({
                                title: 'Gagal Proses Pesanan!',
                                text: data.message,
                                icon: 'error',
                                timer: '3000'
                            }).then(()=>{
                                processData($('#machineModal [name=id]').val());
                            });
                        }
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
                swal('Data tidak jadi diproses');
            }
        });
    }

    function cancelData(id){
        $('#cancelModal form')[0].reset();
        $.ajax({
            url: "{{route('admin.order.machine',['id'=>''])}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#cancelModal').modal('show');
                $('.modal-title').text('Batal Pesanan');

                $('[name=id]').val(data.id);
                $('[name=code]').val(data.code);
                $('[name=remark]').val(data.remark);
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
    }

    function setCancelData(){

        $('#cancelModal').modal('hide');

        swal({
            title: "Yakin Batal Pesanan?",
            text : "Data pesanan akan di batalkan!",
            icon: "warning",
            buttons: {
                cancel:true,
                confirm: {
                    text:'Batal!',
                    closeModal: false,
                },
            },
        })
            .then((process) => {
                if(process){
                    $.ajax({
                        url:"{{route('admin.order.status')}}",
                        type:'POST',
                        // data: $('#myModal form').serialize(),
                        data: $('#cancelModal form').serialize(),
                        success: function(data){
                            if(data.status){
                                table.ajax.reload();
                                swal({
                                    title: 'Berhasil Batal pesanan',
                                    text: data.message,
                                    icon: 'success',
                                    timer: '3000'
                                });
                            }else{
                                swal({
                                    title: 'Gagal Batal Pesanan!',
                                    text: data.message,
                                    icon: 'error',
                                    timer: '3000'
                                }).then(()=>{
                                    processData($('#cancelModal [name=id]').val());
                                });
                            }
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
                    swal('Data tidak jadi diproses');
                }
            });
    }

</script>

@endpush
