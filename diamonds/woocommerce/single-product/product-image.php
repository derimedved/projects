<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

$v = get_field('video', $product->get_id());
$p = get_field('poster', $product->get_id());

?>

<div class="slider-wrap title1">
	<div thumbsSlider="" class="swiper slider-small">
		<div class="swiper-wrapper">

			<div class="swiper-slide">
				<figure>
					<?= wp_get_attachment_image( $post_thumbnail_id, 'thumb' ); ?>
				</figure>
			</div>

			<?php if ( $attachment_ids && $product->get_image_id() ) {
				
				foreach ( $attachment_ids as $attachment_id ) {
					
					echo '<div class="swiper-slide"><figure>'.wp_get_attachment_image( $attachment_id, 'thumb' ).'</figure></div>';
						}
					} 
 			?>

 			<?php if($v):?>

				<div class="swiper-slide">
					<div class="video-slide">
						<img src="<?= get_template_directory_uri();?>/img/icon-10.svg" alt="">
					</div>
				</div>

			<?php endif;?>

		</div>
	</div>
	<div class="swiper slider-big">
		<div class="swiper-wrapper">

			<div class="swiper-slide">
				<a href="<?= wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0] ?>" data-fancybox="images" data-caption="My caption">
						<?= wp_get_attachment_image( $post_thumbnail_id, 'large' ) ?>
				</a>
			</div>

			<?php if ( $attachment_ids && $product->get_image_id() ) {
				
				foreach ( $attachment_ids as $attachment_id ) {
					
					echo '<div class="swiper-slide"><a href="'.wp_get_attachment_image( $attachment_id, 'full' )[0].'" data-fancybox="images" data-caption="My caption">'.wp_get_attachment_image( $attachment_id, 'large' ).'</a></div>';
						}
					} 
 			?>

 			<?php if($v):?>

 				<div class="swiper-slide">
 					<a data-fancybox href="<?= $v;?>">
 						<?php if($p){
	 						echo wp_get_attachment_image($p['ID'], 'large');
 						}?>
 						<span><img src="<?= get_template_directory_uri();?>/img/icon-11.svg" alt=""></span>
 					</a>
 				</div>

 			<?php endif;?>

		</div>
	</div>
</div>

