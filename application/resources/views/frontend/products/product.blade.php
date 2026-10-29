@extends('frontend.layouts.template')

@section('pageTitle','Product')

@push('customCss')

@endpush

@section('content')

    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        Semua
                    </button>

                    @foreach($categories as $category)

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ 'cat-'.$category->id }}">
                        {{ucwords($category->name)}}
                    </button>

                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="keyword" value="{{@$filter->keyword}}" placeholder="Cari Produk">
                    </div>
                </div>
            </div>

            <div class="row isotope-grid isotope">
                @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ 'cat-'.$product->category_id }}">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{url('storage/'.$product->image)}}" alt="{{ucwords($product->name)}}">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" product-id="{{$product->id}}">
                                Lihat
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ucwords($product->name)}}
                                </a>

                                <span class="stext-105 cl3">
									Rp. {{number_format($product->prices())}}
								</span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative" style="color:#999">
                                    <i class="fa fa-archive" style="margin-left: 2px"></i>{{number_format($product->qty)}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" id="loadMore" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </div>

    @include('frontend.layouts.preview')

@endsection

@push('customJs')
    <script>
        var page = 1;
        var sort = '{{empty($filter->sort)?'':$filter->sort}}';
        var price = '{{empty($filter->price)?'':$filter->price}}';
        var label = '{{empty($filter->label)?'':$filter->label}}';
        var category = '{{empty($filter->category)?'':$filter->category}}';
        var subCategory = '{{empty($filter->subCategory)?'':$filter->subCategory}}';
        var keyword = '{{empty($filter->keyword)?'':$filter->keyword}}';

        @if(!empty($filter->category))
            $('[name=category]').change();
        @endif

        function preview(id) {
            $('.modal-loading').addClass('modal-loading-show');
            $('[name=previewSize]').empty();

            $.ajax({
                url: productUrl + '/preview/' + (id ? id : $(this).attr('product-id')),
                type: 'GET',
                dataType: 'JSON',
                success: function (product) {
                    $('[name=previewId]').val(product.id);
                    $('#previewName').html(product.name);
                    $('#previewPrice').html('Rp. ' + product.price);
                    $('#previewUnit').html(product.unit.name);
                    $('#previewDescription').html(product.description);
                    $('#previewQty').attr('max',product.stock);

                    $('[name=previewSize]').empty();

                    $('[name=previewSize]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Jenis')
                    );

                    $.each(product.variants, function(productKeySize,productSize) {
                        var currentSize = $("<option></option>")
                            .attr("value",JSON.stringify(productSize))
                            .text((productSize.remark ? productSize.remark : '') + ' ('+priceTypes[productSize.types]+')');

                        $('[name=previewSize]').append(currentSize);
                    });

                    $('.wrap-slick3').html('<div class="wrap-slick3-dots"></div><div class="wrap-slick3-arrows flex-sb-m flex-w"></div><div class="slick3 gallery-lb" id="previewImages"></div>');

                    // $.each(product.images, function(productKeyImage,productImage) {
                    var currentImage= '<div class="item-slick3" data-thumb="'+productPath+'/'+product.image+'">\
                        <div class="wrap-pic-w pos-relative">\
                            <img src="'+productPath+'/'+product.image+'" alt="'+product.name+'">\
                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+productPath+'/'+product.image+'">\
                                <i class="fa fa-expand"></i>\
                            </a>\
                        </div>\
                        </div>';

                    $('#previewImages').append(currentImage);
                    // });

                    $('.wrap-slick3').each(function(){
                        $(this).find('.slick3').slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            infinite: true,
                            autoplay: false,
                            autoplaySpeed: 6000,

                            arrows: true,
                            appendArrows: $(this).find('.wrap-slick3-arrows'),
                            prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                            nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                            dots: true,
                            appendDots: $(this).find('.wrap-slick3-dots'),
                            dotsClass:'slick3-dots',
                            customPaging: function(slick, index) {
                                var portrait = $(slick.$slides[index]).data('thumb');
                                return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                            },
                        });
                    });

                    $('#previewDetailId').attr('href',productUrl+'/'+product.id);

                    $('.modal-loading').removeClass('modal-loading-show');
                    $('.js-modal1').addClass('show-modal1');
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $('[name=keyword]').on('keypress', function () {
            var keyword = $('[name=keyword]').val();
            location.href = productUrl+'?keyword='+keyword+'&category='+category;
        });
    </script>
@endpush
