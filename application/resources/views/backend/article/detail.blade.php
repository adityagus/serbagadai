@extends('backend.layouts.template')

@section('pageTitle','Detail Artikel')

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
                    <li><a href="{{route('admin.article')}}">Artikel</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Artikel</span></li>
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
                                <span class="caption-subject font-dark bold uppercase">Detail Artikel</span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-12 article">
                                    <form action="javascript:;" id="form-article" enctype="multipart/form-data">
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
                                                <div class="form-group" id="featured_image">
                                                    <label class="control-label">Featured Image</label>
                                                    <input type="file" name="featured_image" class="form-control" value="{{@$model->featured_image}}">
                                                    <div class="help-block"><small>resolusi 344 x 220 px</small></div>
                                                    <div id="featured_image_error" class="help-block help-block-error"> </div>
                                                    @if(!empty(@$model->featured_image))
                                                        <br/>
                                                        <a href="{{url('storage/'.@$model->featured_image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->featured_image)}}" width="100" height="100"></a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="banner_image">
                                                    <label class="control-label">Banner Image</label>
                                                    <input type="file" name="banner_image" class="form-control" value="{{@$model->banner_image}}">
                                                    <div class="help-block"><small>resolusi 1296 x 829 px</small></div>
                                                    <div id="banner_image_error" class="help-block help-block-error"> </div>
                                                    @if(!empty(@$model->banner_image))
                                                        <br/>
                                                        <a href="{{url('storage/'.@$model->banner_image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->banner_image)}}" width="100" height="100"></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="status">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control text-editor" name="status" placeholder="Masukan status content">
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
                                            <div class="col-md-12">
                                                <div class="form-group" id="content">
                                                    <label class="control-label">Konten Article</label>
                                                    <textarea class="form-control text-editor" name="content" placeholder="Masukan article content" rows="5">{{ @$model->content }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="content_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
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
                            url: "{{ route('admin.article.save') }}",
                            type: "POST",
                            data: new FormData($("#form-article")[0]),
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
                                        location.href = '{{ route('admin.article') }}';
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
                                    });

                                    var error_arr = [];
                                    @foreach(\App\Models\Article::FORM_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.article #'+error_arr[i]).addClass('has-error');
                                            $('.article #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
