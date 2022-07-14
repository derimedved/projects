<?php 

/*

Template Name: Teams

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$team = new WP_Query([
	'post_type' => 'team',
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

		<section class="team-block">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-9-1.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-9-2.png" alt="" class="img img-2">
				<img src="<?= get_template_directory_uri();?>/img/after-9-3.png" alt="" class="img img-3">
			</div>
			<div class="content-width">
				<h2><?php the_field('title');?></h2>
				<p><?php the_field('text');?></p>

				<?php if($team->have_posts()):?>

					<div class="content">

						<?php while($team->have_posts()): $team->the_post();?>
					
							<div class="item">
								<figure>
									<img src="<?php the_post_thumbnail_url();?>" alt="">
                  <div class="bg-figure">
                    <img src="<?= get_template_directory_uri();?>/img/icon-300-1.png" alt="" class="img img-1">
                    <img src="<?= get_template_directory_uri();?>/img/icon-300-2.png" alt="" class="img img-2">
                    <img src="<?= get_template_directory_uri();?>/img/icon-300-3.png" alt="" class="img img-3">
                    <img src="<?= get_template_directory_uri();?>/img/icon-300-4.png" alt="" class="img img-4">
                  </div>
								</figure>
								<div class="text-wrap">
									<h3><?php the_title();?></h3>
									<h6><?php the_field('position');?></h6>
									<p><?= get_the_excerpt();?> <a href="<?php the_permalink();?>">Read More</a></p>
								</div>
							</div>

						<?php endwhile;

						wp_reset_postdata();?>
					
					</div>

				<?php endif;?>
			</div>
		</section>


		<?php get_template_part('parts/testimonials');

		get_template_part('parts/verify');

get_footer();?>