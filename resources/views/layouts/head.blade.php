<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LineBacker - Privacy Protector</title>
	<link rel="shortcut icon" href="{{ asset('/ico/favicon.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/ico/apple-touch-icon-114-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('/ico/apple-touch-icon-57-precomposed.png') }}">
<body>
	<div id="top">
		<div class="container">
			<div class="col-md-4 row text-left">
				<p>
					<a href="https://twitter.com/PProtector_org"><span aria-hidden="true" class="social_twitter"></span></a>
					<a href="https://www.facebook.com/Privacyprotector.org/"><span aria-hidden="true" class="social_facebook"></span></a>
					<span aria-hidden="true" class="social_instagram"></span>
				</p>
			</div>
			<div class="col-sm-6 col-md-4 row">
				<a href="{{ route('auth.login') }}" class="btn-go">Go >></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="{{ URL::to('register') }}" class="btn-reg">Register</a>
			</div>
			<div class="col-sm-6 col-md-4">
				<p>Need support?&nbsp;&nbsp;<span aria-hidden="true" class="icon_phone"></span><a href="tel;+18887555555">&nbsp;&nbsp;+1 (888) 755­55­55</a></p>
			</div>
		</div>
	</div>
	<!-- Top menu -->
	<nav class="navbar" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" <a href="{{ url('/') }}">LineBacker</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="top-navbar-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active">
						<a href="{{ url('/') }}" class="smooth">Home</a>
					</li>
					<li>
						<a href="#privacy" class="smooth">Privacy Protector</a>
					</li>
					<li>
						<a href="#linebacker" class="smooth">LineBacker</a>
					</li>
					<li>
						<a href="#services" class="smooth">Services</a>
					</li>
					<li>
						<a href="#app" class="smooth">Download App</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</head>