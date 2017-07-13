<?php

class Location_Widget extends WP_Widget {
  
  	public function __construct() {
  		$widget_ops = array( 'classname' => 'Location_Widget', 'description' => __("Footer widget to display address, phone and email in footer.", 'framework') );
  		parent::__construct( 'Location_Widget', 'HealthPress : Footer Location Widget', $widget_ops);
  	}
  	
  	function form($instance) {
  			
  		$instance = wp_parse_args( (array) $instance, array( 
		                                                  'title' => 'Location',
														  'address' => 'Address will be appear here, some details here City Name, State & Country.',
														  'phone' => '+800 123 4567', 
														  'email' => 'info@yoursite.com' 
														));
        
		$title= esc_attr($instance['title']);
        $address = esc_attr($instance['address']);
		$phone = esc_attr($instance['phone']);
		$email = esc_attr($instance['email']);
  
  		        ?>
                <p>
			            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
			            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		        </p>
                
  				<p>
  		                <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e( 'Address:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
  		        </p>
  		        
                <p>
  		                <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e( 'Phone:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
  		        </p>
                
                <p>
  		                <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e( 'Email Address:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
  		        </p>  		  		  					  		
  		        <?php
    }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;  		
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['email'] = strip_tags($new_instance['email']);
		
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);		
			if ( empty($title) ) 
					$title = false;

        if ( function_exists( 'icl_translate' ) ) {
            $address = icl_translate( 'Widgets', 'location_widget_address', $instance['address'] );
            $phone = icl_translate( 'Widgets', 'location_widget_phone', $instance['phone'] );
            $email = icl_translate( 'Widgets', 'location_widget_email', $instance['email'] );
        } else {
            $address = $instance['address'];
            $phone = $instance['phone'];
            $email = $instance['email'];
        }

		
  		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
  		    ?>   
            <p><?php echo $address; ?></p>
            <p><span><?php _e("Ph:", 'framework'); ?></span> <?php echo $phone; ?></p>
            <p><span><?php _e("Email:", 'framework'); ?></span> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>               
            <?php	
				  
        echo $after_widget;		  
  	}
	  
}

?>