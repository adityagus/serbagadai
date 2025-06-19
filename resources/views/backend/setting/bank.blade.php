@extends('backend.layouts.template')

@section('pageTitle','Daftar Bank')

@push('customCss')

@endpush

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Beranda</a> <i class="fa fa-circle"></i></li>
                    <li><span>Bank Account</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="portlet light bordered margin-top-20">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark"></i>
                                <span
                                        class="caption-subject font-dark bold uppercase">Pengaturan Bank Account
                                    </span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <form action="javascript:;" id="formSetting" enctype="multipart/form-data">
                                <input type="hidden" name="idSetting" value="1">
                                {{csrf_field()}}
                                @php
                                    $i = 0;
                                    @$banks = json_decode($config->bank);
                                @endphp
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Daftar Akun Bank</h4>
                                        <button class="btn btn-sm btn-success" type="button" onclick="addData()"><i class="fa fa-plus"></i> Tambah</button>
                                        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No</th>
                                                <th style="text-align: center">Bank</th>
                                                <th style="text-align: center">Rekening</th>
                                                <th style="text-align: center">Atas Nama</th>
                                                <th style="text-align: center">Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody id="listBank">
                                            @foreach($banks as $key => $bank)
                                                <tr id="tr_{{$key}}">
                                                    <td style="text-align: center">{{$key+1}}</td>
                                                    <td>
                                                        <input type="text" name="bank[]" class="form-control" value="{{@$bank->bank}}" placeholder="Nama Bank ke-{{$key+1}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="number[]" class="form-control" value="{{@$bank->number}}" placeholder="Rekening Bank ke-{{$key+1}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="account[]" class="form-control" value="{{@$bank->account}}" placeholder="Atas Nama ke-{{$key+1}}">
                                                    </td>
                                                    <td style="text-align: center">
                                                        <button class="btn btn-sm btn-danger" onclick="deleteData({{$key}})"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9 text-right">
                                    <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page content -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection

@push('customJs')
    <script type="text/javascript">
        function save(){
            swal({
                title: "Yakin Simpan Data?",
                text : "Data akan disimpan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Simpan!',
                        closeModal: false,
                    },
                },
            })
                .then((process) => {
                    if(process){

                        $('.form-group').removeClass('has-error');
                        $('.help-block-error').html('');

                        $.ajax({
                            url: "{{ route('admin.bank.save') }}",
                            type: "POST",
                            data: new FormData($("#formSetting")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        if(done){
                                            location.reload();
                                        }

                                        setTimeout(function(){ location.reload() }, 3000);
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = ['title','banner','header1','image1','content1','header2','image2','content2'];
                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('#'+error_arr[i]).addClass('has-error');
                                            $('#'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
                                        }
                                    }
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
                        swal('Data tidak jadi disimpan');
                    }
                });
        }
    </script>

    <script type="text/javascript">
        var currentBank = {{$key+2}};

        function addData(){
            var row = '<tr id="tr_'+currentBank+'">\n' +
                '                    <td style="text-align: center">'+currentBank+'</td>\n' +
                '                    <td><input class="form-control" name="bank[]" type="text" placeholder="Nama Bank ke-'+currentBank+'"></td>\n' +
                '                    <td><input class="form-control" name="number[]" type="text" placeholder="Rekening Bank ke-'+currentBank+'"></td>\n' +
                '                    <td><input class="form-control" name="account[]" type="text" placeholder="Atas Nama ke-'+currentBank+'"></td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-danger" onclick="deleteData('+currentBank+')"><i class="fa fa-remove"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listBank').append(row);
            currentBank++;
        }

        function deleteData(id){
            $('#tr_'+id).remove();
        }
    </script>
@endpush
