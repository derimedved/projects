<?php 

get_header();

$thumb_id = get_post_thumbnail_id( 224 );

$params = [ 'class' => 'bg-img' ];

$ids = get_the_ID();

$ser = new WP_Query([
	'post_type' => 'service',
	'posts_per_page'=> 10,
	'post__not_in' => array($ids),
]);

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?> 
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?= get_the_title(224);?></h1>
			</div>
		</section>

		<section class="services-block">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-11.png" alt="">
			</div>
			<div class="content-width">
				<h2><?php the_title();?></h2>
				<div class="content">
					<figure>
						<?= wp_get_attachment_image(get_post_thumbnail_id( get_the_ID() ), 'large')?> 
					</figure>
					
					<?php the_content();?>

				</div>
			</div>
		</section>

		<?php if($ser->have_posts()):?>
			<section class="services-slider-wrap">
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-12.png" alt="">
				</div>
				<div class="content-width">
					<h2>OTHER SERVICES</h2>
					<div class="slider-wrap">
						<div class="swiper services-slider">
							<div class="swiper-wrapper">

								<?php while($ser->have_posts()): $ser->the_post();?>

									<div class="swiper-slide">
										<div class="item">
											<a href="<?php the_permalink();?>">
												<figure>
													<img src="<?php the_post_thumbnail_url();?>" alt="">
												</figure>
												<div class="text-wrap">
													<h4><?php the_title();?></h4>
													<?php the_excerpt();?>
												</div>
											</a>
										</div>
									</div>

								<?php endwhile;

								wp_reset_postdata();?>

							</div>
						</div>
						<div class="nav-wrap">
							<div class="swiper-button-next services-next"></div>
							<div class="swiper-button-prev services-prev"></div>
						</div>
						<div class="swiper-pagination services-pagination"></div>
					</div>
				</div>
			</section>

	<?php endif;


	get_template_part('parts/admissions');

	get_template_part('parts/testimonials');

	get_template_part('parts/verify');

get_footer();