<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LineBacker - Privacy Protector</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500italic,500,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/elegant-font/code/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/flexslider/flexslider.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/form-elements.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/media-queries.css') }}">
	<!--<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">-->
	<link rel="stylesheet" href="{{ asset('/assets/css/jquery.carousel-3d.default.css') }}">
	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="{{ asset('/assets/ico/favicon.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/assets/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/assets/ico/apple-touch-icon-114-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/assets/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('/assets/ico/apple-touch-icon-57-precomposed.png') }}">	
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
                                    <a class="navbar-brand" <a href="{{ url('/home') }}">LineBacker</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">						
						<li class="active">
							<a href="{{ url('/home') }}" class="smooth">Home</a>
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

        <!-- Slider -->
        <div class="slider-container">
            <div class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <video id="video" controls loop="yes" src="http://linebacker.privacyprotector.org/assets/img/bannerproject720p.flv.mp4" type="video/mp4"></video>
                            <!--<video id="video" loop="" width="100%" height="auto" autoplay="true">
                            <source src="http://linebacker.privacyprotector.org/assets/img/bannerproject720p.flv.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
                                            </video>-->
            </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Presentation -->
        <div class="presentation-container clearfix">
			<div id="privacy" class="presentation-container-2 clearfix">
				<div class="col-sm-12 col-sm-6 wow fadeInLeftBig text">
					<h2>
						Privacy Protector
					</h2>
					<div class="sidebar-box 2">
						<p>
							Let’s face it, by now you have probably figured out that the Federal Do Not Call list does not work.
						</p>
						<p>
							Since its inception over 220 million Americans have registered on the DNC list but, according to the FTC, violations and complaints are at an all time high numbering millions every year.
						</p>
						<p>
							According to industry insiders the FTC, Federal and State agencies are so inundated that violators seldom get prosecuted. Those that do have figured out that even after paying fines they still make more money by telemarketing to the Do Not Call list, than not.
						</p>
						<p>
							The powers that be also realized that they were fighting a losing battle and that is why they sent for reinforcement by way of certain legislative changes to the Telephone Consumer Protection Act (TCPA). Rather than allow most violators to go unpunished these recent changes now empower consumers to take direct action against violators in small claims court.	
						</p>
						<p>
							This was the catalyst that gave birth to Privacyprotector.org.
						</p>
						<p>
							We are a consumer protection organization dedicated to educating consumers about their rights under the TCPA and providing the tools and technology to end the scourge of unwanted solicitation calls once and for all.
						</p>
						<p>
							This is a membership consumer protection service focused on teaching our members how to use existing telemarketing laws to protect their privacy and more importantly, how to make telemarketers pay them cash for violating the law!
						</p>
						
					</div>
					<div class="read-more"><button data-box="2" class="button">Read More</button></div>
				</div>
				<div class="col-sm-12 col-sm-6 wow fadeInRightBig img">
				</div>
			</div>			
			<div id="linebacker" class="presentation-container-1 clearfix">
				<div class="col-sm-12 col-sm-6 wow fadeInLeftBig img">
				</div>
				<div class="col-sm-12 col-sm-6 wow fadeInRightBig text">
					<h2>
						LineBacker
					</h2>
					<div class="sidebar-box 1">
					<p>
						Any phone number that is not whitelisted by you is automatically intercepted and greeted with a pre-recorded warning message which effectively gives “legal notice” to the caller that the call is being recorded and that any unwanted calls may be a violation of the TCPA and or other Federal Laws.
					</p>
					<p>
						If the caller does not hang up, your phone will then ring and the call will proceed as normal. If the call does turn out to be a telemarketer, you will need to decide how you wish to proceed.
					</p>
					<p>
						How does the LineBacker protect your privacy?
					</p>
					<p>
						On a home line: If your number is registered with the National DNC list for more than 31 days any non-exempt solicitation call is a direct violation of the law and you may be eligible to take direct action against the telemarketer that called you.
					</p>
					<p>
						Please, install LineBacker on my home line!
					</p>
					</div>
					<div class="read-more"><button data-box="1" class="button">Read More</button></div>
				</div>
			</div>			
        </div>		
			
		<!-- Video Testimonials -->					
		<div class="video-testimonials-container">
			<div class="container">
				<div class="row"> 
					<div class="col-xs-12">
						<div class="text">
						<h3>This is what Privacy Protector users are saying about LineBacker and our services</h3>
						</div>
						<div data-carousel-3d>														
							<figure selected>
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-1.jpg') }}" data-url="XNh4WdN0p8U"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure>
							<figure>
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-2.png') }}" data-url="qK2jYeDVNlc"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure>
							<figure >
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-3.png') }}" data-url="yqGNmdmkAk0"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure>																						
							<figure>
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-4.jpg') }}" data-url="nkaCsDtXKtE"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure>		
							<figure>
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-2.png') }}" data-url="qK2jYeDVNlc"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure>
							<figure>
								<img class="popup-video" src="{{ asset('/assets/img/video-testimonials/video-3.png') }}" data-url="yqGNmdmkAk0"/>
								<!--<figcaption>Busy mom</figcaption>-->
							</figure> 							
						</div>
					</div>
				</div>
			</div>	
		</div>
		
		<!-- Video Testimonials - Popup -->		
		<div id="myModal" class="white-popup" >
			<!-- <a href="#a" id="close">X</a> -->
			<img id="close" src="{{ asset('/assets/img/video-testimonials/close.png') }}"></img>
			<iframe id="myFrame" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="popup-overlay"></div>
	
		<!-- Download -->
		<div class="download clearfix">
			<div class="container">
			  	<div class="row">
					<div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-1 wow fadeInLeftBig text">
						<h4>Is your telephone number registered in the National 
							DNC list and you still get annoying telemarketing calls?</h4><br/>
						Did you know that you can turn those irritating telemarketing calls into CASH?<br/><br/>
						<span class="blue">Download</span> this <span class="blue">FREE</span>
						 e-book and learn how you too can turn annoying telemarketing calls into cash.
						<a class="btn btn-primary button-blue" href="{{ asset('/assets/doc/DNC_e-book.pdf') }}" target="_back">Download Now</a>

						<strong>This is your first step to get cash out of unwanted calls!</strong><br/><br/>
						<div class="facebook">
							<div class="fb-share-button" data-href="https://www.facebook.com/Privacyprotector.org/" data-layout="button_count"></div>
						</div>
						<div class="twitter">
							<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
						</div>
						Share this information with friends and Get 30 days of our Premium service for FREE
					</div>
					<div class="col-xs-12 col-sm-6 col-lg-5 wow fadeInRightBig">
					  <img src="{{ asset('/assets/img/annoying-call-image.jpg') }}" class="img-responsive center-block">
					</div>
				</div>
			</div>	
		</div>
		<div id="services" class="services container clearfix">
		  <div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-1 wow fadeInLeftBig text">
				<h2>Free Services</h2>
				<p>Your Free service grants you partial access to information,
				some trainings and webinars by qualified experts.</p> 				
				<p>Check the calendar and don't miss any of the trainings and
				webinars that Privacy Protector has scheduled just for you!</p> 				
				<p>If you want to know what you are missing, take a look at our
					Premium services.</p> 
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-5 wow fadeInRightBig text">
			  <h2><span>Premium</span> Services</h2>
				<p> Your Premium service grants you full access to all information,
				trainings, webinars by qualified experts, downloadable forms,
				filling a case engine and an automated tool to track the on
				going of your case.</p> 				
				<p>Check the calendar and don't miss the trainings and
					webinars that Privacy Protector has scheduled just for you!</p>				
			</div>
		  </div>
		</div>	
		<div class="table-services container clearfix">				
			<div class="col-xs-12 col-lg-10 col-lg-offset-1">				
				<table class="table table-striped"> 
					<thead>
					  <tr class="wow fadeInRightBig">
						<th></th>
						<th>Free</th>
						  <th><span>Premium</span></th>
					  </tr>
					</thead>
					<tbody>
					  <tr class="wow fadeInLeftBig">
						<td>Trainings</td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
					  </tr>
					  <tr class="wow fadeInRightBig">
						<td>Webinars</td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
					  </tr>
					  <tr class="wow fadeInLeftBig">
						<td>Filing a Case</td>
						<td></td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
					  </tr>
					  <tr class="wow fadeInRightBig">
						<td>Forms</td>
						<td></td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
					  </tr>
					  <tr class="wow fadeInLeftBig">
						<td>Track Your Case</td>
						<td></td>
						<td><img src="{{ asset('/assets/img/check.png') }}" class="img-responsive"></td>
					  </tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="register">
			<div class="container">
				<h2>
					Register for FREE and you will receive:
				</h2>
				<p>
					<img src="{{ asset('/assets/img/check-white.png') }}" class="img-responsive">  Our exclusive e-book that will teach you how to turn telemarketing calls into cash
				</p>
				<p>
					<img src="{{ asset('/assets/img/check-white.png') }}" class="img-responsive">  A link to download our free Mobile App to start protecting your cell phone right now
				</p>
				<p>
					<img src="{{ asset('/assets/img/check-white.png') }}" class="img-responsive">  Access to all our free contents
				</p>
				<p>
					<img src="{{ asset('/assets/img/check-white.png') }}" class="img-responsive">  And, if you share this, 30 days or our Premium service for free
				</p>
				<a href="{{ URL::to('register') }}" class="btn btn-primary button-white">REGISTER NOW <img src="{{ asset('/assets/img/register-arrow.png') }}" class="img-responsive"></a>
			</div>
		</div>
		<div id="app" class="download-app">
			<div class="container">
				<div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-1 wow fadeInLeftBig">
					<div class="img">
						
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-5 wow fadeInRightBig">
					<div class="text">
						<h2>
							Privacy Protector	
						</h2>
						<p>
							We care for your privacy. That is why Privacy Protector is a non for profit organization created to guide and advise all those who, just like you, value their privacy. People who understand that their privacy is a value and are determined to have it respected.
						</p>
					</div>
					<div class="googleplay">
						<a href="#"><img src="{{ asset('/assets/img/googleplay.png') }}" /></a>
					</div>
					
				</div>
			</div>
		</div>
       

        <!-- Footer -->
        <footer>
			<!-- <div class="subscribe">
				<div class="container wow fadeIn">
					<b>Subscribe</b> to our newsletter <b>to receive Discounts and Special Offers!</b>
					<form role="form" method="post">
						<input type="text" class="name" placeholder="Firs Name" name="name"/>
						<input type="email" class="email" placeholder="E-mail Address" />
						<input type="submit" class="btn btn-primary" name="submit" value="SUBMIT"/>
					</form>
				</div> 
			</div> -->
            <div class="footer">
                <div class="container">
					<div class="text-center wow fadeIn">
						Follow Us
						<span aria-hidden="true" class="social_twitter"></span>
                                                <a href="https://www.facebook.com/Privacyprotector.org/"><span aria-hidden="true" class="social_facebook"></span></a>
						<span aria-hidden="true" class="social_instagram"></span>
					</div>
					<ol class="breadcrumb hidden-470">
						<li class="wow fadeIn"><a href="#">Terms Of Service</a></li>
						<li class="wow fadeIn"><a href="#">Privacy Policy</a></li>
						<li class="wow fadeIn"><a href="#">Support</a></li>
						<li class="wow fadeIn"><a href="#">Trainning Section</a></li>
						<li class="wow fadeIn"><a href="#">Webinars</a></li>
						<li class="wow fadeIn"><a href="#">Forms for Claims</a></li>
						<li class="wow fadeIn"><a href="#">Filing a Case</a></li>
						<li class="wow fadeIn"><a href="#">Track my case</a></li>
					</ol>
                    <div class="footer-copyright wow fadeIn">
                        <p>&copy; 2015 LineBacker. All rights reserved. Designed and Developed by <a href="https://www.clouditapp.com"><img src="{{ asset('/assets/img/cloudlogo.png') }}"/></a></p>
                    </div>                   
                </div>
            </div>
        </footer>
		<a href="#0" class="cd-top cd-fade-out"><span aria-hidden="true" class="arrow_carrot-up"></span></a>
        <!-- Javascript -->
        <script src="{{ asset('/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('/assets/js/retina-1.1.0.min.js') }}"></script>
        <script src="{{ asset('/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('/assets/flexslider/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('/assets/js/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('/assets/js/masonry.pkgd.min.js') }}"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="{{ asset('/assets/js/jquery.ui.map.min.js') }}"></script>
        <script src="{{ asset('/assets/js/scripts.js') }}"></script>
		<!-- Carousel-3d -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-resize/1.1/jquery.ba-resize.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		<script src="{{ asset('/assets/js/jquery.waitforimages.js') }}"></script>
		<script src="{{ asset('/assets/js/jquery.carousel-3d.js') }}"></script>	
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