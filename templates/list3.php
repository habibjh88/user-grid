<?php
/**
 * User List layout 3
 *
 * @author  DevOfWP
 * @since   1.0
 * @version 1.0
 *
 * @var $user_id
 * @var $display_name
 * @var $grid_column
 * @var $avatar_visibility
 * @var $name_visibility
 * @var $name_tag
 * @var $designation_visibility
 * @var $short_desc_visibility
 * @var $bio_visibility
 * @var $social_visibility
 * @var $email_visibility
 * @var $content_order
 * @var $button_visibility
 */

use DOWP\UserGrid\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$avatar_size      = [ 'size' => $avatar_dimension ?? '300' ];
$avater_image_url = get_avatar_url( $user_id, $avatar_size );
$designation      = get_user_meta( $user_id, 'user_grid_designation', true );
$description      = get_user_meta( $user_id, 'description', true );
$short_desc       = get_user_meta( $user_id, 'user_grid_short_desc', true );
$col_class        = Fns::get_dynamic_cols(
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
				<a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<img width="<?php echo esc_attr( $avatar_size['size'] ); ?>px"
					     height="<?php echo esc_attr( $avatar_size['size'] ); ?>px"
					     src="<?php echo esc_url( $avater_image_url ); ?>"
					     alt="<?php echo esc_html( $display_name ); ?>"/>
				</a>
			</div>
		<?php endif; ?>
		<div class="user-content-wrap">
			<?php if ( $name_visibility ) : ?>
			<<?php echo esc_attr( $name_tag ); ?> class="user-name">
			<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $display_name ); ?></a>
		</<?php echo esc_attr( $name_tag ); ?>>
	<?php endif; ?>

		<?php if ( $designation && $designation_visibility ) : ?>
			<div class="user-designation">
				<?php echo esc_html( $designation ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $short_desc_visibility && $short_desc ) : ?>
			<div class="user-short-desc">
				<?php echo esc_html( $short_desc ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $bio_visibility && $description ) : ?>
			<div class="user-biography">
				<?php echo esc_html( $description ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $social_visibility ) : ?>
            <div class="dwp-user-social-icons <?php Fns::order_class( 'social', $content_order ); ?>">
				<?php Fns::get_user_social_icon( $user_id, $email_visibility ); ?>
            </div>
		<?php endif; ?>

		<?php if ( $button_visibility ) : ?>
            <div class="read-articles-btn <?php Fns::order_class( 'button', $content_order ); ?>">
                <a class="read-btn" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<?php esc_html_e( 'Read Articles', 'user-grid' ); ?>
                </a>
            </div>
		<?php endif; ?>
	</div>
</div>
</div>