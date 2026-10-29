<div class="col-md-12 product">
    <form action="javascript:;" id="form-product" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="product_title">
                    <label class="control-label">Title</label>
                    <input type="text" name="product_title" class="form-control" value="{{@$content->product_title}}" placeholder="Masukan title text">
                    <div class="help-block"></div>
                    <div id="product_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="product_sub_title">
                    <label class="control-label">Sub Title</label>
                    <textarea class="form-control" name="product_sub_title" placeholder="Masukan product subt title" rows="5">{{ @$content->product_sub_title }}</textarea>
                    <div class="help-block"></div>
                    <div id="product_sub_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <!--<div class="row"> tidak ada efek kemanapun
            <div class="col-md-6">
                <div class="form-group" id="product_menu_title">
                    <label class="control-label">Produk Title (Bagian Menu Header)</label>
                    <input type="text" name="product_menu_title" class="form-control" value="{{@$content->product_menu_title}}" placeholder="Masukan produk menu title text">
                    <div class="help-block"></div>
                    <div id="product_menu_title_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="product_menu_content">
                    <label class="control-label">Produk Konten (Bagian Menu Header)</label>
                    <textarea class="form-control" name="product_menu_content" placeholder="Masukan product menu content" rows="5">{{ @$content->product_menu_content }}</textarea>
                    <div class="help-block"></div>
                    <div id="product_menu_content_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-offset-3 col-md-9 text-right">
                <button type="button" class="btn btn-primary" onclick="saveProduct()">Simpan</button>
            </div>
        </div>
    </form>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveProduct(){
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
                            url: "{{ route('admin.pages.home.product.save') }}",
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
                                    @foreach(\App\Models\Pages::HOME_PRODUCT_VALIDATION as $key => $value)
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
