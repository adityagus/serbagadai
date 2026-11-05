@extends('frontend.layouts.template')

@section('pageTitle', 'Hubungi Kami')

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">HUBUNGI KAMI</span>
        <h1 class="subhero-title">Hubungi & <span class="gold-text">Layanan Pelanggan</span></h1>
        <p class="subhero-subtitle">Ada pertanyaan seputar simulasi gadai, sewa modal, atau lokasi cabang? Hubungi tim support {{ @$CONF->title ?? 'Gadai Mulia' }} secara cepat dan ramah.</p>
    </div>
</section>

<!-- Contact details and Form -->
<section class="page-content-section">
    <div class="container">
        <div class="about-detail-grid">
            <div>
                <h2 class="section-title-dark">Informasi Kontak Kantor Pusat</h2>
                <p class="section-desc">{{ @$CONF->title ?? 'Gadai Mulia' }} melayani pertanyaan Anda setiap hari kerja melalui saluran resmi berikut:</p>
                
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <span class="c-bullet">🏢</span>
                        <div>
                            <strong>Alamat Kantor Pusat:</strong>
                            <p class="c-desc">{{ !empty($CONF->address) ? $CONF->address : 'Kirana Three Office Tower, Lt. 15. Kelapa Gading, Jakarta Utara, DKI Jakarta 14240' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="c-bullet">💬</span>
                        <div>
                            <strong>WhatsApp / Telepon Hotline:</strong>
                            <p class="c-desc">{{ !empty($CONF->phone) ? $CONF->phone : '0811-8112-6771' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="c-bullet">✉️</span>
                        <div>
                            <strong>E-mail Support:</strong>
                            <p class="c-desc">{{ !empty($CONF->email) ? $CONF->email : 'cs@gadaimulia.com' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <span class="c-bullet">⏰</span>
                        <div>
                            <strong>Jam Operasional:</strong>
                            <p class="c-desc">Senin - Jumat: 08:30 - 17:00 WIB<br>Sabtu: 08:30 - 14:00 WIB<br>Minggu & Hari Libur Nasional: Tutup</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px; border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-color);">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.444018333579!2d106.7731035745363!3d-6.5916036644350555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5f3675c9fb1%3A0xeefbdc100af8f62f!2sGadai%20Mulia%20-%20Bogor%3A%20Gadai%20Emas%20%26%20Elektronik%20(Hp%2C%20Laptop%2C%20Kamera)%20(Pergadaian)!5e0!3m2!1sen!2sid!4v1786525472878!5m2!1sen!2sid" width="100%" height="260" style="border:0; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
            </div>

            <div class="contact-form-wrapper contact">
                <form action="javascript:;" method="post" id="form-contact" class="contact-form">
                    {{ csrf_field() }}
                    <h3>Kirim Pesan Langsung</h3>
                    <p>Silakan isi form di bawah untuk mengirim pesan resmi kepada tim manajemen kami.</p>
                    
                    <div class="input-group" id="name" style="margin-bottom: 16px;">
                        <label class="input-label">Nama Lengkap</label>
                        <input type="text" name="name" class="input-select" placeholder="Masukkan nama lengkap Anda">
                        <div id="name_error" class="help-block help-block-error"></div>
                    </div>

                    <div class="input-group" id="email" style="margin-bottom: 16px;">
                        <label class="input-label">Email</label>
                        <input type="email" name="email" class="input-select" placeholder="Masukkan alamat email Anda">
                        <div id="email_error" class="help-block help-block-error"></div>
                    </div>
                    
                    <div class="input-group" id="phone" style="margin-bottom: 16px;">
                        <label class="input-label">Nomor WhatsApp / HP</label>
                        <input type="tel" name="phone" class="input-select" placeholder="Contoh: 08123456789">
                        <div id="phone_error" class="help-block help-block-error"></div>
                    </div>
                    
                    <div class="input-group" id="content" style="margin-bottom: 24px;">
                        <label class="input-label">Pesan Anda</label>
                        <textarea name="content" class="input-select textarea-input" rows="4" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..."></textarea>
                        <div id="content_error" class="help-block help-block-error"></div>
                    </div>

                    <button type="button" onclick="send()" class="btn btn-primary btn-block">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('customJs')
<script type="text/javascript">
    function send() {
        swal({
            title: "Yakin Kirim Pesan?",
            text: "Pesan Anda akan dikirimkan ke tim kami",
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
                $('.help-block-error').html('');

                $.ajax({
                    url: "{{ route('contact.send') }}",
                    type: "POST",
                    data: new FormData($("#form-contact")[0]),
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
                            @foreach(\App\Models\Contact::CONTACT_VALIDATION as $key => $value)
                            error_arr.push('{{ $key }}');
                            @endforeach

                            for (var i = 0; i < error_arr.length; i++) {
                                if (response.error && error_arr[i] in response.error) {
                                    $('.contact #' + error_arr[i] + '_error').html(response.error[error_arr[i]]);
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
