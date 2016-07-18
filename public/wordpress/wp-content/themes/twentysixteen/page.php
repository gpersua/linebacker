<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->


	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->
<?php get_sidebar(); ?>


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
        </div>
        <div class="col-sm-12 col-sm-6 wow fadeInRightBig img">
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
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-1.jpg" data-url="XNh4WdN0p8U"/>
                <!--<figcaption>Busy mom</figcaption>-->
              </figure>
              <figure>
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-2.png" data-url="qK2jYeDVNlc"/>
                <!--<figcaption>Busy mom</figcaption>-->
              </figure>
              <figure >
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-3.png" data-url="yqGNmdmkAk0"/>
                <!--<figcaption>Busy mom</figcaption>-->
              </figure>                                           
              <figure>
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-4.jpg" data-url="nkaCsDtXKtE"/>
                <!--<figcaption>Busy mom</figcaption>-->
              </figure>   
              <figure>
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-2.png" data-url="qK2jYeDVNlc"/>
                <!--<figcaption>Busy mom</figcaption>-->
              </figure>
              <figure>
                <img class="popup-video" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/video-3.png" data-url="yqGNmdmkAk0"/>
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
      <img id="close" src="wordpress/wp-content/themes/wpbootstrap/assets/img/video-testimonials/close.png')"></img>
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
            <a class="btn btn-primary button-blue" href="/wordpress/wp-content/themes/wpbootstrap/assets/doc/DNC_e-book.pdf" target="_back">Download Now</a>

            <strong>This is your first step to get cash out of unwanted calls!</strong><br/><br/>
            <div class="facebook">
              <div class="fb-share-button" data-href="https://www.facebook.com/Privacyprotector.org/" data-layout="button_count"></div>
            </div>
            <div class="twitter">
              <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
            </div>
            Share this information with friends and Get 30 days of our Premium service for FREE
          </div>
        </div>
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
            
        </footer>
    <a href="#0" class="cd-top cd-fade-out"><span aria-hidden="true" class="arrow_carrot-up"></span></a>
        <!-- Javascript -->
        <script src="<?php get_template_directory_uri() . '/js/bootstrap.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsjquery-1.11.1.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . 'assets/bootstrap/js/bootstrap.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsbootstrap-hover-dropdown.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jswow.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsretina-1.1.0.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsjquery.magnific-popup.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . 'assets/flexslider/jquery.flexslider-min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsjflickrfeed.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsmasonry.pkgd.min.js'?>"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=true'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsjquery.ui.map.min.js'?>"></script>
        <script src="<?php get_template_directory_uri() . '/jsscripts.js'?>"></script>
    <!-- Carousel-3d -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-resize/1.1/jquery.ba-resize.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php get_template_directory_uri() . 'js/jquery.waitforimages.js'?>"></script>
    <script src="<?php get_template_directory_uri() . 'js/jquery.carousel-3d.js'?>"></script> 
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
          var myData = $(event.target).data("url")  // event.target returns object who started the event          
          if($(window).width() > 650){
            $('#myFrame').attr('src',  'https://www.youtube.com/embed/'+myData+'?autoplay=1&rel=0&fs=0&modestbranding=1&title=0');          
            //$("#myFrame").src += "?autoplay=1";     // setup autoplay. it can be done at the url too.
            $('#myModal').show('slow');
            $('.popup-overlay').fadeIn('slow');
            $('.popup-overlay').height($(window).height());
            //------------
            $('.popup-overlay').click(function (){
              $('#myModal').hide('slow');
              $('.popup-overlay').fadeOut('slow');
              $('#myFrame').attr('src', '');    // stops playing video
            }); 
          }else{
            window.open('https://www.youtube.com/watch?v='+myData, '_blank'); 
          }
        });
        //-----------
        $('#close').click(function () {
          $('#myModal').hide('slow');
          $('.popup-overlay').fadeOut('slow');              
          $('#myFrame').attr('src', '');    // stops playing video
        });
      })
    </script>
    </body>

</html>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>
