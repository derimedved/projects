<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$sku = $product->get_sku();
$sizes = get_the_terms($product->get_id(), 'pa_size');


$atr = $product->get_attributes();

?>

		<section class="product-inner">
			<div class="content-width">
				<div class="info-wrap title2" >
					<?php 

					if($sku){ echo '<p class="label">דגם '.$sku.'</p>';}
					
					woocommerce_template_single_title();

					echo '<p>' . $product->description . '</p>';

					echo '<p class="cost">';

					woocommerce_show_product_sale_flash();

					woocommerce_template_single_price();

					echo '</p>';

					woocommerce_template_single_add_to_cart();

					$link = get_field('question_link_product', 'options');

					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<h5><a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a></h5>
					<?php endif; ?>
					<div class="accordion-wrap">
						<ul class="accordion">

							<li class="accordion-item">
								<div class="accordion-thumb">
									<h6>מידע על המוצר</h6>
								</div>
								<?php if($atr):?>
									<div class="accordion-panel">
										<?php foreach ( $atr as $attribute ) :

											if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) 
												continue;

												$values = wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) );
												$att_val = apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );

												?>
											 		<p>
														<span><?= wc_attribute_label( $attribute['name'] ); ?>:</span>
														<b><?= $att_val; ?></b>
													</p>
												
											 
										<?php endforeach; ?>
									</div>
								<?php endif;?>
							</li>

							<?php if($product->short_description):?>

								<li class="accordion-item">
									<div class="accordion-thumb">
										<h6>מה מקבלים</h6>
									</div>
									<div class="accordion-panel">
										
										<?php woocommerce_template_single_excerpt();?>

									</div>
								</li>

							<?php endif;?>

						</ul>
					</div>
					<div class="bg-block">
						<?php $imb = get_field('bg_img_product_banner', 'options');?>
						<div class="bg">
							<?php if($imb):?>
								<img src="<?= $imb['url'];?>" alt="<?= $imb['alt'];?>">
							<?php endif;?>
						</div>
						<h5><?php the_field('title_product_banner', 'options');?></h5>
						<?php $link = get_field('btn_product_banner', 'options');

						if( $link ): 
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
							?>
							<div class="btn-wrap">
								<a class="btn-blue" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a>
							</div>
						<?php endif; ?>
						
					</div>
				</div>

				<?php woocommerce_show_product_images();?>

			</div>
		</section>

		<?php woocommerce_output_related_products();?>
