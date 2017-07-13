jQuery(document).ready(function(){
	
	$ = jQuery;	
    
    /*-----------------------------------------------------------------------------------*/
    /*	Cross Browser CSS Fixes
    /*-----------------------------------------------------------------------------------*/
	$("footer .footer-widget:last-child").css('marginRight',0);



    /*-----------------------------------------------------------------------------------*/
    /*	Services list count and add related class
     /*-----------------------------------------------------------------------------------*/
    $("ul.services").addClass("item-count-"+$("ul.services > li").size());



    /*-----------------------------------------------------------------------------------*/
    /*	Flex Slider Target
    /*-----------------------------------------------------------------------------------*/
    if(jQuery().flexslider)
	{
	    $('.flexslider').flexslider({
		    slideshowSpeed: 		4000,
			animationDuration:		1000,
			directionNav:			false,
			controlNav:				true,
			manualControls: 		".slide-nav li",
			keyboardNav:			false			
	    });

        $('.gallery-slider').flexslider({
            slideshowSpeed: 3000,
            animation: "slide",
            directionNav: false
        });
	}

	
    /*-----------------------------------------------------------------------------------*/
    /*	Testimonials author image round fix
    /*-----------------------------------------------------------------------------------*/
	$('.patients li .imgbox').each(function(index, element) {
			var img_src = $(this).children('img').attr('src');
			$(this).css('background-image','url('+img_src+')')
					.css('background-position','center')
					.css('background-repeat','no-repeat')
					.css('background-color','#e6e6e6');
			
			$(this).children('img').css('display','none');
	});

	
	

    /*-----------------------------------------------------------------------------------*/
    /*	jQuery UI Datepicker
    /*-----------------------------------------------------------------------------------*/
    if( jQuery().datepicker ){
	    $( "#apo_date" ).datepicker({ dateFormat: 'dd/mm/yy' });
	}
	
	
    /*-----------------------------------------------------------------------------------*/
    /*	Menu drop down Control
    /*-----------------------------------------------------------------------------------*/
	$('.main-nav li').hover(function(){
			$(this).children('ul').stop(true, true).slideDown(500);	
	},function(){
			$(this).children('ul').stop(true, true).delay(50).slideUp(500);
	});
		


    /* ---------------------------------------------------- */
    /*	Content Tabs
    /* ---------------------------------------------------- */
	(function(){

		var $tabsNav    = $('.tabs-nav'),
			$tabsNavLis = $tabsNav.children('li');

		$tabsNav.each(function(){
			var $this = $(this);
			$this.next().children('.tab-content').stop(true,true).hide()
												 .first().show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);
			$this.siblings().removeClass('active').end()
				 .addClass('active');
			var idx = $this.parent().children().index($this);			
			$this.parent().next().children('.tab-content').stop(true,true).hide().eq(idx).fadeIn();
			e.preventDefault();
		});
		
	})();



    /* ---------------------------------------------------- */
    /*	Accordion
    /* ---------------------------------------------------- */
    (function(){
	    $('.accordion h5').click(function(){
		    if(!$(this).hasClass('current')){
			    var $this = $(this);
			    var tabNumber = $this.index();
			    $this.siblings('.pane.current').slideUp(500, function(){ $(this).removeClass('current'); });
			    $this.next('.pane').slideDown(500,function(){ $(this).addClass('current'); });
			    $this.siblings('h5.current').removeClass('current');
			    $this.addClass('current');
		    }
	    });
	})();
	


    /*-----------------------------------------------------------------------------------*/
    /*	Pretty Photo
    /*-----------------------------------------------------------------------------------*/
    if( jQuery().prettyPhoto ){
	        $(".pretty-photo").prettyPhoto({
				deeplinking: false,
				social_tools: false
			});

            $('a[data-rel]').each(function() {
                $(this).attr('rel', $(this).data('rel'));
            });

            $("a[rel^='prettyPhoto']").prettyPhoto({
                deeplinking: false,
                social_tools: false
            });
	}



    /*-----------------------------------------------------------------------------------*/
    /*	FAQ Code
    /*-----------------------------------------------------------------------------------*/
	// on page load	
	$('.faq-unit').not('.faq-unit.active').find('.faq-answer').slideUp('slow');
	$('.faq-unit').first().addClass('active').find('.faq-answer').slideDown('slow');
	
	$('.faq-unit').click(function(e){		
		var $this = $(this);
		if( !$this.hasClass('active') )
		{
			$('.faq-unit.active').removeClass('active').find('.faq-answer').slideUp('slow');		
			$this.addClass('active').find('.faq-answer').slideDown('slow');
		}
	});


    /*-----------------------------------------------------------------------------------*/
    /*	Isotope
    /*-----------------------------------------------------------------------------------*/
	    
	    jQuery(function() {

            var container = jQuery('.isotope'),
                filterLinks = jQuery('#filter-by a');
            
            filterLinks.click(function(e){
                var selector = jQuery(this).attr('data-filter');
                container.isotope({ 
                    filter : '.' + selector, 
                    itemSelector : '.isotope-item',
                    layoutMode : 'fitRows',
                    animationEngine : 'best-available'
                });
                
                filterLinks.removeClass('active');
				jQuery('#filter-by li').removeClass('current-cat');
                jQuery(this).addClass('active');
               	e.preventDefault();
            });
            
	    });


    /*-----------------------------------------------------------------------------------*/
    /*	Scroll to Top
    /*-----------------------------------------------------------------------------------*/
		jQuery(function() {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 50) {
					$('a#scroll-top').fadeIn();
				} else {
					$('a#scroll-top').fadeOut();
				}
			});
			
			$('a#scroll-top').on('click', function(){
				$('html, body').animate({scrollTop:0}, 'slow' );
				return false;
			});
		});


    /*-----------------------------------------------------------------------------------*/
    /*	Responsive Nav
     /*-----------------------------------------------------------------------------------*/
    var $mainNav    = $('.main-nav .menu-div').children('ul');
    var optionsList = '<option value="" selected>'+ localized.nav_title +'</option>';

    $mainNav.find('li').each(function() {
        var $this   = $(this),
            $anchor = $this.children('a'),
            depth   = $this.parents('ul').length - 1,
            indent  = '';
        if( depth ) {
            while( depth > 0 ) {
                indent += ' - ';
                depth--;
            }
        }
        optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
    }).end()
        .after('<select class="responsive-nav">' + optionsList + '</select>');

    $('.responsive-nav').on('change', function() {
        if($(this).val() != 'undefined'){
            window.location = $(this).val();
        }
    });



    /*----------------------------------------------------------------------------------*/
    /*	Form AJAX validation and submition
     /*  Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
     /*	Form Ajax Plugin : http://www.malsup.com/jquery/form/
     /*---------------------------------------------------------------------------------- */
    if( jQuery().validate ){

        // Contact Options
        var contact_options = {
            target: '#message-sent',
            beforeSubmit: function(){
                $('#contact-loader').fadeIn('fast');
                $('#message-sent').fadeOut('fast');
            },
            success: function(responseText, statusText, xhr, $form){

                $('#contact-loader').fadeOut('fast');
                $('#message-sent').fadeIn('fast');

                if( responseText == localized.wrong_code )
                {
                    // wrong code - so do not reset form and display message
                }
                else
                {
                    $('#contact-form').resetForm();
                }
            }
        };

        // Contact Form AJAX Function
        $("#contact-form").validate({
            errorLabelContainer: $("#contact-form div.error-container"),
            submitHandler: function(form) {
                $(form).ajaxSubmit(contact_options);
            }
        });


        // Appointment Form Options
        var appointment_options = {
            target: '#apo-message-sent',
            beforeSubmit: function(){
                $('#apo-loader').fadeIn('fast');
                $('#apo-message-sent').fadeOut('fast');
            },
            success: function(responseText, statusText, xhr, $form){

                $('#apo-loader').fadeOut('fast');
                $('#apo-message-sent').fadeIn('fast');

                if( responseText == localized.wrong_code )
                {
                    // wrong code - so do not reset form and display message
                }
                else
                {
                    $('#appoint-form').resetForm();
                }

            }
        };


        // Appointment Form AJAX Function
        $("#appoint-form").validate({
            errorLabelContainer: $("#appoint-form .error-container"),
            submitHandler: function(form) {
                $(form).ajaxSubmit(appointment_options);
            }
        });

        // Newsletter Form
        $('#newsletter').validate({
            errorLabelContainer: $("#newsletter .error-container")
        });

    }

});

