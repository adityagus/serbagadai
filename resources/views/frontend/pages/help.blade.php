@extends('frontend.layouts.template')

@php
    $help = json_decode($CONF->faq);
@endphp

@section('pageTitle',ucwords(@$help->title))

@push('customCss')

@endpush

@section('content')

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{url('storage/'.@$help->banner)}}');">
        <h2 class="ltext-105 cl0 txt-center">
            {{ucwords(@$help->title)}}
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        @foreach(@$help->list as $faq)
                        <div class="p-b-63">
                            <div class="p-t-32">
                                <h4 class="p-b-15">
                                    <a href="javascript:;" class="ltext-108 cl2 hov-cl1 trans-04">
                                        {{$faq->title}}
                                    </a>
                                </h4>

                                <p class="stext-117 cl6">
                                    {!! $faq->content !!}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="bor17 of-hidden pos-relative">
                            <form action="{{route('product')}}" method="get">
                                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="keyword" placeholder="Cari Produk">

                                <button type="submit" class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Kategori
                            </h4>

                            <ul>
                                @foreach($resultCategories as $category)
                                <li class="bor18">
                                    <a href="{{route('product').'?category='.$category->id}}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        {{ucwords($category->name.' ('.$category->total.')')}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-t-65">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Produk Unggulan
                            </h4>

                            <ul>
                                @foreach($features as $feature)
                                <li class="flex-w flex-t p-b-30">
                                    <a href="{{url('product/'.$feature->id)}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                        <img style="max-height: 200px;max-width: 100px;" src="{{url('storage/'.json_decode($feature->images)[0])}}" alt="{{ucwords($feature->name)}}">
                                    </a>

                                    <div class="size-215 flex-col-t p-t-8">
                                        <a href="{{url('product/'.$feature->id)}}" class="stext-116 cl8 hov-cl1 trans-04">
                                            {{ucwords($feature->name)}}
                                        </a>

                                        <span class="stext-116 cl6 p-t-20">
											Rp. {{number_format($feature->price)}}
										</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('customJs')

@endpush