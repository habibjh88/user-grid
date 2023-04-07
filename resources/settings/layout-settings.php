<?php
/**
 * Settings: Layout Settings
 *
 * @package RT_TPG
 */

use GT\GtUsers\Helpers\Fns;
use GT\GtUsers\Helpers\Options;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersLayoutSettingFields() ), true );
echo '<div class="rd-responsive-column">';
Fns::print_html( Fns::rtFieldGenerator( Options::responsiveSettingsColumn() ), true );
echo '</div>';
Fns::print_html( Fns::rtFieldGenerator( Options::layoutMiscSettings() ), true );
