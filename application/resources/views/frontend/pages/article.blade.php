@extends('frontend.layouts.template')

@section('pageTitle', 'Artikel & Edukasi Finansial')

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">ARTIKEL</span>
        <h1 class="subhero-title">Edukasi & <span class="gold-text">Tips Keuangan</span></h1>
        <p class="subhero-subtitle">Dapatkan tips keuangan praktis, panduan cerdas investasi emas, serta berita edukatif seputar pergadaian di Indonesia.</p>
    </div>
</section>

<!-- Article Index Section -->
<section class="page-content-section">
    <div class="container">
        <!-- Sample Article Card for JS Load More -->
        <article class="art-card article-sample" style="display: none;">
            <div class="art-img-wrapper">
                <img src="#" alt="Artikel" class="art-img image_article" onerror="this.src='{{ url('serbamulia/assets/emas.jpg') }}'">
            </div>
            <div class="art-content">
                <div class="art-meta">
                    <span class="art-tag">ARTIKEL</span>
                    <span class="art-date article_date"></span>
                </div>
                <h3 class="art-title article_title"></h3>
                <p class="art-excerpt article_excerpt"></p>
                <a href="#" class="btn-readmore article_link">Baca Selengkapnya →</a>
            </div>
        </article>

        <div class="article-grid article_list">
            @foreach($articles as $article)
                <article class="art-card">
                    <div class="art-img-wrapper">
                        <img src="{{ url('storage/'.$article->featured_image) }}" alt="{{ $article->title }}" class="art-img" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/emas.jpg') }}';">
                    </div>
                    <div class="art-content">
                        <div class="art-meta">
                            <span class="art-tag">ARTIKEL</span>
                            <span class="art-date">{{ \Carbon\Carbon::parse($article->created_at)->format('d F Y') }}</span>
                        </div>
                        <h3 class="art-title">{{ $article->title }}</h3>
                        <p class="art-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 140) }}</p>
                        <a href="{{ route('article.detail', ['slug' => $article->slug]) }}" class="btn-readmore">Baca Selengkapnya →</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 48px;">
            <button onclick="loadMore()" type="button" class="btn btn-outline btn-load">
                Muat Artikel Lainnya
            </button>
        </div>
    </div>
</section>
@endsection

@push('customJs')
<script type="text/javascript">
    const count_article = {{ $count_article ?? 0 }};
    let current_article = {{ count($articles ?? []) }};

    function checkArticle() {
        if (count_article > current_article) {
            $('.btn-load').show();
        } else {
            $('.btn-load').hide();
        }
    }

    checkArticle();

    function loadMore() {
        $.ajax({
            url: "{{ route('article.get', ['offset' => '']) }}" + "/" + (current_article + 1),
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                response.map(data => {
                    const article_card = $('.article-sample').clone();
                    article_card.removeAttr('style');
                    article_card.removeClass('article-sample');
                    article_card.find('.image_article').attr('src', '{{ url('storage/') }}/' + data.featured_image);
                    article_card.find('.article_title').html(data.title);
                    article_card.find('.article_date').html(data.date);
                    article_card.find('.article_excerpt').html(data.excerpt || '');
                    article_card.find('.article_link').attr('href', '{{ route('article.detail', ['slug' => '']) }}/' + data.slug);

                    $('.article_list').append(article_card);
                    current_article++;
                });
                checkArticle();
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
