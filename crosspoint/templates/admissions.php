<?php 

/*

Template Name: Admissions

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params);?>
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?php the_title();?></h1>
			</div>
		</section>

		<?php get_template_part('parts/admissions');

		get_template_part('parts/verify');

get_footer();?>