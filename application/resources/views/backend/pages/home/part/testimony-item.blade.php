<div class="row testimony_slider">
    <div class="col-md-12">
        <h5><b>Daftar Testimony ("Apa Kata Mereka")</b></h5>
        <div class="row" style="background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
            <div class="form-group">
                <div class="col-sm-2" id="image0">
                    <label style="font-size: 12px; font-weight: 600;">Foto Avatar</label>
                    <input type="file" class="form-control" name="image0" accept="image/*">
                    <div id="image0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-2" id="title0">
                    <label style="font-size: 12px; font-weight: 600;">Nama</label>
                    <input type="text" class="form-control" name="title0" maxlength="50" placeholder="Nama Nasabah">
                    <div id="title0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-2" id="role0">
                    <label style="font-size: 12px; font-weight: 600;">Jabatan / Pekerjaan</label>
                    <input type="text" class="form-control" name="role0" maxlength="50" placeholder="Contoh: Dosen / Wirausaha">
                    <div id="role0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-3" id="content0">
                    <label style="font-size: 12px; font-weight: 600;">Isi Testimoni</label>
                    <textarea class="form-control" name="content0" placeholder="Kutipan testimoni nasabah..." rows="2"></textarea>
                    <div id="content0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" id="star0">
                    <label style="font-size: 12px; font-weight: 600;">Bintang</label>
                    <input type="number" class="form-control" name="star0" min="1" max="5" value="5" placeholder="5">
                    <div id="star0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" id="priority0">
                    <label style="font-size: 12px; font-weight: 600;">Urutan</label>
                    <input type="number" class="form-control" name="priority0" min="1" value="1" placeholder="1">
                    <div id="priority0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" style="padding-top: 24px;">
                    <button class="btn btn-sm btn-success" type="button" onclick="saveTestimonySlider(0)" style="width: 100%;"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 10px">
            <thead>
            <tr>
                <th style="text-align: center; width: 40px;">No</th>
                <th style="text-align: center; width: 140px;">Foto</th>
                <th style="text-align: center; width: 160px;">Nama</th>
                <th style="text-align: center; width: 160px;">Jabatan / Status</th>
                <th style="text-align: center;">Isi Testimoni</th>
                <th style="text-align: center; width: 70px;">Bintang</th>
                <th style="text-align: center; width: 70px;">Urutan</th>
                <th style="text-align: center; width: 100px;">Aksi</th>
            </tr>
            </thead>
            <tbody id="listSlider">
            @if(!empty($content->testimony_sliders))
                @foreach($content->testimony_sliders as $key => $slider)
                    <tr id="tr_{{$key+1}}">
                        <td style="text-align: center; vertical-align: middle;">{{$key+1}}</td>
                        <td id="image{{$key+1}}" style="text-align: center; vertical-align: middle;">
                            @if(!empty($slider->image))
                                <div style="margin-bottom: 6px;">
                                    <img src="{{ url('storage/' . $slider->image) }}" alt="{{ @$slider->title }}" width="50" height="50" style="border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                                </div>
                            @else
                                <div style="margin-bottom: 6px;">
                                    <span style="display: inline-block; width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; line-height: 50px; font-size: 20px;">👤</span>
                                </div>
                            @endif
                            <input type="file" name="image{{$key+1}}" class="form-control" accept="image/*" style="font-size: 11px;">
                            <div id="image{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="title{{$key+1}}" style="vertical-align: middle;">
                            <input type="text" name="title{{$key+1}}" maxlength="50" class="form-control" value="{{@$slider->title}}" placeholder="Nama Nasabah">
                            <div id="title{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="role{{$key+1}}" style="vertical-align: middle;">
                            <input type="text" name="role{{$key+1}}" maxlength="50" class="form-control" value="{{@$slider->role}}" placeholder="Jabatan / Status">
                            <div id="role{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="content{{$key+1}}" style="vertical-align: middle;">
                            <textarea class="form-control" name="content{{$key+1}}" placeholder="Kutipan Testimoni..." rows="3">{{@$slider->content}}</textarea>
                            <div id="content{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="star{{$key+1}}" style="vertical-align: middle;">
                            <input type="number" name="star{{$key+1}}" min="1" max="5" class="form-control" value="{{@$slider->star ?? 5}}">
                            <div id="star{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="priority{{$key+1}}" style="vertical-align: middle;">
                            <input type="number" name="priority{{$key+1}}" class="form-control" value="{{@$slider->priority ?? ($key+1)}}">
                            <div id="priority{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button class="btn btn-sm btn-primary" onclick="saveTestimonySlider({{$key+1}})" title="Simpan"><i class="fa fa-save"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteTestimonySlider({{$key+1}})" title="Hapus"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
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
                title: "Yakin Simpan Data Testimoni?",
                text : "Data testimoni akan disimpan",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {
                        text: 'Simpan!',
                        closeModal: false,
                    },
                },
            })
                .then((process) => {
                    if(process) {
                        var formData = new FormData();
                        formData.append('id', id);
                        formData.append('_token', '{{csrf_token()}}');
                        formData.append('title' + id, $('.testimony_slider [name=title' + id + ']').val());
                        formData.append('content' + id, $('.testimony_slider [name=content' + id + ']').val());
                        formData.append('role' + id, $('.testimony_slider [name=role' + id + ']').val());
                        formData.append('star' + id, $('.testimony_slider [name=star' + id + ']').val());
                        formData.append('priority' + id, $('.testimony_slider [name=priority' + id + ']').val());

                        var fileInput = $('.testimony_slider [name=image' + id + ']');
                        if (fileInput.length > 0 && fileInput[0].files.length > 0) {
                            formData.append('image' + id, fileInput[0].files[0]);
                        }

                        $.ajax({
                            url: "{{ route('admin.pages.home.testimony.slider.save') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            async: false,
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Simpan Testimoni!',
                                        text: 'Data testimoni berhasil disimpan',
                                        icon: 'success',
                                        timer: '2000'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Simpan Testimoni',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = [
                                        'title' + id,
                                        'priority' + id,
                                        'content' + id,
                                        'role' + id,
                                        'star' + id,
                                        'image' + id
                                    ];
                                    for(var i=0; i < error_arr.length; i++){
                                        if(data.error && error_arr[i] in data.error){
                                            $('.testimony_slider #' + error_arr[i]).addClass('has-error');
                                            $('.testimony_slider #' + error_arr[i] + '_error').html(data.error[error_arr[i]]);
                                        }
                                    }
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '3000'
                                });
                            }
                        });
                    }
                });
        }

        function deleteTestimonySlider(id) {
            swal({
                title: "Yakin Hapus Testimoni?",
                text : "Data testimoni akan dihapus",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {
                        text: 'Hapus!',
                        closeModal: false,
                    },
                },
            })
                .then((process) => {
                    if(process) {
                        $.ajax({
                            url: "{{ route('admin.pages.home.testimony.slider.delete') }}",
                            type: "POST",
                            data: {
                                '_token': '{{csrf_token()}}',
                                'id': id,
                            },
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Hapus Testimoni!',
                                        text: 'Data testimoni berhasil dihapus',
                                        icon: 'success',
                                        timer: '2000'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Hapus Testimoni',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '3000'
                                });
                            }
                        });
                    }
                });
        }
    </script>
@endpush
