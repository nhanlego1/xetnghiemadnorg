<?php if (!justlanded_get_option('hide_post_meta_footer')) : ?>
	<div class="entry-footer">
		<?php
		printf( __( 'This article was posted in %1$s%2$s.', 'justlanded' ),
			get_the_category_list(', '),
			get_the_tag_list( __( ' and tagged ', 'justlanded' ), ', ', '' )
		);

		edit_post_link( __( 'Edit', 'justlanded' ), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>" );
		?>
	</div>
<?php endif; ?>