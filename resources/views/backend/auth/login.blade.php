@extends('backend.template_auth')

@section('title', 'Admin Login')

@section('page_level_plugins_css')
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('page_level_css')
    <link href="/assets/pages/css/login.css" rel="stylesheet" type="text/css"/>
@endsection

@section('page_level_plugins_js')
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
    <script src="/assets/pages/scripts/login.js" type="text/javascript"></script>
@endsection

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <h3 class="form-title font-blue-steel">Sign In</h3>
        <div class="alert alert-danger @if (!count($errors) > 0) display-hide @endif ">
            <button class="close" data-close="alert"></button>
            <span> Please enter correct email and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
        </div>
        <div class="form-group">
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" />Remember me
                <span></span>
            </label>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn blue-steel uppercase">Login</button>
            <!--a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">Forgot Password?</a-->
        </div>
        <!--div class="login-options">
            <h4>Or login with</h4>
            <ul class="social-icons">
                <li>
                    <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
                </li>
                <li>
                    <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
                </li>
            </ul>
        </div-->
        <!--div class="create-account">
            <p>
                <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
            </p>
        </div-->
    </form>
    <!-- END LOGIN FORM -->
@endsection
