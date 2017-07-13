<?php

/*-----------------------------------------------------------------------------------*/
/*	Add Page Title Metabox
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'page_title_meta_box_add' );
	
	function page_title_meta_box_add()
	{
		add_meta_box( 'page-title-meta-box', __('Page Title', 'framework'), 'page_title_meta_box', 'page', 'normal', 'high' );
	}
	
	function page_title_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$page_title = isset( $values['page_title'] ) ? esc_attr( $values['page_title'][0] ) : '';
		$page_sub_title = isset( $values['page_sub_title'] ) ? esc_attr( $values['page_sub_title'][0] ) : '';
		
		wp_nonce_field( 'page_title_meta_box_nonce', 'meta_box_nonce_page_title' );
		?>
		<table style="width:100%;">			
        	<tr>
				<td style="width:25%;">
					<label for="page_title"><strong><?php _e('Page Title','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="page_title" id="page_title" value="<?php echo $page_title; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('To highlight the specific words, You can wrap them in &lt;span&gt;&lt;/span&gt; tag','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%; vertical-align:top;">
					<label for="page_sub_title"><strong><?php _e('Page Sub Title','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<textarea name="page_sub_title" id="page_sub_title" cols="30" rows="3" style="width:80%; margin-right:4%; " ><?php echo $page_sub_title; ?></textarea>
                    <span style="color:#999; display:block;  margin-bottom:10px;"><?php _e('You can use &lt;br/&gt; tag for linebreak.','framework'); ?></span>
				</td>
			</tr>			
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'page_title_meta_box_save' );
	
	function page_title_meta_box_save( $post_id )
	{
		
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		if( !isset( $_POST['meta_box_nonce_page_title'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_page_title'], 'page_title_meta_box_nonce' ) ) return;
		
		if( !current_user_can( 'edit_post' ) ) return;				
		
		if( isset( $_POST['page_title'] ) )
			update_post_meta( $post_id, 'page_title', $_POST['page_title']  );
		
		if( isset( $_POST['page_sub_title'] ) )
			update_post_meta( $post_id, 'page_sub_title', $_POST['page_sub_title'] );

	}


/*-----------------------------------------------------------------------------------*/
/*	Add Page Title Metabox for Doctor
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'doctor_info_meta_box_add' );
	
	function doctor_info_meta_box_add()
	{
		add_meta_box( 'doctor-info-meta-box', __('Doctor Information', 'framework'), 'doctor_info_meta_box', 'doctor', 'normal', 'high' );
	}
	
	function doctor_info_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$doctor_name = isset( $values['doctor_name'] ) ? esc_attr( $values['doctor_name'][0] ) : '';		
		$doctor_education = isset( $values['doctor_education'] ) ? esc_attr( $values['doctor_education'][0] ) : '';
		$doctor_intro_text = isset( $values['doctor_intro_text'] ) ? esc_attr( $values['doctor_intro_text'][0] ) : '';
		$twitter_link = isset( $values['twitter_link'] ) ? esc_attr( $values['twitter_link'][0] ) : '';
		$facebook_link = isset( $values['facebook_link'] ) ? esc_attr( $values['facebook_link'][0] ) : '';
		
		wp_nonce_field( 'doctor_info_meta_box_nonce', 'doctor_meta_box_nonce_info' );
		?>
		<table style="width:100%;">			
        	<tr>
				<td style="width:25%;">
					<label for="doctor_name"><strong><?php _e('Doctor Name','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="doctor_name" id="doctor_name" value="<?php echo $doctor_name; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('To highlight the specific words, You can wrap them in &lt;span&gt;&lt;/span&gt; tag','framework'); ?></span>
				</td>
			</tr>
            <tr>
				<td style="width:25%;">
					<label for="doctor_education"><strong><?php _e('Doctor Education','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="doctor_education" id="doctor_education" value="<?php echo $doctor_education; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Example: MBBS , MD, ENT, ORTHO','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%; vertical-align:top;">
					<label for="doctor_intro_text"><strong><?php _e('Doctor Intro Text','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<textarea name="doctor_intro_text" id="doctor_intro_text" cols="30" rows="3" style="width:80%; margin-right:4%; " ><?php echo $doctor_intro_text; ?></textarea>
                    <span style="color:#999; display:block;  margin-bottom:10px;"><?php _e('You can use &lt;br/&gt; tag for linebreak.','framework'); ?></span>
				</td>
			</tr>	
            <tr>
				<td style="width:25%;">
					<label for="twitter_link"><strong><?php _e('Twitter URL','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="twitter_link" id="twitter_link" value="<?php echo $twitter_link; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php echo ''; ?></span>
				</td>
			</tr>
            <tr>
				<td style="width:25%;">
					<label for="facebook_link"><strong><?php _e('Facebook URL','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="facebook_link" id="facebook_link" value="<?php echo $facebook_link; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php echo ''; ?></span>
				</td>
			</tr>		
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'doctor_info_meta_box_save' );
	
	function doctor_info_meta_box_save( $post_id )
	{
		
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		if( !isset( $_POST['doctor_meta_box_nonce_info'] ) || !wp_verify_nonce( $_POST['doctor_meta_box_nonce_info'], 'doctor_info_meta_box_nonce' ) ) return;
		
		if( !current_user_can( 'edit_post' ) ) return;				
		
		if( isset( $_POST['doctor_name'] ) )
			update_post_meta( $post_id, 'doctor_name', $_POST['doctor_name']  );
		
		if( isset( $_POST['doctor_education'] ) )
			update_post_meta( $post_id, 'doctor_education', $_POST['doctor_education']  );
		
		if( isset( $_POST['doctor_intro_text'] ) )
			update_post_meta( $post_id, 'doctor_intro_text', $_POST['doctor_intro_text'] );
		
		if( isset( $_POST['twitter_link'] ) )
			update_post_meta( $post_id, 'twitter_link', $_POST['twitter_link']  );
		
		if( isset( $_POST['facebook_link'] ) )
			update_post_meta( $post_id, 'facebook_link', $_POST['facebook_link']  );

	}	


/*-----------------------------------------------------------------------------------*/
/*	Add Metabox to Slide
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'slide_meta_box_add' );
	
	function slide_meta_box_add()
	{
		add_meta_box( 'slide-meta-box', __('Slide Information', 'framework'), 'slide_meta_box', 'slide', 'normal', 'high' );
	}
	
	function slide_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$slide_sub_title = isset( $values['slide_sub_title'] ) ? esc_attr( $values['slide_sub_title'][0] ) : '';
		$slide_url = isset( $values['slide_url'] ) ? esc_attr( $values['slide_url'][0] ) : '';
		
		wp_nonce_field( 'slide_meta_box_nonce', 'meta_box_nonce_slide' );
		?>
		<table style="width:100%;">			
        	<tr>
				<td style="width:25%;">
					<label for="slide_sub_title"><strong><?php _e('Sub Title','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="slide_sub_title" id="slide_sub_title" value="<?php echo $slide_sub_title; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('This text will appear below Title in Slider Navigation.','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%; vertical-align:top;">
					<label for="slide_url"><strong><?php _e('Target URL','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
                    <input type="text" name="slide_url" id="slide_url" value="<?php echo $slide_url; ?>" style="width:60%; margin-right:4%;" />
                    <span style="color:#999; display:block;  margin-bottom:10px;"><?php _e('This URL will be applied on Slide Image.','framework'); ?></span>
				</td>
			</tr>			
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'slide_meta_box_save' );
	
	function slide_meta_box_save( $post_id )
	{
		
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		if( !isset( $_POST['meta_box_nonce_slide'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_slide'], 'slide_meta_box_nonce' ) ) return;
		
		if( !current_user_can( 'edit_post' ) ) return;				
		
		if( isset( $_POST['slide_sub_title'] ) )
			update_post_meta( $post_id, 'slide_sub_title', $_POST['slide_sub_title']  );
		
		if( isset( $_POST['slide_url'] ) )
			update_post_meta( $post_id, 'slide_url', $_POST['slide_url'] );

	}	
	
	

/*-----------------------------------------------------------------------------------*/
/*	Add Testimonial Metabox
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'testimonial_meta_box_add' );
	
	function testimonial_meta_box_add()
	{
		add_meta_box( 'testimonial-meta-box', __('Testimonial Settings', 'framework'), 'testimonial_meta_box', 'testimonial', 'normal', 'high' );
	}
	
	function testimonial_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$theTestimonial = isset( $values['the_testimonial'] ) ? esc_attr( $values['the_testimonial'][0] ) : '';
		$testimonialAuthor = isset( $values['testimonial_author'] ) ? esc_attr( $values['testimonial_author'][0] ) : '';
		$testimonialAuthorLink = isset( $values['testimonial_author_link'] ) ? esc_attr( $values['testimonial_author_link'][0] ) : '';
		$testimonial_department = isset( $values['testimonial_department'] ) ? esc_attr( $values['testimonial_department'][0] ) : '';
		
		wp_nonce_field( 'testimonial_meta_box_nonce', 'meta_box_nonce_testimonial' );
		?>
		<table style="width:100%;">			
			<tr>
				<td style="width:25%; vertical-align:top;">
					<label for="the_testimonial"><strong><?php _e('Testimonial','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<textarea name="the_testimonial" id="the_testimonial" cols="30" rows="10" style="width:75%; margin-right:4%; " ><?php echo $theTestimonial; ?></textarea>
                    <span style="color:#999; display:block;"><?php _e('Provide Testimonial Text','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%;">
					<label for="testimonial_author"><strong><?php _e('Author Name','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<input type="text" name="testimonial_author" id="testimonial_author" value="<?php echo $testimonialAuthor; ?>" style="width:35%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide Name of Author','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%;">
					<label for="testimonial_author_link"><strong><?php _e('Testimonial Author Link','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="testimonial_author_link" id="testimonial_author_link" value="<?php echo $testimonialAuthorLink; ?>" style="width:75%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide The URL to author website or page.','framework'); ?></span>
				</td>
			</tr>
            <tr>
				<td style="width:25%;">
					<label for="testimonial_department"><strong><?php _e('Related Department','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="testimonial_department" id="testimonial_department" value="<?php echo $testimonial_department; ?>" style="width:35%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide the name of related department.','framework'); ?></span>
				</td>
			</tr>            
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'testimonial_meta_box_save' );
	
	function testimonial_meta_box_save( $post_id )
	{
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['meta_box_nonce_testimonial'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_testimonial'], 'testimonial_meta_box_nonce' ) ) return;
		if( !current_user_can( 'edit_post' ) ) return;
		$allowed = array( 
			'a' => array(
				'href' => array()
			)
		);
		
		if( isset( $_POST['the_testimonial'] ) )
			update_post_meta( $post_id, 'the_testimonial', $_POST['the_testimonial'] );
			
		if( isset( $_POST['testimonial_author'] ) )
			update_post_meta( $post_id, 'testimonial_author', $_POST['testimonial_author'] );
			
		if( isset( $_POST['testimonial_author_link'] ) )
			update_post_meta( $post_id, 'testimonial_author_link', $_POST['testimonial_author_link'] );
			
		if( isset( $_POST['testimonial_department'] ) )
			update_post_meta( $post_id, 'testimonial_department', $_POST['testimonial_department'] );
			
	}
?>