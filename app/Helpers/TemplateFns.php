<?php
/**
 * Template Functions.
 *
 * @package USER_GRID
 */

namespace DOWP\UserGrid\Helpers;

// Do not allow directly accessing this file.
use DOWP\UserGrid\Utils\SvgIcons;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Helper class.
 */
class TemplateFns {

	/**
	 * Get user name
	 *
	 * @param $user_id
	 * @param $name_visibility
	 * @param $name_tag
	 * @param $name_order
	 * @param $display_name
	 *
	 * @return void
	 */
	public static function user_name( $user_id, $name_visibility, $name_tag, $name_order, $display_name ) {
		if ( ! $name_visibility ) {
			return;
		}
		?>
		<<?php echo esc_attr( $name_tag ); ?> class="user-name <?php echo esc_attr( $name_order ); ?>">
		<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php echo esc_html( $display_name ); ?></a>
		</<?php echo esc_attr( $name_tag ); ?>>
		<?php
	}

	/**
	 * Get User Designmation
	 *
	 * @param $designation
	 * @param $designation_visibility
	 * @param $designation_order
	 *
	 * @return void
	 */
	public static function user_designation( $designation, $designation_visibility, $designation_order ) {
		if ( $designation && $designation_visibility ) :
			?>
			<div class="user-designation <?php echo esc_attr( $designation_order ); ?>">
				<?php echo esc_html( $designation ); ?>
			</div>
		<?php
		endif;
	}

	/**
	 * Get User Job Role
	 *
	 * @param $job_role_visibility
	 * @param $job_role
	 * @param $job_role_order
	 *
	 * @return void
	 */
	public static function user_job_role( $job_role_visibility, $job_role, $job_role_order ) {
		if ( $job_role_visibility && $job_role ) :
			?>
			<div class="user-short-desc <?php echo esc_attr( $job_role_order ); ?>">
				<?php echo esc_html( $job_role ); ?>
			</div>
		<?php
		endif;
	}

	/**
	 * Get user contact
	 *
	 * @param $email_visibility
	 * @param $phone_visibility
	 * @param $email
	 * @param $phone
	 * @param $contact_order
	 *
	 * @return void
	 */
	public static function user_contact( $email_visibility, $phone_visibility, $email, $phone, $contact_order ) {
		if ( $email_visibility || $phone_visibility ) :
			?>
			<div class="user-contact <?php echo esc_attr( $contact_order ); ?>">
				<?php if ( $email && $email_visibility ) : ?>
					<p><a class="user-email" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				<?php endif; ?>
				<?php if ( $phone && $phone_visibility ) : ?>
					<p><a class="user-phone" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
				<?php endif; ?>
			</div>
		<?php
		endif;
	}

	/**
	 * User Biography
	 *
	 * @param $bio_visibility
	 * @param $description
	 * @param $biography_order
	 *
	 * @return void
	 */
	public static function user_biography( $bio_visibility, $description, $biography_order ) {
		if ( $bio_visibility && $description ) :
			?>
			<div class="user-biography <?php echo esc_attr( $biography_order ); ?>">
				<?php echo esc_html( $description ); ?>
			</div>
		<?php
		endif;
	}

	/**
	 * Get user social info
	 *
	 * @param $user_id
	 * @param $social_visibility
	 * @param $social_position
	 * @param $email_visibility
	 * @param $phone_visibility
	 * @param $social_order
	 *
	 * @return void
	 */
	public static function social_info( $user_id, $social_visibility, $social_position, $email_visibility, $phone_visibility, $social_order ) {
		if ( $social_visibility && 'spos-d' === $social_position ) : ?>
			<div class="dowp-user-social-icons <?php echo esc_attr( $social_order ); ?>">
				<?php Fns::get_user_social_icon( $user_id, $email_visibility, $phone_visibility ); ?>
			</div>
		<?php endif;
	}

	/**
	 * Get HR 1
	 *
	 * @param $hr_1_visibility
	 * @param $hr_1_order
	 *
	 * @return void
	 */
	public static function hr_1( $hr_1_visibility, $hr_1_order ) {
		if ( $hr_1_visibility ) :
			?>
			<div class="hr-1 <?php echo esc_attr( $hr_1_order ); ?>"><span></span></div>
		<?php
		endif;
	}

	/**
	 * Get HR 2
	 *
	 * @param $hr_2_visibility
	 * @param $hr_2_order
	 *
	 * @return void
	 */
	public static function hr_2( $hr_2_visibility, $hr_2_order ) {
		if ( $hr_2_visibility ) :
			?>
			<div class="hr-2 <?php echo esc_attr( $hr_2_order ); ?>"><span></span></div>
		<?php
		endif;
	}

	/**
	 * Get User read article button.
	 *
	 * @param $user_id
	 * @param $button_visibility
	 * @param $button_order
	 * @param $button_style
	 * @param $button_text
	 *
	 * @return void
	 */
	public static function user_button( $user_id, $button_visibility, $button_order, $button_style, $button_text ) {
		if ( ! $button_visibility || ! $button_text ) {
			return;
		}
		?>
		<div class="read-articles-btn <?php echo esc_attr( $button_order ); ?>">
			<a class="read-btn <?php echo esc_attr( $button_style ); ?>"
			   href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
				<?php echo esc_html( $button_text ); ?>
			</a>
		</div>
		<?php
	}
}
