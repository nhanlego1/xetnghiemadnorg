<?php

/**
 * It's important you don't edit anything in this file.
 * This is what makes Marketers Delight run, and modifying
 * anything in it could break functionality or make upgrading
 * a huge headache in the future.
 *
 * Please add custom code to custom_functions.php
 */

// security

if(!defined('ABSPATH'))
	die('Please do not directly access this file');


// run kolakube options

function kol_option($option)
{
	$options = get_option('kol_options');
	if(isset($options[$option]))
		return $options[$option];
	else
		return false;
}

// constants
define('THEME_NAME', 'Marketers Delight');
define('THEME_VERSION', '2.2.5');
define('THEME_OPTIONS_PAGE', 'marketers-delight');
define('USER_ACCOUNT', 'http://kolakube.com/forum/index.php?app=nexus&module=clients/');
define('SUPPORT_URL', 'http://kolakube.com/forum/');
define('THEME_DOCS', 'http://kolakube.com/docs/');
define('KOL_ATT_LINK', 'http://kolakube.com/forum/index.php?/store/product/4-attribution-link-removal/');
define('KOL_AFF_PROG', 'http://kolakube.com/affiliates/');
define('THESIS_ATT_LINK', 'http://diythemes.com/plans/');
define('THESIS_AFF_PROG', 'http://diythemes.com/affiliate-program/');

// admin
require_once('admin/admin_options.php');
require_once('admin/meta_boxes.php');
include('admin/profile_fields.php');

// walker
include('functions/walker.php');

// shortcodes
include('functions/shortcodes.php');

// pagination
include('functions/pagination.php');

// widgets
include('widgets/optin.php');
include('widgets/quotes.php');
include('widgets/affiliate.php');
include('widgets/popular_articles.php');
include('widgets/orb.php');

// md class

class kol_marketers_delight extends thesis_custom_loop
{
	// start engine

	public function __construct()
	{
		parent::__construct();
		
		add_action('init', array($this, 'init'));
	}

	// initalize class

	public function init()
	{
		$this->actions();
		$this->filters();
		$this->switch_skin();
		$this->menus();
		$this->widgets();
	}

	// hook functions in

	public function actions()
	{
		global $thesis_design;

		// load scripts
		add_action('thesis_hook_after_html', array($this, 'load_scripts'));
		// meta tags
		add_action('wp_head', array($this, 'meta_tags'), 1);
		// clear custom template
		remove_action('thesis_hook_custom_template', 'thesis_custom_template_sample');
		// flip nav + logo
		remove_action('thesis_hook_before_header', 'thesis_nav_menu');
		add_action('thesis_hook_header', array($this, 'header_menu'), 1);
		// remove comments
		remove_action('thesis_hook_after_post', 'thesis_comments_link');
		// add twitter byline
		add_action('thesis_hook_byline_item', array($this, 'twitter_byline'));
		// share buttons
		if(kol_option('blog_share'))
		{
			add_action('thesis_hook_after_post', array($this, 'share_buttons'));
			add_action('thesis_hook_after_headline', array($this, 'share_buttons'));
			add_action('thesis_hook_after_html', array($this, 'share_js'));
		}
		// author box
		add_action('thesis_hook_after_post', array($this, 'author_box'));
		// post footer
		add_action('thesis_hook_after_post_box', array($this, 'post_footer'));
		add_action('thesis_hook_after_post_box', array($this, 'after_post'));
		// pagination
		remove_action('thesis_hook_after_content', 'thesis_post_navigation');
		add_action('thesis_hook_after_content', array($this, 'pagination'));
		// remove footer attribution
		remove_action('thesis_hook_footer', 'thesis_attribution');
		// footer
		add_action('thesis_hook_footer', array($this, 'footer'));
		// landing page
		add_action('template_redirect', array($this, 'landing_page'));
		// full-width
		if($thesis_design->layout['framework'] == 'full-width')
		{
			add_action('thesis_hook_before_content_area', array($this, 'menu_area'), 1);
			add_action('thesis_hook_before_content_area', array($this, 'feature_box'), 2);
			add_action('thesis_hook_before_content_area', array($this, 'page_leads'));
		}
		// page-width
		else
		{
			add_action('thesis_hook_after_header', array($this, 'menu_area'), 1);
			add_action('thesis_hook_after_header', array($this, 'feature_box'), 2);
			add_action('thesis_hook_after_header', array($this, 'page_leads'));
		}
	}

	// filters

