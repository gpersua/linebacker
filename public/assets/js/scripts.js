
    function init() {
      enableVideoClicks();
    }

    function enableVideoClicks() {
       var videos = document.getElementsByTagName('video')[0].play();
      for (var i = 0; i < videos.length; i++) {
        videos[i].addEventListener('click', function(videoNode) {
          return function() {
            videoNode.play();
          };
        }(videos[i]));
      }
    }
jQuery(document).ready(function() {
	console.log($('body').width()+' '+$('.presentation-container-2 ').width());
	/*
	    Wow
	*/
	new WOW().init();
	
	/*
	    Slider
	*/
	$('.flexslider').flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "",
        nextText: "",
		smoothHeight: true,
		
    });
    
	//document.getElementById('video').play();
        /*var video = document.getElementById('video');
        video.addEventListener('click',function(){
          video.play();
        },false);
	*/
	/*
	    Image popup (home latest work)
	*/
	$('.view-work').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.parent('.work-bottom').siblings('img').attr('alt');
			}
		},
		callbacks: {
			elementParse: function(item) {
				item.src = item.el.attr('href');
			}
		}
	});
	
	/*
	    Flickr feed
	*/
	$('.flickr-feed').jflickrfeed({
        limit: 8,
        qstrings: {
            id: '52617155@N08'
        },
        itemTemplate: '<a href="{{link}}" target="_blank" rel="nofollow"><img src="{{image_s}}" alt="{{title}}" /></a>'
    });
	
	/*
	    Google maps
	*/
	var position = new google.maps.LatLng(45.067883, 7.687231);
    $('.map').gmap({'center': position,'zoom': 15, 'disableDefaultUI':true, 'callback': function() {
            var self = this;
            self.addMarker({'position': this.get('map').getCenter() });	
        }
    });
    
    /*
	    Subscription form
	*/
	$('.success-message').hide();
	$('.error-message').hide();
	
	$('.footer-box-text-subscribe form').submit(function(e) {
		e.preventDefault();
		
		var form = $(this);
	    var postdata = form.serialize();
	    
	    $.ajax({
	        type: 'POST',
	        url: 'assets/subscribe.php',
	        data: postdata,
	        dataType: 'json',
	        success: function(json) {
	            if(json.valid == 0) {
	                $('.success-message').hide();
	                $('.error-message').hide();
	                $('.error-message').html(json.message);
	                $('.error-message').fadeIn();
	            }
	            else {
	                $('.error-message').hide();
	                $('.success-message').hide();
	                form.hide();
	                $('.success-message').html(json.message);
	                $('.success-message').fadeIn();
	            }
	        }
	    });
	});
    
	
	
    /*
	    Contact form
	*/
    $('.contact-form form').submit(function(e) {
    	e.preventDefault();

    	var form = $(this);
    	var nameLabel = form.find('label[for="contact-name"]');
    	var emailLabel = form.find('label[for="contact-email"]');
    	var messageLabel = form.find('label[for="contact-message"]');
    	
    	nameLabel.html('Name');
    	emailLabel.html('Email');
    	messageLabel.html('Message');
        
        var postdata = form.serialize();
        
        $.ajax({
            type: 'POST',
            url: 'assets/contact.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.nameMessage != '') {
                	nameLabel.append(' - <span class="colored-text error-label"> ' + json.nameMessage + '</span>');
                }
                if(json.emailMessage != '') {
                	emailLabel.append(' - <span class="colored-text error-label"> ' + json.emailMessage + '</span>');
                }
                if(json.messageMessage != '') {
                	messageLabel.append(' - <span class="colored-text error-label"> ' + json.messageMessage + '</span>');
                }
                if(json.nameMessage == '' && json.emailMessage == '' && json.messageMessage == '') {
                	form.fadeOut('fast', function() {
                		form.parent('.contact-form').append('<p><span class="colored-text">Thanks for contacting us!</span> We will get back to you very soon.</p>');
                    });
                }
            }
        });
    });
	
});
	// DOM Ready
		$(function() {

			var totalHeight;

			$(".read-more .button").click(function() {
				var box = $(this).data('box');
				// measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
				$('.'+box).each(function() {
					totalHeight = $(this).height()+$(this).outerHeight();
					// FAIL totalHeight += $(this).css("margin-bottom");
				});
				console.log(totalHeight);
				$('.'+box)
					.css({
						// Set height to prevent instant jumpdown when max height is removed
						"max-height": 9999
					});

				// fade out read-more
				$(this).fadeOut();

				// prevent jump-down
				return false;

			});
		var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
		$(window).scroll(function(){
			if ($(this).scrollTop() > offset ) { $back_to_top.addClass('cd-is-visible'); } else { $back_to_top.removeClass('cd-is-visible cd-fade-out');}
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
				}, scroll_top_duration
			);
		});
		});

jQuery(window).load(function() {
	
	/*
	    Portfolio
	*/
	$('.portfolio-masonry').masonry({
		columnWidth: '.portfolio-box', 
		itemSelector: '.portfolio-box',
		transitionDuration: '0.5s'
	});
	
	$('.portfolio-filters a').on('click', function(e){
		e.preventDefault();
		if(!$(this).hasClass('active')) {
	    	$('.portfolio-filters a').removeClass('active');
	    	var clicked_filter = $(this).attr('class').replace('filter-', '');
	    	$(this).addClass('active');
	    	if(clicked_filter != 'all') {
	    		$('.portfolio-box:not(.' + clicked_filter + ')').css('display', 'none');
	    		$('.portfolio-box:not(.' + clicked_filter + ')').removeClass('portfolio-box');
	    		$('.' + clicked_filter).addClass('portfolio-box');
	    		$('.' + clicked_filter).css('display', 'block');
	    		$('.portfolio-masonry').masonry();
	    	}
	    	else {
	    		$('.portfolio-masonry > div').addClass('portfolio-box');
	    		$('.portfolio-masonry > div').css('display', 'block');
	    		$('.portfolio-masonry').masonry();
	    	}
		}
	});
	
	$(window).on('resize', function(){ $('.portfolio-masonry').masonry(); });
	
	// image popup	
	$('.portfolio-box h3').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.text();
			}
		},
		callbacks: {
			elementParse: function(item) {
				var box_container = item.el.parents('.portfolio-box-container');
				if(box_container.hasClass('portfolio-video')) {
					item.type = 'iframe';
					item.src = box_container.data('portfolio-big');
				}
				else {
					item.type = 'image';
					item.src = box_container.find('img').attr('src');
				}
			}
		}
	});
	
	/*
		Testimonial images
	*/
	$(".testimonial-image img").attr("style", "width: auto !important; height: auto !important;");
	
});
