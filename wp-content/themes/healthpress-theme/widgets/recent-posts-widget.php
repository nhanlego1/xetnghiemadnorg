<?php
class Recent_Posts_With_Thumb extends WP_Widget {

	public function __construct()
	{
		$widget_ops = array( 'classname' => 'Recent_Posts_With_Thumb', 'description' => __('Show Recent or Popular or Random posts from your blog with thumbnail.','framework') );
		parent::__construct( 'Recent_Posts_With_Thumb', __('HealthPress: Recent Posts With Thumbnail','framework'), $widget_ops );
	}
	

	function widget($args, $instance) 
	{ 
		extract($args);
						
		$title = apply_filters('widget_title', $instance['title']);	
			
		if ( empty($title) ) 
		  $title = false;
		
		$number = absint( $instance['number'] );					
		$sort_by = $instance['sort_by'];		
		$categories = (array) $instance['categories'];		
		
		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
		
		$args = array('post_type'=>'post');
		
		//Number
		$args['posts_per_page'] = $number;
		
		//Categories
		$args['category__in'] = $categories;
		
		//Order by
		if($sort_by == "popular"):
			$args['orderby']= "comment_count";
		
		elseif($sort_by == "random"):
			$args['orderby']= "rand";
			
		else:
			$args['orderby']= "date";
			
		endif;

		$recent_posts_query = new WP_Query($args);
		
		if($recent_posts_query->have_posts()): 
			while($recent_posts_query->have_posts()): 
			$recent_posts_query->the_post();
			
				?>

                <div class="sidebar-post clearfix">						
                    <?php
                    if(has_post_thumbnail()) 
                    {
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'sidebar-post-thumb' ); ?>
                        </a>
                        <?php
                    } 							
                    ?>
                    <div class="sidebar-post-text">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span class="date"><?php the_time('F j, Y'); ?></span>
                    </div>
                </div>				                         						
				<?php
						
			endwhile;
		endif;

		echo $after_widget;
	}
	

	function form($instance) 
	{	
		$instance = wp_parse_args( (array) $instance, array('number' => 3, 'title' => '', 'sort_by' => 'recent', 'categories' => array() ) );
		
        $title= esc_attr($instance['title']);		
		$number = absint( $instance['number'] );	
		$sort_by = $instance['sort_by'];
		$categories = (array) $instance['categories'];
		
		?>
			<p>
	            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','framework');?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	        </p>
			<p> 
				<label><?php _e('Select Categories','framework');?>:</label>	
				<br />
				<?php
				$all_categories = get_categories('hide_empty=0&orderby=name');
				foreach ($all_categories as $cat ):
					$cat_id = intval($cat->cat_ID);
					$cat_name = $cat->cat_name;
					$selected = '';
					if(in_array($cat_id, $categories))
						$selected=' checked="checked"';
					?>
			  <input value="<?php echo $cat_id; ?>" class="checkbox" type="checkbox"<?php echo $selected; ?> id="<?php echo $this->get_field_id('categories'); echo $cat_id; ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" /> <label for="<?php echo $this->get_field_id('categories'); echo $cat_id; ?>"><?php echo $cat_name; ?></label> <br />
			  <?php
				endforeach;
				?>				
			</p>
			
			<p> 
				<label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort them by','framework');?>:</label>
				<select name="<?php echo $this->get_field_name('sort_by'); ?>" id="<?php echo $this->get_field_id('sort_by'); ?>" class="widefat">
						<option value="popular" <?php selected( $instance['sort_by'], 'popular' ); ?>><?php _e('Most Popular','framework');?></option>
						<option value="recent" <?php selected( $instance['sort_by'], 'recent' ); ?>><?php _e('Most Recent','framework');?></option>
						<option value="random" <?php selected( $instance['sort_by'], 'random' ); ?>><?php _e('Random','framework');?></option>
				</select>
			</p>
			
			<p>
	            <label for="<?php echo $this->get_field_id('number'); ?>">
	               <?php _e('Number of posts to display','framework');  ?>:
	            </label>
	                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
	        </p>
		<?php
	}

	function update($new_instance, $old_instance) {
        $instance = $old_instance;
		
        $instance['title'] = strip_tags($new_instance['title']);
		if( isset( $new_instance['categories'] ) ) {
			$instance['categories']  = ( array ) $new_instance['categories'];
		}
		$instance['sort_by'] = $new_instance['sort_by'];
		$instance['number'] = absint( $new_instance['number'] );	
		
        return $instance;

    }
	
}

?>