	public function filters()
	{
		// filters style.css
		add_filter('thesis_css', array($this, 'css'), 11, 4);
		// html5 doctype
		add_filter('thesis_doctype', array($this, 'html5_doctype'));
		// remove profile attribute from head
		add_filter('thesis_head_profile', array($this, 'filter_content'));
		// body classes
		add_filter('thesis_body_classes', array($this, 'body_classes'));
		// filter sidebars
		add_filter('thesis_show_sidebars', array($this, 'no_sidebars'));
	}

	// dynamic css

	public function css($contents, $thesis_css, $style, $multisite)
	{
		global $thesis_design, $thesis_header;

		// background pattern
		if(kol_option('design_background') != 'no-background')
			$md_css .= "\n\n/*---:[ background pattern ]:---*/\n"
				. "body." . kol_option('design_background') . " { background-image: url(md/images/textures/" . kol_option('design_background') . ".png) }";

		// full-width framework
		if($thesis_design->layout['framework'] == 'full-width')
			$md_css .= "\n\n/*---:[ full-width framework ]:---*/\n"
				. ".full_width > .page { background: transparent }\n"
				. "#header_area { background: #fff url(md/images/textures/soft_shadow.png) repeat-x bottom; border-bottom: 1px solid #b6b6b6; -moz-box-shadow: 0 0 4px 2px #ccc; -webkit-box-shadow: 0 0 4px 2px #ccc; box-shadow: 0 0 4px 2px #ccc }\n"
				. "#content_box { margin: 3em 0 }\n"
				. "#content { background: #fff; border: 1px solid #b6b6b6; margin: -1px; -moz-box-shadow: 0 0 4px rgba(0, 0, 0, .2); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, .2); box-shadow: 0 0 4px rgba(0, 0, 0, .2) }\n"
				. ".post_box, #archive_intro { background: url(md/images/textures/soft_shadow.png) repeat-x bottom }\n"
				. "#footer_area { background: #333 url(md/images/textures/soft_noise.png) }\n";

		// page framework
		if($thesis_design->layout['framework'] == 'page')
			$md_css .= "\n\n/*---:[ page framework ]:---*/\n"
				. "#container { background: #fff; -moz-box-shadow: 0 0 10px rgba(0, 0, 0, .3); -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .3); box-shadow: 0 0 10px rgba(0, 0, 0, .3) }\n"
				. "#page { background: transparent }\n"
				. "\t#header { border-bottom: 1px solid #b6b6b6; -moz-box-shadow: inset 0 -3px 3px rgba(0, 0, 0, .05); -webkit-box-shadow: inset 0 -3px 3px rgba(0, 0, 0, .05); box-shadow: inset 0 -3px 3px rgba(0, 0, 0, .05) }\n"
				. "\t.post_box, #archives_intro { background: none; border: 0 }\n"
				. "#comments { border: 1px solid #ddd; border-width: 1px 1px 0 0 }\n"
				. "#footer { background: #333 url(md/images/textures/soft_noise.png) }\n";

		// logo
		$md_css .= "\n/*---:[ logo ]:---*/\n"
			. "#header { background: none; height: auto }\n"
			. "\t#header #logo { padding: " . round(($thesis_header->header['height'] / $thesis_css->base['num']) * 10 / 5, 3) . "px 32px }\n"
			. "\t\t\t#header #logo a { background: url(" . $thesis_header->header['url'] . ") no-repeat 50% 50% }\n";

		// header menu
		$md_css .= "#header .menu { padding-top: " . round(($thesis_header->header['height'] / $thesis_css->base['num']) * 10 / 2.5, 3) . "px }\n";

		// main menu
		if(has_nav_menu('main'))
		{
			$md_css .= "\n/*---:[ main menu ]:---*/\n"
				. "#menu_area." . kol_option('design_menu_theme') . " { border: 1px solid rgba(0, 0, 0, .2); border-width: 1px 0; margin: -1px 0 }\n"
				. "\t#menu_area." . kol_option('design_menu_theme') . " ul > li { border-left: 1px solid rgba(255, 255, 255, .25); border-right: 1px solid rgba(0, 0, 0, .2) }\n";
		
			if(kol_option('design_menu_theme') == 'menu-md')
				$md_css .= "#menu_area.menu-md a, #menu_area.menu-md .sub-menu a { color: #232323 }\n"
					. "#menu_area .sub-menu { background: #cdcdcd }\n";
			elseif(kol_option('design_menu_theme') == 'menu-red')
				$md_css .= "#menu_area .sub-menu { background: #b30000 }\n";
			elseif(kol_option('design_menu_theme') == 'menu-orange')
				$md_css .= "#menu_area .sub-menu { background: #f76d10 }\n";
			elseif(kol_option('design_menu_theme') == 'menu-blue')
				$md_css .= "#menu_area .sub-menu { background: #1187b7 }\n";
			elseif(kol_option('design_menu_theme') == 'menu-green')
				$md_css .= "#menu_area .sub-menu { background: #259435 }\n";
			elseif(kol_option('design_menu_theme') == 'menu-dark')
				$md_css .= "#menu_area .sub-menu { background: #353535 }\n";

			if(kol_option('nav_disable_search'))
				$md_css .= "\n/*---:[ main menu search form ]:---*/\n"
					. "#menu_area #searchform { float: right; margin: .8em 3.2em 0 0 }\n"
					. "\t#menu_area #searchform input[type=\"text\"] { background: #fff url(md/images/search.png) no-repeat 16px center; border: 0; font-size: 1.3em; padding-left: 3.076em; -moz-border-radius: 15px; -webkit-border-radius: 15px; border-radius: 15px; -moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, .25); -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, .25); box-shadow: 1px 1px 1px rgba(0, 0, 0, .25) }\n";
		}

		// author box
		if(kol_option('pf_author'))
			$md_css .= "\n/*---:[ author box ]:---*/\n"
				. "#author_box { border-top: 1px solid #ddd; clear: both; font-size: .938em; line-height: 1.533em; margin: 22px -32px 0 -32px; padding: 22px 32px 0 }\n"
				. "\t#author_box .author_image { float: left; margin-right: 3%; width: 13% }\n"
				. "\t#author_box .author_info { float: left; width: 84% }\n"
				. "\t#author_box img { -moz-border-radius: 40px; -webkit-border-radius: 40px; border-radius: 40px }\n";

		// fat footer
		if(kol_option('fat_footer'))
			$md_css .= "\n/*---:[ fat footer ]:---*/\n"
				. "#fat_footer { border-bottom: 1px solid rgba(0, 0, 0, .2); list-style: none; margin-bottom: 3em }\n"
				. "\t#fat_footer .column_wrap { float: left; margin: 0 5% 2.857em 0; width: 30% }\n"
				. "\t#fat_footer .widget { font-size: 1.4em; margin-bottom: 2.857em }\n"
				. "\t\t#footer #fat_footer .widget p { line-height: 1.429em; margin-bottom: 1.429em }\n"
				. "\t/* quote box */\n"
				. "\t#fat_footer .quote_box { border: 1px solid #222; color: #232323; -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, .4); -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, .4); box-shadow: 0 2px 2px rgba(0, 0, 0, .4) }\n"
				. "\t\t#fat_footer .quote_box:before { border-color: #222 transparent transparent #222 }\n"
				. "\t/* optin */\n"
				. "\t#fat_footer .widget.optin .social_proof { background-image: none }\n"
				. "\t/* orb */\n"
				. "\t#fat_footer .orb h3 { font-size: 19px; line-height: 27px }\n"
				. "\t/* popular */\n"
				. "\t#fat_footer .popular ul { border: 1px solid #222; margin-left: 0 }\n"
				. "\t#fat_footer .popular a { border: 0; color: #ae2525 }\n"
				. "\t/* affiliate */\n"
				. "\t#footer .widget.affiliate h3 { margin-bottom: 0 }\n"
				. "\t#fat_footer .affiliate_box { border: 1px solid #111; color: #232323 }\n"
				. "\t\t#fat_footer .affiliate_box .button:hover { color: #fff }\n"
				. "\t\t\t#fat_footer .affiliate_box a { color: #ae2525 }\n"
				. "\t/* styles */\n"
				. "\t#fat_footer h3 { font-size: 20px; line-height: 28px; margin-bottom: 8px }\n"
				. "\t#fat_footer .button, #fat_footer input { border: 1px solid rgba(0, 0, 0, .7) }\n";

		// kolakube copyright
		if(kol_option('foot_disable_kol_attr') == 0)
			$md_css .= "\n/*---:[ kolakube copyright ]:---*/\n"
				. "#footer a.kolakube { background: url(md/images/footer-copyright.png); display: inline-block; height: 19px; margin: 0 0 -5px 5px; width: 131px }\n"
				. "\t#footer a.kolakube span { left: -999em; position: absolute }\n";

		// landing page
		$md_css .= "\n/*---:[ landing page ]:---*/\n"
			. ".landing .full_width .page, .landing #container { width: " . round((($thesis_css->layout['widths']['content'] + $thesis_css->widths['post_box_margin_left'] + $thesis_css->widths['post_box_margin_right']) / $thesis_css->base['num']), 1) . "em }\n";

		// responsive resets
		if(kol_option('design_reponsive_toggle'))
			$md_css .= "\n\n/*---:[ responsive resets ]:---*/\n"
				. "@media screen and (max-width: " . round((($thesis_css->widths['container'] + ($thesis_css->base['page_padding'] * 2)) / $thesis_css->base['num']) * 10, 1) . "px) {\n"
				. "\t.custom .full_width .page, #column_wrap, #content, #sidebars, #sidebar_1, #sidebar_2, .custom #container, .custom #image_box img { width: 100% }\n"
				. "\t.custom .full_width, #container { overflow: hidden; padding: 0 }\n"
				. "\t#header_area .page, #footer_area .page { padding: 0 }\n"
				. ".custom #header { padding-top: 0 }\n"
				. "\t.custom #header .menu { margin-right: 0 }\n"
				. "\tinput[type=\"submit\"] { width: auto!important }\n"
				. "\t#header #logo a { height: auto; margin: 0 auto; margin: " . round(($thesis_header->header['height'] / $thesis_css->base['num']) * 10 / 5, 3) . "px auto; max-width: 100%; -moz-background-size: cover; -webkit-background-size: cover; background-size: cover }\n"
				. "\t.sub-menu, #searchform, .headline_area .share { display: none /* woops */ }\n"
				. "\t.custom #header .menu { float: none; margin-top: 0; padding-top: 0 }\n"
				. "\t\t.custom #header .menu li, .custom #menu_area .menu li { border: 1px solid rgba(0, 0, 0, .1); border-width: 0 1px 1px 0; float: left; margin: 0 -1px 0 0; text-align: center; width: 25% }\n"
				. "\t\t\t.custom #header .menu li:nth-child(4), .custom #menu_area .menu li:nth-child(4) { border-right: 0; margin: 0 }\n"
				. "\t\t\t.custom #header .menu li.button, .custom #menu_area .menu li.button { border-width: 0 1px 0 0; border-radius: 0; padding: 0 }\n"
				. "\t\t\t.custom #header .menu li a { padding: .4em }\n"
				. "\t\t.custom #menu_area { border-bottom: 0 }\n"
				. "\t\t\t.custom #menu_area .menu li a { padding: .8em 0 }\n"
				. "\t\t\t.custom #header .menu li a:hover, .custom #menu_area .menu li a:hover { background: rgba(0, 0, 0, .8); color: #fff }\n"
				. "\t.custom #menu_area .menu, .custom #menu_area .menu li a span { float: none; margin: 0; text-shadow: none }\n"
				. "\t.custom .table_chart_lead .dark, .custom .table_chart_lead .light { float: none; width: 97.8% }\n"
				. "\t.custom .table_chart_lead .light { margin-top: 0 }\n"
				. "\t.custom .table_chart_lead .dark { margin: 2.2em 0 }\n"
				. "\t.custom .orb_area_lead #orb_lead .format_text, .custom .column_box_lead #column_lead .format_text { float: none; margin: 0; width: 100% }\n"
				. "\t.landing #header_area { background-image: none; border-bottom: 0 }\n"
				. "\t.landing #content_box { margin-bottom: 0 }\n"
				. "\t#content_box { margin-top: 0 }\n"
				. "\t#column_wrap, #content { border: 0; float: none }\n"
				. "\t.teasers_box { margin: 0 5%; width: 90% }\n"
				. ".teaser { margin-right: 5%; width: 45% }\n"
				. ".teaser_right { margin: 0 }\n"
				. "\t.sidebar ul.sidebar_list { margin-right: -5% }\n"
				. "\tli.widget { float: left; margin-right: 5%; width: 45% }\n"
				. "\t.custom #multimedia_box { padding: 0 }\n"
				. "\t\t.custom .widget.affiliate .affiliate_box .feat_image_box { text-align: center }\n"
				. "\t.quote_box .detail_box { margin-bottom: 12px }\n"
				. "#fat_footer .column_wrap { float: none; margin-right: 0; width: 100% }\n"
				. ".custom #footer_copy span, #commentform input[type=\"text\"] { float: none; text-align: left }\n"
				. "\n}\n\n"

				. "@media screen and (max-width: " . round((($thesis_css->widths['container'] + ($thesis_css->base['page_padding'] * 2)) / $thesis_css->base['num']) * 10 / 1.5, 1) . "px) {\n"
				. "\tinput, input[type=\"submit\"] { width: 100%!important }\n"
				. "\tinput[type=\"text\"] { padding: 11px 0!important; text-align: center }\n"
				. "\t.custom #header .menu li, .custom #menu_area .menu li { width: 50% }\n"
				. "\t.custom #menu_area .menu li a span { display: none } /* woops */\n"
				. "\t#lead_area, #after_post { text-align: center }\n"
				. "\t.custom .feature_box_lead #feature_box.spacing { padding-left: 3.2em }\n"
				. "\t.custom .feature_box_lead #feature_box .ribbon { margin: -32px auto 32px; position: static }\n"
				. "\t.custom .format_text .quote_box.featured .detail_box, .custom .format_text .quote_box.featured .said_box, .custom .widget.affiliate .affiliate_box .feat_image_box, .custom .widget.affiliate .affiliate_box .desc_box, .custom .quote_box .detail_box, .custom .quote_box .said_box { float: none; margin-right: 0; width: 100% }\n"
				. "\t.teasers_box { padding: 0 }\n"
				. "\t.teasers_box.top { padding-top: 2.2em }\n"
				. "\t.teaser { float: none; padding-bottom: " . round(($thesis_css->line_heights['content'] / $thesis_css->base['num']), 1) . "em; width: 100% }\n"
				. "\t.sidebar ul.sidebar_list { margin-right: 0 }\n"
				. "\tli.widget { float: none; margin-right: 0; width: 100% }\n"
				. "\t.custom .wp-caption, .custom img.alignleft, .custom img.left, .custom img.alignright, .custom img.right, .custom img[align=\"left\"], .custom img[align=\"right\"] { clear: both; display: block; float: none; margin-left: auto; margin-right: auto }\n"
				. "\n}\n\n";

		// include everything but style.css
		$md_default = @file_get_contents(THESIS_CUSTOM . '/md/css/marketers-delight.css');
		$css = $thesis_css->fonts_to_import . $this->css_reset . $thesis_css->css . $md_css . $md_default;
		
		// return new stylesheet
		return $css;
	}

