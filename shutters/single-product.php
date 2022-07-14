<?php setcookie('title', get_the_title(), 0, '/'); ?>

<?php get_header(); ?>

	<main>
		<section class="domestic-head hover-block">
			<div class="bg"></div>
			<div class="top">
				<div class="content-width">
					
					<?php get_template_part('parts/breadcrumbs') ?>

					<div class="st">
						<div class="btn-wrap">
							<a href="#popup-quote" class="btn-default fancybox"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt="">FREE MEASURE & QUOTE</a>
						</div>
					</div>
					<div class="content">
						<h1><?php the_title() ?></h1>
						<p><?php the_field('subtitle') ?></p>
					</div>
				</div>
			</div>
			<div class="slider-wrap">
				<div class="swiper home-top-slider">
					<div class="swiper-wrapper">

						<?php if( have_rows('slider') ): ?>
						  <?php while( have_rows('slider') ): the_row(); ?>

							<div class="swiper-slide">
								<figure>
									<img src="<?= get_sub_field('image')['url'] ?>" alt="">
								</figure>
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
			</div>

			<div class="bottom">
				<div class="content-width">
					<div class="content">
						<?php the_field('text') ?>
					</div>
					<div class="btn-wrap">
						<?php $link = get_field('view_button') ?>
						<a href="<?= $link['url'] ?>" class="btn-default btn-border" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
					</div>
				</div>
			</div>

		</section>

		<section class="system">
			<div class="content-width">
				<h2><?php the_field('title_systems') ?></h2>
				<ul class="content-list">

					<?php if( have_rows('systems') ): ?>
					  <?php while( have_rows('systems') ): the_row(); ?>

						<li>
							<figure>
								<img src="<?= get_sub_field('image')['url'] ?>" alt="">
							</figure>
							<div class="text-wrap">
								<h5><?php the_sub_field('title') ?></h5>
								<?php the_sub_field('text') ?>
							</div>
						</li>

					  <?php endwhile; ?>
					<?php endif; ?>

				</ul>
			</div>
		</section>

		<section class="technical-specifications">
			<div class="content-width">
				<div class="left">
					<h2><?php the_field('title_specifications') ?></h2>
					<div class="btn-wrap">
						<?php $link = get_field('download_button') ?>
						<a href="<?= $link['url'] ?>" class="btn-default btn-border" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
					</div>
				</div>
				<div class="right">
					<h2><?php the_field('title_colours') ?></h2>
					<ul>

						<?php if( have_rows('colours') ): ?>
						  <?php while( have_rows('colours') ): the_row(); ?>

							<li>
								<figure>
									<img src="<?= get_sub_field('image')['url'] ?>" alt="">
								</figure>
								<p><?php the_sub_field('colour_name') ?></p>
							</li>

						  <?php endwhile; ?>
						<?php endif; ?>

					</ul>
				</div>
			</div>
		</section>

		<section class="promotion default-nav">
			<div class="content-width">
				<h2><?php the_field('title_promotion') ?></h2>
				<div class="nav-wrap">
					<div class="content-width">
						<div class="nav-section">
							<div class="wrap">
								<div class="nav">
									<div class="swiper-button-next promotion-next"></div>
									<div class="swiper-button-prev promotion-prev"></div>
								</div>
								<div class="pagination">
									<div class="swiper-pagination promotion-pagination"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper promotion-slider ">
					<div class="swiper-wrapper">

						<?php if( have_rows('title_45') ): ?>
						  <?php while( have_rows('title_45') ): the_row(); ?>

							<div class="swiper-slide">
								<div class="text-wrap">
									<h2><?php the_sub_field('title'); ?></h2>
									<h6><?php the_sub_field('subtitle'); ?></h6>
									<p><?php the_sub_field('text'); ?></p>
									<div class="btn-wrap">
										<?php $link = get_sub_field('button_contact_us') ?>
										<a href="<?= $link['url'] ?>" class="btn-default btn-border" target="<?= $link['target'] ?>">
											<img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?>
										</a>
									</div>
								</div>
								<figure>
									<img src="<?= get_sub_field('image')['url'] ?>" alt="">
								</figure>
							</div>

						  <?php endwhile; ?>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</section>

		<section class="faq">
			<div class="content-width">
				<h2><?php the_field('title_faq') ?></h2>
				<ul class="accordion">

					<?php if( have_rows('text_faq') ): ?>
					  <?php while( have_rows('text_faq') ): the_row(); ?>

						<li class="accordion-item ">
							<div class="accordion-thumb"><h6><?php the_sub_field('question'); ?></h6></div>
							<div class="accordion-panel">
								<p><?php the_sub_field('answer'); ?></p>
							</div>
						</li>

					  <?php endwhile; ?>
					<?php endif; ?>

				</ul>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>