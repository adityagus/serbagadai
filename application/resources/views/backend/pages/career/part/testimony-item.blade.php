<div class="col-md-12">
    <br/>
    <div class="row testimony_item">
        <div class="col-md-12">
            <h5><b>Daftar Testimony</b></h5>
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-3" id="name0">
                        <input type="text" class="form-control" name="name0" maxlength="30" placeholder="Name Testimony">
                        <div id="name0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="role0">
                        <input type="text" class="form-control" name="role0" maxlength="30" placeholder="Jabatan Testimony">
                        <div id="role0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="quote0">
                        <input type="text" class="form-control" name="quote0" maxlength="30" placeholder="Quote Testimony">
                        <div id="quote0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="description0">
                        <textarea class="form-control" name="description0" placeholder="Deskripsi Testimony"></textarea>
                        <div id="description0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-3" id="image0">
                        <input type="file" class="form-control" name="image0" placeholder="Gambar Testimony">
                        <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 100 x 100 px</small></div>
                        <div id="image0_error" class="help-block help-block-error"> </div>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-sm btn-success" type="button" onclick="saveTestimony(0)"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
                <thead>
                <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Jabatan</th>
                    <th style="text-align: center">Quote</th>
                    <th style="text-align: center">Deskripsi</th>
                    <th style="text-align: center">Gambar</th>
                    <th style="text-align: center;width: 100px;" >Aksi</th>
                </tr>
                </thead>
                <tbody id="listSlider">
                @foreach($content->testimony_item as $key => $slider)
                    <tr id="tr_{{$key+1}}">
                        <td style="text-align: center">{{$key+1}}</td>
                        <td id="title{{$key+1}}">
                            <input type="text" name="name{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->name}}" placeholder="Nama Testimony ke-{{$key+1}} (Max 20 Karakter)">
                            <div id="name{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="role{{$key+1}}">
                            <input type="text" name="role{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->role}}" placeholder="Role Testimony ke-{{$key+1}} (Max 20 Karakter)">
                            <div id="role{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="quote{{$key+1}}">
                            <input type="text" name="quote{{$key+1}}" maxlength="30" class="form-control" value="{{@$slider->quote}}" placeholder="Quote Testimony ke-{{$key+1}} (Max 20 Karakter)">
                            <div id="quote{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="description{{$key+1}}">
                            <textarea class="form-control" name="description{{$key+1}}" placeholder="Deskripsi Testimony ke-{{$key+1}}" rows="8">{{@$slider->description}}</textarea>
                            <div id="description{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="image{{$key+1}}">
                            <input type="file" name="image{{$key+1}}" onchange="setImage({{$key+1}})" class="form-control">
                            <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 80 x 80 px</small></div>
                            <div id="image{{$key+1}}_error" class="help-block help-block-error"> </div>
                            <br>
                            <a href="{{url('storage/'.@$slider->image)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$slider->image)}}" width="100" height="100"></a>
                        </td>
                        <td style="text-align: center">
                            <button class="btn btn-sm btn-primary" onclick="saveTestimony({{$key+1}})"><i class="fa fa-save"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteTestimony({{$key+1}})"><i class="fa fa-remove"></i></button>
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
        function saveTestimony(id) {
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

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
                    if(process) {
                        formData = new FormData();
                        formData.append('id',id);
                        formData.append('_token','{{csrf_token()}}');
                        formData.append('name'+id,$('.testimony_item [name=name'+id+']').val());
                        formData.append('description'+id,$('.testimony_item [name=description'+id+']').val());
                        formData.append('role'+id,$('.testimony_item [name=role'+id+']').val());
                        formData.append('quote'+id,$('.testimony_item [name=quote'+id+']').val());
                        if($('.testimony_item [name=image'+id+']').val() != ''){
                            formData.append('image'+id,$('.testimony_item [name=image'+id+']')[0].files[0]);
                        }
                        $.ajax({
                            url: "{{ route('admin.pages.career.testimony.item.save') }}",
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
                                    var error_arr = ['name'+id,'description'+id,'role'+id,'quote'+id,'image'+id];
                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in data.error){
                                            $('.testimony_item #'+error_arr[i]).addClass('has-error');
                                            $('.testimony_item #'+error_arr[i]+'_error').html(data.error[error_arr[i]]);
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

        function deleteTestimony(id) {
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
                            url: "{{ route('admin.pages.career.testimony.item.delete') }}",
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
