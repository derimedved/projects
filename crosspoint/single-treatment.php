<?php 

get_header();

$thumb_id = get_post_thumbnail_id( 195 );

$params = [ 'class' => 'bg-img' ];

$ids = get_the_ID();

$tr = new WP_Query([
	'post_type' => 'treatment',
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
				<h1><?= get_the_title(195);?></h1>
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

		<?php if($tr->have_posts()):?>
			
			<section class="treat-slider-wrap">
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-13.png" alt="">
				</div>
				<div class="content-width">
					<h2>OTHER TREATMENTS</h2>
					<div class="slider-wrap">
						<div class="swiper treat-slider">
							<div class="swiper-wrapper">
								<?php while($tr->have_posts()): $tr->the_post();?>

									<div class="swiper-slide">
										<div class="item">
											<figure>
												<img src="<?php the_post_thumbnail_url();?>" alt="">
											</figure>
											<a href="<?php the_permalink();?>">
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
							<div class="swiper-button-next treat-next"></div>
							<div class="swiper-button-prev treat-prev"></div>
						</div>
						<div class="swiper-pagination treat-pagination"></div>
					</div>
				</div>
			</section>

	<?php endif;


	get_template_part('parts/admissions');

	get_template_part('parts/testimonials');

	get_template_part('parts/verify');

get_footer();