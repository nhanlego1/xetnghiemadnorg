<?php

function md_load_quotes_widget() {
	register_widget('Quotes_Widget');
}
	add_action('widgets_init', 'md_load_quotes_widget');


class Quotes_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'quotes', 'description' => __('Add a testimonial/quote to any designated widget area!'));
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'quotes-widget');
		parent::__construct('quotes-widget', __('MD &raquo; Quotes Widget'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$quote = apply_filters('widget_text', $instance['quote']);
		$name = $instance['name'];
		$role = $instance['role'];
		$image = $instance['image'];

		echo $before_widget;

		if($title)
			echo $before_title . $title . $after_title;
		
		echo '<div class="quote_box">';
			echo '<div class="quote_content clear">';
				if(!empty($image) || !empty($name) || !empty($role)) {
					echo '<div class="detail_box">';
						if($image)
							echo '<img src="' . $image . '" alt="' . $name . ' says&hellip;" />';
						if($name)
							echo '<span class="name">' . $name . '</span>';
						if($role)
							echo '<span class="role">' . $role . '</span>';
					echo '</div>';
				}
				if($quote) {
					echo '<div class="said_box">';
						echo wpautop($quote);
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['quote'] = $new_instance['quote'];
		$instance['name'] = $new_instance['name'];
		$instance['role'] = $new_instance['role'];
		$instance['image'] = $new_instance['image'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'quote' => __('"Use this box to display quotes or testimonials from people who love your work!"'),
			'name' => __('Alex M.'),
			'role' => __('Creator of MD2')
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('quote'); ?>"><?php _e('Quote:'); ?></label>
			<textarea id="<?php echo $this->get_field_id('quote'); ?>" name="<?php echo $this->get_field_name('quote'); ?>" class="widefat" rows="4" cols="20"><?php echo $instance['quote']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Who said it:'); ?></label>
			<input id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $instance['name']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('role'); ?>"><?php _e('Who are they?'); ?></label>
			<input id="<?php echo $this->get_field_id('role'); ?>" name="<?php echo $this->get_field_name('role'); ?>" value="<?php echo $instance['role']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Their picture (60x60, please)'); ?></label>
			<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" class="widefat" type="text" />
		</p>
	<?php
	}
}