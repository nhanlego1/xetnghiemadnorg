<?php 

/**
 * Adds extra info to a users
 * profile information section
 */

function md_bonus_fields($user)
{
?>
	<table class="form-table">
		<tr>
			<th>
				<label for="md_twitter"><?php _e("Your Twitter Username:"); ?></label>
			</th>
			<td>
				<input type="text" name="md_twitter" id="md_twitter" value="<?php echo esc_attr(get_the_author_meta('md_twitter', $user->ID)); ?>" class="regular-text" /><br />
				<span class="description"><?php _e("Exclude @ symbol. Example: <a href=\"http://twitter.com/afrais/\" target=\"blank\">afrais</a>"); ?></span>
			</td>
		</tr>
	</table>
<?php
}
	add_action('show_user_profile', 'md_bonus_fields');
	add_action('edit_user_profile', 'md_bonus_fields');

 
function md_save_bonus_fields($user_id)
{
	if(!current_user_can('edit_user', $user_id))
	{
		return false;
	}
	update_usermeta($user_id, 'md_twitter', $_POST['md_twitter']);
}
	add_action('personal_options_update', 'md_save_bonus_fields');
	add_action('edit_user_profile_update', 'md_save_bonus_fields');