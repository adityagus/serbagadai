<div class="col-md-12 general">
    <form action="javascript:;" id="form-general" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="general_title">
                    <label class="control-label">Header Title</label>
                    <input type="text" name="general_title" class="form-control" value="{{@$content->general_title}}" placeholder="Masukan Title text">
                    <div class="help-block"></div>
                    <div id="general_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="header_image">
                    <label class="control-label">Header Banner</label>
                    <input type="file" name="header_image" class="form-control" value="{{@$content->header_image}}">
                    <div class="help-block"><small>resolusi 1440 x 228 px</small></div>
                    <div id="header_image_error" class="help-block help-block-error"> </div>
                    @if(!empty($content->header_image))
                        <br/>
                        <a href="{{url('storage/'.@$content->header_image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$content->header_image)}}" width="100" height="100"></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="general_testimony">
                    <label class="control-label">Title Testimony</label>
                    <input type="text" name="general_testimony" class="form-control" value="{{@$content->general_testimony}}" placeholder="Masukan Title Testimony text">
                    <div class="help-block"></div>
                    <div id="general_testimony_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="general_drop_cv">
                    <label class="control-label">Konten Drop CV</label>
                    <textarea class="form-control" name="general_drop_cv" placeholder="Masukan content drop CV" rows="5">{{ @$content->general_drop_cv }}</textarea>
                    <div class="help-block"></div>
                    <div id="general_drop_cv_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveGeneral()">Simpan</button>
            </div>
        </div>
    </form>
</div>

@push('customJs')
    <script type="text/javascript">

        function saveGeneral(){
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
                            url: "{{ route('admin.pages.career.general.save') }}",
                            type: "POST",
                            data: new FormData($("#form-general")[0]),
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
                                        location.reload();
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
                                    });

                                    var error_arr = [];
                                    @foreach(\App\Models\Pages::CAREER_GENERAL_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.general #'+error_arr[i]).addClass('has-error');
                                            $('.general #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
