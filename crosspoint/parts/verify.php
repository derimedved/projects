<section class="insurance">
	<div class="bg">
		<img src="<?= get_template_directory_uri();?>/img/after-7-1.png" alt="" class="img img-1">
		<img src="<?= get_template_directory_uri();?>/img/after-7-2.png" alt="" class="img img-2">
		<img src="<?= get_template_directory_uri();?>/img/after-7-3.png" alt="" class="img img-3">
	</div>
	<div class="content-width">
		<div class="content">
			<h2><?php the_field('title_verify', 'options');?></h2>
					<p><?php the_field('subtitle_verify', 'options');?></p>
					<div class="top-img">
						<?php $imc = get_field('image_verify', 'options');?>
						<div class="bg-img">
							<?php if($imc):?>
								<img src="<?= $imc['url'];?>" alt="<?= $imc['alt'];?>">
							<?php endif;?>
						</div>
						<?php $images = get_field('slider_verify', 'options');

						if( $images ):?>

							<div class="slider-wrap">
								<div class="swiper img-slider img-slider-4">
									<div class="swiper-wrapper">

						    			<?php foreach( $images as $im ): ?>
									        <div class="swiper-slide">
									        	<figure>
									        		<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
									        	</figure>
									        </div>
									    <?php endforeach;?>
						
									</div>
								</div>
								<div class="nav-wrap">
									<div class="swiper-button-next img-next-4"></div>
									<div class="swiper-button-prev img-prev-4"></div>
								</div>
							</div>
							
						<?php endif; ?>
					</div>
					<?= do_shortcode(''.get_field('form_verify', 'options').'');?>
		</div>
	</div>
</section>	