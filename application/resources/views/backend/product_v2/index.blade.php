@extends('backend.layouts.template')

@section('pageTitle', 'Kelola Product V2 (CNAF Style Slider)')

@push('customCss')
<style>
    .card-product-box {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        padding: 20px 24px;
    }
    .card-product-header {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 14px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-product-header h4 {
        margin: 0;
        font-weight: 700;
        color: #1e293b;
        font-size: 16px;
    }
    .product-icon-preview {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        object-fit: contain;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 4px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }
    .product-icon-placeholder {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: #f1f5f9;
        font-size: 22px;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }
    .form-section-add {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 18px 20px 10px;
        margin-bottom: 25px;
    }
</style>
@endpush

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- PAGE HEADER / BREADCRUMB -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Beranda</a> <i class="fa fa-circle"></i></li>
                <li><span>Product V2 (Cards Slider)</span></li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <a href="{{ url('/#layanan') }}" target="_blank" class="btn btn-sm btn-default" style="margin-right: 5px;">
                        <i class="fa fa-external-link"></i> Pratinjau di Beranda
                    </a>
                    <a href="{{ route('admin.product') }}" class="btn btn-sm btn-outline green">
                        <i class="fa fa-list"></i> Produk Lama (V1)
                    </a>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col-md-12">

                <!-- SECTION 1: HEADER SECTION PRODUK -->
                <div class="card-product-box">
                    <div class="card-product-header">
                        <h4><i class="fa fa-header" style="color: #0284c7; margin-right: 8px;"></i> Header Section Produk V2</h4>
                        <span class="text-muted" style="font-size: 13px;">Teks judul dan deskripsi yang tampil di bagian atas slider kartu produk</span>
                    </div>

                    <form id="form-header-product" onsubmit="saveHeader(event)">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group" id="group_product_title">
                                    <label class="control-label" style="font-weight: 600;">Judul Section</label>
                                    <input type="text"
                                           name="product_title"
                                           class="form-control input-lg"
                                           style="font-size: 15px;"
                                           value="{{ @$content->product_title ?: 'Produk & Simulasi CIMB Niaga Finance' }}"
                                           placeholder="Contoh: Produk & Simulasi CIMB Niaga Finance / Produk Serba Gadai">
                                    <div class="help-block help-block-error" id="product_title_error"></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group" id="group_product_sub_title">
                                    <label class="control-label" style="font-weight: 600;">Subjudul / Deskripsi Singkat</label>
                                    <textarea name="product_sub_title"
                                              class="form-control"
                                              rows="2"
                                              placeholder="Masukan subjudul deskripsi section produk">{{ @$content->product_sub_title ?: 'Cari tahu angsuran dan pilihan tenor sesuai dengan kemampuan kamu disini. Simulasikan pilihan pembiayaan kamu sekarang' }}</textarea>
                                    <div class="help-block help-block-error" id="product_sub_title_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary" id="btn-save-header">
                                <i class="fa fa-save"></i> Simpan Header Section
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SECTION 2: DAFTAR KARTU SLIDER PRODUK V2 -->
                <div class="card-product-box">
                    <div class="card-product-header">
                        <h4><i class="fa fa-th-large" style="color: #e11d48; margin-right: 8px;"></i> Daftar Kartu Slider Produk (CNAF Style)</h4>
                        <span class="text-muted" style="font-size: 13px;">Icon / gambar, nama produk, link tujuan, dan urutan kartu di beranda</span>
                    </div>

                    <!-- FORM TAMBAH ITEM BARU -->
                    <div class="form-section-add">
                        <h5 style="margin-top: 0; margin-bottom: 12px; font-weight: 700; color: #334155;">
                            <i class="fa fa-plus-circle" style="color: #10b981;"></i> Tambah Kartu Produk Baru
                        </h5>
                        <form id="form-item-0" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="0">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="item_image_0">
                                        <label style="font-size: 12px; font-weight: 600;">Upload Icon / Foto Produk</label>
                                        <input type="file" name="image" class="form-control input-sm" accept="image/*">
                                        <span class="help-block" style="font-size: 11px; margin-bottom: 0;">Format: PNG, SVG, JPG, WebP (Maks. 2MB)</span>
                                        <div class="help-block help-block-error" id="image_error_0"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="item_title_0">
                                        <label style="font-size: 12px; font-weight: 600;">Judul Produk <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control input-sm" placeholder="Contoh: Pembiayaan Mobil Baru / Gadai Smartphone" required>
                                        <div class="help-block help-block-error" id="title_error_0"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="item_link_0">
                                        <label style="font-size: 12px; font-weight: 600;">Link / Tautan Halaman</label>
                                        <input type="text" name="link" class="form-control input-sm" placeholder="Contoh: /simulasi?jenis=smartphone">
                                        <div class="help-block help-block-error" id="link_error_0"></div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group" id="item_priority_0">
                                        <label style="font-size: 12px; font-weight: 600;">Urutan</label>
                                        <input type="number" name="priority" class="form-control input-sm" value="{{ (!empty($content->product_sliders) ? count((array)$content->product_sliders) : 0) + 1 }}" min="1">
                                        <div class="help-block help-block-error" id="priority_error_0"></div>
                                    </div>
                                </div>
                                <div class="col-md-1" style="padding-top: 22px;">
                                    <button type="button" class="btn btn-sm btn-success btn-block" onclick="saveItem(0)">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DAFTAR ITEM SLIDER PRODUK -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th style="text-align: center; width: 45px; vertical-align: middle;">No</th>
                                    <th style="text-align: center; width: 140px; vertical-align: middle;">Icon / Gambar</th>
                                    <th style="vertical-align: middle;">Judul Produk</th>
                                    <th style="vertical-align: middle;">Link / Tautan</th>
                                    <th style="text-align: center; width: 90px; vertical-align: middle;">Urutan</th>
                                    <th style="text-align: center; width: 130px; vertical-align: middle;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sliders = !empty($content->product_sliders) ? (array)$content->product_sliders : [];
                                @endphp

                                @if(!empty($sliders) && count($sliders) > 0)
                                    @foreach($sliders as $idx => $slider)
                                        @php $idNum = $idx + 1; @endphp
                                        <tr id="row_prod_{{ $idNum }}">
                                            <form id="form-item-{{ $idNum }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $idNum }}">
                                                
                                                <td style="text-align: center; vertical-align: middle; font-weight: 600;">
                                                    {{ $idNum }}
                                                </td>

                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div style="margin-bottom: 8px;">
                                                        @if(!empty($slider->image))
                                                            <img src="{{ url('storage/' . $slider->image) }}" alt="{{ @$slider->title }}" class="product-icon-preview">
                                                        @else
                                                            <div class="product-icon-placeholder">
                                                                <i class="fa fa-cubes"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <input type="file" name="image" class="form-control input-sm" accept="image/*" style="font-size: 11px;">
                                                    <div class="help-block help-block-error" id="image_error_{{ $idNum }}"></div>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="text"
                                                           name="title"
                                                           class="form-control"
                                                           value="{{ @$slider->title }}"
                                                           placeholder="Judul Produk"
                                                           required>
                                                    <div class="help-block help-block-error" id="title_error_{{ $idNum }}"></div>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="text"
                                                           name="link"
                                                           class="form-control"
                                                           value="{{ @$slider->link }}"
                                                           placeholder="/simulasi">
                                                    <div class="help-block help-block-error" id="link_error_{{ $idNum }}"></div>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="number"
                                                           name="priority"
                                                           class="form-control text-center"
                                                           value="{{ @$slider->priority ?? $idNum }}"
                                                           min="1">
                                                    <div class="help-block help-block-error" id="priority_error_{{ $idNum }}"></div>
                                                </td>

                                                <td style="text-align: center; vertical-align: middle;">
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary"
                                                            onclick="saveItem({{ $idNum }})"
                                                            title="Simpan Perubahan">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="deleteItem({{ $idNum }})"
                                                            title="Hapus Kartu">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" style="padding: 35px 20px; text-align: center; color: #64748b; background: #fafafa;">
                                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; display: block; margin-bottom: 8px;"></i>
                                            <strong>Belum ada item kartu produk di CMS.</strong><br>
                                            <span style="font-size: 12px;">Di frontend saat ini tampil 5 item default bawaan sistem (Smartphone, Laptop, Kamera, Smart TV, Konsol). Gunakan form di atas untuk menambahkan kartu baru.</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('customJs')
<script type="text/javascript">
    // Simpan Header Section
    function saveHeader(e) {
        e.preventDefault();
        const form = document.getElementById('form-header-product');
        const btn = document.getElementById('btn-save-header');
        
        $('.help-block-error').html('');
        $('.form-group').removeClass('has-error');

        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

        $.ajax({
            url: "{{ route('admin.product_v2.header.save') }}",
            type: "POST",
            data: new FormData(form),
            processData: false,
            contentType: false,
            success: function(res) {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-save"></i> Simpan Header Section';
                if (res.status) {
                    swal({
                        title: 'Berhasil!',
                        text: res.message,
                        icon: 'success',
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    swal('Gagal Simpan', res.message || 'Terjadi kesalahan', 'error');
                    if (res.error) {
                        for (let k in res.error) {
                            $('#' + k + '_error').html(res.error[k][0]);
                            $('#group_' + k).addClass('has-error');
                        }
                    }
                }
            },
            error: function() {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-save"></i> Simpan Header Section';
                swal('Error', 'Gagal memproses permintaan ke server', 'error');
            }
        });
    }

    // Simpan Item Card Slider (Tambah / Edit)
    function saveItem(id) {
        const form = document.getElementById('form-item-' + id);
        if (!form) return;

        $('.help-block-error').html('');
        $('.form-group').removeClass('has-error');

        swal({
            title: id === 0 ? "Tambah Kartu Produk?" : "Simpan Perubahan?",
            text: "Data kartu produk akan disimpan ke slider beranda",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Ya, Simpan",
                    closeModal: false
                }
            }
        }).then((confirmed) => {
            if (!confirmed) return;

            $.ajax({
                url: "{{ route('admin.product_v2.slider.save') }}",
                type: "POST",
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status) {
                        swal({
                            title: 'Berhasil!',
                            text: res.message,
                            icon: 'success',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swal('Gagal Simpan', res.message || 'Periksa kembali data item', 'error');
                        if (res.error) {
                            if (res.error.title) $('#title_error_' + id).html(res.error.title[0]);
                            if (res.error.image) $('#image_error_' + id).html(res.error.image[0]);
                            if (res.error.priority) $('#priority_error_' + id).html(res.error.priority[0]);
                            if (res.error.link) $('#link_error_' + id).html(res.error.link[0]);
                        }
                    }
                },
                error: function() {
                    swal('Error', 'Gagal memproses penyimpanan item', 'error');
                }
            });
        });
    }

    // Hapus Item Card Slider
    function deleteItem(id) {
        swal({
            title: "Yakin Hapus Kartu Ini?",
            text: "Kartu produk akan dihapus dari slider beranda",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Ya, Hapus!",
                    closeModal: false
                }
            },
            dangerMode: true,
        }).then((confirmed) => {
            if (!confirmed) return;

            $.ajax({
                url: "{{ route('admin.product_v2.slider.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(res) {
                    if (res.status) {
                        swal({
                            title: 'Berhasil Dihapus!',
                            text: res.message,
                            icon: 'success',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swal('Gagal Hapus', res.message || 'Gagal menghapus item', 'error');
                    }
                },
                error: function() {
                    swal('Error', 'Gagal memproses penghapusan item', 'error');
                }
            });
        });
    }
</script>
@endpush

