<?php global $authordata, $data; ?>
<div class="entry-meta">
	<?php if (!justlanded_get_option('hide_post_author')) : ?>
		<span class="author vcard"><?php _e('By', 'justlanded'); ?> <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( 'View all articles by %s', 'justlanded' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
	<?php endif; ?>
	<?php if (!justlanded_get_option('hide_post_meta') && !justlanded_get_option('hide_post_meta_comments') ) : ?>
		<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
	<?php endif; ?>
	<? if ( comments_open() ) : ?>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'justlanded' ), __( '1 Comment', 'justlanded' ), __( '% Comments', 'justlanded' ) ); ?></span>
	<? endif; ?>
	<?php edit_post_link( __( 'Edit', 'justlanded' ), "<span class=\"edit-link\">", "</span>\n" ) ?>
</div>