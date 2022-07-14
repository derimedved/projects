<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="item">
	<?php woocommerce_show_product_loop_sale_flash();?>
	<figure>
		<a href="<?php the_permalink();?>"><img src="<?php the_post_thumbnail_url();?>" alt=""></a>
	</figure>
	<div class="text-wrap">
		<div class="info">
			<h5><a href="#"><?php the_title();?></a></h5>
			<?php woocommerce_template_loop_price();?>
			<!-- <p class="cost"><span class="old">8,400₪</span><span class="now">5,200₪ </span></p> -->
		</div>
		<div class="btn-wrap">
			<?php woocommerce_template_loop_add_to_cart();?>
		</div>
	</div>
</div>