	// generate css in absense of after_switch_theme

	public function switch_skin()
	{
		if(is_admin() && !get_option(__CLASS__ . '_generate'))
		{
			thesis_generate_css();
			update_option(__CLASS__ . '_generate', 1);
			wp_cache_flush();
		}
		else return null;
	}

	// meta tags

	public function meta_tags()
	{
		// scales site for mobile devices
		if(kol_option('design_reponsive_toggle'))
		{
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' . "\n";
			echo '<meta name="viewport" content="width=device-width">' . "\n";
		}	
	}

	// register md menus

	public function menus()
	{
		register_nav_menus(array(
			'primary' => 'Header Menu',
			'main' => 'Main Menu'
		));
	}

	// register widgets

	public function widgets()
	{
		// footer

		if(kol_option('fat_footer'))
		{
			register_sidebar(array(
				'name' => 'Footer Column 1',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'=>'<h3>',
				'after_title'=>'</h3>'
			));

			register_sidebar(array(
				'name' => 'Footer Column 2',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'=>'<h3>',
				'after_title'=>'</h3>'
			));

			register_sidebar(array(
				'name' => 'Footer Column 3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'=>'<h3>',
				'after_title'=>'</h3>'
			));
		}
	}

	// apply this to remove any filterable element

	function filter_content($content)
	{
		return '';
	}

