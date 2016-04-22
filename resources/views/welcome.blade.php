<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Linebacker</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.5">
<style>
</style>

</head>
<body>
		<div class="sidebar">
                    <div class="container"><img class="logo" src="{{ asset('images/logo-420x149.png') }}">
                    <div class="title">WELCOME TO <strong>LINEBACKER</strong></div>
                    <div class="sub-title">PRIVACY PROTECTOR</div>
                    <div class="box-l links"><a href="{{ URL::to('register') }}">REGISTER&nbsp;&nbsp;&nbsp;&nbsp;</a> <a class="pipe" href=""> | </a> <a href="{{ route('auth.login') }}">&nbsp;&nbsp;&nbsp;&nbsp;LOGIN</a></div>
			
                    </div>
                </div>
</body>
</html>
