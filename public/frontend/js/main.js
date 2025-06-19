
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');
    var $grid;

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });

    });

    // init Isotope
    $(window).on('load', function () {
        $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        if(numProduct < $(this).prev().attr('max'))$(this).prev().val(numProduct + 1);
    });

    $('[name=num-product]').on('keydown',function () {
        return ($(this).val() < $(this).attr('max')) ? true:false;
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /* == load more */

    $('#loadMore').on('click',function(e){
        $('.modal-loading').addClass('modal-loading-show');
        $.ajax({
            url: productUrl + '/loadMore?page='+page,
            type: 'GET',
            dataType: 'JSON',
            success: function (product) {
                $.each(product, function(productKey,productItem) {
                    var productImage = productPath +'/'+ productItem.image;
                    var $divProduct = $('<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item '+productItem.category+'">\n' +
                        '                    <!-- Block2 -->\n' +
                        '                    <div class="block2">\n' +
                        '                        <div class="block2-pic hov-img0">\n' +
                        '                            <img src="'+productImage+'" alt="' + productItem.name + '">\n' +
                        '\n' +
                        '                            <a href="javascript:;" id="loadProduct-'+productItem.id+'" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" onclick="preview('+productItem.id+')" product-id="' + productItem.id + '">\n' +
                        '                                Lihat\n'+
                        '                            </a>\n' +
                        '                        </div>\n' +
                        '\n' +
                        '                        <div class="block2-txt flex-w flex-t p-t-14">\n' +
                        '                            <div class="block2-txt-child1 flex-col-l ">\n' +
                        '                                <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">\n' +
                        '                                    ' + productItem.name + '\n' +
                        '                                </a>\n' +
                        '\n' +
                        '                                <span class="stext-105 cl3">\n' +
                        '\t\t\t\t\t\t\t\t\tRp. ' + productItem.price + '\n' +
                        '\t\t\t\t\t\t\t\t</span>\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                            <div class="block2-txt-child2 flex-r p-t-3">\n' +
                        '                                <a href="#" class="btn-addwish-b2 dis-block pos-relative" style="color:#999">\n' +
                        '                                    <i class="fa fa-archive" style="margin-left: 2px"></i>' + productItem.qty + '\n' +
                        '                                </a>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>');
                    $topeContainer.isotope('insert', $divProduct);
                });
                page++;
                $('.modal-loading').removeClass('modal-loading-show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        $('.modal-loading').addClass('modal-loading-show');
        $('[name=previewColor]').empty();
        $('[name=previewSize]').empty();

        $.ajax({
            url: productUrl + '/preview/' + $(this).attr('product-id'),
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
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });

    $('.js-hide-modal2').on('click',function(){
        $('.js-modal2').removeClass('show-modal1');
    });

    $('.js-hide-modal3').on('click',function(){
        $('.js-modal3').removeClass('show-modal1');
    });

})(jQuery);
