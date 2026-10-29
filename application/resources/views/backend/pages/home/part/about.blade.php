<div class="col-md-12 about">
    <form action="javascript:;" id="form-about" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="about_title">
                    <label class="control-label">Title</label>
                    <input type="text" name="about_title" class="form-control" value="{{@$content->about_title}}" placeholder="Masukan title text">
                    <div class="help-block"></div>
                    <div id="about_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="about_content">
                    <label class="control-label">Content</label>
                    <textarea class="form-control" name="about_content" placeholder="Masukan about content" rows="5">{{ @$content->about_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="about_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="about_image">
                    <label class="control-label">Image</label>
                    <input type="file" name="about_image" class="form-control" value="{{@$content->about_image}}">
                    <div class="help-block"><small>resolusi 1000 x 760 px</small></div>
                    <div id="about_image_error" class="help-block help-block-error"> </div>
                    @if(!empty($content->about_image))
                        <br/>
                        <a href="{{url('storage/'.@$content->about_image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$content->about_image)}}" width="100" height="100"></a>
                    @endif
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
                            url: "{{ route('admin.pages.home.about.save') }}",
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
                                    @foreach(\App\Models\Pages::HOME_ABOUT_VALIDATION as $key => $value)
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
