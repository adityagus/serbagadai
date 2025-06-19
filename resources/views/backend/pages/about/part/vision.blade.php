<div class="col-md-12 vision">
    <form action="javascript:;" id="form-vision" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="vision_content">
                    <label class="control-label">Visi</label>
                    <textarea class="form-control text-editor" name="vision_content" placeholder="Masukan vision content" rows="5">{{ @$content->vision_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="vision_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="mission_content">
                    <label class="control-label">Misi</label>
                    <textarea class="form-control text-editor" name="mission_content" placeholder="Masukan mission content" rows="5">{{ @$content->mission_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="mission_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="vision_image">
                    <label class="control-label">Vision Image</label>
                    <input type="file" name="vision_image" class="form-control" value="{{@$content->vision_image}}">
                    <div class="help-block"><small>resolusi 1160 x 760 px</small></div>
                    <div id="vision_image_error" class="help-block help-block-error"> </div>
                    @if(!empty($content->vision_image))
                        <br/>
                        <a href="{{url('storage/'.@$content->vision_image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$content->vision_image)}}" width="100" height="100"></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveVision()">Simpan</button>
            </div>
        </div>
    </form>
</div>

@push('customJs')
    <script type="text/javascript">

        function saveVision(){
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
                            url: "{{ route('admin.pages.about.vision.save') }}",
                            type: "POST",
                            data: new FormData($("#form-vision")[0]),
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
                                    @foreach(\App\Models\Pages::ABOUT_VISION_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.vision #'+error_arr[i]).addClass('has-error');
                                            $('.vision #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
