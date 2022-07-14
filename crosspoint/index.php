<?php 

get_header();

$idb = get_option('page_for_posts');

$thumb_id = get_post_thumbnail_id( $idb );

$params = ['class' => 'bg-img'];

$title = get_field('title', $idb);
$text = get_field('text', $idb);

?>

		<section class="home-banner page-header">
			<div class="bg">
      
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?>
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">

			</div>
			<div class="content-width">
				<h1><?= is_home()?get_the_title($idb):get_queried_object()->name;?></h1>
			</div>
		</section>


		<section class="blog">
			<div class="bg">
				<img src="<?= get_template_directory_uri();?>/img/after-14-1.png" alt="" class="img img-1">
				<img src="<?= get_template_directory_uri();?>/img/after-14-2.png" alt="" class="img img-2">
			</div>
			<div class="content-width">
				<?php if(is_home()){
					if($title){
						echo '<h2>'.$title.'</h2>';
					}
					if($text){
						echo '<p>'.$text.'</p>';
					}
				}?>

				<?php if(have_posts()):?>
					<div class="content">

						<?php while(have_posts()): the_post();

							get_template_part('parts/post');

						endwhile;?>
							
					</div>
					<div class="pagination-wrap">
						
						<?php kama_pagenavi(); ?>
						
					</div>

				<?php endif;?>

			</div>
		</section>


<?php get_footer();?>