	// html5 doctype

	public function html5_doctype($content)
	{
		return '<!DOCTYPE html>';
	}

	// body classes

	public function body_classes($classes)
	{
		global $post;

		if(kol_option('design_background') != 'no-background')
			$classes[] .= kol_option('design_background');
		
		if(get_post_meta($post->ID, 'kol_page_leads', true) == 'landing_page_template')
			$classes[] .= 'landing';

		return $classes;
	}

	// load scripts

	/**
	 * NOTE: script enqueue is a little clunky in
	 * thesis, so this is the *temporary* alternative
	 */

	public function load_scripts()
	{
		echo '<script src="' . THESIS_CUSTOM_FOLDER . '/md/js/md-scripts.js"></script>';		
	}

	// header menu

	public function header_menu()
	{
		global $thesis_site;

		if(function_exists('wp_nav_menu') && $thesis_site->nav['type'] == 'wp')
		{
			$args = array(
				'theme_location' => 'primary',
				'container' => '',
				'fallback_cb' => 'thesis_nav_default'
			);
			wp_nav_menu($args);
			echo "\n";
		}
		else
			thesis_nav_default();
	}

	// main menu

	public function menu_area()
	{
		global $thesis_design;

		if(has_nav_menu('main'))
		{
		?>
			<div id="menu_area" class="<?php if($thesis_design->layout['framework'] == 'full-width') { echo 'full_width '; } echo kol_option('design_menu_theme'); ?> clear">
				<?php if($thesis_design->layout['framework'] == 'full-width') { echo '<div class="page">'; } ?>
					<?php if(kol_option('nav_disable_search')) { ?>
						<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/">
							<input type="text" size="23" value="Search" name="s" />
						</form>
					<?php } ?>
					<?php
						wp_nav_menu(array(
							'theme_location' => 'main',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container' => '',
							'walker' => new md_custom_walker
						));
					?>
				<?php if($thesis_design->layout['framework'] == 'full-width') { echo '</div>'; } ?>
			</div>
		<?php
		}
	}

