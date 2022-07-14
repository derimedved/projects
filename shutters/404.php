<?php get_header(); ?>

	<main>
		<section class="thank-you block-404">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="content">
					<h1><?php the_field('title_404', 'option') ?></h1>
					<p><?php the_field('text_404', 'option') ?></p>
					<div class="btn-wrap">
						<?php $link = get_field('link_404', 'option') ?>
						<a href="<?= $link['url'] ?>" class="btn-default" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
					</div>
					<ul class="soc-list">
						<li><?php the_field('title_social_404', 'option') ?></li>

						<?php if( have_rows('social_networks_1', 'option') ): ?>
				            <?php while( have_rows('social_networks_1', 'option') ): the_row(); ?>

				              <li><a href="<?php the_sub_field('social_link_1'); ?>"><i class="<?php the_sub_field('icon_1'); ?>"></i></a></li>

				            <?php endwhile; ?>
				          <?php endif; ?>
				          
					</ul>
				</div>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>