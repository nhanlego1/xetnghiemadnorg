<?php

class Quick_Contact_Widget extends WP_Widget {
  
  	public function __construct() {
  		$widget_ops = array( 'classname' => 'Quick_Contact_Widget', 'description' => __("Widget to display phone numbers and email in contact page sidebar.", 'framework') );
  		parent::__construct( 'Quick_Contact_Widget', 'HealthPress : Quick Contact', $widget_ops);
  	}
  	
  	function form($instance) {
  			
  		$instance = wp_parse_args( (array) $instance, array( 
		                                                'title' => 'Quick Contact',
														'work' => '+92 - 123 - 456 - 7890', 
														'cell' => '+92 - 1234567890', 
														'fax' => '+92 - 123 - 456 - 7891', 
														'text' => '' 
														));
        
		$title= esc_attr($instance['title']);
        $work = esc_attr($instance['work']);
		$cell = esc_attr($instance['cell']);
		$fax = esc_attr($instance['fax']);
  		$text = esc_attr($instance['text']);
  
  		?>
                <p>
			            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
			            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		        </p>
                
  				<p>
  		                <label for="<?php echo $this->get_field_id('work'); ?>"><?php _e( 'Work Phone:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('work'); ?>" name="<?php echo $this->get_field_name('work'); ?>" type="text" value="<?php echo $work; ?>" />
  		        </p>
  		        
                <p>
  		                <label for="<?php echo $this->get_field_id('cell'); ?>"><?php _e( 'Cell Number:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('cell'); ?>" name="<?php echo $this->get_field_name('cell'); ?>" type="text" value="<?php echo $cell; ?>" />
  		        </p>
                
                <p>
  		                <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e( 'Fax Number:', 'framework') ?></label>
  		                <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" />
  		        </p>  		
  		
  				<p>
  		            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e( 'More Text:', 'framework') ?></label>
  		            <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" cols="10" rows="5" ><?php echo $text; ?></textarea>
  		        </p>	
  		
  		<?php
      }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;  		
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['work'] = strip_tags($new_instance['work']);
		$instance['cell'] = strip_tags($new_instance['cell']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['text'] = $new_instance['text'];
		
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);		
			if ( empty($title) ) 
					$title = false;

        if ( function_exists( 'icl_translate' ) ) {
            $work = icl_translate( 'Widgets', 'quick_contact_work', $instance['work'] );
            $cell = icl_translate( 'Widgets', 'quick_contact_cell', $instance['cell'] );
            $fax = icl_translate( 'Widgets', 'quick_contact_fax', $instance['fax'] );
            $text = icl_translate( 'Widgets', 'quick_contact_text', $instance['text'] );
        } else {
            $work = $instance['work'];
            $cell = $instance['cell'];
            $fax = $instance['fax'];
            $text = $instance['text'];
        }

		
  		echo $before_widget; 
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
  		?>
        <div class="contact-widget">
            <p>
                <strong><?php _e('Work','framework'); ?> :</strong> <?php echo $work;?><br/>
                <strong><?php _e('Cell','framework'); ?> :</strong> <?php echo $cell;?><br/>
                <strong><?php _e('Fax','framework'); ?> :</strong> <?php echo $fax;?><br/>
            </p>
            <hr/>
            <p>
            <?php echo $text; ?>
            </p>
        </div>        
        <?php		  
        echo $after_widget;		  
  	}
	  
}

?>