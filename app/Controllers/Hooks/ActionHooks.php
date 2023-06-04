<?php
/**
 * Action Hooks class.
 *
 * @package GT_USERS
 */

namespace GT\GtUsers\Controllers\Hooks;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

use GT\GtUsers\Helpers\Fns;

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
		$attachment_id = get_user_meta( $user->ID, GT_USER_META_KEY, true );
		?>

		<h3><?php esc_html_e( 'Social profile information', 'gutenberg-users' ); ?></h3>

		<table class="form-table">
			<tr>
				<th><label for="facebook"><?php esc_html_e( 'Facebook', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_facebook" id="facebook"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_facebook', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your facebook URL.', 'gutenberg-users' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="twitter"><?php esc_html_e( 'Twitter', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_twitter" id="twitter"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_twitter', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Twitter username.', 'gutenberg-users' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="linkedin"><?php esc_html_e( 'LinkedIn', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_linkedin" id="linkedin"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_linkedin', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your LinkedIn Profile', 'gutenberg-users' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="gplus"><?php esc_html_e( 'Google+', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_gplus" id="gplus"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_gplus', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your google+ Profile', 'gutenberg-users' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="pinterest"><?php esc_html_e( 'Pinterest', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_pinterest" id="pinterest"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_pinterest', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Pinterest Profile', 'gutenberg-users' ); ?></span>
				</td>
			</tr>

			<tr>
				<th><label for="pinterest"><?php esc_html_e( 'User Avater', 'gutenberg-users' ); ?></label></th>
				<td>
					<?php echo get_avatar( $user->ID, self::$avatar_size, '', $user->display_name, [ 'class' => 'gt-users-attachment-avatar' ] ); ?>
					<p class="description <?php if ( ! empty( $attachment_id ) ) {
						echo 'hidden';
					} ?>"
					   id="gt-users-attachment-description"><?php _e( "You're seeing the default profile picture.", 'gutenberg-users' ); ?></p>
					<p>
						<button type="button" class="button"
						        id="gt-avatar-add"><?php _e( 'Choose Avatar', 'gutenberg-users' ); ?></button>
						<button type="button" class="button <?php if ( empty( $attachment_id ) ) {
							echo 'hidden';
						} ?>"
						        id="gt-avatar-remove"><?php _e( 'Remove Avatar', 'gutenberg-users' ); ?></button>
					</p>
				</td>
			</tr>

			<tr>
				<th><label for="designation"><?php esc_html_e( 'Designation', 'gutenberg-users' ); ?></label></th>
				<td><input type="text" name="gt_users_designation" id="designation"
				           placeholder="<?php esc_attr_e( 'Eg. Product Manager', 'gutenberg-users' ); ?>"
				           value="<?php echo esc_attr( get_the_author_meta( 'gt_users_designation', $user->ID ) ); ?>"
				           class="regular-text"/><br/><span
						class="description"><?php esc_html_e( 'Please enter your Designation', 'gutenberg-users' ); ?></span>
				</td>
			</tr>
		</table>

		<!-- Hidden attachment ID -->
		<input type="hidden" name="<?php echo GT_USER_META_KEY; ?>" value="<?php echo $attachment_id; ?>"/>

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

		update_user_meta( $user_id, 'gt_users_facebook', $_POST['gt_users_facebook'] );
		update_user_meta( $user_id, 'gt_users_twitter', $_POST['gt_users_twitter'] );
		update_user_meta( $user_id, 'gt_users_linkedin', $_POST['gt_users_linkedin'] );
		update_user_meta( $user_id, 'gt_users_gplus', $_POST['gt_users_gplus'] );
		update_user_meta( $user_id, 'gt_users_pinterest', $_POST['gt_users_pinterest'] );
		update_user_meta( $user_id, 'gt_users_author_designation', $_POST['gt_users_author_designation'] );
		update_user_meta( $user_id, 'gt_users_designation', $_POST['gt_users_designation'] );

		// Validate POST data and, if is ok, add it
		if ( ! empty( $_POST[ GT_USER_META_KEY ] ) ) {
			update_user_meta( $user_id, GT_USER_META_KEY, (int) $_POST[ GT_USER_META_KEY ] );
		}

	}

}