<?php

function md_load_orb_widget() {
	register_widget('Orb_Widget');
}
	add_action('widgets_init', 'md_load_orb_widget');


class Orb_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'orb-widget', 'description' => __('Create an orb lead right into a widget area! Can be used just like the Page Lead form.'));
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'orb-widget');
		parent::__construct('orb-widget', __('MD &raquo; Orb Widget'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$description = apply_filters('widget_text', $instance['description']);
		$outer_text = $instance['outer_text'];
		$button_text = $instance['button_text'];
		$button_url = $instance['button_url'];
		$button_color = $instance['button_color'];

		echo $before_widget;

		if(!empty($title) || !empty($description)) {
			echo '<div class="orb">';
				echo '<div class="orb_content">';
					if($title)
						echo $before_title . $title . $after_title;
					if($description)
						echo wpautop($description);	
				echo '</div>';
			echo '</div>';
		}

		if($outer_text)
			echo wpautop($outer_text);
		
		if($button_text && $button_url)
			echo '<p><a href="' . $button_url . '" class="' . $button_color . ' button">' . $button_text . '</a></p>';


		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = $new_instance['description'];
		$instance['outer_text'] = $new_instance['outer_text'];
		$instance['button_text'] = $new_instance['button_text'];
		$instance['button_url'] = $new_instance['button_url'];
		$instance['button_color'] = $new_instance['button_color'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'title' => __('Fun With Orbs!'),
			'description' => __('Guide users through some sort of sign-up process on your site.'),
			'outer_text' => __('The idea of these orbs are this: To help users understand how to navigate through a process like signing up, or ordering something. But really, you can use them for pretty much any content you want!'),
			'button_text' => __('Click this nice button!'),
			'button_url' => __('http://kolakube.com/'),
			'button_color' => __('red'),
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
			<textarea id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" class="widefat" rows="3" cols="20"><?php echo $instance['description']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('outer_text'); ?>"><?php _e('Outer text'); ?></label>
			<textarea id="<?php echo $this->get_field_id('outer_text'); ?>" name="<?php echo $this->get_field_name('outer_text'); ?>" class="widefat" rows="8" cols="20"><?php echo $instance['outer_text']; ?></textarea>		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button text'); ?></label>
			<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" value="<?php echo $instance['button_text']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL:'); ?></label>
			<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" value="<?php echo $instance['button_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_color'); ?>"><?php _e('Button color:'); ?></label> 
			<select id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>">
				<option <?php if('red' == $instance['button_color']) echo 'selected="selected"'; ?>>red</option>
				<option <?php if('orange' == $instance['button_color']) echo 'selected="selected"'; ?>>orange</option>
				<option <?php if('green' == $instance['button_color']) echo 'selected="selected"'; ?>>green</option>
				<option <?php if('blue' == $instance['button_color']) echo 'selected="selected"'; ?>>blue</option>
				<option <?php if('gray' == $instance['button_color']) echo 'selected="selected"'; ?>>gray</option>
				<option <?php if('dark' == $instance['button_color']) echo 'selected="selected"'; ?>>dark</option>
			</select>
		</p>
	<?php
	}
}