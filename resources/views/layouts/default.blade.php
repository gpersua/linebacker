<!doctype html> 
<html> 
    <head> @include('head')
    <!-- CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500italic,500,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/elegant-font/code/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('/flexslider/flexslider.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/form-elements.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/style_con_body.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/media-queries.css') }}">
	<!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">-->
	<link rel="stylesheet" href="{{ asset('/css/jquery.carousel-3d.default.css') }}">
	

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="{{ asset('/ico/favicon.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/ico/apple-touch-icon-114-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('/ico/apple-touch-icon-57-precomposed.png') }}">	
        <style>
        a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: #fff;
}

</style>
    </head> 
    <body onload="init()">
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
        <div class="container"> 
            <header class="row"> @include('includes.header') </header> 
            <div id="main" class="row"> @yield('content') </div> 
            <footer class="row"> @include('includes.footer') </footer> 
        </div> 
        <!-- Javascript -->
        <script src="{{ asset('/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('/js/wow.min.js') }}"></script>
        <script src="{{ asset('/js/retina-1.1.0.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('/flexslider/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('/js/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('/js/masonry.pkgd.min.js') }}"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="{{ asset('/js/jquery.ui.map.min.js') }}"></script>
        <script src="{{ asset('/js/scripts.js') }}"></script>
		<!-- Carousel-3d -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-resize/1.1/jquery.ba-resize.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		<script src="{{ asset('/js/jquery.waitforimages.js') }}"></script>
		<script src="{{ asset('/js/jquery.carousel-3d.js') }}"></script>	
		<!--- Pop-up -->
		<script>
			$(document).ready(function (){
				/* Smooth scrolling para anclas */
				$('a.smooth').on('click', function(e) {
					var $link = $(this);
					var anchor  = $link.attr('href');
					$('html, body').stop().animate({
						scrollTop: $(anchor).offset().top
					}, 2000);
				});
				/* Popup testimonial video */
				$('.popup-video').click(function (event){				
					var myData = $(event.target).data("url")	// event.target returns object who started the event					
					if($(window).width() > 650){
						$('#myFrame').attr('src',  'https://www.youtube.com/embed/'+myData+'?autoplay=1&rel=0&fs=0&modestbranding=1&title=0');					
						//$("#myFrame").src += "?autoplay=1";			// setup autoplay. it can be done at the url too.
						$('#myModal').show('slow');
						$('.popup-overlay').fadeIn('slow');
						$('.popup-overlay').height($(window).height());
						//------------
						$('.popup-overlay').click(function (){
							$('#myModal').hide('slow');
							$('.popup-overlay').fadeOut('slow');
							$('#myFrame').attr('src', '');		// stops playing video
						});	
					}else{
						window.open('https://www.youtube.com/watch?v='+myData, '_blank'); 
					}
				});
				//-----------
				$('#close').click(function () {
					$('#myModal').hide('slow');
					$('.popup-overlay').fadeOut('slow');							
					$('#myFrame').attr('src', '');		// stops playing video
				});
			})
		</script>
    </body>
</html>