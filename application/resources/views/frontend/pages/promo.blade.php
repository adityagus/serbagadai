@extends('frontend.layouts.template')

@section('pageTitle', 'Promo')

@section('content')
@php
    $waNumber = preg_replace('/[^0-9]/', '', @$CONF->whatsapp ?: '6281181126771');
@endphp

<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">PROMOSI</span>
        <h1 class="subhero-title">Promo & <span class="gold-text">Penawaran Spesial</span></h1>
        <p class="subhero-subtitle">Jangan lewatkan berbagai program hadiah langsung, cashback sewa modal, dan kemudahan biaya admin di {{ @$CONF->title ?? 'Gadai Mulia' }}.</p>
    </div>
</section>

<!-- Promo List Section -->
<section class="page-content-section">
    <div class="container">
        <!-- Hidden template for AJAX Load More -->
        <div class="p-card promo-sample" style="display: none;">
            <div class="p-card-tag active">PROMO AKTIF</div>
            <div class="p-card-img-wrapper">
                <img src="#" alt="Promo" class="image_promo" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="gradient-fallback-img p-fallback" style="display: none;">
                    <span class="p-icon">🎁</span>
                </div>
            </div>
            <div class="p-card-content">
                <span class="p-date valid_promo"></span>
                <h3 class="p-title title_promo"></h3>
                <a href="#" target="_blank" class="btn btn-primary btn-block link_promo" style="margin-top: auto;">Klaim Sekarang</a>
            </div>
        </div>

        <div class="promo-grid promo_list">
            @foreach($promos as $promo)
                <div class="p-card">
                    <div class="p-card-tag active">PROMO AKTIF</div>
                    <div class="p-card-img-wrapper">
                        <img src="{{ url('storage/'.$promo->image) }}" alt="{{ $promo->title ?? 'Promo' }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <div class="gradient-fallback-img p-fallback" style="display: none;">
                            <span class="p-icon">🎁</span>
                        </div>
                    </div>
                    <div class="p-card-content">
                        <span class="p-date">Sampai {{ \Carbon\Carbon::parse($promo->valid_date)->format('d F Y') }}</span>
                        <h3 class="p-title">{{ !empty($promo->title) ? $promo->title : 'Promo Spesial Gadai Mulia' }}</h3>
                        <a href="{{ !empty($promo->action_link) ? $promo->action_link : 'https://api.whatsapp.com/send?phone='.$waNumber.'&text=Halo%20Admin,%20saya%20ingin%20klaim%20promo%20'.urlencode($promo->title ?? 'Gadai Mulia') }}" target="_blank" class="btn btn-primary btn-block" style="margin-top: auto;">Klaim Sekarang</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 48px;">
            <button type="button" class="btn btn-outline btn-load" onclick="loadMore()">
                Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>
@endsection

@push('customJs')
<script type="text/javascript">
    const count_promo = {{ $count_promo ?? 0 }};
    let current_promo = {{ count($promos ?? []) }};
    const defaultWa = "{{ $waNumber }}";

    function checkPromo() {
        if (count_promo > current_promo) {
            $('.btn-load').show();
        } else {
            $('.btn-load').hide();
        }
    }

    checkPromo();

    function loadMore() {
        $.ajax({
            url: "{{ route('promo.get', ['offset' => '']) }}" + "/" + (current_promo + 1),
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                response.map(data => {
                    const promo_card = $('.promo-sample').clone();
                    promo_card.removeAttr('style');
                    promo_card.removeClass('promo-sample');
                    promo_card.find('.image_promo').attr('src', '{{ url('storage/') }}/' + data.image);
                    promo_card.find('.valid_promo').html('Sampai ' + data.valid_date);
                    promo_card.find('.title_promo').html(data.title || 'Promo Spesial Gadai Mulia');
                    const actionLink = data.action_link ? data.action_link : ('https://api.whatsapp.com/send?phone=' + defaultWa + '&text=Halo%20Admin,%20saya%20ingin%20klaim%20promo%20' + encodeURIComponent(data.title || 'Gadai Mulia'));
                    promo_card.find('.link_promo').attr('href', actionLink);

                    $('.promo_list').append(promo_card);
                    current_promo++;
                });
                checkPromo();
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
</script>
@endpush
