@extends('backend.layouts.template')

@section('pageTitle','Detail Member')

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
                    <li><a href="{{route('users')}}">Member</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Member</span></li>
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
                                    class="caption-subject font-dark bold uppercase">   Informasi Akun
                                    </span>
                            </div>
                            <div class="actions">
                                
                            </div>

                        </div>

                        <div class="portlet-body form">
                            <div class="row">
                                @foreach($model::FORM_DETAIL as $keyDetail => $labelDetail)
                                <div class="col-md-6">
                                    <div class="form-group" id="{{ $keyDetail }}">
                                        <label class="control-label col-sm-2" for="{{ $keyDetail }}">{{ $labelDetail }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="{{ $keyDetail }}" placeholder="Masukan {{ $labelDetail }}" value="{{ $model->$keyDetail }}" required = "true">
                                            <div id="{{ $keyDetail }}_error" class="help-block help-block-error"> </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9 text-right">
                                    <a href="{{route('users')}}" class="btn default" >Kembali</a>
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

@endpush
