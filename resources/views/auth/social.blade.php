@extends('auth.auth')

@section('htmlheader_title')
    Password reset
@endsection

@section('content')

    <body class="login-page">
    <div class="login-box">
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
		<p class="login-box-msg"><img alt="User Image" class="img-circle" src="{{ empty($user->avatar)? Input::old('avatar') : $user->avatar }}"></p>
            <p class="login-box-msg">Create Account for {{ empty($user->name)? Input::old('name') : $user->name }}</p>
            <form action="{{ url('/social/save') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Form::hidden('name', empty($user->name)? Input::old('name') : $user->name ) !!}
		{!! Form::hidden('email', empty($user->email)? Input::old('email') : $user->email ) !!}
		{!! Form::hidden('id', $confirmation_code ) !!}
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype Password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                    <div class="col-xs-2">
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/auth/login') }}">Log in</a><br>
            <a href="{{ url('/auth/register') }}" class="text-center">Register a new membership</a>

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