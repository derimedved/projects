<?php 

/*

Template Name: About

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$images = get_field('logos');
$sli1 = get_field('slider');
$sli2 = get_field('slider_2');
?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?>
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?= get_the_title();?></h1>
			</div>
		</section>

		<section class="about">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-1-1.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-1-2.png" alt="" class="img img-2">
			</div>
			<div class="content-width">
				<h2><?php the_field('title');?></h2>

				<div class="content">

					<div class="slider-wrap slider-right">
						<div class="swiper img-slider img-slider-1">
							<div class="swiper-wrapper">

								<?php foreach ($sli1 as $sl1):
									$ism = $sl1['is_image'];
									$img = $sl1['image'];?>

									<div class="swiper-slide">
												<?php if(!$ism):?>
													<figure>
														<img src="<?= $img;?>" alt="">
													</figure>	
													
												<?php else:?>

													<div class="hover-block">
														<a href="#">
															<img src="<?= $img;?>" alt="">
															<i class="fas fa-play"></i>
														</a>
													</div>

													<div class="video-wrap">
														<iframe width="1904" height="711" src="<?= $sl1['video'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>

														
												<?php endif;?>
									</div>
								<?php endforeach;?>
							</div>
						</div>
						<div class="nav-wrap">
							<div class="swiper-button-next img-next-1"></div>
							<div class="swiper-pagination img-pagination-1"></div>
							<div class="swiper-button-prev img-prev-1"></div>
						</div>
					</div>

					<?php the_field('text');?>

					<div class="slider-wrap slider-left">
						<div class="swiper img-slider img-slider-2">
							<div class="swiper-wrapper">
									<?php foreach ($sli2 as $sl2):
											$ism2 = $sl2['is_image'];
											$img2 = $sl2['image'];
											?>

											<div class="swiper-slide">
											<?php if(!$ism2):?>

												<figure>
													<img src="<?= $img2;?>" alt="">
												</figure>
													
											<?php else:?>

												<div class="hover-block">

														<a href="#">
															<img src="<?= $img2;?>" alt="">
															<i class="fas fa-play"></i>
														</a>
													</div>
													<div class="video-wrap">
														<iframe width="1904" height="711" src="<?= $sl2['video'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>
													
												
											<?php endif;?>
										</div>
										<?php endforeach;?>
								</div>
						</div>
						<div class="nav-wrap">
							<div class="swiper-button-next img-next-2"></div>
							<div class="swiper-pagination img-pagination-2"></div>
							<div class="swiper-button-prev img-prev-2"></div>

						</div>
					</div>
					
					<?php the_field('text_2');?>

				</div>
			</div>
		</section>

		<?php if( $images ):?>

			<section class="logo-slider-wrap">
				<div class="content-width">
					<h2><?php the_field('title_1');?></h2>
					<div class="slider-wrap">
						<div class="swiper logo-slider logo-slider-2">
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
							<div class="swiper-button-next logo-slider-next-2"></div>
							<div class="swiper-button-prev logo-slider-prev-2"></div>
						</div>
						<div class="swiper-pagination logo-slider-pagination-2"></div>
					</div>

				</div>
			</section>

		<?php endif;

		get_template_part('parts/testimonials');

		get_template_part('parts/admissions');

		get_template_part('parts/verify');

get_footer();?>