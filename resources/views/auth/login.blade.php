@extends('auth.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="login-page">
    <div class="login-box login-box-body">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><image class="logo" src="{{ asset('images/logo.png') }}"/></a>
        </div><!-- /.login-logo -->
     @if (session()->has('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif    
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-box-body">
    <p class="login-box-msg">SIGN IN TO START YOUR SESSION</p>
   <!-- <form action="{{ url('/auth/login') }}" method="post">-->
    <form action="{{ route('login_path') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" style="font-size: 0.81em;"> Remember Me
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
        </div>
    </form>
    
   

    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <div class="caja-redes">
            <a href="{{ url('/facebook') }}" class="facebook"><span class="icon-button icon-facebook"><i class="fa fa-facebook"></i></span></a>
        <a href="{{ url('/google') }}" class="google-plus"><span class="icon-button icon-google-plus"><i class="fa fa-google-plus"></i></span></a>
        </div>
    </div><!-- /.social-auth-links -->
<div class="row">
            <div class="col-xs-12">
                <a href="{{ url('/password/email') }}" class="link">I forgot my password</a><br>
                <a href="{{ url('/auth/register') }}" class="link text-center">Register a new membership</a>
            </div>
</div>
</div><!-- /.login-box-body -->

</div><!-- /.login-box -->

    @include('auth.scripts')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
