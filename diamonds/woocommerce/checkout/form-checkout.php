<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="wrap-checkout">
		<div class="info">
			<h1><?php the_title();?></h1>
			<?php if(!is_user_logged_in()):?>
				<div class="btn-wrap">
					<a href="#login" class="btn-blue login-open">להיכנס</a>
					<a href="#registration" class="link registration">צור חשבון</a>
				</div>
			<?php endif;?>
			<div class="default-form">
				<div class="input-wrap input-wrap-50">
					<label for="name"></label>
					<input type="text" name="billing_first_name" id="billing_first_name" placeholder="שֵׁם" value="<?= WC()->checkout->get_value('billing_first_name');?>" autocomplete="given-name">
				</div>
				<div class="input-wrap input-wrap-50">
								<label for="last-name"></label>
								<input type="text" name="billing_last_name" id="billing_last_name" placeholder="שֵׁם מִשׁפָּחָה"  value="<?= WC()->checkout->get_value('billing_last_name');?>">
				</div>
				<div class="input-wrap">
					<label for="company"></label>
					<input type="text" name="billing_company" id="billing_company" placeholder="שם חברה (אופציונלי)" value="<?= $_POST['billing_company'];?>">
				</div>
				<div class="input-wrap">
					<label for="text1"></label>
					<input type="text" name="billing_address_1" id="billing_address_1" placeholder="הבחוץ" value="<?= WC()->checkout->get_value('billing_address_1');?>">
				</div>
				<div class="input-wrap input-wrap-50">
					<label for="city"></label>
					<input type="text" name="billing_city" id="billing_city" placeholder="עִיר" value="<?= WC()->checkout->get_value('billing_city');?>">
				</div>
				<div class="input-wrap input-wrap-50">
					<label for="index"></label>
					<input type="text" name="billing_postcode" id="billing_postcode" value="<?= WC()->checkout->get_value('billing_postcode');?>" placeholder="אינדקס">
				</div>
				<div class="input-wrap input-wrap-50">
					<label for="tel1"></label>
					<input type="text" name="billing_phone" id="billing_phone" class="tel" placeholder="טֵלֵפוֹן" value="<?= WC()->checkout->get_value('billing_phone');?>">
				</div>
				<div class="input-wrap input-wrap-50">
					<label for="email"></label>
					<input type="email" name="billing_email" id="billing_email" placeholder="אימייל" value="<?= WC()->checkout->get_value('billing_email');?>"autocomplete="email">
				</div>
				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			        <div class="line"></div>
					<h2>שיטת אספקה</h2>
					<div class="select-block ">
						<label class="form-label" for="select-11"></label>
								
						<?php wc_cart_totals_shipping_html();?>

			        </div>

			    <?php endif; ?>
						
				<?php if ( WC()->cart->needs_payment() ) : ?>

					<div class="line"></div>
					<h2>אמצעי תשלום</h2>
					<div class="select-block ">
						<label class="form-label" for="select-12"></label>
						<select id="select-12" class="wc_payment_methods payment_methods methods">
							<?php $WC_Payment_Gateways = new WC_Payment_Gateways();
								$available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
								if ( ! empty( $available_gateways ) ) {
									foreach ( $available_gateways as $gateway ) {
										wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
									}
								}?>
										
						</select>
						<?php if ( ! empty( $available_gateways ) ) {
							foreach ( $available_gateways as $gateway ) {?>
								<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio pay_method" name="payment_method"value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<?php }
						}?>
						
					</div>
				<?php endif; ?>
								
			</div>
		</div>
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
</form>



<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
