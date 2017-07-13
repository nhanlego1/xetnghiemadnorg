<?php

$prefix = 'kol_';

$kol_meta_boxes = array();

// share

$kol_meta_boxes[] = array(
	'id' => 'md_share_buttons',
	'title' => 'MD Share Buttons',
	'pages' => array('post', 'page'),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'type' => 'checkbox',
			'id' => $prefix . 'share_buttons',
			'name' => 'Disable share'
		)
	)
);


// lead selector

$kol_meta_boxes[] = array(
	'id' => 'lead_selector',
	'title' => 'Marketers Delight',
	'pages' => array('page'),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' => 'Page Leads:',
			'id' => $prefix . 'page_leads',
			'type' => 'radio',
			'options' => array(
				array('name' => ' Feature Box', 'value' => 'feature_box_lead'),
				array('name' => ' Standard Lead', 'value' => 'standard_box_lead'),
				array('name' => ' Column Lead', 'value' => 'column_box_lead'),
				array('name' => ' Full Lead', 'value' => 'full_width_lead'),
				array('name' => ' Table Lead', 'value' => 'table_chart_lead'),
				array('name' => ' Orb Lead', 'value' => 'orb_area_lead'),
				array('name' => ' Landing Page', 'value' => 'landing_page_template'),
				array('name' => ' None', 'value' => 'no_lead')
			)
		)
	)
);

// feature box

$kol_meta_boxes[] = array(
	'id' => 'lead_feature_box',
	'title' => 'Feature Box',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'checkbox',
			'id' => $prefix . 'feature_red',
			'name' => 'Use red color scheme'
		),
		array(
			'type' => 'text',
			'id' => $prefix . 'feature_ribbon',
			'name' => 'Ribbon text',
			'desc' => 'You can use HTML, to link the headline somewhere for example.<br />Ex: &lt;a href="http://kolakube.com/"&gt;Headline Text&lt;/a&gt;'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'feature_content',
			'name' => 'Feature box content',
			'desc' => 'The content of your feature box goes here.<br />Headlines, images, optin forms, custom HTML - you name it.'
		)
	)
);


// standard

$kol_meta_boxes[] = array(
	'id' => 'standard_lead',
	'title' => 'Standard Lead',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'textarea',
			'id' => $prefix . 'standard_content',
			'name' => 'Lead content',
			'desc' => 'The content of your Standard Lead (you can use HTML)'
		)
	)
);


// column

$kol_meta_boxes[] = array(
	'id' => 'column_lead',
	'title' => 'Column Lead',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		// Column 1

		array(
			'type' => 'textarea',
			'id' => $prefix . 'column_one_content',
			'name' => 'Column 1 content',
			'desc' => ''
		),

		// Column 2

		array(
			'type' => 'textarea',
			'id' => $prefix . 'column_two_content',
			'name' => 'Column 2 content',
			'desc' => ''
		),

		// Column 3

		array(
			'type' => 'textarea',
			'id' => $prefix . 'column_three_content',
			'name' => 'Column 3 content',
			'desc' => ''
		)
	)
);


// full

$kol_meta_boxes[] = array(
	'id' => 'full_lead',
	'title' => 'Full Lead',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'textarea',
			'id' => $prefix . 'full_content',
			'name' => 'Lead content',
			'desc' => ''
		)
	)
);

// table

$kol_meta_boxes[] = array(
	'id' => 'table_lead',
	'title' => 'Table Lead',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'checkbox',
			'id' => $prefix . 'table_light',
			'name' => 'Use light color scheme'
		),
		array(
			'type' => 'text',
			'id' => $prefix . 'table_title',
			'name' => 'Lead title',
			'desc' => 'The title of your Table Lead'
		),
		array(
			'type' => 'text',
			'id' => $prefix . 'table_desc',
			'name' => 'Lead description',
			'desc' => 'This text will go under the Lead Title'
		),

		// Table 1

		array(
			'type' => 'textarea',
			'id' => $prefix . 'table_one_content',
			'name' => 'Table 1 content',
			'desc' => ''
		),

		// Table 2

		array(
			'type' => 'textarea',
			'id' => $prefix . 'table_two_content',
			'name' => 'Table 2 content',
			'desc' => ''
		),

		// Table 3

		array(
			'type' => 'textarea',
			'id' => $prefix . 'table_three_content',
			'name' => 'Table 3 content',
			'desc' => ''
		)
	)
);


// orb