	// feature box

	public function feature_box()
	{
		global $thesis_design;

		$fb_optin = kol_option('fb_optin');
		$fb_ribbon = kol_option('fb_ribbon_text');

		if(is_home())
		{
			if(kol_option('fb_on'))
			{
			?>
				<div id="lead_area" class="feature_box_lead <?php if($thesis_design->layout['framework'] == 'full-width') echo 'full_width '; if(kol_option('feature_red')) echo 'feature_red'; else echo 'feature_dark'; ?>">
					<?php if($thesis_design->layout['framework'] == 'full-width') { echo '<div class="page">'; } ?>
						<div id="feature_box" class="<?php if(kol_option('fb_ribbon_text')) { echo 'spacing '; } ?>clear">
							<div class="format_text">
								<?php if(kol_option('fb_ribbon_text')) { echo '<span class="ribbon">' . kol_option('fb_ribbon_text') . '</span>'; } ?>
								<?php if($fb_optin) { echo wpautop($fb_optin); } ?>
							</div>
						</div>
					<?php if($thesis_design->layout['framework'] == 'full-width') { echo '</div>'; } ?>
				</div>
			<?php
			}
		}
	}

	// add twitter byline

	public function twitter_byline()
	{
		if(get_the_author_meta('md_twitter'))
		{
		?>
			<a href="http://twitter.com/<?php echo get_the_author_meta('md_twitter'); ?>" class="twitter_byline"><?php _e('Follow me on Twitter'); ?></a>
		<?php
		}
	}

