<div class="col-md-12 area">
    <form action="javascript:;" id="form-area" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="area_title">
                    <label class="control-label">Title</label>
                    <input type="text" name="area_title" class="form-control" value="{{@$content->area_title}} asdasda" placeholder="Masukan title text">
                    <div class="help-block"></div>
                    <div id="area_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="area_content">
                    <label class="control-label">Content</label>
                    <textarea class="form-control" name="area_content" placeholder="Masukan area content" rows="5">{{ @$content->area_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="area_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveArea()">Simpan</button>
            </div>
        </div>
    </form>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveArea(){
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
                            url: "{{ route('admin.pages.about.area.save') }}",
                            type: "POST",
                            data: new FormData($("#form-area")[0]),
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
                                            $('.area #'+error_arr[i]).addClass('has-error');
                                            $('.area #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
