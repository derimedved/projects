<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

    <div class="shop_table woocommerce-checkout-review-order-table total">
        <h5>פרטי יצירת קשר</h5>
        <a href="#" class="edit">לַעֲרוֹך</a>
    
        <?php do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $price = number_format($_product->price, 0, '', ',');
                    if($_product->sale_price){
                        $sale = number_format($_product->sale_price, 0, '', ',');
                    }
                    $reg = number_format($_product->regular_price, 0, '', ',');

                    $size = $_product->get_attribute('size');

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {?>

                <div class="item">
                    <?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );?>
                        
                    <figure>
                        <?= $thumbnail;?>
                    </figure>
                    <div class="text">
                        <?php if($size):?>
                            <p>מידה <?= $size;?></p>
                        <?php endif;?>
                        <h6>
                            <a href="<?= $product_permalink;?>"><?= get_the_title($product_id);?></a>
                        </h6>
                        <p class="price">
                            <span><?= $cart_item['quantity'];?> חתיכה</span>
                            <?php if($sale):?>
                                <span class="old"><?= $reg. get_woocommerce_currency_symbol(); ?></span>
                                <span class="now"><?= $sale. get_woocommerce_currency_symbol(); ?></span>
                            <?php else:?>
                                <span class="now"><?= $price. get_woocommerce_currency_symbol(); ?></span>
                            <?php endif;?>
                        </p>
                    </div>
                </div>

            <?php }
            
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );?>


        <div class="cart-subtotal item-total">
            <p>
                <span>מוצרים <?= WC()->cart->get_cart_contents_count() ?>לכמות:</span>
                <b><?php wc_cart_totals_subtotal_html(); ?></b>
            </p>
            <p>
                <?php $tt = WC()->cart->get_total_tax();?>
                <span>מְסִירָה</span>
                <b><?= $tt==0?'חינם   ':wc_cart_totals_taxes_total_html();?></b>
            </p>
            <p>
                <span>סך הכל</span>
                <b><?php wc_cart_totals_order_total_html(); ?></b>
            </p>
        </div>

        <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn-blue" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="לבדוק">לבדוק</button>' ); ?>
  

    </div>