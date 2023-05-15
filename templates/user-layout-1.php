<?php
/**
 * User layout 1
 *
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use GT\GtUsers\Helpers\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user_info        = get_user_by( 'id', $data['user'] );
$avatar_size      = [ 'size' => $data['avatar_dimension'] ?? '300' ];
$avater_image_url = get_avatar_url( $user_info->ID, $avatar_size );
$designation  = get_user_meta( $user_info->ID, 'gt_users_designation', true );
//Columns
$default_grid_column_desktop = '4';
$default_grid_column_tab     = '6';
$default_grid_column_mobile  = '12';

$grid_column_desktop = ( isset( $data['grid_column']['lg'] ) && 0 != $data['grid_column']['lg'] ) ? $data['grid_column']['lg'] : $default_grid_column_desktop;
$grid_column_tab     = ( isset( $data['grid_column']['md'] ) && 0 != $data['grid_column']['md'] ) ? $data['grid_column']['md'] : $default_grid_column_tab;
$grid_column_mobile  = ( isset( $data['grid_column']['sm'] ) && 0 != $data['grid_column']['sm'] ) ? $data['grid_column']['sm'] : $default_grid_column_mobile;

$col_class = "cub-col-md-{$grid_column_desktop} cub-col-sm-{$grid_column_tab} cub-col-xs-{$grid_column_mobile}";
?>
<div class="user-item-col <?php echo esc_attr( $col_class ) ?>">
	<div class="user-inner-wrapper">
		<?php if ( $data['avatar_visibility'] ) : ?>
			<div class="user-avatar">
				<a class="user-link" href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>">
					<img width="<?php echo esc_attr( $avatar_size['size'] ) ?>px"
					     height="<?php echo esc_attr( $avatar_size['size'] ) ?>px"
					     src="<?php echo esc_url( $avater_image_url ) ?>"
					     alt="<?php echo esc_html( $user_info->display_name ) ?>"/>
				</a>
			</div>
		<?php endif; ?>
		<div class="user-content-wrap">
			<?php if ( $data['name_visibility'] ) : ?>
				<<?php echo esc_attr( $data['name_tag'] ) ?> class="user-name">
					<a href="<?php echo esc_url( get_author_posts_url( $user_info->ID ) ) ?>"><?php echo esc_html( $user_info->display_name ) ?></a>
				</<?php echo esc_attr( $data['name_tag'] ) ?>>
			<?php endif; ?>

				<?php if ( $designation && $data['designation_visibility'] ) : ?>
					<div class="user-designation">
						<?php echo esc_html( $designation ) ?>
					</div>
				<?php endif; ?>
				<?php
				if ( $data['social_visibility'] ) {
					echo Fns::get_user_social_icon( $user_info->ID, $data);
				}
				?>

				<?php if ( $data['bio_visibility'] ) : ?>
					<div class="cub-bio-wrapper">
						<a href="#" class="load-user-button" data-userid="<?php echo esc_attr( $user_info->ID ); ?>">
							<?php echo esc_html( "Load users's biography" ); ?>
						</a>

						<div class="user-modal-content">
							<div class="modal-inner">
								<div class="modal-header">
									<span><?php echo esc_html__( "User Biography", "gutenberg-users" ) ?></span>
									<button class="close-modal-btn"><i class="dashicons dashicons-no-alt"></i></button>
								</div>
								<?php if ( ! is_user_logged_in() && $data['bio_visible_for'] === 'loggedin' ) : ?>
									<?php if ( ! empty( $data['show_message_frontend'] ) ) : ?>
										<p class="user-biography"><?php echo esc_html( $data['show_message_frontend'] ) ?></p>
									<?php endif; ?>
								<?php else : ?>
									<div class="bio-content"></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
</div>
</div>