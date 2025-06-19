@extends('backend.layouts.template')

@section('pageTitle','Dashboard')

@push('customCss')

@endpush

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar" style="padding:10px 0px;">
            <div class="col-md-6 label-control pull-right" style="text-align: right;">
                <span style="margin-top: 7px;font-size: 16px;font-weight: bold;">{{date('D, d F Y')}}</span>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- page content -->
        <div class="row portlet-body">
            <div class="col-lg-12 text-center">
                <br>
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('admin.product')}}">
                        <div class="visual">
                            <i class="fa fa-tag"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$product)}}</span>
                            </div>
                            <div class="desc">Produk</div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                    \App\Util\Constant::USER_ROLE_HRD,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('admin.career')}}">
                        <div class="visual">
                            <i class="fa fa-database"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$career)}}</span>
                            </div>
                            <div class="desc">Karir Terbuka</div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{route('admin.promo')}}">
                        <div class="visual">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$promo)}}</span>
                            </div>
                            <div class="desc">Promo Aktif</div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('admin.article')}}">
                        <div class="visual">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$article)}}</span>
                            </div>
                            <div class="desc">Artikel Publish</div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
            <div class="col-lg-12 text-center">
                <br>
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('admin.outlet')}}">
                        <div class="visual">
                            <i class="fa fa-location-arrow"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$outlet)}}</span>
                            </div>
                            <div class="desc">Outlet Aktif</div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                    \App\Util\Constant::USER_ROLE_HRD,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('admin.career.submission')}}">
                        <div class="visual">
                            <i class="fa fa-address-card-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$career)}}</span>
                            </div>
                            <div class="desc">Lamaran Karir</div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array(@\Auth::user()->role,[
                    \App\Util\Constant::USER_ROLE_ADMIN,
                ]))
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{route('admin.contact')}}">
                        <div class="visual">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$contact)}}</span>
                            </div>
                            <div class="desc">Hubungi Kami</div>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

@endsection

@push('customJs')

@endpush
