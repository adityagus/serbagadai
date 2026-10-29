<div class="col-md-12 activities">
    <form action="javascript:;" id="form-activities" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="activity_header">
                    <label class="control-label">Header</label>
                    <input type="text" name="activity_header" class="form-control" value="{{@$content->activity_header}}" placeholder="Masukan Header text">
                    <div class="help-block"></div>
                    <div id="activity_header_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="activity_sub_header">
                    <label class="control-label">Subheader</label>
                    <input type="text" name="activity_sub_header" class="form-control" value="{{@$content->activity_sub_header}}" placeholder="Masukan Sub Header text">
                    <div class="help-block"></div>
                    <div id="activity_sub_header_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveActivity()">Simpan</button>
            </div>
        </div>
        <hr/>
        @include('backend.pages.about.part.activity-item')
    </form>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveActivity(){
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
                            url: "{{ route('admin.pages.about.activity.save') }}",
                            type: "POST",
                            data: new FormData($("#form-activities")[0]),
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
                                    @foreach(\App\Models\Pages::ABOUT_ACTIVITY_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('.activities #'+error_arr[i]).addClass('has-error');
                                            $('.activities #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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
