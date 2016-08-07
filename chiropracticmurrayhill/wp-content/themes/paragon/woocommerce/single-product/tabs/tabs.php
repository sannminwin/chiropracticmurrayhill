<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
wp_enqueue_script('jquery-tools');

if ( ! empty( $tabs ) ) : ?>
	<div class="clearboth"></div>
	<div class="mk-tabs mk-woo-tabs horizental" >
		<ul class="mk-tabs-tabs">
		<?php foreach ( $tabs as $key => $tab ) : ?><li><a href="#"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a></li><?php endforeach; ?>
		</ul>
		<div class="mk-tabs-panes">
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>
