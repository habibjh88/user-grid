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
	 * Get Layout Image with Social
	 *
	 * @param $user_id
	 * @param $args
	 *
	 * @return void
	 */
	public static function layout_image_with_social( $user_id, $args ) {
		if ( ! $args['avatar_visibility'] ) {
			return;
		}
		echo '<div class="user-avatar">';
		if ( 'spos-d' !== $args['social_position'] && $args['social_visibility'] && userGrid()->hasPro() ) {
			echo "<div class='dowp-user-social-icons thumbnail-social " . esc_attr( $args['social_position'] ) . "'>";
			Fns::get_user_social_icon( $user_id, $args['email_visibility'], $args['phone_visibility'], $args['share_icon'] );
			echo '</div>';
		}
		Fns::layout_image( $user_id, $args['avatar_dimension'], $args['default_size'], $args['alt_txt'] );
		echo '</div>';
	}

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
	public static function user_name( $user_id, $display_name, $args ) {
		if ( ! $args['name_visibility'] ) {
			return;
		}
		?>
		<<?php echo esc_attr( $args['name_tag'] ); ?> class="user-name <?php echo esc_attr( $args['name_order'] ); ?>">
		<?php Fns::user_url( $user_id ); ?>
		<?php echo esc_html( $display_name ); ?>
		<?php Fns::user_url( $user_id, false ); ?>
		</<?php echo esc_attr( $args['name_tag'] ); ?>>
		<?php
	}


	/**
	 * Get User Designation
	 *
	 * @param $designation
	 * @param $args
	 *
	 * @return void
	 */
	public static function user_designation( $designation, $args ) {
		if ( $designation && $args['designation_visibility'] ) :
			?>
			<div class="user-designation <?php echo esc_attr( $args['designation_order'] ); ?>">
				<?php echo esc_html( $designation ); ?>
			</div>
			<?php
		endif;
	}

	/**
	 * Get User Job Role
	 *
	 * @param $job_role
	 * @param $args
	 *
	 * @return void
	 */
	public static function user_job_role( $job_role, $args ) {
		if ( $args['job_role_visibility'] && $job_role ) :
			?>
			<div class="user-short-desc <?php echo esc_attr( $args['job_role_order'] ); ?>">
				<?php echo esc_html( $job_role ); ?>
			</div>
			<?php
		endif;
	}

	/**
	 * Get user contact
	 *
	 * @param $email
	 * @param $phone
	 * @param $args
	 *
	 * @return void
	 */
	public static function user_contact( $email, $phone, $args ) {
		if ( $args['email_visibility'] || $args['phone_visibility'] ) :
			?>
			<div class="user-contact <?php echo esc_attr( $args['contact_order'] ); ?>">
				<?php if ( $email && $args['email_visibility'] ) : ?>
					<p><a class="user-email" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				<?php endif; ?>
				<?php if ( $phone && $args['phone_visibility'] ) : ?>
					<p><a class="user-phone" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
				<?php endif; ?>
			</div>
			<?php
		endif;
	}

	/**
	 * User Biography
	 *
	 * @param $description
	 * @param $args
	 *
	 * @return void
	 */
	public static function user_biography( $description, $args ) {
		if ( $args['bio_visibility'] && $description ) :
			?>
			<div class="user-biography <?php echo esc_attr( $args['biography_order'] ); ?>">
				<?php echo esc_html( $description ); ?>
			</div>
			<?php
		endif;
	}

	/**
	 * Get user social info
	 *
	 * @param $user_id
	 * @param $args
	 *
	 * @return void
	 */
	public static function social_info( $user_id, $args ) {
		if ( $args['social_visibility'] && 'spos-d' === $args['social_position'] ) :
			?>
			<div class="dowp-user-social-icons <?php echo esc_attr( $args['social_order'] ); ?>">
				<?php Fns::get_user_social_icon( $user_id, $args['email_visibility'], $args['phone_visibility'] ); ?>
			</div>
			<?php
		endif;
	}

	/**
	 * Get HR 1
	 *
	 * @param $hr_1_visibility
	 * @param $hr_1_order
	 *
	 * @return void
	 */
	public static function hr_1( $args ) {
		if ( $args['hr_1_visibility'] ) :
			?>
			<div class="hr-1 <?php echo esc_attr( $args['hr_1_order'] ); ?>"><span></span></div>
			<?php
		endif;
	}

	/**
	 * Get HR 2
	 *
	 * @param $args
	 *
	 * @return void
	 */
	public static function hr_2( $args ) {
		if ( $args['hr_2_visibility'] ) :
			?>
			<div class="hr-2 <?php echo esc_attr( $args['hr_2_order'] ); ?>"><span></span></div>
			<?php
		endif;
	}

	/**
	 * Get User read article button.
	 *
	 * @param $user_id
	 * @param $args
	 *
	 * @return void
	 */
	public static function user_button( $user_id, $args ) {
		if ( ! $args['button_visibility'] || ! $args['button_text'] ) {
			return;
		}
		?>
		<div class="read-articles-btn <?php echo esc_attr( $args['button_order'] ); ?>">
			<a class="read-btn <?php echo esc_attr( $args['button_style'] ); ?>"
			   href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
				<?php echo esc_html( $args['button_text'] ); ?>
			</a>
		</div>
		<?php
	}

	/**
	 * @param $user_id
	 *
	 * @return void
	 */
	public static function recent_posts( $user_id, $args ) {

		if ( ! $args['post_visibility'] ) {
			return;
		}

		$post_args = array(
			'post_type'      => 'post',
			'posts_per_page' => $args['post_number'] ?? 3,
			'post_status'    => 'publish',
			'author'         => $user_id,
		);
		$postslist = get_posts( $post_args );
		?>

		<?php if ( $postslist ) { ?>
			<div class='user-recent-posts'>

			<?php if ( ! empty( $args['main_title_text'] ) ) : ?>
			<h3 class="recent-posts-title"><?php echo esc_html( $args['main_title_text'] ); ?></h3>
				<?php
			endif;

			foreach ( $postslist as $post ) :
				setup_postdata( $post );

				?>
				<div class="post-item">
					<?php if ( $args['show_post_img'] ) : ?>
						<div class="post-image">
							<?php
							$thumb_id = get_post_thumbnail_id( $post );
							echo wp_get_attachment_image( $thumb_id );
							?>
						</div>
					<?php endif; ?>
					<div class="post-content">
						<h4 class="post-title"><a href="<?php echo esc_url( get_the_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h4>
						<?php if ( $args['show_post_cat'] || $args['show_post_date'] ) : ?>
							<ul class="post-meta">

								<?php if ( $args['show_post_cat'] ) : ?>
								<li><?php echo get_the_category_list( ',', '', $post ); ?></li> <?php //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php endif; ?>

								<?php if ( $args['show_post_date'] ) : ?>
								<li><?php echo get_the_date( null, $post ); ?></li>
								<?php endif; ?>

							</ul>
						<?php endif; ?>
					</div>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			echo '</div>';
		}
	}

		/**
		 * Get Dynamic columns for each block
		 *
		 * @param $grid_column
		 * @param $default_grid_columns
		 *
		 * @return string
		 */
	public static function get_dynamic_cols( $grid_column, $default_grid_columns = [] ) {
		if ( ! $default_grid_columns ) {
			$default_grid_columns = [
				'lg' => '3',
				'md' => '6',
				'sm' => '12',
			];
		}
		$grid_column_desktop = ( isset( $grid_column['lg'] ) && 0 != $grid_column['lg'] ) ? $grid_column['lg'] : $default_grid_columns['lg'];
		$grid_column_tab     = ( isset( $grid_column['md'] ) && 0 != $grid_column['md'] ) ? $grid_column['md'] : $default_grid_columns['md'];
		$grid_column_mobile  = ( isset( $grid_column['sm'] ) && 0 != $grid_column['sm'] ) ? $grid_column['sm'] : $default_grid_columns['sm'];

		return "dowp-col-md-{$grid_column_desktop} dowp-col-sm-{$grid_column_tab} dowp-col-xs-{$grid_column_mobile}";
	}
}
