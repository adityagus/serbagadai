<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>{{ $CONF->title }} || Masuk PIC</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ url('frontend/app/custom/login/login-v5.default.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ url('frontend/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{ url('frontend/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ url('frontend/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ url('frontend/demo/default/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/demo/default/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/demo/default/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/demo/default/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('frontend/custom/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url('frontend/vendors/custom/ion.calendar-2.0.2/css/ion.calendar.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ url('storage/'.$CONF->icon) }}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" style="background-image: url({{ url('frontend/media//bg/bg-3.jpg')}});">
            <div class="kt-login__left">
                <div class="kt-login__wrapper">
                    <div class="kt-login__content">
                        <a class="kt-login__logo" href="{{ route('home') }}">
                            <img src="{{ url('storage/'.$CONF->logo) }}">
                        </a>
                        <h3 class="kt-login__title">Halaman Masuk</h3>
                        <span class="kt-login__desc">
                            Masukan username dan password yang sudah terdaftar, jika username tidak ditemukan silahkan lakukan pendaftaran.
                        </span>
                        <div class="kt-login__actions">
                            <a href="{{ route('register') }}"><button type="button" class="btn btn-outline-brand btn-pill">Pendaftaran</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-login__divider">
                <div></div>
            </div>
            <div class="kt-login__right">
                <div class="kt-login__wrapper">
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Masuk ke Akun PIC</h3>
                        </div>
                        <div class="kt-login__form">
                            <form class="kt-form" action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control form-control-last" type="text" placeholder="Username" name="username" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-last" type="Password" placeholder="Password" name="password">
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col kt-align-right">
                                        <a href="javascript:;" id="kt_login_forgot" class="kt-link">Lupa Password ?</a>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signin_submit" type="submit" class="btn btn-brand btn-pill btn-elevate">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Lupa Password ?</h3>
                            <div class="kt-login__desc">Masukan Username, Tanggal Lahir dan Password Baru Anda:</div>
                        </div>
                        <div class="kt-login__form">
                            <form class="kt-form" id="forgot_form" action="{{ route('pic.reset.password') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="username" name="username" id="kt_usename" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control datepickerinput" type="text" placeholder="tanggal lahir" name="birthDay" autocomplete="off" id="kt_birthDay">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" id="password" placeholder="password baru" name="password" id="kt_password" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="password baru" name="password_confirmation" id="kt_password_confirmation" autocomplete="off">
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Reset</button>
                                    <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="myCalendar" id="myCalendar-1"></div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };

    var homeUrl = '{{ route('home') }}';
    var forgotUrl = '{{ route('pic.reset.password') }}';
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ url('frontend/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{ url('frontend/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-datepicker/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-timepicker/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-switch/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-markdown/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/bootstrap-notify/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/jquery-validation/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/components/vendors/sweetalert2/init.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ url('frontend/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ url('frontend/app/custom/login/login-general.js') }}" type="text/javascript"></script>

<!--end::Page Scripts -->

<!--begin::Global App Bundle(used by all pages) -->
<script src="{{ url('frontend/app/bundle/app.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('frontend/vendors/custom/ion.calendar-2.0.2/js/ion.calendar.js') }}"></script>

<script>
    $(".datepickerinput").ionDatePicker({
        years: "80",                    // years diapason
        format: "YYYY-MM-DD",
    });
</script>

<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>
