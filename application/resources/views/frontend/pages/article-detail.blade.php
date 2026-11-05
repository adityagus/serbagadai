@extends('frontend.layouts.template')

@section('pageTitle', $article->title)

@section('content')
<!-- Subpage Hero Section -->
<section class="subhero-section">
    <div class="container">
        <span class="section-badge">ARTIKEL & EDUKASI</span>
        <h1 class="subhero-title" style="max-width: 900px; margin-left: auto; margin-right: auto;">{{ $article->title }}</h1>
        <p class="subhero-subtitle">Dipublikasikan pada {{ \Carbon\Carbon::parse($article->created_at)->format('d F Y') }}</p>
    </div>
</section>

<!-- Article Content Section -->
<section class="page-content-section">
    <div class="container">
        <div class="service-detail-card" style="max-width: 920px; margin: 0 auto 72px auto; padding: 40px;">
            @if(!empty($article->banner_image) || !empty($article->featured_image))
                <div style="margin-bottom: 32px; border-radius: var(--radius-md); overflow: hidden; max-height: 440px;">
                    <img src="{{ url('storage/'.($article->banner_image ?: $article->featured_image)) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" onerror="this.src='{{ url('serbamulia/assets/emas.jpg') }}'">
                </div>
            @endif

            <div class="cms-rich-content text-justify">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Related Articles -->
        @if(!empty($random_article) && count($random_article) > 0)
        <div>
            <div class="section-header-center" style="margin-bottom: 36px;">
                <span class="section-badge center">BACA JUGA</span>
                <h2 class="section-title-dark text-center">Artikel Terkait Lainnya</h2>
            </div>

            <div class="article-grid">
                @foreach($random_article as $random)
                    <article class="art-card">
                        <div class="art-img-wrapper">
                            <img src="{{ url('storage/'.$random->featured_image) }}" alt="{{ $random->title }}" class="art-img" onerror="this.onerror=null;this.src='{{ url('serbamulia/assets/emas.jpg') }}';">
                        </div>
                        <div class="art-content">
                            <div class="art-meta">
                                <span class="art-tag">ARTIKEL</span>
                                <span class="art-date">{{ \Carbon\Carbon::parse($random->created_at)->format('d F Y') }}</span>
                            </div>
                            <h3 class="art-title">{{ $random->title }}</h3>
                            <p class="art-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($random->content), 120) }}</p>
                            <a href="{{ route('article.detail', ['slug' => $random->slug]) }}" class="btn-readmore">Baca Selengkapnya →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
