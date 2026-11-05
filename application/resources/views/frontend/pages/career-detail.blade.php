@extends('frontend.layouts.template')

@section('pageTitle', $career->title . ' - Karir')

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">LOWONGAN KERJA</span>
        <h1 class="subhero-title">{{ $career->title }}</h1>
        <p class="subhero-subtitle">
            Level: <strong>{{ \App\Util\Constant::CAREER_CATEGORY_LIST[$career->category] ?? $career->category }}</strong>
            &nbsp;•&nbsp; Tipe: <strong>{{ \App\Util\Constant::CAREER_TYPES_LIST[$career->types] ?? $career->types }}</strong>
            @if(!empty($location))
                &nbsp;•&nbsp; 📍 <strong>{{ $location }}</strong>
            @endif
        </p>
    </div>
</section>

<!-- Career Detail & Application Form -->
<section class="page-content-section">
    <div class="container">
        <div class="about-detail-grid">
            <div>
                <div class="service-detail-card" style="padding: 36px; margin-bottom: 32px;">
                    <span class="gold-text-badge">PERSYARATAN KANDIDAT</span>
                    <h3 style="font-family: var(--font-heading); font-size: 24px; margin-bottom: 16px;">Kualifikasi</h3>
                    <div class="cms-rich-content">
                        {!! $career->qualification !!}
                    </div>

                    <div class="divider-line"></div>

                    <span class="gold-text-badge">DESKRIPSI PEKERJAAN</span>
                    <h3 style="font-family: var(--font-heading); font-size: 24px; margin-bottom: 16px;">Rincian Tugas</h3>
                    <div class="cms-rich-content">
                        {!! $career->job_desk !!}
                    </div>
                </div>
            </div>

            <!-- Form Lamaran -->
            <div class="contact-form-wrapper">
                <form id="form-submission" class="contact-form" method="post" enctype="multipart/form-data" action="javascript:;">
                    {{ csrf_field() }}
                    <input type="hidden" name="career_id" value="{{ $career->id }}">

                    <h3>Lamar Posisi Ini</h3>
                    <p>Lengkapi formulir di bawah ini untuk melamar posisi <strong>{{ $career->title }}</strong>.</p>

                    <div class="input-group" id="name" style="margin-bottom: 16px;">
                        <label class="input-label">Nama Lengkap</label>
                        <input type="text" name="name" class="input-select" placeholder="Tulis Nama Lengkap">
                        <div id="name_error" class="help-block help-block-error"></div>
                    </div>

                    <div class="input-group" id="email" style="margin-bottom: 16px;">
                        <label class="input-label">Email</label>
                        <input type="email" name="email" class="input-select" placeholder="Tulis Email Aktif">
                        <div id="email_error" class="help-block help-block-error"></div>
                    </div>

                    <div class="input-group" id="phone" style="margin-bottom: 16px;">
                        <label class="input-label">No Handphone / WhatsApp</label>
                        <input type="text" name="phone" class="input-select" placeholder="Tulis No Handphone">
                        <div id="phone_error" class="help-block help-block-error"></div>
                    </div>

                    <div class="input-group" id="cover_letter" style="margin-bottom: 16px;">
                        <label class="input-label">Cover Letter</label>
                        <textarea name="cover_letter" class="input-select textarea-input" rows="4" placeholder="Tulis cover letter singkat..."></textarea>
                        <div id="cover_letter_error" class="help-block help-block-error"></div>
                    </div>

                    <div class="input-group" id="cv" style="margin-bottom: 16px;">
                        <label class="input-label">Upload CV / Resume (Maks 2MB, PDF/JPG/PNG)</label>
                        <input class="input-select" name="cv" type="file">
                        <div id="cv_error" class="help-block help-block-error"></div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 10px; margin: 20px 0;">
                        <input type="checkbox" name="agreement" value="true" id="flexCheckDefault" style="margin-top: 4px;">
                        <label for="flexCheckDefault" style="font-size: 13px; color: var(--text-muted);">
                            Dengan menggunakan formulir ini, Anda menyetujui penyimpanan dan pengelolaan data Anda oleh situs web ini.
                        </label>
                    </div>

                    <button type="button" class="btn btn-primary btn-block" onclick="save()">Kirim Lamaran</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('customJs')
<script type="text/javascript">
    function save() {
        swal({
            title: "Yakin Simpan Data?",
            text: "Data lamaran akan dikirimkan",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: {
                    text: 'Simpan!',
                    closeModal: false,
                },
            },
        }).then((process) => {
            if (process) {
                if (!$('[name=agreement]').is(':checked')) {
                    swal({
                        title: 'Persetujuan Belum Di Checklist',
                        text: 'Mohon lengkapi data anda',
                        icon: 'error',
                        timer: '1500'
                    });
                    return;
                }

                $('.help-block-error').html('');

                $.ajax({
                    url: "{{ route('career.save') }}",
                    type: "POST",
                    data: new FormData($("#form-submission")[0]),
                    processData: false,
                    contentType: false,
                    async: false,
                    success: function(response) {
                        if (response.status) {
                            swal({
                                title: 'Berhasil Simpan Data',
                                text: response.message,
                                icon: 'success',
                                timer: '1500'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'Gagal Simpan Data',
                                text: response.message,
                                icon: 'error',
                                timer: '1500'
                            });

                            var error_arr = [];
                            @foreach(\App\Models\CareerSubmission::FORM_VALIDATION as $key => $value)
                            error_arr.push('{{ $key }}');
                            @endforeach

                            for (var i = 0; i < error_arr.length; i++) {
                                if (response.error && error_arr[i] in response.error) {
                                    $('#' + error_arr[i] + '_error').html(response.error[error_arr[i]]);
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
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
</script>
@endpush
