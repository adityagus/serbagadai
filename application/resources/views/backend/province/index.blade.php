@extends('backend.layouts.template')

@section('pageTitle','Province')

@push('customCss')
    <link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><span>Provinsi</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                class="caption-subject font-dark bold uppercase">List Provinsi</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12 col-lg-12" style="text-align: right;">
                                <a href="{{route('admin.province.export')}}" target="_blank" class="btn btn-success">Export</a>
                                <button onclick="addData()" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td class="all">
                                        <input placeholder="Find ID" type="text" class="form-control" name="s_id" onchange="filter()">
                                    </td>
                                    <td class="all">
                                        <input placeholder="Find Nama" type="text" class="form-control" name="s_name" onchange="filter()">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Jumlah Outlet</th>
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
@include('backend.province.modal')
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
            url: "{{ route('admin.province.data') }}",
            data: function (d) {
                d['province.id'] = $('[name=s_id]').val();
                d['province.name'] = $('[name=s_name]').val();
            }
        },
        'dataType'    : 'json',
        'searching'   : false,
        'paging'      : true,
        'lengthChange': true,
        'columns'     : [
            {data:'id', name: 'id'},
            {data:'name', name: 'name'},
            {data:'image', name: 'image'},
            {data:'outlet_count', name: 'outlet_count'},
            {data:'action', name: 'action', orderable: false, searchable: false},
        ],
        'info'        : true,
        'order'       : ['0','desc'],
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
        $('.preview-image').hide();
    }

    function editData(id){
        $('#myModal form')[0].reset();
        $('[name=method]').val('EDIT');
        $.ajax({
            url: "{{route('admin.province.get',['id'=>''])}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#myModal').modal('show');
                $('.modal-title').text('Edit Data');

                $('[name=id]').val(data.id);
                @foreach(\App\Models\Province::FORM_VALIDATION as $key => $item)
                    @if(!in_array($key,['image']))
                        $('[name={{$key}}]').val(data['{{$key}}']);
                    @endif
                @endforeach

                if(data.image){
                    $('.preview-image').show();
                    $('.preview-image').attr('href',data.image);
                    $('.preview-image img').attr('src',data.image);
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
                    url: "{{ route('admin.province.delete',['id'=>'']) }}" + '/' + id,
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
                        }).then(()=>{
                            table.ajax.reload();
                        });
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

    $('#submit').click(function(e){
      e.preventDefault();
      url = "{{route('admin.province.save')}}";
      
      $('.form-group').removeClass('has-error');
      $('.help-block-error').html('');

      $('#myModal').modal('hide');

      $.ajax({
        url:url,
        type:'POST',
        data: new FormData($("#myModal form")[0]),
        processData: false,
        contentType: false,
        async:false,
        success: function(data){
            if(data.status){
                table.ajax.reload();
                swal({
                    title: 'Berhasil Simpan Data',
                    text: data.message,
                    icon: 'success',
                    timer: '3000'
                });
            }else{
                swal({
                    title: 'Gagal Simpan Data',
                    text: data.message,
                    icon: 'error',
                    timer: '3000'
                }).then(()=>{
                    var error_arr = [];

                    @foreach(\App\Models\Province::FORM_VALIDATION as $key => $item)
                    error_arr.push('{{ $key }}');
                    @endforeach

                    for(var i=0;i < error_arr.length;i++){
                        if(error_arr[i] in data.error){
                            $('#'+error_arr[i]).addClass('has-error');
                            $('#'+error_arr[i]+'_error').html(data.error[error_arr[i]]);
                        }
                    }

                    $('#myModal').modal('show');
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
    });

</script>

@endpush
