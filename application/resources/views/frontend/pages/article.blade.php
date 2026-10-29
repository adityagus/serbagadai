@extends('frontend.layouts.template')

@section('pageTitle','Article')

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

    <!-- Article Section -->
    <main id="main">
        <section class="section">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold mb-5">Artikel</p>
                <div class="container">
                    <div class="row g-4 article_list">
                        <div class="col-md-4 article-sample">
                            <div class="card card-item border-radius-24 p-4">
                                <img src="#" class="border-radius-top-24 image_article" alt="image news">
                                <div class="d-grid mt-4">
                                    <p class="subheading-24 weight-bold article_title">#</p>
                                    <p class="body-16 grayscale-700 mb-0 article_date">#</p>
                                </div>
                                <div class="overlay border-radius-24 bg-primary-400">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                        <a role="button" class="btn btn-outline-secondary-small article_link" href="#">
                                            Lihat Selengkapnya
                                            <i class="bi bi-arrow-right push-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($articles as $article)
                            <div class="col-md-4">
                                <div class="card card-item border-radius-24 p-4">
                                    <img src="{{ url('storage/'.$article->featured_image ) }}" class="border-radius-top-24" alt="image news">
                                    <div class="d-grid mt-4">
                                        <p class="subheading-24 weight-bold">{{ $article->title }}</p>
                                        <p class="body-16 grayscale-700 mb-0">{{ \Carbon\Carbon::parse($article->created_at)->format('d F Y') }}</p>
                                    </div>
                                    <div class="overlay border-radius-24 bg-primary-400">
                                        <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                            <a role="button" class="btn btn-outline-secondary-small" href="{{ route('article.detail',['slug'=>$article->slug]) }}">
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
                <div class="d-flex justify-content-center mt-5">
                    <button onclick="loadMore()" role="button" class="btn btn-outline-secondary btn-load">
                        Load More
                    </button>
                </div>
            </div>
        </section>
    </main>
    <!-- End Article Section -->

@endsection

@push('customJs')
    <script type="text/javascript">

        const count_article = {{ $count_article }};
        let current_article = {{ count($articles) }};

        function checkArticle() {
            if(count_article > current_article){
                $('.btn-load').show();
            }else{
                $('.btn-load').hide();
            }
        }

        checkArticle();

        $('.article-sample').hide();

        function loadMore(){
            $.ajax({
                url: "{{ route('article.get',['offset'=>'']) }}"+"/"+(current_article+1),
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    response.map(data=>{
                        const article_card = $('.article-sample').clone();
                        article_card.show();
                        article_card.removeClass('article-sample');
                        article_card.find('.image_article').attr('src','{{ url('storage/') }}/'+data.featured_image);
                        article_card.find('.article_title').html(data.title);
                        article_card.find('.article_date').html(data.date);
                        article_card.find('.article_link').attr('href','{{ route('article.detail',['slug'=>'']) }}/'+data.slug);

                        $('.article_list').append(article_card);
                        current_article++;
                    });
                    checkArticle();
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
