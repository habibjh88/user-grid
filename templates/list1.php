<?php
/**
 * User List layout 1
 *
 * @author  DevOfWP
 * @since   1.0
 * @version 1.0
 *
 * @var $user_id
 * @var $display_name
 * @var $grid_column
 * @var $avatar_dimension
 * @var $avatar_visibility
 * @var $name_visibility
 * @var $designation
 * @var $name_tag
 * @var $short_desc
 * @var $designation_visibility
 * @var $short_desc_visibility
 * @var $bio_visibility
 * @var $social_visibility
 * @var $email_visibility
 * @var $phone_visibility
 * @var $content_order
 * @var $button_visibility
 * @var $button_visibility
 * @var $button_style
 * @var $description
 * @var $email
 * @var $phone
 */

use DOWP\UserGrid\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$col_class = Fns::get_dynamic_cols(
	$grid_column,
	[
		'lg' => '12',
		'md' => '12',
		'sm' => '12',
	]
);
?>

<div class="user-item-col <?php echo esc_attr( $col_class ); ?>">
	<div class="user-inner-wrapper">
		<?php if ( $avatar_visibility ) : ?>
			<div class="user-avatar">
				<?php Fns::layout_image( $user_id, $avatar_dimension, '300', $display_name ); ?>
			</div>
		<?php endif; ?>
		<div class="user-content-wrap">
			<?php if ( $name_visibility ) : ?>
			<<?php echo esc_attr( $name_tag ); ?> class="user-name <?php Fns::order_class( 'title', $content_order ); ?>">
			<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $display_name ); ?></a>
		</<?php echo esc_attr( $name_tag ); ?>>
	<?php endif; ?>

		<?php if ( $designation && $designation_visibility ) : ?>
			<div class="user-designation <?php Fns::order_class( 'designation', $content_order ); ?>">
				<?php echo esc_html( $designation ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $short_desc_visibility && $short_desc ) : ?>
			<div class="user-short-desc <?php Fns::order_class( 'short_description', $content_order ); ?>">
				<?php echo esc_html( $short_desc ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $email_visibility || $phone_visibility ) : ?>
			<div class="user-contact <?php Fns::order_class( 'contact', $content_order ); ?>">
				<?php if ( $email && $email_visibility ) : ?>
					<p><a class="user-email" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				<?php endif; ?>
				<?php if ( $phone && $phone_visibility ) : ?>
					<p><a class="user-phone" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $bio_visibility && $description ) : ?>
			<div class="user-biography <?php Fns::order_class( 'biography', $content_order ); ?>">
				<?php echo esc_html( $description ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $social_visibility ) : ?>
			<div class="dowp-user-social-icons <?php Fns::order_class( 'social', $content_order ); ?>">
				<?php Fns::get_user_social_icon( $user_id, $email_visibility ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $button_visibility ) : ?>
			<div class="read-articles-btn <?php Fns::order_class( 'button', $content_order ); ?>">
				<a class="read-btn <?php echo esc_attr( $button_style ); ?>"
				   href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<?php esc_html_e( 'Read Articles', 'user-grid' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
</div>
