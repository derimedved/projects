<?php 

get_header(); 

$images = get_field('slider');

?>

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

<?php get_footer();
