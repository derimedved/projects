<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
<a href="#" class="close-popup">
	<img src="<?= get_template_directory_uri();?>/img/icon-5.svg" alt="">
</a>
<?php if ( ! WC()->cart->is_empty() ) : ?>
<div class="top">
	<h2><sup>(<?= WC()->cart->get_cart_contents_count();?>)</sup> סַל</h2>
	<?php do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ):
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				$price = number_format($_product->price, 0, '', ',');
					$sale = number_format($_product->sale_price, 0, '', ',');
					$reg = number_format($_product->regular_price, 0, '', ',');

					$size = $_product->get_attribute('size');
				?>
					<div class="item">
						<?= apply_filters( 'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove del-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><img src="'.get_template_directory_uri().'/img/icon-6.svg" alt=""></a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								esc_attr__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $cart_item_key ),
								esc_attr( $_product->get_sku() )
							),
							$cart_item_key
						);
						?>
						<figure>
							<?php if ( empty( $product_permalink ) ) :
								echo $thumbnail;

							else : ?>
								<a href="<?= esc_url( $product_permalink ); ?>">
									<?= $thumbnail; ?>
								</a>
							<?php endif; ?>
						</figure>
						<div class="text-wrap">
							<?php if($size):?>
								<p>מידה <?= $size;?></p>
							<?php endif;?>
							<h6><a href="<?= esc_url( $product_permalink ); ?>"><?= wp_kses_post( $product_name );?></a></h6>
							<div class="info">
								<p class="cost">

									<?php if($sale):?>
										<span class="old"><?= $reg. get_woocommerce_currency_symbol(); ?></span>
										<span class="now"><?= $sale. get_woocommerce_currency_symbol(); ?></span>
											
									<?php else:?>
										<span class="now"><?= $price. get_woocommerce_currency_symbol(); ?></span>
									<?php endif;?>
								</p>
								<input type="hidden" name="product_id" value="<?= $product_id;?>">
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
							</div>
						</div>
					</div>
				<?php
			endif;
		endforeach;

		do_action( 'woocommerce_mini_cart_contents' );
	?>
</div>
<div class="bottom">

	<?php 
	$discount_total = 0;
    
   foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {         
      $product = $values['data'];
      if ( $product->is_on_sale() ) {
         $regular_price = $product->get_regular_price();
         $sale_price = $product->get_sale_price();
         $discount = ( $regular_price - $sale_price ) * $values['quantity'];
         $discount_total += $discount;
      }

      $sum = WC()->cart->total+$discount_total;
   }?>
	<ul>
		<li>
			<p><b>סְכוּם</b></p>
			<span><?= number_format($sum, 0, '', ','). get_woocommerce_currency_symbol();?></span>
		</li>
		<li>
			<p><b>הנחה</b></p>
			<span><?= number_format($discount_total, 0, '', ','). get_woocommerce_currency_symbol();?></span>
		</li>
		<li>
			<p><b>סך הכל</b></p>
			<span><?= number_format(WC()->cart->total, 0, '', ','). get_woocommerce_currency_symbol();?></span>
		</li>
	</ul>
	<div class="btn-wrap">
		<a href="<?= esc_url( wc_get_cart_url() ); ?>" class="btn-border">להציג את עגלת הקניות</a>
		<a href="<?= get_permalink( wc_get_page_id( 'shop' ) );?>" class="btn-border">המשך בקניות</a>
		<a href="<?= esc_url( wc_get_checkout_url() ); ?>" class="btn-blue width-100">לבדוק</a>
	</div>
</div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

