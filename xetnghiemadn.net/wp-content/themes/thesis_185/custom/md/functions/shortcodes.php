<?php

/**
 * Shortcodes can be used throughout your entire
 * site. Improper use of them can break your site,
 * so please be sure to read the documentation at
 * Kolakube before using them.
 * http://kolakube.com/docs/using-md-shortcodes/
 */

// makes shortcodes work in designated widget area

add_filter('widget_text', 'do_shortcode');
add_filter('widget_title', 'do_shortcode');


// stupid editor fix

function shortcode_filter($content)
{   
	$array = array(
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
		return $content;
}
	add_filter('the_content', 'shortcode_filter');


// buttons

function md_button($atts, $content = null)
{
	extract(shortcode_atts(array(
		'link' => '',
		'color' => '',
		),$atts));
	
	return '<a href="' . $link . '" class="button ' . $color . '">' . do_shortcode($content) . '</a>';
}
	add_shortcode('button', 'md_button');

// alert

function md_alert($atts, $content = null)
{	
	return '<div class="alert_box">' . do_shortcode($content) . '</div>';
}
	add_shortcode('alert', 'md_alert');

// note

function md_note($atts, $content = null)
{	
	return '<div class="note_box">' . do_shortcode($content) . '</div>';
}
	add_shortcode('note', 'md_note');

// content block

function md_block($atts, $content = null)
{
	return '<div class="block">' . do_shortcode($content) . '</div>';
}
	add_shortcode('block', 'md_block');

// optin form

function md_optin($atts, $content = null)
{
	extract(shortcode_atts(array(
		'align' => ''
	), $atts));

	return '<div class="post_optin ' . $align . '">' . do_shortcode($content) . '</div>';
}
	add_shortcode('optin', 'md_optin');

// testimonial

function md_testimonial($atts, $content = null)
{
	extract(shortcode_atts(array(
		'picture' => '',
		'align' => '',
		'name' => '',
		'role' => ''
		), $atts));
	
	return
	'
		<div class="quote_box ' . $align . '">
			<div class="quote_content clear">
				<div class="detail_box">
					<img src="' . $picture . '" alt="' . $name . '" says&hellip;"/>
					<span class="name">' . $name . '</span>
					<span class="role">' . $role . '</span>
				</div>
				<div class="said_box">
					<p>' . do_shortcode($content) . '</p>
				</div>
			</div>
		</div>
	';
}
	add_shortcode('testimonial', 'md_testimonial');