@extends('auth.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

    <body class="register-page">
        <div id="top1">
    <div class="container">
        <div class="col-md-6 row text-left">
				<p>
                                    <a href="{{ url('/home') }}">Home</a>
				</p>
				
    </div>
        <div class="col-sm-6 col-md-6">
                                            <p>Need support? <span aria-hidden="true" class="icon_phone"></span> <a href="tel;+18887555555">+1 (888) 755­55­55</a></p>
					</div>
    </div>
</div> 
        <div class="register-box register-box-body">
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
        <div class="register-box-body">
            <p class="login-box-msg">REGISTER A NEW MEMBERSHIP</p>
            <form action="{{ url('register') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"><p class="link">I agree to the <a href="#" class="link">terms</a> </p>
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <div class="caja-redes">
            <a href="{{ url('/facebook') }}" class="facebook"><span class="icon-button icon-facebook"><i class="fa fa-facebook"></i></span></a>
        <a href="{{ url('/google') }}" class="google-plus"><span class="icon-button icon-google-plus"><i class="fa fa-google-plus"></i></span></a>
                </div>
            </div>
<div class="row">
            <div class="col-xs-12">
            <a href="{{ url('/auth/login') }}" class="link text-center">I already have a membership</a>
            </div>
</div>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->
    <link rel="stylesheet" href="{{ asset('/css/style_con_body.css') }}">
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
    <!-- Footer -->
        <footer>
			
            <div class="new">					
                    <div class="footer-copyright">
                        <p>&copy; 2015 LineBacker. All rights reserved. </p>
                    </div>                   
            </div>
        </footer>

    
</body>

@endsection
