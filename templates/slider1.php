<?php
/**
 * User Grid layout 1
 *
 * @author  devofwp
 * @since   1.0
 * @version 1.0
 *
 * @var $user_id
 * @var $card_bg
 * @var $display_name
 * @var $designation
 * @var $job_role
 * @var $email
 * @var $phone
 * @var $description
 * @var $grid_column
 * @var $post_args
 * @var $name_args
 * @var $hr1_args
 * @var $hr2_args
 * @var $designation_args
 * @var $job_role_args
 * @var $contact_args
 * @var $bio_args
 * @var $social_args
 * @var $button_args
 */


use USGR\UserGrid\Helpers\TemplateFns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="user-item-col" style="<?php echo esc_attr( $card_bg ? "--card-bg:$card_bg" : '' ); ?>">
	<div class="user-inner-wrapper">
		<?php
			$image_args['alt_txt'] = $display_name;
			TemplateFns::layout_image_with_social( $user_id, $image_args );
		?>
		<div class="user-content-wrap">
			<?php TemplateFns::user_name( $user_id, $display_name, $name_args ); ?>
			<?php TemplateFns::hr_1( $hr1_args ); ?>
			<?php TemplateFns::user_designation( $designation, $designation_args ); ?>
			<?php TemplateFns::user_job_role( $job_role, $job_role_args ); ?>
			<?php TemplateFns::user_contact( $email, $phone, $contact_args ); ?>
			<?php TemplateFns::user_biography( $description, $bio_args ); ?>
			<?php TemplateFns::social_info( $user_id, $social_args ); ?>
			<?php TemplateFns::hr_2( $hr2_args ); ?>
			<?php TemplateFns::user_button( $user_id, $button_args ); ?>
		</div>

		<?php TemplateFns::recent_posts( $user_id, $post_args ); ?>
	</div>
</div>
