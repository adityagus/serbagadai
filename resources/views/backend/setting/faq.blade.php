@extends('backend.layouts.template')

@section('pageTitle','Detail Member')

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
                    <li><span>Pengaturan Tentang</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark"></i>
                                <span
                                        class="caption-subject font-dark bold uppercase">Pengaturan Bantuan & FAQ
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
                                    @$faq = json_decode($config->faq);
                                @endphp
                                @foreach($config::FAQ_FIELD as $keyField => $field)
                                    @if($i%2==0)
                                        <div class="row">
                                            @endif
                                            <div class="col-md-6">
                                                <div class="form-group" id="{{$keyField}}">
                                                    <label class="control-label">{{$config::FAQ_LABEL[$keyField]}}</label>
                                                    @if($field == 'file')
                                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$faq->$keyField}}" placeholder="{{$config::FAQ_LABEL[$keyField]}}">
                                                        <br>
                                                        <a href="{{url('storage/'.@$faq->$keyField)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$faq->$keyField)}}" width="100" height="100"></a>
                                                    @elseif($field != 'textarea')
                                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$faq->$keyField}}" placeholder="{{$config::FAQ_LABEL[$keyField]}}">
                                                    @else
                                                        <textarea class="form-control" name="{{$keyField}}" rows="8">{{@$faq->$keyField}}</textarea>
                                                    @endif
                                                    <div class="help-block">{{ in_array($keyField,$config::FAQ_LABEL_LIST)? $config::FAQ_LABEL_HELP[$keyField]:''}}</div>
                                                    <div id="{{$keyField}}_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            @if(($i+1)%2==0)
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Daftar Pertanyaan</h4>
                                        <button class="btn btn-sm btn-success" type="button" onclick="addData()"><i class="fa fa-plus"></i> Tambah</button>
                                        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No</th>
                                                <th style="text-align: center">Pertanyaan</th>
                                                <th style="text-align: center">Jawaban</th>
                                                <th style="text-align: center">Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody id="listQuestion">
                                            @foreach($faq->list as $key => $question)
                                                <tr id="tr_{{$key}}">
                                                    <td style="text-align: center">{{$key+1}}</td>
                                                    <td>
                                                        <input type="text" name="question[]" class="form-control" value="{{@$question->title}}" placeholder="Pertanyaan ke-{{$key+1}}">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="answer[]" rows="4">{{@$question->content}}</textarea>
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
                title: "Yakin Simpan Data Pengaturan Umum?",
                text : "Data Pengaturan akan disimpan",
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
                            url: "{{ route('admin.faq.save') }}",
                            type: "POST",
                            data: new FormData($("#formSetting")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data Pengaturan',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '1500'
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data Pengaturan',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
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
                                    timer: '1500'
                                });
                            }
                        });
                    }else{
                        swal('Data Pengaturan tidak jadi disimpan');
                    }
                });
        }
    </script>

    <script type="text/javascript">
        var currentQuestion = {{$key+2}};

        function addData(){
            var row = '<tr id="tr_'+currentQuestion+'">\n' +
                '                    <td style="text-align: center">'+currentQuestion+'</td>\n' +
                '                    <td><input class="form-control" name="question[]" type="text" placeholder="Pertanyaan ke-'+currentQuestion+'"></td>\n' +
                '                    <td><textarea class="form-control" name="answer[]" placeholder="Jawaban ke-'+currentQuestion+'" rows="4"></textarea></td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-danger" onclick="deleteData('+currentQuestion+')"><i class="fa fa-remove"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listQuestion').append(row);
            currentQuestion++;
        }

        function deleteData(id){
            $('#tr_'+id).remove();
        }
    </script>
@endpush
