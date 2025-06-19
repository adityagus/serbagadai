<div class="row testimony_slider">
    <div class="col-md-12">
        <h5><b>Daftar Testimony</b></h5>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-3" id="title0">
                    <input type="text" class="form-control" name="title0" maxlength="30" placeholder="Nama Slider">
                    <div id="title0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-3" id="content0">
                    <textarea class="form-control" name="content0" placeholder="Konten Slider"></textarea>
                    <div id="content0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-2" id="role0">
                    <input type="text" class="form-control" name="role0" maxlength="30" placeholder="Jabatan Slider">
                    <div id="role0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-2" id="star0">
                    <input type="number" class="form-control" name="star0" min="0" placeholder="Bintang">
                    <div id="star0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" id="priority0">
                    <input type="number" class="form-control" name="priority0" min="1" placeholder="Priority">
                    <div id="priority0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-sm btn-success" type="button" onclick="saveTestimonySlider(0)"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
            <thead>
            <tr>
                <th style="text-align: center">No</th>
                <th style="text-align: center">Nama</th>
                <th style="text-align: center">Konten</th>
                <th style="text-align: center">Jabatan</th>
                <th style="text-align: center">Bintang</th>
                <th style="text-align: center">Priority</th>
                <th style="text-align: center;width: 100px;" >Aksi</th>
            </tr>
            </thead>
            <tbody id="listSlider">
            @foreach($content->testimony_sliders as $key => $slider)
                <tr id="tr_{{$key+1}}">
                    <td style="text-align: center">{{$key+1}}</td>
                    <td id="title{{$key+1}}">
                        <input type="text" name="title{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->title}}" placeholder="Judul Slider ke-{{$key+1}} (Max 20 Karakter)">
                        <div id="title{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td id="content{{$key+1}}">
                        <textarea class="form-control" name="content{{$key+1}}" placeholder="Konten Slider ke-{{$key+1}}" rows="8">{{@$slider->content}}</textarea>
                        <div id="content{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td id="role{{$key+1}}">
                        <input type="text" name="role{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->role}}" placeholder="Jabatan Slider ke-{{$key+1}} (Max 20 Karakter)">
                        <div id="role{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td id="star{{$key+1}}">
                        <input type="number" name="star{{$key+1}}" class="form-control" value="{{@$slider->star}}" placeholder="Bintang Slider ke-{{$key+1}}">
                        <div id="star{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td id="priority{{$key+1}}">
                        <input type="number" name="priority{{$key+1}}" class="form-control" value="{{@$slider->priority}}" placeholder="Prioritas Slider ke-{{$key+1}}">
                        <div id="priority{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td style="text-align: center">
                        <button class="btn btn-sm btn-primary" onclick="saveTestimonySlider({{$key+1}})"><i class="fa fa-save"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTestimonySlider({{$key+1}})"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('customJs')
    <script type="text/javascript">
        function saveTestimonySlider(id) {
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            swal({
                title: "Yakin Simpan Data Slider?",
                text : "Data slider akan disimpan",
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
                    if(process) {
                        formData = new FormData();
                        formData.append('id',id);
                        formData.append('_token','{{csrf_token()}}');
                        formData.append('title'+id,$('.testimony_slider [name=title'+id+']').val());
                        formData.append('content'+id,$('.testimony_slider [name=content'+id+']').val());
                        formData.append('role'+id,$('.testimony_slider [name=role'+id+']').val());
                        formData.append('star'+id,$('.testimony_slider [name=star'+id+']').val());
                        formData.append('priority'+id,$('.testimony_slider [name=priority'+id+']').val());

                        $.ajax({
                            url: "{{ route('admin.pages.home.testimony.slider.save') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Simpan Slider!',
                                        text: 'Slider berhasil di simpan',
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Simpan Slider',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = [
                                        'title'+id,
                                        'priority'+id,
                                        'content'+id,
                                        'role'+id,
                                        'star'+id
                                    ];
                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in data.error){
                                            $('.testimony_slider #'+error_arr[i]).addClass('has-error');
                                            $('.testimony_slider #'+error_arr[i]+'_error').html(data.error[error_arr[i]]);
                                        }
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '1500'
                                });
                            }
                        });
                    }
                });
        }

        function deleteTestimonySlider(id) {
            swal({
                title: "Yakin Hapus Data Slider?",
                text : "Data slider akan dihapus permanen",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Hapus!',
                        closeModal: false,
                    },
                },
            })
            .then((process) => {
                if(process){
                    $.ajax({
                        url: "{{ route('admin.pages.home.testimony.slider.delete') }}",
                        type: "POST",
                        data: {
                            '_token': '{{csrf_token()}}',
                            'id':id,
                        },
                        success: function(data) {
                            swal({
                                title: 'Berhasil Hapus Slider!',
                                text: 'Slider berhasil di hapus',
                                icon: 'success',
                                timer: '1500'
                            }).then((done)=>{
                                location.reload();
                            });
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
                    swal('Data Slider tidak jadi dihapus');
                }
            });
        }
    </script>
@endpush