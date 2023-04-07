<?php
/**
 * Style
 *
 * @package RT_TPG
 */

use GT\GtUsers\Helpers\Fns;
use GT\GtUsers\Helpers\Options;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersStyleFields() ), true );
?>

<div class="field-holder button-color-style-wrapper">
	<div class="field-label"><?php esc_html_e( 'Button Color', 'gutenberg-users' ); ?></div>
	<div class="field">
		<div class="tpg-multiple-field-group">
			<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersStyleButtonColorFields() ), true ); ?>
		</div>
	</div>
</div>

<div class="field-holder widget-heading-stle-wrapper">
	<div class="field-label"><?php esc_html_e( 'ShortCode Heading', 'gutenberg-users' ); ?></div>
	<div class="field">
		<div class="tpg-multiple-field-group">
			<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersStyleHeading() ), true ); ?>
		</div>
	</div>
</div>

<div class="field-holder full-area-style-wrapper">
	<div class="field-label"><?php esc_html_e( 'Full Area / Section', 'gutenberg-users' ); ?></div>
	<div class="field">
		<div class="tpg-multiple-field-group">
			<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersStyleFullArea() ), true ); ?>
		</div>
	</div>
</div>

<?php do_action( 'rt_tpg_sc_style_group_field' ); ?>

<?php Fns::print_html( Fns::rtSmartStyle( Options::extraStyle() ), true ); ?>
