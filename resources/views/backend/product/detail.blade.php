@extends('backend.layouts.template')

@section('pageTitle','Detail Produk')

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
                    <li><a href="{{route('admin.product')}}">Produk</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Produk</span></li>
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
                                <span class="caption-subject font-dark bold uppercase">Detail Produk</span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-12 product">
                                    <form action="javascript:;" id="form-product" enctype="multipart/form-data">
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
                                                <div class="form-group" id="icon">
                                                    <label class="control-label">Icon Produk</label>
                                                    <input type="file" name="icon" class="form-control" value="{{@$model->icon}}">
                                                    <div class="help-block"><small>resolusi 100 x 100 px</small></div>
                                                    <div id="icon_error" class="help-block help-block-error"> </div>
                                                    @if(!empty(@$model->icon))
                                                        <br/>
                                                        <a href="{{url('storage/'.@$model->icon)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->icon)}}" width="100" height="100"></a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="image">
                                                    <label class="control-label">Image Produk</label>
                                                    <input type="file" name="image" class="form-control" value="{{@$model->image}}">
                                                    <div class="help-block"><small>resolusi 800 x 800 px</small></div>
                                                    <div id="image_error" class="help-block help-block-error"> </div>
                                                    @if(!empty(@$model->image))
                                                        <br/>
                                                        <a href="{{url('storage/'.@$model->image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->image)}}" width="100" height="100"></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="short_description">
                                                    <label class="control-label">Deskripsi Singkat</label>
                                                    <textarea class="form-control" name="short_description" placeholder="Masukan Deskripsi Singkat" rows="5">{{ @$model->short_description }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="short_description_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="position">
                                                    <label class="control-label">Position</label>
                                                    <input type="number" min="1" name="position" class="form-control" value="{{@$model->position}}" placeholder="Masukan posisi produk" >
                                                    <div class="help-block"></div>
                                                    <div id="position_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
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
                                            <div class="col-md-6">
                                                <div class="form-group" id="call_action">
                                                    <label class="control-label">Link Ajukan Sekarang</label>
                                                    <input type="text" name="call_action" class="form-control" value="{{@$model->call_action}}" placeholder="Masukan Link Ajukan Sekarang">
                                                    <div class="help-block"></div>
                                                    <div id="call_action_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="description">
                                                    <label class="control-label">Deskripsi Detail</label>
                                                    <textarea class="form-control text-editor" name="description" placeholder="Masukan product deskripsi" rows="5">{{ @$model->description }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="description_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        @include('backend/product/part/advantage')

                                        <hr/>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="terms">
                                                    <label class="control-label">Persyaratan</label>
                                                    <textarea class="form-control text-editor" name="terms" placeholder="Masukan product persyaratan" rows="5">{{ @$model->terms }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="terms_error" class="help-block help-block-error"> </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="pricing">
                                                    <label class="control-label">Pricing Produk</label>
                                                    <textarea class="form-control text-editor" name="pricing" placeholder="Masukan product pricing" rows="5">{{ @$model->pricing }}</textarea>
                                                    <div class="help-block"></div>
                                                    <div id="pricing_error" class="help-block help-block-error"> </div>
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
                            url: "{{ route('admin.product.save') }}",
                            type: "POST",
                            data: new FormData($("#form-product")[0]),
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
                                        location.href = '{{route('admin.product')}}';
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
                                    });

                                    var error_arr = [];
                                    @foreach(\App\Models\Product::FORM_VALIDATION as $key => $value)
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
