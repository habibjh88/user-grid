<?php
/**
 * Action Hooks class.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Hooks;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

use DOWP\UserGrid\Controllers\ScriptController;
use DOWP\UserGrid\Helpers\Fns;

//phpcs:disable WordPress.Security.NonceVerification.Missing

/**
 * Action Hooks class.
 */
class ActionHooks {

	private static $avatar_size = 300;

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
		$attachment_id = get_user_meta( $user->ID, userGrid()->avatar_meta_key, true );
		$social_list   = Fns::social_list();
		?>
		<br>
		<div class="user-gird-user-informationi" style="background: #FFF;border: 1px solid #dbdbdb; padding: 15px 30px; border-radius: 10px;">
			<h3><?php esc_html_e( 'User Grid: Extra User information', 'user-grid' ); ?></h3>
			<p><?php esc_html_e( 'The following settings are derived from the User Grid plugin. That helps to create more professional user blocks.', 'user-grid' ); ?></p>
			<table class="form-table">

				<tr>
					<th><label for="user-image"><?php esc_html_e( 'User Image', 'user-grid' ); ?></label></th>
					<td>
						<div class="user-grid-attachment-avatar" style="max-height: 300px;display:inline-block;">
							<?php
							$default_avatar = ScriptController::get_default_avatar_url( $user->user_email );
							$des_hidden     = ! empty( $attachment_id ) ? 'hidden' : '';
							$btn_hidden     = empty( $attachment_id ) ? 'hidden' : '';
							echo get_avatar( $user->ID, self::$avatar_size, '', $user->display_name );
							?>
						</div>
						<p class="description <?php echo esc_attr( $des_hidden ); ?>" id="user-grid-attachment-description">
							<?php esc_html_e( "You're seeing the default profile picture.", 'user-grid' ); ?>
						</p>

						<?php if ( current_user_can( 'upload_files' ) ) : ?>
							<p class="action-button">
								<input type="hidden" class="input_default_avatar" value="<?php echo esc_attr( $default_avatar ); ?>">

								<button type="button" class="button" id="gt-avatar-add">
									<?php esc_html_e( 'Choose Avatar', 'user-grid' ); ?>
								</button>

								<button type="button" class="button <?php echo esc_attr( $btn_hidden ); ?>" id="gt-avatar-remove">
									<?php esc_html_e( 'Remove Avatar', 'user-grid' ); ?>
								</button>
							</p>
						<?php endif; ?>

						<input type="hidden" name="<?php echo esc_attr( userGrid()->avatar_meta_key ); ?>" value="<?php echo esc_attr( $attachment_id ); ?>"/>

					</td>
				</tr>

				<tr>
					<th><label for="user_grid_designation"><?php esc_html_e( 'Designation', 'user-grid' ); ?></label></th>
					<td><input type="text" name="user_grid_designation" id="user_grid_designation"
							   placeholder="<?php esc_attr_e( 'Founder & CEO', 'user-grid' ); ?>"
							   value="<?php echo esc_attr( get_the_author_meta( 'user_grid_designation', $user->ID ) ); ?>"
							   class="regular-text"/><br/><span
							class="description"><?php esc_html_e( 'Please enter your Designation', 'user-grid' ); ?></span>
					</td>
				</tr>

				<tr>
					<th><label for="user_grid_job_role"><?php esc_html_e( 'Job Role', 'user-grid' ); ?></label></th>
					<td><input type="text" name="user_grid_job_role" id="user_grid_job_role"
							   placeholder="<?php esc_attr_e( 'Lead engineering teams at DevOfWP, Pitch, and Protocol Labs.', 'user-grid' ); ?>"
							   value="<?php echo esc_attr( get_the_author_meta( 'user_grid_job_role', $user->ID ) ); ?>"
							   style="width: 500px;max-width: 100%"
							   class="regular-text"/><br/><span
							class="description"><?php esc_html_e( 'Please enter your Job Role', 'user-grid' ); ?></span>
					</td>
				</tr>
				<tr>
					<th><label for="user_grid_custom_url"><?php esc_html_e( 'Custom Author URL', 'user-grid' ); ?></label></th>
					<td><input type="text" name="user_grid_custom_url" id="user_grid_custom_url"
							   placeholder="<?php esc_attr_e( 'Enter custom url for the user', 'user-grid' ); ?>"
							   value="<?php echo esc_attr( get_the_author_meta( 'user_grid_custom_url', $user->ID ) ); ?>"
							   style="width: 500px;max-width: 100%"
							   class="regular-text"/><br/><span
							class="description"><?php esc_html_e( 'Enter custom url instead of the author post url. Avoid this field if you would not like to redirect the user to a different page.`', 'user-grid' ); ?></span>
					</td>
				</tr>

				<!-- User Social Info-->
				<?php
				foreach ( $social_list as $s_id => $s_title ) {
					$input_id  = 'user_grid_' . $s_id;
					$input_val = get_the_author_meta( $input_id, $user->ID );
					?>
					<tr>
						<th><label for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $s_title ); ?></label></th>
						<td><input type="text"
								   name="<?php echo esc_attr( $input_id ); ?>"
								   id="<?php echo esc_attr( $input_id ); ?>"
								   value="<?php echo esc_attr( $input_val ); ?>"
								   class="regular-text"/><br/>
							<span class="description">
							<?php
							// translators: %s is the Social title.
							printf( esc_html__( 'Please enter your %s link.', 'user-grid' ), esc_html( $s_title ) )
							?>
						</span>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		<style>
			img {
				object-fit: cover
			}
		</style>
		<?php
		wp_nonce_field( userGrid()->nonceText(), userGrid()->nonceId() );
	}

	/**
	 * Update user social
	 *
	 * @param $user_id
	 *
	 * @return false|void
	 */
	public static function update_profile_fields( $user_id ) {
		$social_list = Fns::social_list();
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		if ( ! Fns::verifyNonce() ) {
			return;
		}

		foreach ( $social_list as $s_id => $s_title ) {
			$input_id = 'user_grid_' . $s_id;

			if ( isset( $_POST[ $input_id ] ) ) {
				update_user_meta( $user_id, $input_id, sanitize_text_field( wp_unslash( $_POST[ $input_id ] ) ) );
			}
		}

		// Validate POST data and, if is ok, add it.
		if ( ! empty( $_POST[ userGrid()->avatar_meta_key ] ) ) {
			update_user_meta( $user_id, userGrid()->avatar_meta_key, (int) $_POST[ userGrid()->avatar_meta_key ] );
		}
		if ( isset( $_POST['user_grid_job_role'] ) ) {
			update_user_meta( $user_id, 'user_grid_job_role', sanitize_text_field( wp_unslash( $_POST['user_grid_job_role'] ) ) );
		}
		if ( isset( $_POST['user_grid_designation'] ) ) {
			update_user_meta( $user_id, 'user_grid_designation', sanitize_text_field( wp_unslash( $_POST['user_grid_designation'] ) ) );
		}
		if ( isset( $_POST['user_grid_custom_url'] ) ) {
			update_user_meta( $user_id, 'user_grid_custom_url', sanitize_text_field( wp_unslash( $_POST['user_grid_custom_url'] ) ) );
		}
	}
}
