<?php $sli = get_field('testimonials_slider', 'options');?>

<section class="testimonials">
	<div class="bg-testimonials">
		<img src="<?= get_template_directory_uri();?>/img/bg-4.png" alt="">
	</div>
	<div class="content-width">

		<h2><?php the_field('title_testimonials', 'options');?></h2>

		<?php if(isset($sli)):?>
			<div class="slider-wrap">
				<div class="swiper testimonials-slider">
					<div class="swiper-wrapper">

						<?php foreach ($sli as $sl):
							$rate = $sl['rate'];
							$unrate = 5-$sl['rate'];
							?>
								<div class="swiper-slide">
									<figure>
										<img src="<?= $sl['icon']['url'];?>" alt="<?= $sl['icon']['alt'];?>">
									</figure>
									<div class="text-wrap">
										<blockquote><?= $sl['quote'];?>
											<a href="#">Read More</a>
										</blockquote>
										<h6><?= $sl['name'];?></h6>
										<p><?= $sl['position'];?></p>
										<div class="stars-wrap">
											<?php for ($i=1; $i <= $rate; $i++):?>
												<img src="<?= get_template_directory_uri();?>/img/icon-7-1.svg" alt="">
											<?php endfor;?>
											<?php for ($j=1; $j <= $unrate; $j++):?>
												<img src="<?= get_template_directory_uri();?>/img/icon-7-2.svg" alt="">
											<?php endfor;?>
										</div>
									</div>
								</div>
						<?php endforeach;?>

					</div>
				</div>
				<div class="nav-wrap">
					<div class="swiper-button-next testimonials-next"></div>
					<div class="swiper-button-prev testimonials-prev"></div>
				</div>
				<div class="swiper-pagination testimonials-pagination"></div>
			</div>

		<?php endif;?>
	</div>
</section>