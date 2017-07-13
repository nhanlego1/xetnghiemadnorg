<?php

/**
 * Call footer elements.
 */
function thesis_footer_area() {
	thesis_hook_before_footer();
	thesis_footer();
	thesis_hook_after_footer();
}

/**
 * Display primary footer content.
 */
function thesis_footer() {
	echo "\t<div id=\"footer\">\n";
	thesis_hook_footer();
	thesis_admin_link();
	wp_footer();
	echo "\t</div>\n";
	?>
<p id='scrolltop'></p>";
	<script>
	jQuery(document).ready(function(){
	var top = document.documentElement.scrollTop || document.body.scrollTop;
	if(top>0) jQuery('#scrolltop').css('opacity',0.8);
	jQuery(window).scroll(function(){
		var top = document.documentElement.scrollTop || document.body.scrollTop;
		if(top>0){
			jQuery('#scrolltop').css('opacity',0.8);
		}
		else{jQuery('#scrolltop').css('opacity',0);}
	});
	jQuery('#scrolltop').bind('click',function(){
	jQuery("body,html").animate({ scrollTop: 0 }, "slow");
	});
	});
	</script>
	<?php
}

/**
 * Display default Thesis attribution.
 */
function thesis_attribution() {
	echo "\t\t<p>" . sprintf(__('Get smart with the <a href="%s">Thesis WordPress Theme</a> from DIYthemes.', 'thesis'), 'http://diythemes.com/thesis/') . "</p>\n";
}