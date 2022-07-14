<?php 

/*

Template Name: Amenties

*/

get_header();

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

$ants = get_field('list');

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

		<section class="amenities">
			<div class="content-width">
				<h2><?php the_field('title');?></h2>
				<p><?php the_field('text');?></p>
				<?php if(isset($ants)):?>
					
					<div class="content">

						<?php foreach ($ants as $ant):?>
							<div class="item">
								<figure>
									<img src="<?= $ant['icon']['url'];?>" alt="<?= $ant['icon']['alt'];?>">
								</figure>
								<h4><?= $ant['title'];?></h4>
								<p><?= $ant['text'];?></p>
							</div>
						<?php endforeach;?>

					</div>

				<?php endif;?>
			</div>
		</section>

<?php get_footer();?>