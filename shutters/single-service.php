<?php get_header(); ?>

	<main>
		<section class="service-internal-head">
			<div class="bg">
			</div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="st">
					<div class="btn-wrap">
						<a href="#popup-quote" class="btn-default fancybox"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt="">FREE MEASURE & QUOTE</a>
					</div>
				</div>
				<div class="content">
					<div class="text-wrap">
						<h1><?php the_title() ?></h1>
						<p><?php the_field('text') ?></p>
					</div>
					<figure>
						<img src="<?= get_field('image')['url'] ?>" alt="" class="rellax" data-rellax-speed="-4">
					</figure>
				</div>
			</div>
		</section>

		<section class="service-map hover-block-before">
			<div class="wrap">
				<div class="bg"></div>
				<div class="content-width">
					<div class="text-wrap">
						<h3><?php the_field('title_service') ?></h3>
						<p><?php the_field('text_areas') ?></p>
					</div>
				</div>
				<div class="map-item">
					<div id="map1">

						<?php 

						$location = get_field('map_areas');

						if( !empty($location) ):
						?>
						<div class="acf-map">
						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="bottom-text">
				<div class="content-width">
					<div class="left">
						<h3><?php the_field('text_phone_number') ?></h3>
					</div>
					<div class="right">
						<?php $link = get_field('link_phone_number') ?>
						<a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><span><i class="<?php the_field('icon_phone_number_1') ?>"></i></span><?= $link['title'] ?></a>
					</div>
				</div>
			</div>
		</section>

		<section class="text-columns">
			<div class="content-width">

				<?php if( have_rows('assortment') ): ?>
				  <?php while( have_rows('assortment') ): the_row(); ?>

				  	<?php if (get_row_index() % 2 != 0 || get_row_index() == 1): ?>
				  		<div class="col">
				  	<?php endif ?>
					
						<div class="item">
							<h2><?php the_sub_field('title'); ?></h2>
							<p><?php the_sub_field('text'); ?></p>
						</div>

					<?php if (get_row_index() % 2 == 0): ?>
				  		</div>
				  	<?php endif ?>

				  <?php endwhile; ?>
				<?php endif; ?>

				<div class="btn-wrap">
					<?php $link = get_field('button_products') ?>
					<a href="<?= $link['url'] ?>" class="btn-default" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
				</div>
			</div>
		</section>

		<section class="service-slider-wrap">
			<div class="content-width">
				<div class="line"><span></span></div>
				<h3><?php the_field('history') ?></h3>
				<div class="slider-wrap">
					<div class="swiper home-top-slider">
						<div class="swiper-wrapper">

							<?php $images = get_field('gallery');
							if( $images ): ?>
							<?php foreach( $images as $image ): ?>

								<div class="swiper-slide">
									<figure>
										<img src="<?php echo esc_url($image['url']); ?>" alt="">
									</figure>
								</div>

							<?php endforeach; ?>
							<?php endif; ?>

						</div>
						<div class="nav-wrap">
							<div class="content-width">
								<div class="nav-section">
									<div class="wrap">
										<div class="nav">
											<div class="swiper-button-next home-top-next"></div>
											<div class="swiper-button-prev home-top-prev"></div>
										</div>
										<div class="pagination">
											<div class="swiper-pagination home-top-pagination"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
          <div class="text-wrap">
            <div class="bg"></div>

            <?php if( have_rows('information') ): ?>
						  <?php while( have_rows('information') ): the_row(); ?>

		            <div class="item item-<?= get_row_index() ?>">
		              <?php the_sub_field('text_information_1'); ?>

		              <?php $link = get_sub_field('button_information') ?>
		              <?php if ($link): ?>
		              	<div class="btn-wrap">
			                <a href="<?= $link['url'] ?>" class="btn-default btn-border" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
			              </div>
		              <?php endif ?>
		              
		            </div>

						  <?php endwhile; ?>
						<?php endif; ?>
						
          </div>
				</div>
			</div>
		</section>

		<section class="service-map no-map">
			<div class="bottom-text">
				<div class="content-width">
					<div class="left">
						<h3><?php the_field('text_phone_number_2') ?></h3>
					</div>
					<div class="right">
						<?php $link = get_field('link_phone_number_2') ?>
						<a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><span><i class="<?php the_field('icon_phone_number_2') ?>"></i></span><?= $link['title'] ?></a>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php get_template_part('parts/map') ?>
	
<?php get_footer(); ?>