<?php
/**
 * Settings: Item Fields
 *
 * @package RT_TPG
 */

use GT\GtUsers\Helpers\Fns;
use GT\GtUsers\Helpers\Options;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

Fns::print_html( Fns::rtFieldGenerator( Options::itemFields() ), true );
