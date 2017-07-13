<?php

class Appointment_Widget extends WP_Widget {
  
  	public function __construct() {
  		$widget_ops = array( 'classname' => 'Appointment_Widget', 'description' => __("Appointment Widget", 'framework') );
  		parent::__construct( 'Appointment_Widget', 'HealthPress : Appointment Widget', $widget_ops);
  	}
  	
  	function form($instance) {
  			
  		$instance = wp_parse_args( (array) $instance, array( 
		                                                'heading' => 'Make an Appointment',
														'phone' => '1-800-123-4567', 
														'target_email' => 'info@yoursite.com'
														));
        
		$heading = esc_attr($instance['heading']);
        $phone = esc_attr($instance['phone']);
		$target_email = esc_attr($instance['target_email']);
  
  		        ?>
                <p>
			            <label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Appointment Form Heading', 'framework'); ?></label>
			            <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>" name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="<?php echo $heading; ?>" />
		        </p>
                
  				<p>
  		                <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e( 'Phone:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
  		        </p>  		        
                
                <p>
  		                <label for="<?php echo $this->get_field_id('target_email'); ?>"><?php _e( 'Email Address to Receive Requests:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('target_email'); ?>" name="<?php echo $this->get_field_name('target_email'); ?>" type="text" value="<?php echo $target_email; ?>" />
  		        </p>  		  		  					  		
  		        <?php
      }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;  		
		
		$instance['heading'] = strip_tags($new_instance['heading']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['target_email'] = strip_tags($new_instance['target_email']);
		
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);

        if ( function_exists( 'icl_translate' ) ) {
            $heading = icl_translate( 'Widgets', 'appointment_widget_heading', $instance['heading'] );
            $phone = icl_translate( 'Widgets', 'appointment_widget_phone', $instance['phone'] );
        } else {
            $heading = $instance['heading'];
            $phone = $instance['phone'];
        }

		$target_email = $instance['target_email'];
		
  		echo $before_widget;
		
  		    ?>                   
            <div class="appointment">
                    <div class="header">
                            <h2><?php echo $heading; ?></h2>
                            <h3 class="number"><?php echo $phone; ?></h3>
                            <span class="or"><?php _e("OR", 'framework'); ?></span>
                    </div>
                    <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" id="appoint-form" method="post">
                            <p>
                                <label class="display-ie8" for="apo_name"><?php _e("Full Name", 'framework'); ?></label>
                                <input type="text" name="apo_name" class="required" id="apo_name" placeholder="<?php _e("Full Name", 'framework'); ?>" title="<?php _e("* Please enter your Full Name", 'framework'); ?>" />
                            </p>
                            <p>
                                <label class="display-ie8" for="apo_phone"><?php _e("Phone Number", 'framework'); ?></label>
                                <input type="text" name="apo_phone" class="required" id="apo_phone" placeholder="<?php _e("Phone Number", 'framework'); ?>" title="<?php _e("* Please enter your Phone Number", 'framework'); ?>" />
							</p>
                            <p>
                                <label class="display-ie8" for="apo_email"><?php _e("Email Address", 'framework'); ?></label>
                                <input  type="text" name="apo_email"  class="email required" id="apo_email" placeholder="<?php _e("Email Address", 'framework'); ?>" title="<?php _e("* Please enter valid Email Address", 'framework'); ?>" />
                            </p>
                            <p>
                                <label class="display-ie8" for="apo_date"><?php _e("Appointment Date", 'framework'); ?></label>
                                <input type="text" name="apo_date" class="required" id="apo_date" placeholder="<?php _e("Appointment Date", 'framework'); ?>" title="<?php _e("* Please select desired appointment date", 'framework'); ?>" />
                            </p>
                            <p>
                                <label class="display-ie8" for="apo_date"><?php _e("Message", 'framework'); ?></label>
                                <textarea name="message" class="message required" cols="30" rows="5" placeholder="<?php _e("Message", 'framework'); ?>" title="<?php _e("* Please enter your message", 'framework'); ?>"></textarea>
							</p>

                            <?php
                            $disable_captcha = get_option('theme_disable_captcha');

                            if($disable_captcha != 'true')
                            {
                                ?>
                                <div class="captcha-container">
                                    <img src="<?php echo get_template_directory_uri(); ?>/captcha/appointment_captcha.php" alt=""/>
                                    <input type="text" class="captcha required" name="captcha" maxlength="5" title="<?php _e( '* Please enter the code characters displayed in image!', 'framework'); ?>"/>
                                </div>
                                <?php
                            }
                            ?>
							
							<p>															
                                <input type="submit" value="<?php _e("Submit Request", 'framework'); ?>" class="readmore">
                                <input type="hidden" name="action" value="request_appointment" />
                                <input type="hidden" name="target" value="<?php echo antispambot( $target_email ); ?>" />
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'appointment_message_nonce' ); ?>"/>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" id="apo-loader" alt="Loader" />
                            </p>
                            <p id="apo-message-sent"></p>
                            <div class="error-container"></div>

                    </form>
            </div>                          
            <?php	
		  
        echo $after_widget;		  
  	}
	  
}


?>