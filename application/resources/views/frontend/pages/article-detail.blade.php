@extends('frontend.layouts.template')

@section('pageTitle','Article Detail')

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

        <section class="section">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold">{{ $article->title }}</p>
                <p class="body-18 grayscale-800">{{ \Carbon\Carbon::parse($article->created_at)->format('d F Y') }}</p>
                <img src="{{ url('storage/'.$article->banner_image) }}" class="border-radius-top-24 img-fluid mb-5" alt="image news" width="100%">
                {!! $article->content !!}
            </div>
        </section>

        <!-- Promo Section -->
        <section class="section">
            <div class="container" data-aos="fade-up">
                <p class="subheading-24 weight-bold mb-5">Related Post</p>
                <div class="container">
                    <div class="row g-4">
                        @foreach($random_article as $random)
                            <div class="col-md-4">
                                <div class="card card-item border-radius-24 p-4">
                                    <img src="{{ url('storage/'.$random->featured_image) }}" class="border-radius-top-24" alt="image news">
                                    <div class="d-grid mt-4">
                                        <p class="subheading-24 weight-bold">{{ $random->title }}</p>
                                        <p class="body-16 grayscale-700 mb-0">{{ \Carbon\Carbon::parse($random->created_at)->format('d F Y') }}</p>
                                    </div>
                                    <div class="overlay border-radius-24 bg-primary-400">
                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                            <a role="button" class="btn btn-outline-secondary-small" href="{{ route('article.detail',['slug'=>$random->slug]) }}">
                                                Lihat Selengkapnya
                                                <i class="bi bi-arrow-right push-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End Promo Section -->

    </main>
    <!-- End #main -->

@endsection

@push('customJs')

@endpush