$kol_meta_boxes[] = array(
	'id' => 'orb_lead',
	'title' => 'Orb Lead',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'type' => 'text',
			'id' => $prefix . 'orb_title',
			'name' => 'Lead title',
			'desc' => 'The title of your orbs lead'
		),
		array(
			'type' => 'text',
			'id' => $prefix . 'orb_desc',
			'name' => 'Lead description',
			'desc' => 'This text will go under the Lead Title'
		),

		// Orb 1

		array(
			'type' => 'heading',
			'name' => 'Orb 1',
			'desc' => 'Edit the far left orb area'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_one_content',
			'name' => 'Inner orb area',
			'desc' => 'Content that will appear <em>inside</em> an orb.'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_one_outer',
			'name' => 'Outer orb area',
			'desc' => 'Content that will appear <em>outside</em> an orb.'
		),

		// Orb 2

		array(
			'type' => 'heading',
			'name' => 'Orb 2',
			'desc' => 'Edit the middle orb area'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_two_content',
			'name' => 'Inner orb area',
			'desc' => 'Content that will appear <em>inside</em> an orb.'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_two_outer',
			'name' => 'Outer orb area',
			'desc' => 'Content that will appear <em>outside</em> an orb.'
		),

		// Orb 3

		array(
			'type' => 'heading',
			'name' => 'Orb 3',
			'desc' => 'Edit the far right orb area'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_three_content',
			'name' => 'Inner orb area',
			'desc' => 'Content that will appear <em>inside</em> an orb.'
		),
		array(
			'type' => 'textarea',
			'id' => $prefix . 'orb_three_outer',
			'name' => 'Outer orb area',
			'desc' => 'Content that will appear <em>outside</em> an orb.'
		),
	)
);


// create meta boxes

class Kol_Meta_Box
{
	protected $_meta_box;

	function __construct($kol_meta_box)
	{
		if(!is_admin()) return;
			$this->_meta_box = $kol_meta_box;

		$current_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

		if($current_page == 'page' || $current_page == 'page-new' || $current_page == 'post' || $current_page == 'post-new')
		{
			add_action('admin_enqueue_scripts', array(&$this, 'md_load'));
		}
		add_action('admin_menu', array(&$this, 'kol_add_meta_boxes'));
		add_action('save_post', array(&$this, 'kol_save_meta_boxes'));
	}

	function md_load()
	{
		wp_enqueue_script('meta-boxes', THESIS_CUSTOM_FOLDER . '/md/js/meta-boxes.js');
		wp_enqueue_style('meta-boxes', THESIS_CUSTOM_FOLDER . '/md/css/meta-boxes.css');
	}

	function kol_show_meta_boxes()
	{
		global $post;

		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />'; #be safe
		echo '<table class="form-table">';

		foreach ($this->_meta_box['fields'] as $field)
		{
			$meta = get_post_meta($post->ID, $field['id'], true);

			echo '<tr>';
			switch($field['type'])
			{
				case 'heading':
					echo '<tr><td colspan="2"><h4 class="kol-heading">', $field['name'], '</h4><p class="kol-divider"><em>', $field['desc'], '</em></p></td></tr>';
				break;

				case 'text':
					echo '<th class="kol-th-width"><label for="', $field['id'], '">', $field['name'], '</label></th><td><input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', esc_attr($meta ? $meta : $field['std']), '" size="100" />',
						'<br />', $field['desc'], '</td>';
					break;

				case 'textarea':
					echo '<th class="kol-th-width"><label for="', $field['id'], '">', $field['name'], '</label></th><td><textarea name="', $field['id'], '" id="', $field['id'], '" cols="100" rows="7">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'], '</td>';
					break;

				case 'checkbox':
					echo '<th class="kol-th-width"><label for="', $field['id'], '">', $field['name'], '</label></th><td><input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /></td>';
					break;

				case 'radio':
					foreach ($field['options'] as $option) {
						echo '<div class="kol-radio-button"><input type="radio" name="', $field['id'], '" id="', $option['value'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'] . '</div>';
					}
					break;
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	function kol_add_meta_boxes()
	{
		$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
		$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
		
		foreach($this->_meta_box['pages'] as $page)
		{
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'kol_show_meta_boxes'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// save

	function kol_save_meta_boxes($post_id)
	{
		if(!wp_verify_nonce($_POST['wp_meta_box_nonce'], basename(__FILE__)))
		{
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		{
			return $post_id;
		}

		if('page' == $_POST['post_type'])
		{
			if(!current_user_can('edit_page', $post_id))
			{
				return $post_id;
			}
		}
		
		elseif(!current_user_can('edit_post', $post_id))
		{
			return $post_id;
		}

		foreach($this->_meta_box['fields'] as $field)
		{
			$name = $field['id'];

			$old = get_post_meta($post_id, $name, true);
			$new = $_POST[$field['id']];

			if ($field['type'] == 'textarea')
			{
				$new = $new;
			}

			if($new && $new != $old)
			{
				update_post_meta($post_id, $name, $new);
			}
			
			elseif('' == $new && $old && $field['type'] != 'file' && $field['type'] != 'image')
			{
				delete_post_meta($post_id, $name, $old);
			}
		}
	}
}

foreach ($kol_meta_boxes as $kol_meta_box)
{
	$kol_meta_box = new Kol_Meta_Box($kol_meta_box);
}