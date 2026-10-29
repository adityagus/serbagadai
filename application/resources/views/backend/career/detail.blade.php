@extends('backend.layouts.template')

@section('pageTitle','Detail Karir')

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
                    <li><a href="{{route('admin.career')}}">Karir</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Karir</span></li>
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
                                <span class="caption-subject font-dark bold uppercase">Detail Karir</span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-12 product">
                                    <form action="javascript:;" id="form-career" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{ !empty(@$model->id) ? @$model->id : 0 }}">
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="title">
                                                    <label class="control-label">Judul</label>
                                                    <input type="text" name="title" class="form-control" value="{{@$model->title}}" placeholder="Masukan Judul text">
                                                    <div class="help-block"></div>
                                                    <div id="title_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="slug">
                                                    <label class="control-label">Slug</label>
                                                    <input type="text" name="slug" class="form-control" value="{{@$model->slug}}" placeholder="Masukan Slug text" readonly>
                                                    <div class="help-block"><small>Terisi Otomatis</small></div>
                                                    <div id="slug_header_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="short_description">
                                                    <label class="control-label">Deskripsi Singkat</label>
                                                    <textarea class="form-control " name="short_description" placeholder="Masukan Deskripsi Singkat" rows="5">{{ @$model->short_description }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="short_description_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="status">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control text-editor" name="status" placeholder="Masukan status">
                                                        <option value="">Pilih Status</option>
                                                        @foreach(\App\Helpers\SelectHelper::getCommonStatus() as $value => $label)
                                                            <option value="{{$value}}" {{ $value == @$model->status ? 'selected': '' }}>{{$label}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    <div id="status_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="category">
                                                    <label class="control-label">Kategori</label>
                                                    <select class="form-control" name="category" placeholder="Masukan Kategori">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach(\App\Util\Constant::CAREER_CATEGORY_LIST as $value => $label)
                                                            <option value="{{$value}}" {{ $value == @$model->category ? 'selected' : '' }}>{{$label}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    <div id="category_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="types">
                                                    <label class="control-label">Type</label>
                                                    <select class="form-control" name="types" placeholder="Masukan Type">
                                                        <option value="">Pilih Type</option>
                                                        @foreach(\App\Util\Constant::CAREER_TYPES_LIST as $value => $label)
                                                            <option value="{{$value}}" {{ $value == @$model->types ? 'selected' : '' }}>{{$label}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    <div id="types_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="qualification">
                                                    <label class="control-label">Kualifikasi</label>
                                                    <textarea class="form-control text-editor" name="qualification" placeholder="Masukan qualification" rows="5">{{ @$model->qualification }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="qualification_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="job_desk">
                                                    <label class="control-label">Rincian Tugas</label>
                                                    <textarea class="form-control text-editor" name="job_desk" placeholder="Masukan job desk" rows="5">{{ @$model->job_desk }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="job_desk_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        @include('backend/career/part/location')

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9 text-right">
                                                <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
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
                            url: "{{ route('admin.career.save') }}",
                            type: "POST",
                            data: new FormData($("#form-career")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '1500'
                                    }).then(()=>{
                                        location.href = '{{ route('admin.career') }}';
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
                                    });

                                    var error_arr = [];
                                    @foreach(\App\Models\Career::FORM_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.product #'+error_arr[i]).addClass('has-error');
                                            $('.product #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
                        swal('Data tidak jadi disimpan');
                    }
                });
        }
    </script>
@endpush
