<?php

class Newsletter_Subscription_Widget extends WP_Widget {
  
  	public function __construct() {
  		$widget_ops = array( 'classname' => 'Newsletter_Subscription_Widget', 'description' => __("Custom Newsletter Subscription Widget", 'framework') );
  		parent::__construct( 'Newsletter_Subscription_Widget', 'HealthPress : Newsletter Subscription Widget', $widget_ops);
  	}
  	
  	function form($instance) {
  			
  		$instance = wp_parse_args( (array) $instance, array( 
		                                                'title' => 'Newsletter',
														'form_text' => 'Sign up our newsletter to get latest updates',
														'form_action' => '#', 
														'email_field_name' => 'email', 
														));
        
		$title= esc_attr($instance['title']);
        $form_text = esc_attr($instance['form_text']);
		$form_action = esc_attr($instance['form_action']);
		$email_field_name = esc_attr($instance['email_field_name']);
  
  		        ?>
                <p>
			            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
			            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		        </p>
                
  				<p>
  		                <label for="<?php echo $this->get_field_id('form_text'); ?>"><?php _e( 'Sub Title:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('form_text'); ?>" name="<?php echo $this->get_field_name('form_text'); ?>" type="text" value="<?php echo $form_text; ?>" />
  		        </p>
  		        
                <p>
  		                <label for="<?php echo $this->get_field_id('form_action'); ?>"><?php _e( 'Form Action URL:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('form_action'); ?>" name="<?php echo $this->get_field_name('form_action'); ?>" type="text" value="<?php echo $form_action; ?>" />
  		        </p>
                
                <p>
  		                <label for="<?php echo $this->get_field_id('email_field_name'); ?>"><?php _e( 'Email Field Name:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('email_field_name'); ?>" name="<?php echo $this->get_field_name('email_field_name'); ?>" type="text" value="<?php echo $email_field_name; ?>" />
  		        </p>  		  		  					  		
  		        <?php
      }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;  		
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['form_text'] = strip_tags($new_instance['form_text']);
		$instance['form_action'] = strip_tags($new_instance['form_action']);
		$instance['email_field_name'] = strip_tags($new_instance['email_field_name']);

		
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);		
			if ( empty($title) ) 
					$title = false;

        if ( function_exists( 'icl_translate' ) ) {
            $form_text = icl_translate( 'Widgets', 'subscription_widget_text', $instance['form_text'] );
        } else {
            $form_text = $instance['form_text'];
        }

		$form_action = $instance['form_action'];
		$email_field_name = $instance['email_field_name'];

		
  		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
  		    ?>       
            <div class="newsletter">                  
                  <form action="<?php echo $form_action; ?>" id="newsletter" method="post" >
                      <p><?php echo $form_text;?></p>
                      <p>
                          <label class="display-ie8" for="nl_email"><?php _e("Email Address", 'framework'); ?></label>
                          <input type="text" name="<?php echo $email_field_name; ?>" id="nl_email" class="email required" placeholder="<?php _e("Email Address", 'framework'); ?>" title="<?php _e("* Please enter valid Email Address", 'framework'); ?>">
                          <input type="submit" id="nl_submit" value="<?php _e("Go", 'framework'); ?>" class="readmore">
                      </p>
                      <div class="error-container"></div>
                  </form>
            </div>               
            <?php	
				  
        echo $after_widget;		  
  	}
	  
}

?>