	// share buttons

	public function share_buttons()
	{
		global $post;

		if(!is_home() && !is_search() && !is_archive())
		{
			if(!get_post_meta($post->ID, 'kol_share_buttons', true))
			{
			?>
				<div class="share clear">
					<p><a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo kol_option('share_twitter'); ?>" data-count="vertical">Tweet</a></p>

					<p><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=box_count&amp;show_faces=false&amp;width=120&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:50px; height:63px"></iframe></p>

					<p><g:plusone size="tall" href="<?php the_permalink(); ?>"></g:plusone></p>

					<p><?php echo kol_option('blog_custom_share'); ?></p>
				</div>
			<?php
			}
		}
	}

	// share js

	public function share_js()
	{
		global $wp_query;
		$postid = $wp_query->post->ID;

		if(!get_post_meta($postid, 'kol_share_buttons', true) || is_home() || is_archive() || is_search())
			echo '
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<script>(function(){var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);})();</script>
			';
	}

	// author box

	public function author_box()
	{
		if(is_single())
		{
			$md_twitter = get_the_author_meta('md_twitter');
			$md_url = get_the_author_meta('user_url');

			if(kol_option('pf_author'))
			{
			?>
				<div id="author_box" class="clear">
					<div class="author_image">
						<?php echo get_avatar(get_the_author_id(), 80); ?>
					</div>
					<div class="author_info">
						<p><strong><?php _e('About'); ?> <?php the_author(); ?></strong><br /><?php the_author_description(); ?></p>
						<?php if(!empty($md_twitter) || !empty($md_url)) { ?>
							<p class="author_meta">
								<?php if($md_twitter) { ?>
									<a href="http://twitter.com/<?php echo $md_twitter; ?>"><?php _e('Follow me on Twitter'); ?></a> &middot;
								<?php } ?>
								<?php if($md_url) { ?>
									<a href="<?php echo $md_url; ?>"><?php _e('Visit my website &rarr;'); ?></a>
								<?php } ?>
							</p>
						<?php } ?>
					</div>
				</div>
			<?php
			}
		}
	}

	// post footer

	public function post_footer()
	{
		$pf_content = kol_option('pf_content');

		if(is_single())
		{
			if($pf_content)
			{
			?>
				<div id="after_post" class="post_box">
					<?php if($pf_content) { ?>
						<div class="format_text">
							<?php echo wpautop($pf_content); ?>
						</div>
					<?php } ?>
				</div>
			<?php
			}
		}
	}

	// after post

	public function after_post($post_count)
	{
		$pf_content = kol_option('pf_content');

		if(is_home())
		{
			if($post_count == kol_option('blog_after_post_number'))
			{
			?>
				<div id="after_post" class="post_box">
					<?php if($pf_content) { ?>
						<div class="format_text">
							<?php echo wpautop($pf_content); ?>
						</div>
					<?php } ?>
				</div>
			<?php
			}
		}
	}

	// pagination

	public function pagination()
	{
		md_blog_pagination_build();
	}

	// footer

	function footer()
	{
		global $post;

		$foot_content = kol_option('foot_content');
	?>
		<?php if(kol_option('fat_footer') == 1) { ?>
			<?php if(get_post_meta($post->ID, 'kol_page_leads', true) != 'landing_page_template') { ?>
				<div id="fat_footer" class="clear">
					<div class="column_wrap">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 1')); ?>
					</div>
					<div class="column_wrap">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 2')); ?>
					</div>
					<div class="column_wrap last">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Column 3')); ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<div id="footer_copy">
			<?php

				/**
				 * stop stop stop. don't delete anything below. you can do this in the skin options panel
				 * without worrying about ruining any code.
				 *******
				 * ONLY remove these attribution links IF you have the proper licensing.
				 */

				if(kol_option('foot_disable_kol_attr') == 0 || kol_option('foot_disable_thesis_attr') == 0)
				{
				?>
					<span>
						<?php
							if(kol_option('foot_disable_thesis_attr') == 0) { echo 'Built on <a href="' . kol_option('foot_thesis_link') . '">Thesis</a>'; }
							if(kol_option('foot_disable_kol_attr') == 0) { echo '&nbsp;&nbsp;<a class="kolakube" href="' . kol_option('foot_kolakube_link') . '"><span>Kolakube</span></a>'; }
						?>
					</span>
				<?php
				}
			?>
			<?php echo wpautop($foot_content); ?>
		</div>
	<?php
	}

	// page leads

	public function page_leads()
	{
		global $post, $thesis_design;

		if(is_page())
		{
			if(get_post_meta($post->ID, 'kol_page_leads', true) != 'no_lead')
			{
			?>
				<div id="lead_area" class="<?php echo get_post_meta($post->ID, 'kol_page_leads', true); if($thesis_design->layout['framework'] == 'full-width') echo ' full_width'; if(get_post_meta($post->ID, 'kol_page_leads', true) == 'feature_box_lead') { if(get_post_meta($post->ID, 'kol_feature_red', true)) echo ' feature_red'; else echo ' feature_dark'; } ?>">
				<?php if($thesis_design->layout['framework'] == 'full-width') { echo '<div class="page">'; } ?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'feature_box_lead')
					{
						$fb_content = get_post_meta($post->ID, 'kol_feature_content', true);
					?>
						<div id="feature_box" class="<?php if(get_post_meta($post->ID, 'kol_feature_ribbon', true)) echo 'spacing '; ?>clear">
							<div class="format_text">
								<?php if(get_post_meta($post->ID, 'kol_feature_ribbon', true)) { echo '<span class="ribbon">' . get_post_meta($post->ID, 'kol_feature_ribbon', true) . '</span>'; } ?>
								<?php if($fb_content) { echo wpautop($fb_content); } ?>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'standard_box_lead')
					{
						$standard_content = get_post_meta($post->ID, 'kol_standard_content', true);
					?>
						<div id="standard_lead" class="clear">
							<?php if(get_post_meta($post->ID, 'kol_standard_content', true)) { ?>
							<div class="format_text">
								<?php echo wpautop($standard_content); ?>
							</div>
							<?php } ?>
						</div>
					<?php
					}
				?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'column_box_lead')
					{
						$column_one_content = get_post_meta($post->ID, 'kol_column_one_content', true);
						$column_two_content = get_post_meta($post->ID, 'kol_column_two_content', true);
						$column_three_content = get_post_meta($post->ID, 'kol_column_three_content', true);
					?>
						<div id="column_lead" class="clear">
							<div class="format_text">
								<?php if($column_one_content) { echo wpautop($column_one_content); } ?>
							</div>
							<div class="format_text">
								<?php if($column_two_content) { echo wpautop($column_two_content); } ?>
							</div>
							<div class="format_text last">
								<?php if($column_three_content) { echo wpautop($column_three_content); } ?>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'full_width_lead')
					{
						$full_content = get_post_meta($post->ID, 'kol_full_content', true);
					?>
						<div id="full_width" class="clear">
							<div class="format_text">
								<?php echo wpautop($full_content); ?>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'table_chart_lead')
					{
						$table_one_content = get_post_meta($post->ID, 'kol_table_one_content', true);
						$table_two_content = get_post_meta($post->ID, 'kol_table_two_content', true);
						$table_three_content = get_post_meta($post->ID, 'kol_table_three_content', true);
					?>
						<div id="<?php if(get_post_meta($post->ID, 'kol_table_light', true)) { echo 'light'; } else { echo 'dark'; } ?>_lead" class="clear">
							<?php if(get_post_meta($post->ID, 'kol_table_title', true)) { echo '<h2>' . get_post_meta($post->ID, 'kol_table_title', true) . '</h2>'; } ?>
							<?php if(get_post_meta($post->ID, 'kol_table_desc', true)) { echo '<p class="sub">' . get_post_meta($post->ID, 'kol_table_desc', true) . '</p>'; } ?>
							<div class="light">
								<div class="format_text">
									<?php if($table_one_content) { echo wpautop($table_one_content); } ?>
								</div>
							</div>
							<div class="dark">
								<div class="format_text">
									<?php if($table_two_content) { echo wpautop($table_two_content); } ?>
								</div>
							</div>
							<div class="light">
								<div class="format_text">
									<?php if($table_three_content) { echo wpautop($table_three_content); } ?>
								</div>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(get_post_meta($post->ID, 'kol_page_leads', true) == 'orb_area_lead')
					{
						$orb_one_outer = get_post_meta($post->ID, 'kol_orb_one_outer', true);
						$orb_two_outer = get_post_meta($post->ID, 'kol_orb_two_outer', true);
						$orb_three_outer = get_post_meta($post->ID, 'kol_orb_three_outer', true);
					?>
						<div id="orb_lead" class="clear">
							<?php if(get_post_meta($post->ID, 'kol_orb_title', true)) { echo '<h2>' . get_post_meta($post->ID, 'kol_orb_title', true) . '</h2>'; } ?>
							<?php if(get_post_meta($post->ID, 'kol_orb_desc', true)) { echo '<p class="sub">' . get_post_meta($post->ID, 'kol_orb_desc', true) . '</p>'; } ?>
							<div class="format_text">
								<div class="orb">
									<div class="orb_content">
										<?php if(get_post_meta($post->ID, 'kol_orb_one_content', true)) { echo get_post_meta($post->ID, 'kol_orb_one_content', true); } ?>
									</div>
								</div>
								<?php if($orb_one_outer) { echo wpautop($orb_one_outer); } ?>
							</div>
							<div class="format_text">
								<div class="orb">
									<div class="orb_content">
										<?php if(get_post_meta($post->ID, 'kol_orb_two_content', true)) { echo get_post_meta($post->ID, 'kol_orb_two_content', true); } ?>
									</div>
								</div>
								<?php if($orb_two_outer) { echo wpautop($orb_two_outer); } ?>
							</div>
							<div class="format_text last">
								<div class="orb">
									<div class="orb_content">
										<?php if(get_post_meta($post->ID, 'kol_orb_three_content', true)) { echo get_post_meta($post->ID, 'kol_orb_three_content', true); } ?>
									</div>
								</div>
								<?php if($orb_three_outer) { echo wpautop($orb_three_outer); } ?>
							</div>
						</div>
					<?php
					}
				?>

				<?php if($thesis_design->layout['framework'] == 'full-width') { echo '</div>'; } ?>
				</div>
			<?php
			}
		}
	}

	// landing page

	public function landing_page()
	{
		global $post;

		if(get_post_meta($post->ID, 'kol_page_leads', true) == 'landing_page_template')
		{
			remove_action('thesis_hook_header', array($this, 'header_menu'), 1);
			remove_action('thesis_hook_before_content_area', array($this, 'menu_area'), 1);
			remove_action('thesis_hook_after_header', array($this, 'menu_area'), 1);
		}
	}

	public function no_sidebars()
	{
		global $post;

		if(get_post_meta($post->ID, 'kol_page_leads', true) == 'landing_page_template')
			return false;
		else
			return true;
	}
}

new kol_marketers_delight;