<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>{{ $CONF->title }} || @yield('pageTitle')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Application JSIT COMMERCE" name="description" />
        <meta content="yohankinata@yahoo.com" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->                        
        <link href="{{url('backend/assets/global/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url('backend/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/layouts/layout/css/themes/blue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('backend/assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{url('backend/assets/global/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{url('backend/assets/global/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        {{--<link href="{{ url('frontend/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />--}}

        <link rel="icon" type="image/png" href="{{url('storage/'.$CONF->icon)}}"/>

        <style>
            .ui-helper-hidden-accessible{
                display: none;
            }

            .page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-menu{
                width: 300px;
            }

            .ui-autocomplete-input {
                border: none;
                font-size: 14px;
                margin-bottom: 5px;
                padding-top: 2px;
                border: 1px solid #DDD !important;
                padding-top: 0px !important;
                z-index: 1511;
                position: relative;
            }
            .ui-menu .ui-menu-item a {
                font-size: 12px;
            }
            .ui-autocomplete {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 1510 !important;
                float: left;
                display: none;
                min-width: 160px;
                width: 160px;
                padding: 4px 0;
                margin: 2px 0 0 0;
                list-style: none;
                background-color: #ffffff;
                border-color: #ccc;
                border-color: rgba(0, 0, 0, 0.2);
                border-style: solid;
                border-width: 1px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                *border-right-width: 2px;
                *border-bottom-width: 2px;
            }
            .ui-menu-item > a.ui-corner-all {
                display: block;
                padding: 3px 15px;
                clear: both;
                font-weight: normal;
                line-height: 18px;
                color: #555555;
                white-space: nowrap;
                text-decoration: none;
            }
            .ui-state-hover, .ui-state-active {
                color: #ffffff;
                text-decoration: none;
                background-color: #0088cc;
                border-radius: 0px;
                -webkit-border-radius: 0px;
                -moz-border-radius: 0px;
                background-image: none;
            }
        </style>
    </head>
    @stack('customCss')
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <div class="page-header navbar navbar-fixed-top">
                <div class="page-header-inner ">
                    <div class="page-logo">
                        <a href="">
                            <img src="{{url('storage/'.$CONF->logoSecond)}}" style="height:50px;width: 150px" alt="logo"/>
                        </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    @include('backend.layouts.header')
                </div>
            </div>
            <div class="clearfix"> </div>
            <div class="page-container">
                @include('backend.layouts.sidebar')                
                @yield('content')                
            </div>
            <div class="page-footer">
                <div class="page-footer-inner"> 
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | {{$CONF->title}}                    
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
        </div>

        <!--[if lt IE 9]>
        <script src="{{url('backend/assets/global/respond.min.js')}}"></script>
        <script src="{{url('backend/assets/global/excanvas.min.js')}}"></script>
        <script src="{{url('backend/assets/global/ie8.fix.min.js')}}"></script>
        <![endif]-->
        <script src="{{url('backend/assets/global/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/ladda/ladda.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/ladda/spin.min.js')}}" type="text/javascript"></script>


        <script src="{{url('backend/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/moment.min.js')}}" type="text/javascript"></script>

        <script src="{{url('backend/assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/ui-buttons.min.js')}}" type="text/javascript"></script>

        <script src="{{url('backend/assets/global/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
        <script src="{{url('backend/assets/global/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>

        <!-- Sweet Alert -->
        <script src="{{url('backend/assets/global/sweetalert.min.js')}}"></script>
        <!-- Sweet Alert -->
        <!-- include summernote css/js -->
        <link href="{{ asset('backend/assets/global/summernote/summernote.css') }}" rel="stylesheet">
        <script src="{{ asset('backend/assets/global/summernote/summernote.js') }}"></script>
        <!-- end Summer Note -->

        <!-- Tiny MCE-->
        <script src="{{url('frontend/assets/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
        <!-- Sweet Alert -->

        <!-- Auto Numeric -->
        <script src="{{url('backend/assets/global/autonumeric.min.js')}}"></script>
        <!-- Auto Numeric -->

        <!-- Auto Complete-->
        <script src="{{url('backend/assets/global/jquery-ui.min.js')}}"></script>
        <!-- Sweet Alert -->

{{--        <script src="{{ url('frontend/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>--}}
{{--        <script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-timepicker/init.js') }}" type="text/javascript"></script>--}}

        <script>
            $('.datepickerinput').datetimepicker({
                'format':'YYYY-MM-DD'
            });

            // $(".timepicker").timepicker({
            //     showMeridian : false,
            //     showSeconds: true
            // });

            $(function() {
                var autonumericDecimalOptions = {
                    digitGroupSeparator: '.',
                    decimalPlacesOverride:0,
                    decimalCharacter  : ',',
                    allowDecimalPadding: false,
                    unformatOnSubmit : true
                };

                new AutoNumeric.multiple('.autonumeric', autonumericDecimalOptions);
            });

            $('.summernote').summernote();

            $('[name=province]').on('change', function () {
                var prov = $('[name=province]').val();
                var kab = $('[name=tmpCity]').val();
                if(prov != ''){
                    $.ajax({
                        url: "{{ route('get.city',['province'=> '']) }}/" + prov,
                        type: "GET",
                        dataType: 'JSON',
                        success: function(data) {
                            $('[name=city]').empty();
                            $('[name=city]').append(
                                $("<option></option>")
                                    .attr("value","")
                                    .text('Pilih Kabupaten')
                            );
                            $.each(data, function(index,city) {
                                var selected = '';
                                if(kab != '' && kab == city.id){
                                    selected = 'selected';
                                }
                                var currentData = $("<option " + selected+ "></option>")
                                    .attr("value",city.id)
                                    .text(city.name);

                                $('[name=city]').append(currentData);
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            swal({
                                title: 'System Error',
                                text: errorThrown,
                                icon: 'error',
                                timer: '2000'
                            });
                        }
                    });
                }
            });
            $('[name=city]').on('change', function () {
                var kab = $('[name=city]').val();
                if(!kab) kab = $('[name=tmpCity]').val();
                if(!kab) kab = '';
                var kec = $('[name=tmpDistrict]').val();
                if(kab != ''){
                    $.ajax({
                        url: "{{ route('get.district',['city'=> '']) }}/" + kab,
                        type: "GET",
                        dataType: 'JSON',
                        success: function(data) {
                            $('[name=district]').empty();
                            $('[name=district]').append(
                                $("<option></option>")
                                    .attr("value","")
                                    .text('Pilih Kecamatan')
                            );
                            $.each(data, function(index,district) {
                                var selected = '';
                                if(kec != '' && kec == district.id){
                                    selected = 'selected';
                                }
                                var currentData = $("<option " + selected+ "></option>")
                                    .attr("value",district.id)
                                    .text(district.name);

                                $('[name=district]').append(currentData);
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            swal({
                                title: 'System Error',
                                text: errorThrown,
                                icon: 'error',
                                timer: '2000'
                            });
                        }
                    });
                }
            });

            function clearNotification(){
                swal({
                    title: "Yakin Kosongkan Notifikasi?",
                    text : "Data notikasi akan dikosongkan",
                    icon: "warning",
                    buttons: {
                        cancel:true,
                        confirm: {
                            text:'Kosongkan!',
                            closeModal: false,
                        },
                    },
                })
                .then((process) => {
                    if(process){
                        $.ajax({
                            url: "{{ route('admin.notification.clear') }}",
                            type: "POST",
                            data: {
                                '_token': '{{csrf_token()}}'
                            },
                            success: function(data) {
                                swal({
                                    title: 'Berhasil Kosongkan Data!',
                                    text: 'Data notifikasi berhasil di kosongkan',
                                    icon: 'success',
                                    timer: '3000'
                                }).then((process)=>{
                                    location.reload();
                                });
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
                    }else{
                        swal('Data tidak jadi dikosongkan');
                    }
                });
            }

            function clearAutoNumeric(){
                $('input').each(function(i){
                    var self = $(this);
                    try{
                        var v = self.autoNumeric('get');
                        self.autoNumeric('destroy');
                        self.val(v);
                    }catch(err){
                        //console.log("Not an autonumeric field: " + self.attr("name"));
                    }
                });
            }

            // init tinymce
            tinymce.init({
                selector: 'textarea.text-editor',
                plugins: 'table',
                toolbar: 'table',
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                }
            });
        </script>
        
        @stack('customJs')
    </body>

</html>
