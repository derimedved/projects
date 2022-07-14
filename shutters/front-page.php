<?php get_header(); ?>

	<main>
		<section class="home-head">
			<div class="swiper home-top-slider">
				<div class="swiper-wrapper">

					<?php if( have_rows('banner_slider') ): ?>
					  <?php while( have_rows('banner_slider') ): the_row(); ?>

						<div class="swiper-slide" style="background: url('<?= get_sub_field('image')['url'] ?>')no-repeat center; background-size: cover;">
							<div class="content-width">
								<h1><?php the_sub_field('title'); ?></h1>
								<p><?php the_sub_field('subtitle'); ?></p>
								<div class="btn-wrap">
									<?php $link = get_sub_field('button') ?>
									<a href="<?= $link['url'] ?>" class="btn-default fancybox" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
								</div>
							</div>
						</div>

					  <?php endwhile; ?>
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
		</section>

		<section class="about-home">
			<div class="bg">
				<picture >
					<source srcset="<?php bloginfo('template_directory'); ?>/img/bg-2.png" media="(min-width: 1500px)">
					<source srcset="<?php bloginfo('template_directory'); ?>/img/bg-2-1.png" media="(min-width: 1199px)">
					<source srcset="<?php bloginfo('template_directory'); ?>/img/bg-2-2.png" media="(min-width: 960px)">
					<source srcset="<?php bloginfo('template_directory'); ?>/img/bg-2-3.png" media="(min-width: 600px)">
					<img src="<?php bloginfo('template_directory'); ?>/img/bg-2-4.png" alt="" class="rellax" data-rellax-speed="-4">
				</picture>
			</div>
			<div class="content-width">
				<div class="top">
					<div class="left">
						<h3><?php the_field('title') ?></h3>
						<h6><?php the_field('subtitle') ?></h6>
						<figure>
							<img src="<?= get_field('image_on_the_left')['url'] ?>" alt="">
						</figure>
					</div>
					<div class="right">
						<figure>
							<img src="<?= get_field('image_on_the_right')['url'] ?>" alt="">
						</figure>
						<p><?php the_field('text') ?></p>
						<div class="btn-wrap">
							<?php $link = get_field('find_out_button') ?>
							<a href="<?= $link['url'] ?>" class="btn-default btn-border btn-big" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="content-width">
				<div class="bottom">
					<h2><?php the_field('title_offer') ?></h2>
					<div class="content">
						<div class="item item-text">
							<h4><?php the_field('text_on_the_left') ?></h4>
						</div>
						<?php 
						$terms = get_terms( [
							'taxonomy' => 'categories_product',
							'hide_empty' => false,
						] );
						?>
						<?php foreach ($terms as $term): ?>
							<div class="item">
								<figure>
									<a href="<?= get_term_link($term->term_id) ?>">
										<img src="<?= get_field('image_card_home', 'term_' . $term->term_id)['url'] ?>" alt="">
									</a>
								</figure>
								<div class="text-wrap">
									<h5><a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a></h5>
									<p><?= $term->description ?></p>
									<p><a href="<?= get_term_link($term->term_id) ?>"><span>+ </span> READ MORE</a></p>
								</div>
							</div>
						<?php endforeach ?>

					</div>
				</div>
			</div>
		</section>

		<section class="why-choose">
			<div class="content-width">
				<div class="left">
					<figure>
						<img src="<?= get_field('image')['url'] ?>" alt="">
					</figure>
					<div class="text">
						<h2><?php the_field('title_1') ?></h2>
						<p><?php the_field('text') ?></p>
					</div>
				</div>
			</div>
			<div class="swiper why-slider">
				<div class="swiper-wrapper">

					<?php if( have_rows('benefits_list') ): ?>
					  <?php while( have_rows('benefits_list') ): the_row(); ?>

						<div class="swiper-slide">

							<?php if( have_rows('list') ): ?>
							  <?php while( have_rows('list') ): the_row(); ?>

									<div class="item item-<?= get_row_index() ?>" style="background-color: <?php the_sub_field('background_color'); ?>;">
										<div class="icon-wrap">
											<img src="<?= get_sub_field('icon')['url'] ?>" alt="">
										</div>
										<div class="wrap">
											<h6><?php the_sub_field('title'); ?></h6>
											<p><?php the_sub_field('text'); ?></p>
										</div>
									</div>
									
							  <?php endwhile; ?>
							<?php endif; ?>

						</div>

					  <?php endwhile; ?>
					<?php endif; ?>
				</div>
				<div class="nav-wrap">
					<div class="swiper-pagination home-top-pagination"></div>
				</div>
			</div>
		</section>

		<?php get_template_part('parts/showrooms') ?>
		
		<?php get_template_part('parts/trustpilot') ?>

		<?php get_template_part('parts/trends') ?>
		
	</main>
	
<?php get_footer(); ?>