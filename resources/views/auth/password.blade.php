@extends('auth.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')

<body class="login-page">
      <div id="top">
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
    <div class="login-box login-box-body">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><image class="logo" src="{{ asset('images/logo.png') }}"/></a>
        </div><!-- /.login-logo -->

        @if (session('status'))
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
            <p class="login-box-msg">RESET PASSWORD</p>
            <form action="{{ url('/password/email') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset</button>
                    </div><!-- /.col -->
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/auth/login') }}" class="link">Log in</a><br>
            <a href="{{ url('/auth/register') }}" class="link text-center">Register a new membership</a>

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
