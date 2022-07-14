<?php 

/*

Template Name: Programs

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$pr = new WP_Query([
	'post_type' => 'program',
	'posts_per_page'=> -1,
]);

$im = get_field('image');

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

		<section class="programs">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-3-1.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-3-2.png" alt="" class="img img-2">
			</div>
			<div class="content-width">
				<figure>
					<?= wp_get_attachment_image($im['ID'], 'large')?> 
				</figure>
				<div class="title-wrap">
					<h2><?php the_field('title');?></h2>
					<p><?php the_field('text');?></p>
				</div>

				<?php if($pr->have_posts()):?>

					<div class="content">

						<?php while($pr->have_posts()): $pr->the_post();
							$im = get_field('icon');?>
								<a href="<?php the_permalink();?>" class="item">
									<div class="icon-wrap">
										<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
									</div>
									<h6><?php the_title(); ?></h6>
									<p><?php the_field('card_text');?></p>
								</a>
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