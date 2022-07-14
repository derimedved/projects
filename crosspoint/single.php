<?php 

get_header();

$idb = get_option('page_for_posts');
$ids = get_the_ID();

$thumb_id = get_post_thumbnail_id( $idb );

$params = ['class' => 'bg-img'];

$title = get_field('title', $idb);

$thumb = get_post_thumbnail_id( $ids );

$publish = get_the_time('F d, Y');
$update = get_the_modified_date( 'F d, Y', get_the_ID() );

$a_img = get_field('photo');

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params)?>
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?= get_the_title($idb);?></h1>
			</div>
		</section>

		<section class="services-block blog-inner">
			<div class="content-width">
				<h2><?php the_title();?></h2>
				<div class="content">
					<figure>
						<?= wp_get_attachment_image($thumb, 'large')?> 
					</figure>

					<?php the_content();?>

				</div>
				<div class="info-bottom">
					<div class="left">
						<p>Published: <?= $publish;?></p>
						<?php if($update):?>
							<p>Last Updated: <?= $update;?></p>
						<?php endif;?>
					</div>
					<div class="right">
						<div class="user-wrap">
							<?php if($a_img):?>
								<figure>
									<img src="<?= $a_img['url'];?>" alt="<?= $a_img['alt'];?>">
								</figure>
							<?php endif;?>
							<div class="text-wrap">
								<p><b><?php the_field('author_name');?></b></p>
								<p><i><?php the_field('position');?></i></p>
							</div>
						</div>
						<div class="soc-wrap">
							<ul class="soc a2a_kit">
								<li><a href="#" class="clip"><i class="fal fa-share-alt"></i></a></li>
								<li><a class="a2a_button_linkedin"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a class="a2a_button_facebook"><i class="fab fa-facebook-f"></i></a></li>
								<li><a class="a2a_button_twitter"><i class="fab fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="last-news">
			<div class="content-width">
				<h2>Latest Articles</h2>
				
				<div class="content">
					<?php $lp = new WP_Query([
						'post_type' => 'post',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC',
						'post__not_in' => array($ids),
					]);

					while($lp->have_posts()): $lp->the_post();?>

						<div class="item">
							<a href="<?php the_permalink();?>">
								<figure>
									<img src="<?php the_post_thumbnail_url();?>" alt="">
								</figure>
								<p><?php the_title();?></p>
							</a>
						</div>

					<?php endwhile;

					wp_reset_postdata();?>
				</div>
			</div>
		</section>

		<?php $pos = get_field('recommendation_posts');

		if( $pos ):?>

			<section class="recommendation-new">
				<div class="content-width">
					<h5>Recommendation news</h5>
					<div class="content">

						<?php foreach( $pos as $post): setup_postdata($post); ?>

							<div class="item">
								<figure>
									<a href="<?php the_permalink();?>">
										<img src="<?php the_post_thumbnail_url();?>" alt="">
									</a>
								</figure>
								<div class="text-wrap">
									<h6><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
								</div>
							</div>

						<?php endforeach;

						wp_reset_postdata(); ?>

					</div>
				</div>
			</section>
		<?php endif; ?>

				
<script async src="https://static.addtoany.com/menu/page.js"></script>
<?php 

get_footer();

?>