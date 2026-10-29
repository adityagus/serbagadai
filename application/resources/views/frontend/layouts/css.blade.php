
<!-- Vendor CSS Files -->
<link href="{{ url('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ url('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ url('frontend/assets/css/style.css') }}?v={{ time() }}" rel="stylesheet">

<link href="{{url('backend/assets/global/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>

<style>

    .btn-wa-footer{
        width: 80px;
        height: 80px;
    }
    .img-wa-footer{
        width: 80px;
        height: 80px;
    }

    #footer .footer-top .footer-contact img{
        margin-bottom:10px;
    }

    #footer .footer-top h4{
        padding-bottom: 34px;
    }

    @media (max-width: 992px) {
        .btn-wa-footer{
            width: 65px;
            height: 65px;
        }
        .img-wa-footer{
            width: 65px;
            height: 65px;
        }
        .back-to-top{
            bottom: 30px;
            right: 30px;
        }
    }

    @media (max-width: 576px){
        .carousel-item-description{
            margin-left : 1rem!important;
        }
    }

</style>
