@extends('frontend.layouts.template')

@section('pageTitle','Promo')

@push('customCss')
    <style>
        .carousel-control-next, .carousel-control-prev {
            width: 10%
        }
        .carousel-indicators [data-bs-target] {
            background-color: #4D73CB;
        }
        .btn-circle {
            width: 40px;
            height: 40px;
            padding: 12px 0px;
            border-radius: 35px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
            background-color: #111831;
        }
    </style>
@endpush

@section('content')

    <main id="main">
        <!-- Promo Section -->
        <section class="section">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold mb-5">Promo</p>
                <div class="container">
                    <div class="row g-4 promo_list">
                        <div class="col-md-4 promo-sample">
                            <div id="promo-card" class="card border-radius-24">
                                <img src="#" class="border-radius-top-24 image_promo" alt="image promo">
                                <div class="card-body d-grid">
                                    <p class="card-text valid_promo">#</p>
                                    <a href="#" target="_blank" class="btn btn-primary link_promo">
                                        Klaim Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                        @foreach($promos as $promo)
                            <div class="col-md-4">
                                <div id="promo-card" class="card border-radius-24">
                                    <img src="{{ url('storage/'.$promo->image) }}" class="border-radius-top-24" alt="image promo">
                                    <div class="card-body d-grid">
                                        <p class="card-text">{{ \Carbon\Carbon::parse($promo->valid_date)->format('d F Y') }}</p>
                                        <a href="{{ $promo->action_link }}" target="_blank" class="btn btn-primary">
                                            Klaim Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button role="button" class="btn btn-outline-secondary btn-load" onclick="loadMore()">
                        Load More
                    </button>
                </div>
            </div>
        </section>
        <!-- End Promo Section -->

    </main>
    <!-- End #main -->

@endsection

@push('customJs')
    <script type="text/javascript">

        const count_promo = {{ $count_promo }};
        let current_promo = {{ count($promos) }};

        function checkPromo() {
            if(count_promo > current_promo){
                $('.btn-load').show();
            }else{
                $('.btn-load').hide();
            }
        }

        checkPromo();

        $('.promo-sample').hide();

        function loadMore(){
            $.ajax({
                url: "{{ route('promo.get',['offset'=>'']) }}"+"/"+(current_promo+1),
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    response.map(data=>{
                        const promo_card = $('.promo-sample').clone();
                        promo_card.show();
                        promo_card.removeClass('promo-sample');
                        promo_card.find('.image_promo').attr('src','{{ url('storage/') }}/'+data.image);
                        promo_card.find('.valid_promo').html(data.valid_date);
                        promo_card.find('.link_promo').attr('href',data.action_link);

                        $('.promo_list').append(promo_card);
                        current_promo++;
                    });
                    checkPromo();
                },
                error: function(jqXHR, textStatus, errorThrown){
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
