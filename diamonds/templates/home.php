<?php 

/*

Template Name: Home Page

*/

get_header();

$im = get_field('image');
$v = get_field('video');
$voi = get_field('video_or_image');

?>

		<section class="home-title <?php if($voi == 'video'):?>home-title-video<?php endif;?>">
			<?php if($voi == 'image'):?>
				<div class="bg">
					<?= wp_get_attachment_image($im['ID'], 'full')?>
				</div>
			<?php elseif($voi == 'video'):?>
				<div class="video-bg">
					<video poster="" autoplay="true" loop muted>
						<source src="<?= $v['url'];?>" type="video/mp4">
					</video>
				</div>
			<?php endif;?>
			<div class="content-width">
				<h1 class="title1"><?php the_title();?></h1>
				<?php $link = get_field('button');

				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="btn-wrap title2">
						<a class="btn-default" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?><i class="fas fa-chevron-right"></i></a>
					</div>
				<?php endif; ?>
				
			</div>
		</section>

		<section class="categories">
			<div class="content-width">
				<div class="title" data-aos="fade-up" data-aos-duration="1000">
					<h2><?php the_field('title');?></h2>
					<p><?php the_field('text');?></p>
				</div>
				<?php $cats = get_field('prod_cat');
				$i = 1;
				$n = 0;?>
					<div class="content">

						<?php foreach($cats as $term):
							$d = $n*200; 

							$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
							?>

							<div class="item item-<?= $i;?>" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?= $d;?>">
								<a href="<?= get_term_link($term->term_id);?>">
									<figure>
										<?= wp_get_attachment_image($thumbnail_id, 'large')?>
									</figure>
									<p><i class="fal fa-chevron-right"></i><?= $term->name;?></p>
								</a>
							</div>

						<?php $i++; $n++;

						endforeach;?>
					</div>

				
			</div>
		</section>

		<section class="our-rings">
			<div class="content-width">
				<div class="text-wrap"  data-aos="fade-up" data-aos-duration="1000">
					<h2><?php the_field('title_1');?></h2>
					<?php the_field('text_1');?>
					<?php $link = get_field('button_1');

					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<div class="btn-wrap">
							<a class="btn-default" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?><i class="fas fa-chevron-right"></i></a>
						</div>
					<?php endif; ?>


				</div>

				<?php $images = get_field('images');
				$i=1;
				if( $images ):?>

					<div class="img-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

    					<?php foreach( $images as $im ): ?>

        					<figure class="item item-<?= $i;?>">
        						<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
        					</figure>

    					<?php $i++;

    					endforeach;?>

    				</div>

				<?php endif; ?>
					
			</div>
		</section>

		<section class="product-slider-wrap" data-aos="fade-up" data-aos-duration="1000">
			<div class="content-width">
				<div class="title">
					<div class="wrap">
						<h2><?php the_field('title_2');?></h2>
						<?php the_field('text_2');?>
					</div>
					<div class="nav-wrap">
						<div class="swiper-button-next product-next"></div>
						<div class="swiper-button-prev product-prev"></div>
					</div>
				</div>
				<?php $pos = get_field('products');

					if( $pos ): ?>

						<div class="swiper product-slider">
							<div class="swiper-wrapper">
    
    							<?php foreach( $pos as $post): setup_postdata($post); ?>

    								<div class="swiper-slide">
    									<?php wc_get_template_part( 'content', 'product' );?>
    								</div>
           
							    <?php endforeach;
							    wp_reset_postdata(); ?>

							</div>
						</div>

					<?php endif; ?>
					
			</div>
		</section>

		<section class="text-block" data-aos="fade-up" data-aos-duration="1000">
			<div class="content-width">
				<div class="text-wrap">
					<h2><?php the_field('title_3');?></h2>
					<?php the_field('text_3');?>
					<a href="#" class="show-text"><span>יותר</span><span>hide text</span><i class="fas fa-chevron-down"></i></a>
				</div>

			</div>
		</section>

<?php get_footer();