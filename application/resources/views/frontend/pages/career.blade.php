@extends('frontend.layouts.template')

@section('pageTitle', 'Karir & Lowongan')

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">KARIR</span>
        <h1 class="subhero-title">{{ !empty($page->general_title) ? $page->general_title : 'Tumbuh Bersama Gadai Mulia' }}</h1>
        <p class="subhero-subtitle">Mari bergabung dan kembangkan potensi terbaik Anda bersama salah satu perusahaan pergadaian swasta dengan pertumbuhan tercepat.</p>
    </div>
</section>

<!-- Career Info & Open Positions Section -->
<section class="page-content-section">
    <div class="container">
        <div class="about-detail-grid">
            <div>
                <h2 class="section-title-dark">Mengapa Berkarir di {{ @$CONF->title ?? 'Gadai Mulia' }}?</h2>
                <p class="section-text text-justify">Di {{ @$CONF->title ?? 'Gadai Mulia' }}, kami meyakini bahwa SDM adalah pilar kesuksesan terbesar perusahaan. Kami menyediakan lingkungan kerja yang kolaboratif, aman, transparan, dan berintegritas tinggi untuk mendukung setiap individu bertumbuh secara karier maupun pribadi.</p>
                
                <div class="benefit-list">
                    <div class="benefit-item">
                        <span class="b-icon-check">✓</span>
                        <span>Jenjang karir yang terarah & transparan</span>
                    </div>
                    <div class="benefit-item">
                        <span class="b-icon-check">✓</span>
                        <span>Pelatihan penaksiran profesional emas & gadget</span>
                    </div>
                    <div class="benefit-item">
                        <span class="b-icon-check">✓</span>
                        <span>Asuransi kesehatan & benefit menarik lainnya</span>
                    </div>
                </div>
            </div>

            <div class="culture-box">
                <div class="culture-card">
                    <h4>Budaya Kerja Kami:</h4>
                    <div class="culture-row">
                        <strong>INTEGRITAS</strong>
                        <p>Senantiasa bersikap jujur dan profesional terhadap nasabah dan perusahaan.</p>
                    </div>
                    <div class="culture-row">
                        <strong>INOVATIF</strong>
                        <p>Beradaptasi cepat terhadap tren pasar dan teknologi finansial.</p>
                    </div>
                    <div class="culture-row">
                        <strong>KOLABORATIF</strong>
                        <p>Saling mendukung satu sama lain untuk mencapai target bersama.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open Positions -->
        <div class="jobs-section">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 20px; margin-bottom: 28px;">
                <div>
                    <span class="section-badge">LOWONGAN KERJA</span>
                    <h2 class="section-title-dark" style="margin-bottom: 0;">Posisi Lowongan yang Tersedia</h2>
                </div>

                <!-- Filters -->
                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    <select class="input-select" style="width: auto; min-width: 190px;" onchange="loadMore(true)" name="category">
                        <option value="">Semua Level / Kategori</option>
                        @foreach(\App\Util\Constant::CAREER_CATEGORY_LIST as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <select class="input-select" style="width: auto; min-width: 180px;" onchange="loadMore(true)" name="types">
                        <option value="">Semua Tipe Pekerjaan</option>
                        @foreach(\App\Util\Constant::CAREER_TYPES_LIST as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <select class="input-select" style="width: auto; min-width: 180px;" onchange="loadMore(true)" name="location">
                        <option value="">Semua Lokasi</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Sample Job Card for JS Clone -->
            <div class="job-card career-sample" style="display: none;">
                <div class="job-header">
                    <div>
                        <h3 class="job-title career_title"></h3>
                        <span class="job-location">Level: <strong class="career_category"></strong> <span class="career_loc_wrap">• 📍 <span class="career_location"></span></span></span>
                    </div>
                    <span class="job-tag career_types"></span>
                </div>
                <div class="job-body">
                    <p class="job-desc career_desc"></p>
                    <a href="#" class="btn btn-primary btn-sm career_link">Lihat Detail & Lamar →</a>
                </div>
            </div>

            <!-- Empty State -->
            <div class="job-card career_empty" style="display: none; text-align: center; padding: 48px 24px;">
                <h3 class="job-title" style="margin-bottom: 8px;">Belum ada posisi lowongan yang sesuai filter</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Silakan kirimkan CV Anda melalui fitur Drop CV di bawah ini dan tim HRD kami akan menghubungi Anda saat posisi yang sesuai tersedia.</p>
                <button type="button" class="btn btn-primary btn-sm" onclick="openDropCvModal()">Drop Your CV</button>
            </div>

            <div class="jobs-list career_list"></div>

            <div style="display: flex; justify-content: center; margin-top: 36px;">
                <button type="button" class="btn btn-outline btn-load" onclick="loadMore(false)" style="display: none;">
                    Muat Lebih Banyak Lowongan
                </button>
            </div>
        </div>

        <!-- Drop CV Call to Action -->
        <div class="service-detail-card" style="margin-top: 72px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.14) 0%, var(--bg-secondary) 100%); border-color: rgba(245, 158, 11, 0.3); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
            <div style="max-width: 720px;">
                <span class="gold-text-badge">TALENT POOL</span>
                <h3 style="font-family: var(--font-heading); font-size: 24px; font-weight: 800; margin-bottom: 8px;">{{ !empty($page->general_drop_cv) ? $page->general_drop_cv : 'Belum menemukan posisi yang cocok? Kirimkan CV terbaik Anda kepada kami!' }}</h3>
                <p style="color: var(--text-muted); font-size: 14px; margin: 0;">Tim HR kami secara berkala meninjau CV yang masuk untuk penempatan cabang baru.</p>
            </div>
            <button type="button" class="btn btn-primary" onclick="openDropCvModal()">Drop Your CV →</button>
        </div>

        <!-- Employee Testimonials from CMS -->
        @if(!empty($page->testimony_item) && count($page->testimony_item) > 0)
        <div style="margin-top: 80px;">
            <div class="section-header-center">
                <span class="section-badge center">CERITA TIM KAMI</span>
                <h2 class="section-title-dark text-center">{{ !empty($page->general_testimony) ? $page->general_testimony : 'Apa Kata Mereka tentang Karir di Gadai Mulia?' }}</h2>
            </div>

            <div class="article-grid">
                @foreach($page->testimony_item as $testimony)
                    <div class="o-card" style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; align-items: center; gap: 16px;">
                            @if(!empty($testimony->image))
                                <img src="{{ url('storage/'.$testimony->image) }}" alt="{{ $testimony->name }}" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover;" onerror="this.style.display='none'">
                            @endif
                            <div>
                                <h4 style="font-family: var(--font-heading); font-size: 17px; font-weight: 700;">{{ $testimony->name }}</h4>
                                <span style="font-size: 13px; color: var(--primary); font-weight: 600;">{{ $testimony->role }}</span>
                            </div>
                        </div>
                        @if(!empty($testimony->quote))
                            <strong style="font-size: 15px; color: var(--text-main);">"{{ $testimony->quote }}"</strong>
                        @endif
                        <p style="font-size: 14px; color: var(--text-muted); margin: 0;">{{ $testimony->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Drop CV Modal -->
<div class="gm-modal-backdrop" id="dropCvModal">
    <div class="gm-modal-dialog">
        <div class="gm-modal-header">
            <h3 class="gm-modal-title">Drop CV / Lamaran Umum</h3>
            <button type="button" class="gm-modal-close" onclick="closeDropCvModal()">✕</button>
        </div>
        <form id="form-submission" method="post" enctype="multipart/form-data" action="javascript:;">
            {{ csrf_field() }}
            <input type="hidden" name="career_id" value="0">

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
                <input type="text" name="phone" class="input-select" placeholder="Contoh: 08123456789">
                <div id="phone_error" class="help-block help-block-error"></div>
            </div>

            <div class="input-group" id="cover_letter" style="margin-bottom: 16px;">
                <label class="input-label">Cover Letter / Ringkasan Diri</label>
                <textarea class="input-select textarea-input" name="cover_letter" rows="4" placeholder="Tuliskan pengantar singkat mengenai pengalaman atau posisi yang Anda minati..."></textarea>
                <div id="cover_letter_error" class="help-block help-block-error"></div>
            </div>

            <div class="input-group" id="cv" style="margin-bottom: 16px;">
                <label class="input-label">Upload CV / Resume (PDF/JPG/PNG, Maks 2MB)</label>
                <input class="input-select" name="cv" type="file">
                <div id="cv_error" class="help-block help-block-error"></div>
            </div>

            <div style="display: flex; align-items: flex-start; gap: 10px; margin: 20px 0;">
                <input type="checkbox" name="agreement" value="true" id="flexCheckDefault" style="margin-top: 4px;">
                <label for="flexCheckDefault" style="font-size: 13px; color: var(--text-muted);">
                    Dengan mengirimkan formulir ini, saya menyetujui penyimpanan dan pemrosesan data lamaran saya oleh {{ @$CONF->title ?? 'Gadai Mulia' }}.
                </label>
            </div>

            <button type="button" class="btn btn-primary btn-block" onclick="save()">Kirim Lamaran</button>
        </form>
    </div>
</div>
@endsection

@push('customJs')
<script type="text/javascript">
    let count_data = 0;
    let current_data = 0;

    function openDropCvModal() {
        document.getElementById('dropCvModal').classList.add('open');
    }
    function closeDropCvModal() {
        document.getElementById('dropCvModal').classList.remove('open');
    }

    function loadMore(reset = false) {
        if (reset) {
            current_data = 0;
            $('.career_list').empty();
        }
        $.ajax({
            url: "{{ route('career.get') }}?offset=" + (current_data + 1) + "&category=" + $('[name=category]').val() + '&types=' + $('[name=types]').val() + '&location=' + $('[name=location]').val(),
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                count_data = response.total;
                response.data.map(data => {
                    const career_card = $('.career-sample').clone();
                    career_card.removeAttr('style');
                    career_card.removeClass('career-sample');
                    career_card.find('.career_title').html(data.title);
                    career_card.find('.career_category').html(data.category_label || data.category);
                    career_card.find('.career_types').html(data.types_label || data.types);
                    if (data.location_label) {
                        career_card.find('.career_location').html(data.location_label);
                    } else {
                        career_card.find('.career_loc_wrap').hide();
                    }
                    career_card.find('.career_desc').html(data.short_description || '');
                    career_card.find('.career_link').attr('href', '{{ route('career.detail', ['slug' => '']) }}/' + data.slug);

                    $('.career_list').append(career_card);
                    current_data++;
                });
                checkData();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal({
                    title: 'System Error',
                    text: errorThrown,
                    icon: 'error',
                    timer: '3000'
                });
            }
        });
    }

    function checkData() {
        if (current_data === 0) {
            $('.career_empty').show();
        } else {
            $('.career_empty').hide();
        }
        if (count_data > current_data) {
            $('.btn-load').show();
        } else {
            $('.btn-load').hide();
        }
    }

    loadMore(true);

    function save() {
        swal({
            title: "Yakin Simpan Data?",
            text: "Lamaran Anda akan dikirimkan",
            icon: "warning",
            buttons: {
                cancel: true,
                confirm: {
                    text: 'Kirim!',
                    closeModal: false,
                },
            },
        }).then((process) => {
            if (process) {
                if (!$('[name=agreement]').is(':checked')) {
                    swal({
                        title: 'Persetujuan Belum Di Checklist',
                        text: 'Mohon centang persetujuan terlebih dahulu',
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
