@extends('frontend.layouts.template')

@section('pageTitle','Sales Officer')

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
        #img-location:hover{
            opacity: 0.6;
            background: red;
        }
        .activity-menu{
            border: 1px solid #dee2e6 !important;
        }
        @media (max-width: 576px){
            .value-box-content{
                min-height: auto !important;
            }
        }
    </style>
@endpush

@section('content')

    <main id="main">
        <img src="{{ url('storage/'.$page->header_image) }}" class="img-fluid" width="100%" />

        <section id="about" class="section about pt-md-5">
            <div class="container" data-aos="fade-up">
                <p class="heading-48 weight-bold">{{ $page->general_title }}</p>
                <p class="subheading-24 weight-bold">{{ $page->general_sub_header }}</p>
                {!! $page->general_content !!}
            </div>
        </section>

        <!-- ======= About Section ======= -->
        <section>
            <div class="row g-0 about-us-container" data-aos="fade-up" style="height: 720px;">
                <div class="col-lg-6 d-none d-lg-flex">
                    <img src="{{ url('storage/'.$page->vision_image) }}" class="object-fit-cover img-fluid" width="100%" height="720" alt="image about us">
                </div>
                <div class="col-lg-6 bg-grayscale-50 about-us">
                    <p class="heading-36 weight-bold mb-5">Visi & Misi</p>
                    <div class="mb-5">
                        <p class="subheading-24 weight-bold mb-2">Visi</p>
                        {!! $page->vision_content !!}
                    </div>
                    <div class="mb-5">
                        <p class="subheading-24 weight-bold mb-2">Misi</p>
                        {!! $page->mission_content !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- ======= End About Section ======= -->

        <!-- ======= Product & Service Section ======= -->
        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">

                <div class="section-title mb-5 mt-5 mt-md-0">
                    <p class="heading-36 weight-bold text-black mb-0">Corporate Values</p>
                </div>

                <div class="row content gx-4 gy-4">
                    @foreach($page->values as $value)
                    <div class="col-lg col-md-4 col-sm-6 col-xs-12">
                        <div class="bg-primary-50 border-radius-24 px-4 py-4 value-box-content text-center" style="min-height: 400px;">
                            <img src="{{ url('storage/'.$value->image) }}" width="72" height="72" />
                            <p class="subheading-24 weight-bold mb-5 highlight-first-letter">{{ $value->title }}</p>
                            <p class="body-16 grayscale-950">{{ $value->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Product & Service Section -->

        <!-- Why Section -->
        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="ms-md-5">
                            <p class="heading-36 weight-bold text-black text-sm-start text-center">{{ $page->area_title }}</p>
                            <p class="body-18 grayscale-800 text-sm-start text-center">{{ $page->area_content }}</p>
                            <div class="d-flex justify-content-sm-start justify-content-center">
                                <a target="_blank" href="{{ route('outlet') }}" class="btn btn-outline-secondary">
                                    Lihat Seluruh Outlet Kami
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-sm-grid mt-sm-5">
                        <div class="row">
                            @if(!empty($outlets[0]))
                            <div class="col-lg-8 d-sm-flex justify-content-sm-center">
                                <div id="img-location" class="border-radius-24" style="
                                        position: relative;
                                        width: 466px;
                                        height: 584px;
                                        background-size: cover;
                                        background-image: linear-gradient(to bottom, rgba(239, 191, 3, 0),rgba(239, 191, 3, 1)),
                                        url('{{ url('storage/'.$outlets[0]->image) }}');">
                                    <div style="position: absolute; bottom: 30px; left: 30px;">
                                        <p class="heading-36 grayscale-950 weight-bold">{{ $CONF->title }}</p>
                                        <p class="heading-60 text-black weight-bold mb-0">{{ $outlets[0]->province_name }}</p>
                                        <div id="overlay-location">
                                            <a role="button" class="btn btn-outline-secondary mt-3" href="{{ route('outlet') }}">
                                                Selengkapnya
                                                <i class="bi bi-arrow-right push-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-4 d-sm-flex d-lg-grid justify-content-sm-center mt-sm-4 mt-lg-0">
                                @if(!empty($outlets[1]))
                                    <div id="img-location" style="
                                        position: relative;
                                        width: 198px;
                                        height: 280px;
                                        background-size: cover;
                                        background-image: linear-gradient(to bottom, rgba(239, 191, 3, 0),rgba(239, 191, 3, 1)),
                                        url('{{ url('storage/'.$outlets[1]->image) }}" class="mb-lg-4 border-radius-24">
                                        <div style="position: absolute; bottom: 50px; left: 30px;">
                                            <p class="subheading-20 grayscale-950 weight-bold">{{ $CONF->title }}</p>
                                            <p class="subheading-24 text-black weight-bold mb-0">{{ $outlets[1]->province_name }}</p>
                                            <div id="overlay-location">
                                                <a role="button" class="btn btn-outline-secondary-small mt-3" href="{{ route('outlet') }}">
                                                    Selengkapnya
                                                    <i class="bi bi-arrow-right push-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($outlets[2]))
                                    <div id="img-location" style="
                                            position: relative;
                                            width: 198px;
                                            height: 280px;
                                            background-size: cover;
                                            background-image: linear-gradient(to bottom, rgba(239, 191, 3, 0),rgba(239, 191, 3, 1)),
                                            url('{{ url('storage/'.$outlets[2]->image) }}" class="mb-lg-4 border-radius-24">
                                        <div style="position: absolute; bottom: 50px; left: 30px;">
                                            <p class="subheading-20 grayscale-950 weight-bold">{{ $CONF->title }}</p>
                                            <p class="subheading-24 text-black weight-bold mb-0">{{ $outlets[2]->province_name }}</p>
                                            <div id="overlay-location">
                                                <a role="button" class="btn btn-outline-secondary-small mt-3" href="{{ route('outlet') }}">
                                                    Selengkapnya
                                                    <i class="bi bi-arrow-right push-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Why Section -->

        <!-- Testimony Section -->
        <section class="section">
            <div class="container" data-aos="fade-up">
                <div style="max-width: 613.67px;" class="mx-auto">
                    <p class="heading-36 weight-bold text-center">{{ $page->activity_header }}</p>
                    <p class="body-18 grayscale-800 text-center">{{ $page->activity_sub_header }} </p>
                </div>

                <ul id="tab-custom" class="nav nav-tabs mx-auto mt-5" style="max-width: 637px;">
                    <li class="nav-item" role="presentation" style="margin:5px 5px;">
                        <a class="nav-link active weight-bold activity-menu" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Kegiatan Marketing</a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin:5px 5px;">
                        <a class="nav-link activity-menu" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Kegiatan Internal</a>
                    </li>
                    <li class="nav-item" role="presentation" style="margin:5px 5px;">
                        <a class="nav-link activity-menu" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Corporate Social Responsibility</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container mt-5">
                            <div class="row g-4">
                                @foreach($page->activities as $activity)
                                    @if($activity->category == 'MARKETING')
                                        <div class="col-md-3">
                                            <div class="p-3 bg-grayscale-50 border-radius-24 d-flex align-items-center justify-content-center" style="height: 288px; background-image: url('{{ url('storage/'.$activity->image) }}') !important;">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container mt-5">
                            <div class="row g-4">
                                @foreach($page->activities as $activity)
                                    @if($activity->category == 'INTERNAL')
                                        <div class="col-md-3">
                                            <div class="p-3 bg-grayscale-50 border-radius-24 d-flex align-items-center justify-content-center" style="height: 288px; background-image: url('{{ url('storage/'.$activity->image) }}') !important">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container mt-5">
                            <div class="row g-4">
                                @foreach($page->activities as $activity)
                                    @if($activity->category == 'CSR')
                                        <div class="col-md-3">
                                            <div class="p-3 bg-grayscale-50 border-radius-24 d-flex align-items-center justify-content-center" style="height: 288px; background-image: url('{{ url('storage/'.$activity->image) }}') !important">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- End Testimony Section -->

    </main>
    <!-- End #main -->

@endsection

@push('customJs')

@endpush
