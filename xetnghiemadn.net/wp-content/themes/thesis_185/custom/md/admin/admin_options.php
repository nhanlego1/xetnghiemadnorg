<?php

/**
 * The Marketers Delight options
 * panel is going to get a complete
 * facelift in upcoming versions.
 * For now, this will do. And quite
 * nicely. :D
 */

class Kol_Options
{
	private $sections;
	private $checkboxes;
	private $settings;

	public function __construct()
	{
		$this->checkboxes = array();
		$this->settings = array();
		$this->kol_get_settings();

		$this->sections['design_options'] = __('Design Options');		
		$this->sections['blog_posts'] = __('Posts');
		$this->sections['feature_box'] = __('Feature Box');
		$this->sections['site_footer'] = __('Footer');
		$this->sections['changelog'] = __('Changelog');
		
		add_action('admin_menu', array(&$this, 'kol_add_options'));
		add_action('admin_init', array(&$this, 'kol_register_settings'));
		
		if(!get_option('kol_options'))
			$this->kol_init_settings();
	}

	public function kol_add_options()
	{	
		$kol_admin = add_submenu_page('thesis-options', THEME_NAME . ' Options', THEME_NAME, 'edit_themes', THEME_OPTIONS_PAGE, array(&$this, 'kol_build_options'));
		
		add_action('admin_print_scripts-' . $kol_admin, array(&$this, 'kol_scripts'));
		add_action('admin_print_styles-' . $kol_admin, array(&$this, 'kol_styles'));
	}

	public function kol_create_settings($args = array())
	{			
		extract(wp_parse_args($args));
		
		$field_args = array(
			'type' => $type,
			'id' => $id,
			'desc' => $desc,
			'std' => $std,
			'choices' => $choices,
			'label_for' => $id,
			'class' => $class
		);
		
		if($type == 'checkbox')
			$this->checkboxes[] = $id;
		
		add_settings_field($id, $title, array($this, 'kol_display_settings'), THEME_OPTIONS_PAGE, $section, $field_args);
	}

