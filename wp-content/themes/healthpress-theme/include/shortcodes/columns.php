<?php

/* ------------------------------------------------------------------------*
 * COLUMNS
 * ------------------------------------------------------------------------*/

// columns wrapper
function show_columns($atts, $content = null) {
	return '<div class="columns">'.do_shortcode($content).'</div>';
}
add_shortcode('columns', 'show_columns');


// one third column
function show_one_third($atts, $content = null) {
	return '<div class="one-third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'show_one_third');


// two third column
function show_two_third($atts, $content = null) {
	return '<div class="two-third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'show_two_third');


// one fourth column
function show_one_fourth($atts, $content = null) {
	return '<div class="one-fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'show_one_fourth');


// three fourth column
function show_three_fourth($atts, $content = null) {
	return '<div class="three-fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'show_three_fourth');


// two column
function show_two_column($atts, $content = null) {
	return '<div class="one-half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'show_two_column');


// single column
function show_single_column($atts, $content = null) {
	return '<div class="single-col">'.do_shortcode($content).'</div>';
}
add_shortcode('single_column', 'show_single_column');

?>