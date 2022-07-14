<?php get_header();?>


		<section class="block-404">
			<div class="content-width">
				<h1 class="title1">
					<?php if(get_field('title_404_1', 'options')){
						the_field('title_404_1', 'options');
					} 

					$im = get_field('image_404', 'options');
					if($im){
						echo '<span><img src="'.$im['url'].'" alt="'.$im['url'].'"></span>';
					}
					
					if(get_field('title_404_2', 'options')){
						the_field('title_404_2', 'options');
					}?>
				</h1>
				<h6 class="title2"><?php the_field('subtitle_404', 'options');?></h6>
				<?php $link = get_field('button_404', 'options');

				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="btn-wrap title3">
						<a class="btn-blue" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a>
					</div>
				<?php endif; ?>
				
			</div>
		</section>

		<?php $pos = get_field('products_404', 'options');

		if( $pos ): ?>
			<section class="product-slider-wrap">
				<div class="content-width">
					<div class="title">
						<div class="wrap">
							<h2><?php the_field('products_title_404', 'options');?></h2>
						</div>
						<div class="nav-wrap">
							<div class="swiper-button-next product-next"></div>
							<div class="swiper-button-prev product-prev"></div>
						</div>
					</div>

					<div class="swiper product-slider">
						<div class="swiper-wrapper">
							
							<?php foreach( $pos as $post): setup_postdata($post); ?>
										
								<div class="swiper-slide">

									<?php wc_get_template_part( 'content', 'product' );?>
											
								</div>
							 	 	
							 <?php endforeach;

							 wp_reset_postdata(); ?>

						</div>
					</div>

				</div>
			</section>
		<?php endif; 

get_footer();