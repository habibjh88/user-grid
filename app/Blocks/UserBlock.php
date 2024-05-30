<?php

namespace DOWP\UserGrid\Blocks;

use DOWP\UserGrid\Helpers\Fns;
use DOWP\UserGrid\Abstract\BlockBase;
use DOWP\UserGrid\Helpers\Attributes;

/**
 * UserBlock Class
 */
class UserBlock extends BlockBase {

	private $prefix;

	private $block_type;

	/**
	 * Class Constructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		$this->block_type = 'dowp/user-grid';
	}

	/**
	 * Register Block
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type(
			$this->block_type,
			[
				'render_callback' => [ $this, 'render_block' ],
				'attributes'      => $this->get_attributes(),
			]
		);
	}

	/**
	 * Get attributes
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	public function get_attributes() {
		$initial = [
			'uniqueId' => [
				'type'    => 'string',
				'default' => '',
			],

			'preview'  => [
				'type'    => 'boolean',
				'default' => false,
			],
		];

		return array_merge(
			$initial,
			Attributes::layout(),
			Attributes::query(),
			Attributes::visibility(),
			Attributes::image(),
			Attributes::user_name(),
			Attributes::designation(),
			Attributes::email(),
			Attributes::phone(),
			Attributes::biography(),
			Attributes::job_role(),
			Attributes::social(),
			Attributes::button(),
			Attributes::card(),
		);
	}

	/**
	 * Render Block
	 *
	 * @param array $data
	 *
	 * @return false|string
	 */
	public function render_block( $data ) {
		ob_start();
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$user_limit = $data['user_limit'] ?? 6;
		if ( 1 == $paged ) {
			$offset = 0;
		} else {
			$offset = ( $paged - 1 ) * $user_limit;
		}

		$args = [
			'number' => $user_limit,
			'offset' => $offset,
		];

		if ( ! empty( $data['users_role'] ) ) {
			$args['role__in'] = wp_list_pluck( $data['users_role'], 'value' );
		}

		if ( ! empty( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( ! empty( $data['user_filter_by_domain'] ) ) {
			$args['search']         = '*' . $data['user_filter_by_domain'] . '*';
			$args['search_columns'] = [ 'user_email' ];
		}

		if ( ! empty( $data['users_lists'] ) ) {
			$args['include'] = wp_list_pluck( $data['users_lists'], 'value' );
			$args['orderby'] = 'include';
		}

		$user_query     = new \WP_User_Query( $args );  // get_users( $args );
		$uniqueId       = $data['uniqueId'] ?? null;
		$wrapper_class  = 'dowp-block-usergrid dowp-block-' . $uniqueId;
		$wrapper_class .= 'yes' == $data['image_link'] ? '' : ' no-image-link';

		$inner_class  = preg_replace( '/[0-9]/', '', $data['layout'] ) . '-style';
		$inner_class .= Fns::extendClass( $data['layout'] );
		$inner_class .= ' dowp-' . $data['layout'];
		$inner_class .= ' ' . $data['grid_height'];
		$inner_class .= ' ' . Fns::layout_align( $data['grid_alignment'] );
		$layout_data  = Fns::get_post_args( $data );
		?>

	<div class="<?php echo esc_attr( $wrapper_class ); ?>">
	  <div
		class="dowp-users-block-wrapper clearfix <?php echo esc_attr( $inner_class ); ?>">
				<?php if ( ! empty( $user_query->results ) ) { ?>
		  <div class="dowp-row">
						<?php
						foreach ( $user_query->results as $user ) {
							$user_id                     = $user->ID;
							$layout_data['user_id']      = $user_id;
							$layout_data['display_name'] = $user->display_name;
							$layout_data['email']        = $user->user_email;
							$layout_data['designation']  = get_user_meta( $user_id, 'user_grid_designation', true );
							$layout_data['description']  = get_user_meta( $user_id, 'description', true );
							$layout_data['phone']        = get_user_meta( $user_id, 'user_grid_phone', true );
							$layout_data['job_role']   = get_user_meta( $user_id, 'user_grid_job_role', true );
							Fns::get_template( $data['layout'], $layout_data );
						}
						?>
		  </div>
					<?php
				} else {
					?>
		  <div class="not-found-wrap">
						<?php echo esc_html__( "Sorry! No user's found.", 'user-grid' ); ?>
		  </div>
					<?php
				}
				?>
	  </div>

			<?php
			$total_user  = $user_query->total_users;
			$total_pages = ceil( $total_user / $user_limit );
			echo paginate_links(
				[
					'base'      => get_pagenum_link( 1 ) . '%_%',
					'format'    => '?paged=%#%',
					'current'   => $paged,
					'total'     => $total_pages,
					'prev_text' => 'Previous',
					'next_text' => 'Next',
					'type'      => 'list',
				]
			);
			?>
	</div>
		<?php

		do_action( 'dowp_elementor_script' );

		return ob_get_clean();
	}
}
