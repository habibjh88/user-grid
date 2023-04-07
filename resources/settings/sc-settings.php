<?php
/**
 * Settings: Shortcode Settings
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
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'ShortCode Heading', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCHeadingSettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label">
		<label><?php esc_html_e( 'Category', 'gutenberg-users' ); ?></label>
	</div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCCategorySettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'Title', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCTitleSettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'Meta', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCMetaSettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'Image', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCImageSettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'Excerpt', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCExcerptSettings() ), true ); ?>
	</div>
</div>
<div class="field-holder">
	<div class="field-label"><?php esc_html_e( 'Read More Button', 'gutenberg-users' ); ?></div>
	<div class="field">
		<?php Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersSCButtonSettings() ), true ); ?>
	</div>
</div>
