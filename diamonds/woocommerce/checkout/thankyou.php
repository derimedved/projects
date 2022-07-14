<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

	<section class="checkout-block thank-block">
		<div class="content-width">
			<?php if ( $order ) :

				do_action( 'woocommerce_before_thankyou', $order->get_id() );
					
				if ( $order->has_status( 'failed' ) ) : ?>

					<div class="info-thank">
						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>
					</div>
				<?php else : ?>
					<div class="info-thank">

						<h1>תודה, הזמנה מס' <?= $order->get_order_number();?> התקבלה!</h1>

						<p>אנו ניצור עמך קשר בהקדם לאישור ההזמנה ובירור פרטי המשלוח.</p>
						<div class="btn-wrap">
							<a href="<?= get_home_url();?>" class="btn-blue">לראשי</a>
						</div>
					</div>
					<div class="total">
						<h5>פרטי יצירת קשר</h5>
						<!-- <a href="#" class="edit">לַעֲרוֹך</a> -->

						<?php $items = $order->get_items();

						foreach ( $items as $item ) :
							
                            $product_name = $item['name'];
                            $product_id = $item['product_id'];
                            $product_variation_id = $item['variation_id'];

                            if ($product_variation_id) { 
							    $prod = new WC_Product_Variation($item['variation_id']);
							} else {
							    $prod = new WC_Product($item['product_id']);
							}
							$size = $prod->get_attribute('size');

                            ?>

								<div class="item">
									<figure>
										<img src="<?= get_the_post_thumbnail_url($product_id);?>" alt="">
									</figure>
									<div class="text">
										<?php if($size):?>
				                            <p>מידה <?= $size;?></p>
				                        <?php endif;?>
										<h6><a href="<?= get_permalink($product_id);?>"><?= get_the_title($product_id);?></a></h6>
										<p class="price">
											<span><?= $item['quantity'];?> חתיכה</span>
											<span class="now"><?= number_format($item['total'], 0, '', ',').get_woocommerce_currency_symbol();?></span>
										</p>
									</div>
								</div>

							<?php endforeach;?>
						<div class="item-total">
							<p>
								<span>סך הכל</span>
								<b><?php echo $order->get_formatted_order_total();?></b>
							</p>
						</div>
					</div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	</section>
