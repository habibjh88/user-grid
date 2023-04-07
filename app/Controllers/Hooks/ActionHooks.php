<?php
/**
 * Action Hooks class.
 *
 * @package RT_TPG
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

		add_action( 'wp_ajax_tpg_user_biography', [ __CLASS__, 'tpg_user_biography' ] );
		add_action( 'wp_ajax_noprev_tpg_user_biography', [ __CLASS__, 'tpg_user_biography' ] );
	}

	public static function add_user_social_profile( $user ) {

		?>

        <h3><?php esc_html_e( 'Social profile information', 'the-post-grid' ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="facebook"><?php esc_html_e( 'Facebook', 'the-post-grid' ); ?></label></th>
                <td><input type="text" name="cub_facebook" id="facebook"
                           value="<?php echo esc_attr( get_the_author_meta( 'cub_facebook', $user->ID ) ); ?>"
                           class="regular-text"/><br/><span
                            class="description"><?php esc_html_e( 'Please enter your facebook URL.', 'the-post-grid' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php esc_html_e( 'Twitter', 'the-post-grid' ); ?></label></th>
                <td><input type="text" name="cub_twitter" id="twitter"
                           value="<?php echo esc_attr( get_the_author_meta( 'cub_twitter', $user->ID ) ); ?>"
                           class="regular-text"/><br/><span
                            class="description"><?php esc_html_e( 'Please enter your Twitter username.', 'the-post-grid' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="linkedin"><?php esc_html_e( 'LinkedIn', 'the-post-grid' ); ?></label></th>
                <td><input type="text" name="cub_linkedin" id="linkedin"
                           value="<?php echo esc_attr( get_the_author_meta( 'cub_linkedin', $user->ID ) ); ?>"
                           class="regular-text"/><br/><span
                            class="description"><?php esc_html_e( 'Please enter your LinkedIn Profile', 'the-post-grid' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="gplus"><?php esc_html_e( 'Google+', 'the-post-grid' ); ?></label></th>
                <td><input type="text" name="cub_gplus" id="gplus"
                           value="<?php echo esc_attr( get_the_author_meta( 'cub_gplus', $user->ID ) ); ?>"
                           class="regular-text"/><br/><span
                            class="description"><?php esc_html_e( 'Please enter your google+ Profile', 'the-post-grid' ); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="pinterest"><?php esc_html_e( 'Pinterest', 'the-post-grid' ); ?></label></th>
                <td><input type="text" name="cub_pinterest" id="pinterest"
                           value="<?php echo esc_attr( get_the_author_meta( 'cub_pinterest', $user->ID ) ); ?>"
                           class="regular-text"/><br/><span
                            class="description"><?php esc_html_e( 'Please enter your Pinterest Profile', 'the-post-grid' ); ?></span>
                </td>
            </tr>
        </table>
		<?php
	}

	/**
	 * @param $user_id
	 *
	 * @return false|void
	 */
	public static function update_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}

		update_user_meta( $user_id, 'cub_facebook', $_POST['cub_facebook'] );
		update_user_meta( $user_id, 'cub_twitter', $_POST['cub_twitter'] );
		update_user_meta( $user_id, 'cub_linkedin', $_POST['cub_linkedin'] );
		update_user_meta( $user_id, 'cub_gplus', $_POST['cub_gplus'] );
		update_user_meta( $user_id, 'cub_pinterest', $_POST['cub_pinterest'] );
		update_user_meta( $user_id, 'cub_author_designation', $_POST['cub_author_designation'] );
	}

	/**
     * Get User Biography Ajax Callback
	 * @return void
	 */
	public static function tpg_user_biography() {

		$user_info = get_user_by( 'id', $_REQUEST['user_id'] );
		$biography = get_user_meta( $user_info->ID, 'description', true );

		if ( ! empty( $biography ) ) {
			$return = [
				'success'   => "ok",
				'biography' => $biography
			];
		} else {
			$return = [
				'success'   => "error",
			];
		}
		wp_send_json( $return );
		wp_die();
	}

}