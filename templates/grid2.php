<?php
/**
 * User Grid layout 2
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
 * @var $job_role
 * @var $designation_visibility
 * @var $job_role_visibility
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
 * @var $name_order
 * @var $designation_order
 * @var $job_role_order
 * @var $contact_order
 * @var $biography_order
 * @var $social_order
 * @var $button_order
 * @var $hr_1_order
 * @var $hr_2_order
 * @var $hr_1_visibility
 * @var $hr_2_visibility
 */

use DOWP\UserGrid\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$col_class = Fns::get_dynamic_cols( $grid_column );
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
			<<?php echo esc_attr( $name_tag ); ?> class="user-name <?php echo esc_attr( $name_order ); ?>">
			<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $display_name ); ?></a>
		</<?php echo esc_attr( $name_tag ); ?>>
	<?php endif; ?>

		<?php if ( $hr_1_visibility ) : ?>
			<div class="hr-1 <?php echo esc_attr( $hr_1_order ); ?>"><span></span></div>
		<?php endif; ?>

		<?php if ( $designation && $designation_visibility ) : ?>
			<div class="user-designation <?php echo esc_attr( $designation_order ); ?>">
				<?php echo esc_html( $designation ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $job_role_visibility && $job_role ) : ?>
			<div class="user-short-desc <?php echo esc_attr( $job_role_order ); ?>">
				<?php echo esc_html( $job_role ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $email_visibility || $phone_visibility ) : ?>
			<div class="user-contact <?php echo esc_attr( $contact_order ); ?>">
				<?php if ( $email && $email_visibility ) : ?>
					<p><a class="user-email" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				<?php endif; ?>
				<?php if ( $phone && $phone_visibility ) : ?>
					<p><a class="user-phone" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $bio_visibility && $description ) : ?>
			<div class="user-biography <?php echo esc_attr( $biography_order ); ?>">
				<?php echo esc_html( $description ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $social_visibility ) : ?>
			<div class="dowp-user-social-icons <?php echo esc_attr( $social_order ); ?>">
				<?php Fns::get_user_social_icon( $user_id, $email_visibility, $phone_visibility ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $hr_2_visibility ) : ?>
			<div class="hr-2 <?php echo esc_attr( $hr_2_order ); ?>"><span></span></div>
		<?php endif; ?>

		<?php if ( $button_visibility ) : ?>
			<div class="read-articles-btn <?php echo esc_attr( $button_order ); ?>">
				<a class="read-btn <?php echo esc_attr( $button_style ); ?>"
				   href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
					<?php esc_html_e( 'Read Articles', 'user-grid' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
</div>
