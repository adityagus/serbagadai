<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Sistem Operasional {{ \App\Models\Config::first()->title }} | Login to Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ url('backend/assets/global/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('backend/assets/global/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ url('backend/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ url('backend/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ url('backend/assets/global/css/login.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->

    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ url('storage/'.\App\Models\Config::first()->icon) }}" />
    <!-- END HEAD -->
<body class=" login">

<!-- BEGIN LOGO -->
<div class="logo" style="margin: 30px 0px;max-height: 200px;">
    <img src="{{ url('storage/'.\App\Models\Config::first()->logo) }}" alt="{{ \App\Models\Config::first()->title }}" style="max-width: 360px" />
    {{--<h2 style="color:#fff">{{ \App\Models\Config::first()->title }} </h2>--}}
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content" style="margin:0px auto;">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ route('login') }}" method="post">
        <h3 class="form-title font-green">Login</h3>

        {{ csrf_field() }}

        @if($errors->any())
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> {{ $errors->first() }}. </span>
            </div>
        @endif

        @if($errors->has('password'))
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> {{ $errors->first('password') }}. </span>
            </div>
        @endif

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" value="{{ old('username') }}" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
        <div class="form-actions text-center">
            <button type="submit" style="width: 100%" class="btn green uppercase">Login</button>
        </div>
    </form>
</div>
<div class="copyright"> {{date('Y')}} © Kincat Only </div>
<!--[if lt IE 9]>
<script src="{{ url('backend/assets/global/respond.min.js') }}"></script>
<script src="{{ url('backend/assets/global/excanvas.min.js') }}"></script>
<script src="{{ url('backend/assets/global/ie8.fix.min.js') }}"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{ url('backend/assets/global/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('backend/assets/global/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('backend/assets/global/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ url('backend/assets/global/jquery.blockui.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ url('backend/assets/global/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ url('backend/assets/global/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ url('backend/assets/custom/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ url('backend/assets/custom/login.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->

<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
<!-- End -->
</body>
</html>
