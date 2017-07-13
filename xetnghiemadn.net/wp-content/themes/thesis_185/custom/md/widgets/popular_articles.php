<?php

function md_load_popular_articles_widget() {
	register_widget('Popular_Articles_Widget');
}
	add_action('widgets_init', 'md_load_popular_articles_widget');


class Popular_Articles_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'popular', 'description' => __('Display your most popular articles on your blog!'));
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'popular-widget');
		parent::__construct('popular-widget', __('MD &raquo; Popular Articles'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$article_count = $instance['article_count'];
		$comments = $instance['comments'];

		echo $before_widget;

		if($title)
			echo $before_title . $title . $after_title;

		echo '<ul>';
		
		$popular_articles = new WP_Query(array('orderby' => 'comment_count', 'posts_per_page' => $article_count));
		
		while ($popular_articles->have_posts()) : $popular_articles->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr('Permalink to %s'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?><?php if($comments) { ?> <span><?php comments_number('0', '1', '%'); ?></span><?php } ?></a>
			</li>
		<?php endwhile;
		echo '</ul>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['article_count'] = $new_instance['article_count'];
		$instance['comments'] = $new_instance['comments'];

		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'title' => __('Popular Articles'), 
			'article_count' => __('5'),
			'comments' => true
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('article_count'); ?>"><?php _e('# of Articles:'); ?></label>
			<input id="<?php echo $this->get_field_id('article_count'); ?>" name="<?php echo $this->get_field_name('article_count'); ?>" value="<?php echo $instance['article_count']; ?>" type="text" size="1" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked((bool)$instance['comments'], true); ?> id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Show comments?'); ?></label>
		</p>
	<?php
	}
}