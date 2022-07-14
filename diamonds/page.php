<?php 

get_header(); 

$images = get_field('slider');

if(is_cart()):?>
	
	<section class="cart-block">
		<?php the_content();?>
	</section>

<?php elseif(is_checkout()):?>

	<section class="checkout-block">
		<div class="content-width">
			<?php the_content();?>
		</div>
	</section>

<?php else:?>

	<section class="news-block">
		<div class="content-width">
			<h1><?php the_title();?></h1>

			<?php the_content();?>

			<?php if( $images ):?>

				<div class="slider-wrap">
					<div class="swiper img-slider">
						<div class="swiper-wrapper">

    						<?php foreach( $images as $im ): ?>

    							<div class="swiper-slide">
									<figure>
										<?= wp_get_attachment_image($im['ID'], 'large')?>
									</figure>
								</div>

    						<?php endforeach;?>

    					</div>
						<div class="swiper-button-next img-next"></div>
						<div class="swiper-button-prev img-prev"></div>
						<div class="swiper-pagination img-pagination"></div>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</section>

<?php endif;

get_footer();
