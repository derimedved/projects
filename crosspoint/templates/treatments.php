<?php 

/*

Template Name: Treatments

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$tr = new WP_Query([
	'post_type' => 'treatment',
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

		<section class="item-3-bg">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-5.png" alt="">
			</div>
			<div class="content-width">
				<h2><?php the_field('title');?></h2>
				<p><?php the_field('text');?></p>

				<?php if($tr->have_posts()):?>

					<div class="content">

						<?php while($tr->have_posts()): $tr->the_post();?>

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