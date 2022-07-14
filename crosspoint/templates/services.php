<?php 

/*

Template Name: Services

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$ser = new WP_Query([
	'post_type' => 'service',
	'posts_per_page'=> -1,
]);

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

		<section class="services">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-2-2.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-2-1.png" alt="" class="img img-2">
			</div>
			<div class="content-width">
				<h2><?php the_field('title');?></h2>
				<p><?php the_field('text');?></p>
				<?php if($ser->have_posts()):?>

					<div class="content">

						<?php while($ser->have_posts()): $ser->the_post();?>

							<div class="item">
								<a href="<?php the_permalink();?>">
									<figure>
										<img src="<?php the_post_thumbnail_url();?>" alt="">
									</figure>
									<div class="text-wrap">
										<h4><?php the_title();?></h4>
										<p><?= get_the_excerpt();?></p>
									</div>
								</a>
							</div>
					
						<?php endwhile;

						wp_reset_postdata();?>
					
					</div>

				<?php endif;?>
			</div>
		</section>

		<?php

		get_template_part('parts/admissions');

		get_template_part('parts/testimonials');

		get_template_part('parts/verify');

get_footer();?>