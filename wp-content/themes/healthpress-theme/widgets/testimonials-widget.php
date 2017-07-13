<?php
class Testimonials_Widget extends WP_Widget {

	public function __construct()
	{
		$widget_ops = array( 'classname' => 'Testimonials_Widget', 'description' => __('Displays Testimonials.','framework') );
		parent::__construct( 'Testimonials_Widget', __('HealthPress: Testimonials Widget','framework'), $widget_ops );
	}
	
	
	function widget($args, $instance) 
	{
		extract($args);
						
		$title = apply_filters('widget_title', $instance['title']);	
			
		if ( empty($title) ) 
            $title = false;

		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;

        ?>
        <div class="testi">
            <ul class="patients cycle-slideshow"
                data-cycle-fx="fade"
                data-cycle-timeout="5000"
                data-cycle-slides="> li"
                data-cycle-auto-height="container"
                data-cycle-prev="#testimonial-widget-prev"
                data-cycle-next="#testimonial-widget-next">
                <?php

                $number = absint( $instance['number'] );
                $number = empty($number)?5:$number;

                $testimonials_arguments = array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => $number
                );

                $testimonials_query = new WP_Query( $testimonials_arguments );

                if ( $testimonials_query->have_posts() )
                {
                    while ( $testimonials_query->have_posts() ) :
                        $testimonials_query->the_post();
                        global $post;
                        ?>
                        <li>
                            <?php
                            if ( has_post_thumbnail() )
                            {
                                echo '<div class="imgbox">';
                                the_post_thumbnail('testimonial-thumb');
                                echo '</div>';
                            }
                            ?>
                            <div class="detail">
                                <blockquote>
                                    <p><?php echo get_post_meta($post->ID,'the_testimonial',true); ?></p>
                                </blockquote>
                                <p class="author">
                                    <a href="<?php echo get_post_meta($post->ID,'testimonial_author_link',true); ?>" class="author"><?php echo get_post_meta($post->ID,'testimonial_author',true); ?>,</a>
                                    <?php echo get_post_meta($post->ID,'testimonial_department',true); ?>
                                </p>
                            </div>
                        </li>
                        <?php

                    endwhile;
                }
                ?>
            </ul>
            <p class="patient-nav">
                <span id="testimonial-widget-prev" class="t_left"></span>
                <span id="testimonial-widget-next" class="t_right"></span>
            </p>
        </div>
        <?php
		
		echo $after_widget;
	}
	

	function form($instance) 
	{	
		$instance = wp_parse_args( (array) $instance, array('number' => 3, 'title' => '') );
		
        $title= esc_attr($instance['title']);		
		$number = absint( $instance['number'] );
		
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of testimonials to display','framework');  ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <?php
	}

	function update($new_instance, $old_instance) 
	{
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
        return $instance;
    }
	
}

?>