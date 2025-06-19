<div class="col-md-12 about">
    <form action="javascript:;" id="form-about" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="general_title">
                    <label class="control-label">Header</label>
                    <input type="text" name="general_title" class="form-control" value="{{@$content->general_title}}" placeholder="Masukan Header text">
                    <div class="help-block"></div>
                    <div id="general_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="general_sub_header">
                    <label class="control-label">Sub Header</label>
                    <input type="text" name="general_sub_header" class="form-control" value="{{@$content->general_sub_header}}" placeholder="Masukan Sub Header text">
                    <div class="help-block"></div>
                    <div id="general_sub_header_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
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
            <div class="col-md-12">
                <div class="form-group" id="general_content">
                    <label class="control-label">Konten Tentang</label>
                    <textarea class="form-control text-editor" name="general_content" placeholder="Masukan about content" rows="5">{{ @$content->general_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="general_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveAbout()">Simpan</button>
            </div>
        </div>
    </form>
</div>

@push('customJs')
    <script type="text/javascript">

        function saveAbout(){
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
                            url: "{{ route('admin.pages.about.general.save') }}",
                            type: "POST",
                            data: new FormData($("#form-about")[0]),
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
                                    @foreach(\App\Models\Pages::ABOUT_GENERAL_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.about #'+error_arr[i]).addClass('has-error');
                                            $('.about #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
