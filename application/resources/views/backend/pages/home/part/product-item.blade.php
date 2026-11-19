<div class="row product_slider" style="margin-top: 20px;">
    <div class="col-md-12">
        <hr style="margin-top: 5px; margin-bottom: 25px;"/>
        <h4><b>Daftar Item Produk & Simulasi (Slider Cards)</b></h4>
        <p class="text-muted" style="margin-bottom: 15px; font-size: 13px;">Kelola kartu slider produk seperti tampilan CNAF. Icon/foto dan judul produk akan muncul di slider beranda.</p>
        
        <div class="row" style="background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
            <div class="form-group">
                <div class="col-sm-3" id="image0">
                    <label style="font-size: 12px; font-weight: 600;">Icon / Gambar Produk</label>
                    <input type="file" class="form-control" name="image0" accept="image/*">
                    <div id="image0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-4" id="title0">
                    <label style="font-size: 12px; font-weight: 600;">Judul Produk</label>
                    <input type="text" class="form-control" name="title0" maxlength="80" placeholder="Contoh: Pembiayaan Mobil Baru / Gadai Smartphone">
                    <div id="title0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-3" id="link0">
                    <label style="font-size: 12px; font-weight: 600;">Link / Tautan</label>
                    <input type="text" class="form-control" name="link0" placeholder="Contoh: /simulasi atau link URL">
                    <div id="link0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" id="priority0">
                    <label style="font-size: 12px; font-weight: 600;">Urutan</label>
                    <input type="number" class="form-control" name="priority0" min="1" value="1" placeholder="1">
                    <div id="priority0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" style="padding-top: 24px;">
                    <button class="btn btn-sm btn-success" type="button" onclick="saveProductSlider(0)" style="width: 100%;"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 10px">
            <thead>
            <tr>
                <th style="text-align: center; width: 40px;">No</th>
                <th style="text-align: center; width: 140px;">Icon / Gambar</th>
                <th style="text-align: center; width: 260px;">Judul Produk</th>
                <th style="text-align: center;">Link / Tautan</th>
                <th style="text-align: center; width: 80px;">Urutan</th>
                <th style="text-align: center; width: 100px;">Aksi</th>
            </tr>
            </thead>
            <tbody id="listProductSlider">
            @if(!empty($content->product_sliders))
                @foreach($content->product_sliders as $key => $slider)
                    <tr id="tr_prod_{{$key+1}}">
                        <td style="text-align: center; vertical-align: middle;">{{$key+1}}</td>
                        <td id="image{{$key+1}}" style="text-align: center; vertical-align: middle;">
                            @if(!empty($slider->image))
                                <div style="margin-bottom: 6px;">
                                    <img src="{{ url('storage/' . $slider->image) }}" alt="{{ @$slider->title }}" width="50" height="50" style="border-radius: 12px; object-fit: contain; background: #fff; border: 1px solid #e2e8f0; padding: 4px;">
                                </div>
                            @else
                                <div style="margin-bottom: 6px;">
                                    <span style="display: inline-block; width: 50px; height: 50px; border-radius: 12px; background: #fee2e2; line-height: 50px; font-size: 20px; color: #dc2626;">📦</span>
                                </div>
                            @endif
                            <input type="file" name="image{{$key+1}}" class="form-control" accept="image/*" style="font-size: 11px;">
                            <div id="image{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="title{{$key+1}}" style="vertical-align: middle;">
                            <input type="text" name="title{{$key+1}}" maxlength="80" class="form-control" value="{{@$slider->title}}" placeholder="Judul Produk">
                            <div id="title{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="link{{$key+1}}" style="vertical-align: middle;">
                            <input type="text" name="link{{$key+1}}" class="form-control" value="{{@$slider->link}}" placeholder="/simulasi">
                            <div id="link{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td id="priority{{$key+1}}" style="vertical-align: middle;">
                            <input type="number" name="priority{{$key+1}}" class="form-control" value="{{@$slider->priority ?? ($key+1)}}">
                            <div id="priority{{$key+1}}_error" class="help-block help-block-error"> </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <button class="btn btn-sm btn-primary" onclick="saveProductSlider({{$key+1}})" title="Simpan"><i class="fa fa-save"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProductSlider({{$key+1}})" title="Hapus"><i class="fa fa-remove"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center text-muted" style="padding: 20px;">Belum ada item produk di CMS. Tampilan frontend akan menggunakan item produk default (Smartphone, Laptop, Kamera, TV, Konsol).</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

@push('customJs')
    <script type="text/javascript">
        function saveProductSlider(id) {
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            swal({
                title: "Yakin Simpan Data Produk?",
                text : "Data slider produk akan disimpan",
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
                        formData.append('title' + id, $('.product_slider [name=title' + id + ']').val());
                        formData.append('link' + id, $('.product_slider [name=link' + id + ']').val());
                        formData.append('priority' + id, $('.product_slider [name=priority' + id + ']').val());

                        var fileInput = $('.product_slider [name=image' + id + ']');
                        if (fileInput.length > 0 && fileInput[0].files.length > 0) {
                            formData.append('image' + id, fileInput[0].files[0]);
                        }

                        $.ajax({
                            url: "{{ route('admin.pages.home.product.slider.save') }}",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            async: false,
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Simpan Produk!',
                                        text: data.message,
                                        icon: 'success',
                                        timer: '2000'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Simpan Produk',
                                        text: data.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = [
                                        'title' + id,
                                        'priority' + id,
                                        'image' + id
                                    ];
                                    for(var i=0; i < error_arr.length; i++){
                                        if(data.error && error_arr[i] in data.error){
                                            $('.product_slider #' + error_arr[i]).addClass('has-error');
                                            $('.product_slider #' + error_arr[i] + '_error').html(data.error[error_arr[i]]);
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

        function deleteProductSlider(id) {
            swal({
                title: "Yakin Hapus Produk?",
                text : "Item slider produk akan dihapus",
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
                            url: "{{ route('admin.pages.home.product.slider.delete') }}",
                            type: "POST",
                            data: {
                                '_token': '{{csrf_token()}}',
                                'id': id,
                            },
                            success: function (data) {
                                if (data.status) {
                                    swal({
                                        title: 'Berhasil Hapus Produk!',
                                        text: data.message,
                                        icon: 'success',
                                        timer: '2000'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal({
                                        title: 'Gagal Hapus Produk',
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