	public function kol_build_options()
	{			
		echo '<form action="options.php" method="post"><div class="wrap">';

		echo screen_icon('themes') . ' <h2>' . __(THEME_NAME . ' ' . THEME_VERSION . ' Options') . ' <input name="Submit" type="submit" class="button-primary" value="' . __('Save Changes') . '" /></h2>';

		settings_fields('kol_options');
		
		echo '<a href="' . USER_ACCOUNT . '" target="_blank">Your Account</a> | <a href="' . THEME_DOCS . '" target="_blank">Documentation</a> | <a href="' . SUPPORT_URL . '" target="_blank">Support Forums</a> | <a href="' . KOL_AFF_PROG . '" target=_blank">Affiliate Program</a>';

		if($_GET['settings-updated'] == 'true' && $_GET['page'] == THEME_OPTIONS_PAGE)
		{
			thesis_generate_css();
			echo '<div class="updated fade"><p>' . __(THEME_NAME . ' options saved! <a href="' . get_bloginfo('url') . '" target="_blank">Check your site out!</a>') . '</p></div>';
		}

		echo '<div class="ui-tabs"><ul class="ui-tabs-nav">';
		
		foreach($this->sections as $section_slug => $section)
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';

		do_settings_sections($_GET['page']);
		
		echo '</div>';

		echo '<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __('Save Changes') . '" /></p>';

		echo '</form>';
	
		echo '<script type="text/javascript">jQuery(document).ready(function($) { var sections = [];';

		foreach ($this->sections as $section_slug => $section) echo "sections['$section'] = '$section_slug';";

		echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">"); wrapped.each(function() { $(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel")); }); $(".ui-tabs-panel").each(function(index) { $(this).attr("id", sections[$(this).children("h3").text()]); if (index > 0) $(this).addClass("ui-tabs-hide"); }); $(".ui-tabs").tabs({ fx: { opacity: "toggle", duration: "fast" } }); $("input[type=text], textarea").each(function() { if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") $(this).css("color", "#999"); }); $("input[type=text], textarea").focus(function() { if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") { $(this).val(""); $(this).css("color", "#000"); } }).blur(function() { if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) { $(this).val($(this).attr("placeholder")); $(this).css("color", "#999"); } }); $(".wrap h3, .wrap table").show(); $(".warning").change(function() { if ($(this).is(":checked")) $(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold"); else $(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal"); }); if ($.browser.mozilla)  $("form").attr("autocomplete", "off"); });</script></div>';
	}

	public function kol_display_changelog_section()
	{
		include('changelog.txt');
	}

	public function kol_display_settings($args = array())
	{	
		extract($args);
		
		$options = get_option('kol_options');
		
		if(!isset($options[$id]) && $type != 'checkbox')
			$options[$id] = $std;
		elseif (!isset($options[$id]))
			$options[$id] = 0;
		
		$field_class = '';
		if ($class != '')
			$field_class = ' ' . $class;
		
		switch ($type) {
			case 'heading':
				echo '<tr valign="top"><td colspan="2"><h4>' . $desc . '</h4></td></tr>';
				break;

			case 'text':
				default:
		 			echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="kol_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr($options[$id]) . '" />';
		 			if($desc != '')
		 				echo '<br /><span class="description">' . $desc . '</span>';
		 		break;

			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="kol_options[' . $id . ']" placeholder="' . $std . '" rows="8" cols="70">' . wp_htmledit_pre($options[$id]) . '</textarea>';
				if ($desc != '')
					echo '<br /><span class="description">' . $desc . '</span>';
				break;

			case 'checkbox':
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="kol_options[' . $id . ']" value="1" ' . checked($options[$id], 1, false) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				break;

			case 'select':
				echo '<select class="select' . $field_class . '" name="kol_options[' . $id . ']">';
				foreach ($choices as $value => $label)
					echo '<option value="' . esc_attr($value) . '"' . selected($options[$id], $value, false) . '>' . $label . '</option>';
				echo '</select>';
				if ($desc != '')
					echo '<br /><span class="description">' . $desc . '</span>';
				break;

			case 'radio':
				$i = 0;
				foreach ($choices as $value => $label) {
					echo '<input class="radio' . $field_class . '" type="radio" name="kol_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr($value) . '" ' . checked($options[$id], $value, false) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ($i < count($options) - 1)
						echo '<br />';
					$i++;
				}
				if($desc != '')
					echo '<br /><span class="description">' . $desc . '</span>';
				break;
		}
		
	}

	public function kol_get_settings()
	{

		// posts

		$this->settings['blog_share_headline'] = array(
			'section' => 'blog_posts',
			'type'    => 'heading',
			'title'   => '',
			'desc'    => __('Share Buttons'),
			'std'     => '',
		);

		$this->settings['blog_share'] = array(
			'section' => 'blog_posts',
			'type'    => 'checkbox',
			'title'   => __('Enable share buttons'),
			'desc'    => 'You can override this on a single post or page options',
			'std'     => 1
		);

		$this->settings['blog_custom_share'] = array(
			'section' => 'blog_posts',
			'type'    => 'textarea',
			'title'   => __('Custom share codes'),
			'desc'    => __('Paste custom share codes here'),
			'std'     => '',
		);

		$this->settings['share_twitter'] = array(
			'section' => 'blog_posts',
			'type'    => 'text',
			'title'   => __('Twitter username'),
			'desc'    => __('Enter your Twitter username (no @ symbol)'),
			'std'     => ''
		);


		$this->settings['pf_heading'] = array(
			'section' => 'blog_posts',
			'type'    => 'heading',
			'title'   => '',
			'desc'    => 'Single Post Footer',
		);

		$this->settings['pf_author'] = array(
			'section' => 'blog_posts',
			'type'    => 'checkbox',
			'title'   => __('Enable author box'),
			'desc'    => '',
			'std'     => 0
		);

		$this->settings['pf_content'] = array(
			'section' => 'blog_posts',
			'type'    => 'textarea',
			'title'   => __('Post footer content'),
			'desc'    => __('You can put any content you want here, will appear under every single post<br />You can use HTML for more control<br />(See <a href="' . THEME_DOCS . 'post-footer-message/" target="_blank">documentation</a> for tips + ideas on using this area)'),
			'std'     => '',
		);

		$this->settings['blog_after_post_number'] = array(
			'section' => 'blog_posts',
			'type'    => 'text',
			'title'   => __('Show after xth post'),
			'desc'    => __('Enter the post number you want the above content to appear after.<br />Ex: Entering "2" will show this message after the second post.<br />Leave blank to disable.'),
			'std'     => '',
		);

		// feature box

		$this->settings['fb_on'] = array(
			'section' => 'feature_box',
			'type'    => 'checkbox',
			'title'   => __('Enable feature box'),
			'desc'    => '',
			'std'     => 0
		);

		$this->settings['feature_red'] = array(
			'section' => 'feature_box',
			'type'    => 'checkbox',
			'title'   => __('Use red color scheme'),
			'desc'    => '',
			'std'     => 0
		);

		$this->settings['fb_ribbon_text'] = array(
			'section' => 'feature_box',
			'type'    => 'text',
			'title'   => __('Ribbon text'),
			'desc'    => __('You can use HTML, to link the headline somewhere for example.<br />Ex: &lt;a href="http://kolakube.com/"&gt;Headline Text&lt;/a&gt;'),
			'std'     => '',
		);

		$this->settings['fb_optin'] = array(
			'section' => 'feature_box',
			'type'    => 'textarea',
			'title'   => __('Feature box content'),
			'desc'    => __('The content of your feature box goes here. <br />Headlines, images, optin forms, custom HTML - you name it.'),
			'std'     => '',
		);


		// design options

		$this->settings['design_lookfeel_heading'] = array(
			'section' => 'design_options',
			'type'    => 'heading',
			'title'   => __(''),
			'desc'    => 'Look &amp; Feel',
		);

		$this->settings['design_background'] = array(
			'section' => 'design_options',
			'type'    => 'select',
			'title'   => __('Select a background pattern:'),
			'desc'    => __('You can adjust the background color of your site in Thesis &rarr; <br />Design Options &rarr; Body. Most patterns will adjust to any color!'),
			'std'     => 'pattern-md',
			'choices' => array(
				'pattern-md' => 'Marketers Delight',
				'pattern-pop' => 'Pop-Out',
				'pattern-diamonds' => 'Diamonds',
				'pattern-noise' => 'Noise',
				'pattern-tiny-diagonal' => '(Tiny) Diagonal',
				'pattern-wide-diagonal' => '(Wide) Diagonal',
				'pattern-med-squares' => 'Medium Squares',
				'pattern-squares' => 'Squares',
				'pattern-honeycomb' => 'Honeycomb',
				'pattern-steps' => 'Steps',
				'pattern-horizontal' => 'Horizontal Lines',
				'pattern-vertical' => 'Vertical Lines',
				'no-background' => 'No background pattern',
			)
		);

		$this->settings['design_reponsive_toggle'] = array(
			'section' => 'design_options',
			'type'    => 'checkbox',
			'title'   => __('Enable responsive styles'),
			'desc'    => '&nbsp;Enabling this option will optimize your site for all screen sizes.<br />(MD2 does its best to predict and format your site for mobile. If you made heavy customizations, some things <em>may</em> be off)',
			'std'     => 0
		);

		$this->settings['design_menu_heading'] = array(
			'section' => 'design_options',
			'type'    => 'heading',
			'title'   => __(''),
			'desc'    => 'Main Menu',
		);

		$this->settings['nav_disable_search'] = array(
			'section' => 'design_options',
			'type'    => 'checkbox',
			'title'   => __('Enable search'),
			'desc'    => '',
			'std'     => 0
		);

		$this->settings['design_menu_theme'] = array(
			'section' => 'design_options',
			'type'    => 'select',
			'title'   => __('Color options:'),
			'desc'    => __(''),
			'std'     => 'menu-md',
			'choices' => array(
				'menu-md' => 'Marketers Delight (Gray)',
				'menu-red' => 'Red',
				'menu-orange' => 'Orange',
				'menu-blue' => 'Blue',
				'menu-green' => 'Green',
				'menu-dark' => 'Dark'
			)
		);


		// footer

		$this->settings['fat_footer'] = array(
			'section' => 'site_footer',
			'type'    => 'checkbox',
			'title'   => __('Enable fat footer'),
			'desc'    => __(''),
			'std'     => 0,
		);

		$this->settings['foot_content'] = array(
			'section' => 'site_footer',
			'type'    => 'textarea',
			'title'   => __('Footer copyright'),
			'desc'    => __('Place your copyright information and other site information here <br />You can use HTML for more control<br />3 column footer is located in the Widgets area'),
			'std'     => 'Copyright &copy; your awesome site!',
		);

		$this->settings['thesis_att_heading'] = array(
			'section' => 'site_footer',
			'type'    => 'heading',
			'title'   => '',
			'desc'    => 'Footer Attribution Controls',
		);

		$this->settings['foot_thesis_link'] = array(
			'section' => 'site_footer',
			'type'    => 'text',
			'title'   => __('Thesis affiliate link'),
			'desc'    => __('Replace the Thesis attribution link with your own Thesis affiliate link<br />Learn more about the <a href="' . THESIS_AFF_PROG . '" target="_blank">Thesis affiliate program &rarr;</a>'),
			'std'     => 'http://diythemes.com/',
		);

		$this->settings['foot_kolakube_link'] = array(
			'section' => 'site_footer',
			'type'    => 'text',
			'title'   => __('Kolakube affiliate link'),
			'desc'    => __('Replace the Kolakube attribution link with your own Kolakube affiliate link<br />Learn more about the <a href="' . KOL_AFF_PROG . '" target="_blank">Kolakube affiliate program &rarr;</a>'),
			'std'     => 'http://kolakube.com/skins/',
		);

		$this->settings['foot_disable_thesis_attr'] = array(
			'section' => 'site_footer',
			'type'    => 'checkbox',
			'title'   => __('Remove Thesis attribution'),
			'desc'    => ' <span style="color: red; font-weight: bold; text-transform: uppercase">Do not remove without proper licensing &mdash; <a href="' . THESIS_ATT_LINK . '" target="_blank">Learn More</a></span>',
			'std'     => 0
		);

		$this->settings['foot_disable_kol_attr'] = array(
			'section' => 'site_footer',
			'type'    => 'checkbox',
			'title'   => __('Remove Kolakube attribution'),
			'desc'    => ' <span style="color: red; font-weight: bold; text-transform: uppercase">Do not remove without proper licensing &mdash; <a href="' . KOL_ATT_LINK . '" target="_blank">Learn More</a></span>',
			'std'     => 0
		);
		
	}
	
	// initialize to defaults

	public function kol_init_settings()
	{	
		$default_settings = array();
		foreach($this->settings as $id => $setting)
		{
			if($setting['type'] != 'heading')
				$default_settings[$id] = $setting['std'];
		}
		update_option('kol_options', $default_settings);
		wp_cache_flush();
	}
	
	// register settings

	public function kol_register_settings()
	{	
		register_setting('kol_options', 'kol_options', array (&$this, 'kol_validate_settings'));
		
		foreach($this->sections as $slug => $title) {
			if($slug == 'changelog')
				add_settings_section($slug, $title, array(&$this, 'kol_display_changelog_section'), THEME_OPTIONS_PAGE);
			else
				add_settings_section($slug, $title, array(&$this, 'kol_display_section'), THEME_OPTIONS_PAGE);
		}

		$this->kol_get_settings();

		foreach ($this->settings as $id => $setting) {
			$setting['id'] = $id;
			$this->kol_create_settings($setting);
		}
	}
	
	public function kol_display_section()
	{
	
	}
	
	// jquery tabs

	public function kol_scripts()
	{
		wp_print_scripts('jquery-ui-tabs');	
	}
	
	// admin css

	public function kol_styles()
	{	
		wp_enqueue_style('kol-admin', THESIS_CUSTOM_FOLDER . '/md/css/admin-options.css');
	}
	
	// validate

	public function kol_validate_settings($input)
	{	
		if(!isset($input['reset_theme']))
		{
			$options = get_option('kol_options');
			
			foreach($this->checkboxes as $id)
			{
				if(isset($options[$id]) && ! isset($input[$id]))
					unset($options[$id]);
			}
			return $input;
		}
		return false;
	}
	
}

new Kol_Options();

?>