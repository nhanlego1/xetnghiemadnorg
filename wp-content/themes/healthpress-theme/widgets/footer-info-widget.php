<?php

class Footer_Information_Widget extends WP_Widget {
  
  	public function __construct() {
  		$widget_ops = array( 'classname' => 'Footer_Information_Widget', 'description' => __("This widget will display logo, description and read more link in footer.", 'framework') );
  		parent::__construct( 'Footer_Information_Widget', 'HealthPress : Footer Information Widget', $widget_ops);
  	}
  	
  	function form($instance) 
	{  
	    
        ?>
        <p><?php _e("Note: Please provide footer logo, footer about text and footer read more button link in Customizer.", 'framework'); ?></p>
        <?php
    }

  
  	function widget($args, $instance) 
	{
		extract($args);
  		echo $before_widget;				
		
			$theme_footer_logo = get_option('theme_footer_logo'); 

			if(!empty($theme_footer_logo))
			{
			    ?>
			    <h3>
			    <a href="<?php echo home_url(); ?>">
			    <img src="<?php echo $theme_footer_logo; ?>" alt="<?php  bloginfo( 'name' ); ?>">
			    </a>
			    </h3>
			    <?php
			}
            ?>            
            <p><?php echo stripslashes(get_option('theme_about_text')); ?></p>
            <?php
            $theme_footer_read_more = get_option('theme_footer_read_more');
            if(!empty($theme_footer_read_more))
            {
                ?>
                <a href="<?php echo stripslashes(get_option('theme_footer_read_more')); ?>" class="readmore"><?php _e("Read more", 'framework'); ?></a>
                <?php
            }
         
        echo $after_widget;		  
  	}
	  
}

?>