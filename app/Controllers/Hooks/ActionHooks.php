<?php
/**
 * Action Hooks class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Controllers\Hooks;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

use DOWP\UserGrid\Helpers\Fns;

/**
 * Action Hooks class.
 */
class ActionHooks {
	private static $avatar_size = 96;

	/**
	 * Class init.
	 *
	 * @return void
	 */

	public static function init() {
		add_action( 'show_user_profile', [ __CLASS__, 'add_user_social_profile' ], 10 );
		add_action( 'edit_user_profile', [ __CLASS__, 'add_user_social_profile' ], 10 );
		add_action( 'personal_options_update', [ __CLASS__, 'update_profile_fields' ], 10 );
		add_action( 'edit_user_profile_update', [ __CLASS__, 'update_profile_fields' ], 10 );
	}

	/**
	 * Add user social markup
	 *
	 * @param $user
	 *
	 * @return void
	 */
	public static function add_user_social_profile( $user ) {
		$attachment_id = get_user_meta( $user->ID, USER_GRID_META_KEY, true );
		?>

		<h3><?php esc_html_e( 'Social profile information', 'user-grid' ); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="facebook"><?php esc_html_e( 'Facebook', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_facebook" id="facebook"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_facebook', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your facebook URL.', 'user-grid' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="twitter"><?php esc_html_e( 'Twitter', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_twitter" id="twitter"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_twitter', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Twitter username.', 'user-grid' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="linkedin"><?php esc_html_e( 'LinkedIn', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_linkedin" id="linkedin"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_linkedin', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your LinkedIn Profile', 'user-grid' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="gplus"><?php esc_html_e( 'Google+', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_gplus" id="gplus"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_gplus', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your google+ Profile', 'user-grid' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="pinterest"><?php esc_html_e( 'Pinterest', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_pinterest" id="pinterest"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_pinterest', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Pinterest Profile', 'user-grid' ); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="pinterest"><?php esc_html_e( 'User Avater', 'user-grid' ); ?></label></th>
				<td>
					<?php echo get_avatar( $user->ID, self::$avatar_size, '', $user->display_name, [ 'class' => 'user-grid-attachment-avatar' ] ); ?>
					<p class="description <?php if ( ! empty( $attachment_id ) ) {
						echo 'hidden';
					} ?>"
					   id="user-grid-attachment-description"><?php _e( "You're seeing the default profile picture.", 'user-grid' ); ?></p>
					<p>
						<button type="button" class="button"
						        id="gt-avatar-add"><?php _e( 'Choose Avatar', 'user-grid' ); ?></button>
						<button type="button" class="button <?php if ( empty( $attachment_id ) ) {
							echo 'hidden';
						} ?>"
						        id="gt-avatar-remove"><?php _e( 'Remove Avatar', 'user-grid' ); ?></button>
					</p>
				</td>
			</tr>

			<tr>
				<th><label for="designation"><?php esc_html_e( 'Designation', 'user-grid' ); ?></label></th>
				<td><input type="text" name="user_grid_designation" id="designation"
				           placeholder="<?php esc_attr_e( 'Eg. Product Manager', 'user-grid' ); ?>"
				           value="<?php echo esc_attr( get_the_author_meta( 'user_grid_designation', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Designation', 'user-grid' ); ?></span>
				</td>
			</tr>
		</table>

		<!-- Hidden attachment ID -->
		<input type="hidden" name="<?php echo USER_GRID_META_KEY; ?>" value="<?php echo $attachment_id; ?>"/>

		<?php
	}

	/**
	 * Update user social
	 *
	 * @param $user_id
	 *
	 * @return false|void
	 */
	public static function update_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		update_user_meta( $user_id, 'user_grid_facebook', $_POST['user_grid_facebook'] );
		update_user_meta( $user_id, 'user_grid_twitter', $_POST['user_grid_twitter'] );
		update_user_meta( $user_id, 'user_grid_linkedin', $_POST['user_grid_linkedin'] );
		update_user_meta( $user_id, 'user_grid_gplus', $_POST['user_grid_gplus'] );
		update_user_meta( $user_id, 'user_grid_pinterest', $_POST['user_grid_pinterest'] );
		update_user_meta( $user_id, 'user_grid_author_designation', $_POST['user_grid_author_designation'] );
		update_user_meta( $user_id, 'user_grid_designation', $_POST['user_grid_designation'] );

		// Validate POST data and, if is ok, add it
		if ( ! empty( $_POST[ USER_GRID_META_KEY ] ) ) {
			update_user_meta( $user_id, USER_GRID_META_KEY, (int) $_POST[ USER_GRID_META_KEY ] );
		}

	}

}