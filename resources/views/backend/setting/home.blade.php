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
                    <li><span>Pengaturan Beranda</span></li>
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
                                        class="caption-subject font-dark bold uppercase">Pengaturan Beranda
                                    </span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <form action="javascript:;" id="formSetting" enctype="multipart/form-data">
                                <input type="hidden" name="types" value="{{ \App\Util\Constant::PAGES_TYPES_HOME }}">
                                {{csrf_field()}}
                                <br/>
                                <h4>Section Hero</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="hero_header">
                                            <label class="control-label">Header</label>
                                            <input type="text" name="hero_header" class="form-control" value="{{@$home->hero_header}}" placeholder="Masukan Header text">
                                            <div class="help-block"></div>
                                            <div id="hero_header_error" class="help-block help-block-error"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="hero_sub_header">
                                            <label class="control-label">Subheader</label>
                                            <input type="text" name="hero_sub_header" class="form-control" value="{{@$home->hero_sub_header}}" placeholder="Masukan Sub Header text">
                                            <div class="help-block"></div>
                                            <div id="hero_sub_header_error" class="help-block help-block-error"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="hero_action">
                                            <label class="control-label">Button Action</label>
                                            <input type="text" name="hero_action" class="form-control" value="{{@$home->hero_action}}" placeholder="Masukan Link Action">
                                            <div class="help-block"></div>
                                            <div id="hero_action_error" class="help-block help-block-error"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="hero_background">
                                            <label class="control-label">Background</label>
                                            <input type="file" name="hero_background" class="form-control" value="{{@$home->hero_background}}">
                                            @if(!empty($home->hero_background))
                                            <br/>
                                            <a href="{{url('storage/'.@$home->hero_background)}}" target="_blank" title="preview">Lihat File</a>
                                            @endif
                                            <div class="help-block"><small>resolusi 1440px X 748px</small></div>
                                            <div id="hero_background_error" class="help-block help-block-error"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Daftar Slider</h5>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="title0" maxlength="30" placeholder="Judul Slider">
                                                    <div id="nama_error" class="help-block help-block-error"> </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="file" class="form-control" name="image0" placeholder="Gambar Slider">
                                                    <div id="nama_error" class="help-block help-block-error"> </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-sm btn-success" type="button" onclick="saveSlider(0)"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="help-block">Gambar Format JPG/PNG, Max Image (500kb), Ukuran 1920 x 930 px</div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center">No</th>
                                                <th style="text-align: center">Judul</th>
                                                <th style="text-align: center">Gambar</th>
                                                <th style="text-align: center;width: 100px;" >Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody id="listSlider">
                                            @foreach($sliders as $key => $slider)
                                                <tr id="tr_{{$key+1}}">
                                                    <td style="text-align: center">{{$key+1}}</td>
                                                    <td>
                                                        <input type="text" name="title{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->title}}" placeholder="Judul Slider ke-{{$key+1}} (Max 20 Karakter)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="description{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->description}}" placeholder="Deskripsi Slider ke-{{$key+1}} (Max 20 Karakter)">
                                                    </td>
                                                    <td>
                                                        <input type="file" name="image{{$key+1}}" onchange="setImage({{$key+1}})" class="form-control">
                                                        <div class="help-block">Gambar Format JPG/PNG, Max Image (500kb), Ukuran 1920 x 930 px</div>
                                                        <br>
                                                        <a href="{{url('storage/'.@$slider->image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$slider->image)}}" width="100" height="100"></a>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="link{{$key+1}}" class="form-control" value="{{@$slider->link}}" placeholder="Link Slider ke-{{$key+1}}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="linkText{{$key+1}}" class="form-control" value="{{@$slider->linkText}}" placeholder="Link Slider Text Slider ke-{{$key+1}}">
                                                    </td>
                                                    <td style="text-align: center">
                                                        <button class="btn btn-sm btn-primary" onclick="saveSlider({{$key+1}})"><i class="fa fa-save"></i></button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteSlider({{$key+1}})"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <input type="hidden" name="sliders">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
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
                            url: "{{ route('admin.about.save') }}",
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

        function saveSlider(id) {
            swal({
                title: "Yakin Simpan Data Slider?",
                text : "Data slider akan disimpan",
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
                    if(process) {
                        formData = new FormData();
                        formData.append('id',id);
                        formData.append('_token','{{csrf_token()}}');
                        formData.append('title',$('[name=title'+id+']').val());
                        if($('[name=image'+id+']').val() != ''){
                            formData.append('image',$('[name=image'+id+']')[0].files[0]);
                        }

                        $.ajax({
                            url: "{{ route('admin.slider.save') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Simpan Slider!',
                                        text: 'Slider berhasil di simpan',
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Simpan Slider',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $('#myModalSub').modal('hide');
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '1500'
                                });
                            }
                        });
                    }
                });
        }

        function deleteSlider(id) {
            swal({
                title: "Yakin Hapus Data Slider?",
                text : "Data slider akan dihapus permanen",
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
                        url: "{{ route('admin.slider.delete') }}",
                        type: "POST",
                        data: {
                            '_token': '{{csrf_token()}}',
                            'id':id,
                        },
                        success: function(data) {
                            swal({
                                title: 'Berhasil Hapus Slider!',
                                text: 'Slider berhasil di hapus',
                                icon: 'success',
                                timer: '1500'
                            }).then((done)=>{
                                location.reload();
                            });
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
                    swal('Data Slider tidak jadi dihapus');
                }
            });
        }
    </script>
@endpush
