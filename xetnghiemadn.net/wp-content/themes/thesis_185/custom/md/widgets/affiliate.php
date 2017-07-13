<?php

function md_load_affiliate_widget() {
	register_widget('Affiliate_Widget');
}
	add_action('widgets_init', 'md_load_affiliate_widget');


class Affiliate_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'affiliate', 'description' => __('Create a listing of your favorite affiliate products to promote on your blog!'));
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'affiliate-widget');
		parent::__construct('affiliate-widget', __('MD &raquo; Affiliate Marketing'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$link_name = $instance['link_name'];
		$link_url = $instance['link_url'];
		$image = $instance['image'];
		$description = apply_filters('widget_text', $instance['description']);

		echo $before_widget;

		if($title)
			echo '<h3>' . $title . '</h3>';

		echo '<div class="affiliate_box clear">';

		if($link_url)
			$link_url = '<a href="' . $link_url . '"><span class="aff_name">' . $link_name . '</span></a>';
		else
			$link_url = '<span class="aff_name">' . $link_name . '</span>';
		
		if($description)
			$description = wpautop($description);

		if($image)
			echo '
				<div class="feat_image_box">
					<img src="' . $image . '" alt="' . $link_name . '" />
				</div>
				<div class="desc_box">' .
					$link_url .
					$description . '
				</div>
			 ';
		else
			echo $link_url . $description;
		
		echo '</div>';	

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link_name'] = $new_instance['link_name'];
		$instance['link_url'] = $new_instance['link_url'];
		$instance['image'] = $new_instance['image'];
		$instance['description'] = $new_instance['description'];

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array) $instance); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Featured title:'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link_name'); ?>"><?php _e('Name of affiliate product:'); ?></label>
			<input id="<?php echo $this->get_field_id('link_name'); ?>" name="<?php echo $this->get_field_name('link_name'); ?>" value="<?php echo $instance['link_name']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e('Your affiliate link:'); ?></label>
			<input id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" value="<?php echo $instance['link_url']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Featured Image (recommended: 65x65px)'); ?></label>
			<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
			<textarea id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" class="widefat" rows="5" cols="20"><?php echo $instance['description']; ?></textarea>
		</p>
	<?php
	}
}