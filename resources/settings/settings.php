<?php
/**
 * Settings Page
 *
 * @package RT_TPG
 */

use GT\GtUsers\Helpers\Fns;
use GT\GtUsers\Helpers\Options;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}
?>

<div class="wrap gtusers-wrapper">
	<div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
	<h2><?php esc_html_e( 'The Post Grid Settings', 'gutenberg-users' ); ?></h2>
	<h3><?php esc_html_e( 'General settings', 'gutenberg-users' ); ?>
		<a style="margin-left: 15px; font-size: 15px;" href="<?php echo esc_url( rtTpg()->docLink() ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'gutenberg-users' ); ?></a>
	</h3>

	<div class="rt-setting-wrapper">
		<div class="rt-response"></div>
		<form id="gtusers-settings-form">
			<?php
			$settings = get_option( gtUsers()->options['settings'] );
			$last_tab = isset( $settings['_tpg_last_active_tab'] ) ? trim( $settings['_tpg_last_active_tab'] ) : 'common-settings';
			$html     = null;
			$html    .= '<div id="settings-tabs" class="rt-tabs rt-tab-container">';

			$html .= '<ul class="tab-nav rt-tab-nav">';
			$html .= sprintf(
				'<li%s><a href="#common-settings">%s</a></li>
                        <li%s><a href="#popup-fields">%s</a></li>
                        <li%s><a href="#social-share">%s</a></li>
                        <li%s><a href="#custom-script">%s</a></li>
                        <li%s><a href="#other-settings">%s</a></li>',
				$last_tab == 'common-settings' ? ' class="active"' : '',
				__( 'Common Settings', 'gutenberg-users' ),
				$last_tab == 'popup-fields' ? ' class="active"' : '',
				__( 'PopUp field selection', 'gutenberg-users' ),
				$last_tab == 'social-share' ? ' class="active"' : '',
				__( 'Social Share', 'gutenberg-users' ),
				$last_tab == 'custom-script' ? ' class="active"' : '',
				__( 'Custom Script', 'gutenberg-users' ),
				$last_tab == 'other-settings' ? ' class="active"' : '',
				__( 'Other Settings', 'gutenberg-users' )
			);

			ob_start();
			do_action( 'tpg_settings_tab_title', $last_tab );
			$html .= ob_get_clean();

			$html .= '</ul>';

			$html .= sprintf( '<div id="common-settings" class="rt-tab-content"%s>', $last_tab == 'common-settings' ? ' style="display:block"' : '' );
			$html .= Fns::rtFieldGenerator( Options::gtUsersSettingsCommonSettingsFields() );
			$html .= '</div>';

			$html .= sprintf( '<div id="popup-fields" class="rt-tab-content"%s>', $last_tab == 'popup-fields' ? ' style="display:block"' : '' );
			$html .= Fns::rtFieldGenerator( Options::rtTpgSettingsDetailFieldSelection() );
			$html .= '</div>';

			$html .= sprintf( '<div id="social-share" class="rt-tab-content"%s>', $last_tab == 'social-share' ? ' style="display:block"' : '' );
			$html .= Fns::rtFieldGenerator( Options::gtUsersSettingsSocialShareFields() );
			$html .= '</div>';

			$html .= sprintf( '<div id="custom-script" class="rt-tab-content"%s>', $last_tab == 'custom-script' ? ' style="display:block"' : '' );
			$html .= Fns::rtFieldGenerator( Options::gtUsersSettingsCustomScriptFields() );
			$html .= '</div>';

			$html .= sprintf( '<div id="other-settings" class="rt-tab-content"%s>', $last_tab == 'other-settings' ? ' style="display:block"' : '' );
			$html .= Fns::rtFieldGenerator( Options::gtUsersSettingsOtherSettingsFields() );
			$html .= '</div>';

			ob_start();
			do_action( 'tpg_settings_tab_content', $last_tab );
			$html .= ob_get_clean();

			$html .= sprintf( '<input type="hidden" id="_tpg_last_active_tab" name="_tpg_last_active_tab"  value="%s"/>', $last_tab );
			$html .= '</div>';

			Fns::print_html( $html, true );
			?>
			<p class="submit-wrap"><input type="submit" name="submit" class="button button-primary rtSaveButton" value="Save Changes"></p>

			<?php wp_nonce_field( gtUsers()->nonceText(), gtUsers()->nonceId() ); ?>
		</form>

		<div class="rt-response"></div>
	</div>
</div>
