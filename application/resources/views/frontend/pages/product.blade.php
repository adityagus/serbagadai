@extends('frontend.layouts.template')

@section('pageTitle',$product->title)

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
        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">
                <div class="row g-0">
                    <div class="col-md-8">
                        <p class="heading-36 weight-bold mb-4">{{ $product->title }}</p>
                        {!! $product->description !!}
                    </div>
                    <div class="col-md-4 d-flex justify-content-md-end">
                        <img src="{{ url('storage/'.$product->image) }}" style="width: 288px; height: 288px;" class="border-radius-24" />
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= About Section ======= -->
        <section class="section bg-primary-400">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold mb-5">Keunggulan</p>
                <div class="row g-4">
                    @foreach(json_decode($product->advantages) as $advantage)
                    <div class="col-md-4">
                        <div class="d-flex gap-3">
                            <img src="{{ url('frontend/assets/img/checklist.png') }}" width="35" height="35" />
                            <p class="body-18 mb-0">{{ $advantage->text }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ======= End About Section ======= -->

        <!-- ======= Product & Service Section ======= -->
        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">
                <div class="row g-4">
                    <div class="col-md-4">
                        <p class="heading-36 weight-bold mb-4">Persyaratan</p>
                        {!! $product->terms !!}
                    </div>
                    <div class="col-md-8 pricing">
                        <p class="heading-36 weight-bold mb-4">Pricing Produk</p>
                        <div class="horizontal-scroll">
                            {{--<table id="pricing-table" class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center" style=" min-width: 125px">Nama Produk</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Tenor</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Up</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Admin</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center" style=" min-width: 125px">Sewa Modal</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center" style=" min-width: 100px">Masa Jual</th>
                                    <th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Denda</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="caption-14 grayscale-700 p-4">Gadai Aksesoris Reguler</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">30 Hari</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">Minimal Rp500.000</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">Mulai dari Rp200.000 (sesuai tearing pinjaman)</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">6% per 30 hari dibayar didepan</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">Hari ke 20 setelah jatuh tempo</td>
                                    <td class="caption-14 grayscale-700 p-4" rowspan="2">0.3% perhari atau 9% per bulan terhitung dari hari pertama setelah tanggal jatuh tempo</td>
                                </tr>
                                <tr>
                                    <td class="caption-14 grayscale-700 p-4">Gadai Aksesoris Prioritas</td>
                                </tr>
                                </tbody>
                            </table>--}}

                            {!! $product->pricing !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">
                <div class="card text-bg-dark">
                    <img src="{{ url('frontend/assets/img/call-to-action.png') }}" />
                    <div class="card-img-overlay d-flex align-items-center justify-content-md-between justify-content-end">
                        <p class="subheading-30 text-white weight-bold d-none d-sm-flex" style="max-width: 458px; margin-left: 20%;">Dapatkan Dana Cepat! Ajukan Gadai di Gadai Mulia Sekarang!</p>
                        <a href="{{ $product->call_action }}" target="_blank" class="btn btn-primary" style="margin-right: 5%;">
                            Ajukan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

@endsection

@push('customJs')
    <script type="text/javascript">
        $('.pricing table').prop('id','pricing-table');
        $('.pricing table').addClass('table table-bordered mb-0');
        $('.pricing table th').addClass('bg-primary-100 caption-14 weight-bold p-4 text-center');
        $('.pricing table td').addClass('caption-14 grayscale-700 p-4')

    </script>
@endpush
