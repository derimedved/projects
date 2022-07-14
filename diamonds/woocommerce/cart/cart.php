<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<div class="content-width">
			<h1><?php the_title();?></h1>
			<div class="content">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					$price = number_format($_product->price, 0, '', ',');
					if($_product->sale_price){
						$sale = number_format($_product->sale_price, 0, '', ',');
					}
					$reg = number_format($_product->regular_price, 0, '', ',');

					$size = $_product->get_attribute('size');

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>

							<div class="item">
								<figure>
									<?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										}
									?>
								</figure>
								<div class="info-wrap">
									<div class="name">
										<?php if($size):?>
											<p>מידה <?= $size;?></p>
										<?php endif;?>
										<h5><a href="<?= $product_permalink;?>"><?= get_the_title($product_id);?></a>
										</h5>
									</div>
									<div class="input-number" data-key="<?= $cart_item_key;?>">
										<div class="btn-count btn-count-plus"><img src="<?= get_template_directory_uri();?>/img/icon-7-1.svg" alt=""></div>
										<?php if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );

										} else {
											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $_product->get_max_purchase_quantity(),
													'min_value'    => '0',
													'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'form-control qty' ), $product ),
													'product_name' => $_product->get_name(),
												), $_product, false);
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );

										?>
										
										<div class="btn-count btn-count-minus"><img src="<?= get_template_directory_uri();?>/img/icon-7-2.svg" alt=""></div>
									</div>
									<div class="price-wrap">
										<?php if($sale):?>
											<p class="now"><?= $sale. get_woocommerce_currency_symbol(); ?></p>
											<p class="old"><?= $reg. get_woocommerce_currency_symbol(); ?></p>
											
										<?php else:?>
											<p class="now"><?= $price. get_woocommerce_currency_symbol(); ?></p>
										<?php endif;?>
									</div>
									<input type="hidden" name="product_id" value="<?= $product_id;?>">
								</div>
							</div>
						
						<?php
					}
				}
				?>
					
					<div class="total">
						<a href="<?= esc_url( wc_get_checkout_url() ); ?>" class="btn-blue">לבדוק</a>
					</div>
				</div>
		</div>	

</form>
