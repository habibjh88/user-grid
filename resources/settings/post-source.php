<?php
/**
 * Settings: Post Source
 *
 * @package RT_TPG
 */

use GT\GtUsers\Helpers\Fns;
use GT\GtUsers\Helpers\Options;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

Fns::print_html( Fns::rtFieldGenerator( Options::gtUsersPostType() ), true );

$sHtml  = null;
$sHtml .= '<div class="field-holder gtusers-field-group">';
$sHtml .= '<div class="field-label">Common Filters</div>';
$sHtml .= '<div class="field">';
$sHtml .= Fns::rtFieldGenerator( Options::gtUsersCommonFilterFields() );
$sHtml .= '</div>';
$sHtml .= '</div>';

Fns::print_html( $sHtml, true );
?>

<div class='gtusers-filter-container gtusers-field-group'>
	<?php Fns::print_html( Fns::rtFieldGenerator( Options::rtTPAdvanceFilters() ), true ); ?>
	<div class="gtusers-filter-holder">
		<?php
		$html       = null;
		$pt         = get_post_meta( $post->ID, 'tpg_post_type', true );
		$advFilters = Options::rtTPAdvanceFilters();
		Fns::print_html( $html, true );
		?>
	</div>
</div>

<div class="gtusers-field-group">
	<?php Fns::print_html( Fns::rtFieldGenerator( Options::stickySettings() ), true ); ?>
</div>
