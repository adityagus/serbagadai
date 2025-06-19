@extends('backend.layouts.template')

@section('pageTitle','Setting Halaman Beranda')

@push('customCss')

@endpush

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Beranda</a> <i class="fa fa-circle"></i></li>
                    <li><span>Pengaturan Beranda</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-dark"></i>
                                <span
                                        class="caption-subject font-dark bold uppercase">Pengaturan Beranda
                                    </span>
                            </div>
                            <div class="actions">

                            </div>

                        </div>

                        <div class="portlet-body form">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item active p-b-10">
                                    <a class="nav-link active" data-toggle="tab" href="#hero" role="tab">Hero</a>
                                </li>

                                <li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                                </li>

                                <li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#product" role="tab">Product</a>
                                </li>

                                <li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#why-us" role="tab">Why Us</a>
                                </li>

                                <li class="nav-item p-b-10">
                                    <a class="nav-link" data-toggle="tab" href="#testimony" role="tab">Testimony</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-t-50">
                                <!-- - -->
                                <div class="tab-pane fade in active" id="hero" role="tabpanel">
                                    <div class="row">
                                        @include('backend.pages.home.part.hero')
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="about" role="tabpanel">
                                    <div class="row">
                                        @include('backend.pages.home.part.about')
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="product" role="tabpanel">
                                    <div class="row">
                                        @include('backend.pages.home.part.product')
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="why-us" role="tabpanel">
                                    <div class="row">
                                        @include('backend.pages.home.part.why-us')
                                    </div>
                                </div>

                                <!-- - -->
                                <div class="tab-pane fade" id="testimony" role="tabpanel">
                                    <div class="row">
                                        @include('backend.pages.home.part.testimony')
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- page content -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection

@push('customJs')
    <script type="text/javascript">
        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endpush
