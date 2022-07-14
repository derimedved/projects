<?php 

get_header();

$thumb_id = get_post_thumbnail_id( 185 );

$params = [ 'class' => 'bg-img' ];

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?> 
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?= get_the_title(185);?></h1>
			</div>
		</section>

		<section class="team-block team-block-detail">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-9-1.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-9-2.png" alt="" class="img img-2">
			</div>
			<div class="content-width">
				<h2><?php the_field('title', 185);?></h2>
				<p><?php the_field('text', 185);?></p>
				<div class="content">
					<div class="item-float">
						<figure>
							<?= wp_get_attachment_image(get_post_thumbnail_id( get_the_ID() ), 'large')?>
              
						</figure>
						<div class="text-wrap">
							<h3><?php the_title();?></h3>
							<h6><?php the_field('position');?></h6>
							<?php the_content();?>
						</div>
					</div>

				</div>
			</div>
		</section>



	<?php get_template_part('parts/testimonials');

	get_template_part('parts/verify');

get_footer();