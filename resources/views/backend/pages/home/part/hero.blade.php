<div class="col-md-12 hero">
    <form action="javascript:;" id="form-hero" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="hero_header">
                    <label class="control-label">Header</label>
                    <input type="text" name="hero_header" class="form-control" value="{{@$content->hero_header}}" placeholder="Masukan Header text">
                    <div class="help-block"></div>
                    <div id="hero_header_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="hero_sub_header">
                    <label class="control-label">Subheader</label>
                    <input type="text" name="hero_sub_header" class="form-control" value="{{@$content->hero_sub_header}}" placeholder="Masukan Sub Header text">
                    <div class="help-block"></div>
                    <div id="hero_sub_header_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="hero_action">
                    <label class="control-label">Button Action</label>
                    <input type="text" name="hero_action" class="form-control" value="{{@$content->hero_action}}" placeholder="Masukan Link Action">
                    <div class="help-block"></div>
                    <div id="hero_action_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="hero_background">
                    <label class="control-label">Background</label>
                    <input type="file" name="hero_background" class="form-control" value="{{@$content->hero_background}}">
                    <div class="help-block"><small>resolusi 1440 x 748 px</small></div>
                    <div id="hero_background_error" class="help-block help-block-error"> </div>
                    @if(!empty($content->hero_background))
                        <br/>
                        <a href="{{url('storage/'.@$content->hero_background)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$content->hero_background)}}" width="100" height="100"></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveHero()">Simpan</button>
            </div>
        </div>
        <hr/>
        @include('backend.pages.home.part.hero-slider')
    </form>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveHero(){
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
                            url: "{{ route('admin.pages.home.hero.save') }}",
                            type: "POST",
                            data: new FormData($("#form-hero")[0]),
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
                                    @foreach(\App\Models\Pages::HOME_HERO_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.hero #'+error_arr[i]).addClass('has-error');
                                            $('.hero #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
