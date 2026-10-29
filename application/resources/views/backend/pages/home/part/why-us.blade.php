<div class="col-md-12">
    <br/>
    <div class="row why_us">
        <div class="col-md-12">
            <h5><b>Daftar Why Us</b></h5>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-3" id="title0">
                        <input type="text" class="form-control" name="title0" maxlength="30" placeholder="Judul Why Us">
                        <div id="title0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="description0">
                        <textarea class="form-control" name="description0" placeholder="Deskripsi Why us"></textarea>
                        <div id="description0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="image0">
                        <input type="file" class="form-control" name="image0" placeholder="Gambar Why Us">
                        <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 600 x 500 px</small></div>
                        <div id="image0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-2" id="priority0">
                        <input type="number" class="form-control" name="priority0" min="1" placeholder="Priority">
                        <div id="priority0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-sm btn-success" type="button" onclick="saveWhyUsSlider(0)"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
                <thead>
                <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Judul</th>
                    <th style="text-align: center">Deskripsi</th>
                    <th style="text-align: center">Gambar</th>
                    <th style="text-align: center">Priority</th>
                    <th style="text-align: center;width: 100px;" >Aksi</th>
                </tr>
                </thead>
                <tbody id="listSlider">
                @foreach($content->why_us as $key => $slider)
                    <tr id="tr_{{$key+1}}">
                        <td style="text-align: center">{{$key+1}}</td>
                        <td id="title{{$key+1}}">
                            <input type="text" name="title{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->title}}" placeholder="Judul Slider ke-{{$key+1}} (Max 20 Karakter)">
                            <div id="title{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="description{{$key+1}}">
                            <textarea class="form-control" name="description{{$key+1}}" placeholder="Deskripsi Why us ke-{{$key+1}}" rows="8">{{@$slider->description}}</textarea>
                            <div id="description{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="image{{$key+1}}">
                            <input type="file" name="image{{$key+1}}" onchange="setImage({{$key+1}})" class="form-control">
                            <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 600 x 500 px</small></div>
                            <div id="image{{$key+1}}_error" class="help-block help-block-error"> </div>
                            <br>
                            <a href="{{url('storage/'.@$slider->image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$slider->image)}}" width="100" height="100"></a>
                        </td>
                        <td id="priority{{$key+1}}">
                            <input type="number" name="priority{{$key+1}}" class="form-control" value="{{@$slider->priority}}" placeholder="Prioritas Slider ke-{{$key+1}}">
                            <div id="priority{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td style="text-align: center">
                            <button class="btn btn-sm btn-primary" onclick="saveWhyUsSlider({{$key+1}})"><i class="fa fa-save"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteWhyUsSlider({{$key+1}})"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveWhyUsSlider(id) {
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
                        formData.append('title'+id,$('.why_us [name=title'+id+']').val());
                        formData.append('description'+id,$('.why_us [name=description'+id+']').val());
                        formData.append('priority'+id,$('.why_us [name=priority'+id+']').val());
                        if($('.why_us [name=image'+id+']').val() != ''){
                            formData.append('image'+id,$('.why_us [name=image'+id+']')[0].files[0]);
                        }
                        $.ajax({
                            url: "{{ route('admin.pages.home.why-us.save') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Simpan Data!',
                                        text: 'Data berhasil di simpan',
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = ['title'+id,'description'+id,'priority'+id,'image'+id];
                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in data.error){
                                            $('.why_us #'+error_arr[i]).addClass('has-error');
                                            $('.why_us #'+error_arr[i]+'_error').html(data.error[error_arr[i]]);
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

        function deleteWhyUsSlider(id) {
            swal({
                title: "Yakin Hapus Data?",
                text : "Data akan dihapus permanen",
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
                            url: "{{ route('admin.pages.home.why-us.delete') }}",
                            type: "POST",
                            data: {
                                '_token': '{{csrf_token()}}',
                                'id':id,
                            },
                            success: function(data) {
                                swal({
                                    title: 'Berhasil Hapus Data!',
                                    text: 'Data berhasil di hapus',
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
                        swal('Data tidak jadi dihapus');
                    }
                });
        }
    </script>
@endpush
