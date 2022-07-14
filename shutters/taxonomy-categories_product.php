<?php get_header(); ?>

	<main>
		<section class="roller-head">
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<?php $term =  get_queried_object(); ?>
				<div class="content">
					<div class="text-wrap">
						<h1><?= term_description($term->term_id) ?></h1>
						<h5><?php the_field('subtitle', 'term_' . $term->term_id) ?></h5>
						<div class="wrap"><?php the_field('text_two_column', 'term_' . $term->term_id) ?></div>
						<div class="btn-wrap">

							<?php if (get_field('link_left', 'term_' . $term->term_id)): ?>
								<?php $link = get_field('link_left', 'term_' . $term->term_id); ?>
								<a href="<?= $link['url'] ?>" class="btn-default btn-border btn-big" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
							<?php endif ?>

							<?php if (get_field('link_right', 'term_' . $term->term_id)): ?>
								<?php $link = get_field('link_right', 'term_' . $term->term_id) ?>
								<a href="<?= $link['url'] ?>" class="btn-default btn-border btn-big fancybox" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
							<?php endif ?>

						</div>
					</div>
					<figure>
						<img src="<?= get_field('image_banner', 'term_' . $term->term_id)['url'] ?>" alt="" class="rellax" data-rellax-speed="-4">
					</figure>
				</div>
			</div>
		</section>

		<section class="product-roller hover-block-before">
			<div class="bg"></div>
			<div class="content-width">

				<?php if ( have_posts() ) :
				    while ( have_posts() ) : the_post(); ?> 

						<div class="item">
							<figure>
								<a href="<?php the_permalink() ?>">
									<img src="<?php the_post_thumbnail_url() ?>" alt="">
								</a>
							</figure>
							<div class="text-wrap">
								<h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
								<p><a href="<?php the_permalink() ?>"><span>+</span>  READ MORE</a></p>
							</div>
						</div>

				    <?php endwhile; ?>
				<?php endif; ?>

			</div>
		</section>

		<section class="benefits-roller">
			<div class="content-width">
				<div class="content">
					<div class="left">
						<figure>
							<img src="<?= get_field('image', 'term_' . $term->term_id)['url'] ?>" alt="">
						</figure>
						<div class="text-wrap">
							<h3><?php the_field('title', 'term_' . $term->term_id) ?></h3>
							<p><?php the_field('description', 'term_' . $term->term_id) ?></p>
						</div>
					</div>
					<div class="right">

						<?php if( have_rows('benefits_list', 'term_' . $term->term_id) ): ?>
						  <?php while( have_rows('benefits_list', 'term_' . $term->term_id) ): the_row(); ?>

							<div class="item">
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
				</div>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>