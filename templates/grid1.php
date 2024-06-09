<?php
/**
 * User Grid layout 1
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
 * @var $social_position
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
 * @var $card_bg
 * @var $button_text
 * @var $post_visibility
 */

use DOWP\UserGrid\Helpers\Fns;
use DOWP\UserGrid\Helpers\TemplateFns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$col_class = Fns::get_dynamic_cols( $grid_column );
?>

<div class="user-item-col <?php echo esc_attr( $col_class ); ?>"
	 style="<?php echo esc_attr( $card_bg ? "--card-bg:$card_bg" : '' ); ?>">
	<div class="user-inner-wrapper">
		<?php if ( $avatar_visibility ) : ?>

			<?php
			Fns::layout_image_with_social(
				[
					'user_id'           => $user_id,
					'avatar_dimension'  => $avatar_dimension,
					'default_size'      => 300,
					'display_name'      => $display_name,
					'social_visibility' => $social_visibility,
					'social_position'   => $social_position,
					'alt_txt'           => $display_name,
					'email_visibility'  => $email_visibility,
					'phone_visibility'  => $phone_visibility,
					'share_icon'        => true,
				]
			);
			?>

		<?php endif; ?>

		<div class="user-content-wrap">
			<?php TemplateFns::user_name( $user_id, $name_visibility, $name_tag, $name_order, $display_name ); ?>
			<?php TemplateFns::hr_1( $hr_1_visibility, $hr_1_order ); ?>
			<?php TemplateFns::user_designation( $designation, $designation_visibility, $designation_order ); ?>
			<?php TemplateFns::user_job_role( $job_role_visibility, $job_role, $job_role_order ); ?>
			<?php TemplateFns::user_contact( $email_visibility, $phone_visibility, $email, $phone, $contact_order ); ?>
			<?php TemplateFns::user_biography( $bio_visibility, $description, $biography_order ); ?>
			<?php TemplateFns::social_info( $user_id, $social_visibility, $social_position, $email_visibility, $phone_visibility, $social_order ); ?>
			<?php TemplateFns::hr_2( $hr_2_visibility, $hr_2_order ); ?>
			<?php TemplateFns::user_button( $user_id, $button_visibility, $button_order, $button_style, $button_text ); ?>
		</div>

		<?php Fns::recent_posts( $user_id, $post_visibility ); ?>
	</div>
</div>
