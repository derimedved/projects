<?php 

get_header();

$thumb_id = get_post_thumbnail_id( 229 );

$params = [ 'class' => 'bg-img' ];

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?> 
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?= get_the_title(229);?></h1>
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

	<?php get_template_part('parts/admissions');

	get_template_part('parts/testimonials');

	get_template_part('parts/verify');

get_footer();