<?php
/* Create Custom Post Type : Slide */
function create_slide_post_type() 
{
	$labels = array(
		'name' => __( 'Slides','framework'),
		'singular_name' => __( 'Slide','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New Slide','framework'),
		'edit_item' => __('Edit Slide','framework'),
		'new_item' => __('New Slide','framework'),
		'view_item' => __('View Slide','framework'),
		'search_items' => __('Search Slide','framework'),
		'not_found' =>  __('No Slide found','framework'),
		'not_found_in_trash' => __('No Slide found in Trash','framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => true,
        'menu_icon' => 'dashicons-images-alt2',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','thumbnail')
	  ); 
	  
	  register_post_type('slide',$args);
}

add_action( 'init', 'create_slide_post_type' );


/* Add Custom Columns */
function slide_edit_columns($columns)
{

	$columns = array(
		  "cb" => '<input type="checkbox" >',
		  "title" => __( 'Slide Title','framework' ),		  
		  "thumb" => __( 'Thumbnail','framework' ),		  		 
		  "slide_sub_title" => __('Slide Sub Title','framework'),
		  "date" => __( 'Date','framework' )
	);
	
	return $columns;
}
add_filter("manage_edit-slide_columns", "slide_edit_columns");


function slide_custom_columns($column){
	global $post;
	switch ($column)
	{
		case 'thumb':
			if(has_post_thumbnail($post->ID))
			{
				the_post_thumbnail('slider-img-thumb');                   
			}
			else
			{
				_e('No Slider Image','framework');
			}
			break;		
		case 'slide_sub_title':
			$slide_sub_title = get_post_meta($post->ID,'slide_sub_title',true);
			if(!empty($slide_sub_title))
			{
				echo $slide_sub_title;
			}
			else
			{
				_e('NA','framework');
			}		
			break;
	}
}
add_action("manage_posts_custom_column", "slide_custom_columns");

?>