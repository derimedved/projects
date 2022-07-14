<?php
/*
Template Name: Company
*/
?>

<?php get_header(); ?>

	<main>
		<section class="company-head">
			<div class="content-width">

				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="content">
					<div class="text-wrap">
						<?php the_field('text_local') ?>
						<div class="btn-wrap">
							<?php $link = get_field('button_local') ?>
							<a href="<?= $link['url'] ?>" class="btn-default btn-border btn-big"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
						</div>
					</div>
					<figure>
						<img src="<?= get_field('image_local')['url'] ?>" alt="" data-rellax-speed="-4" class="rellax">
					</figure>
				</div>
			</div>
		</section>

		<section class="discover hover-block-before">
			<div class="bg">
				<p>29 years</p>
			</div>
			<div class="content-width">
				<div class="top"><?php the_field('text_discover') ?></div>
				<div class="wrap-bottom">
					<div class="bottom">

						<?php if( have_rows('discover_list') ): ?>
						  <?php while( have_rows('discover_list') ): the_row(); ?>

							<div class="item">
								<figure>
									<img src="<?= get_sub_field('image')['url'] ?>" alt="">
								</figure>
								<div class="wrap">
									<p><?php the_sub_field('year'); ?></p>
								</div>
							</div>

						  <?php endwhile; ?>
						<?php endif; ?>

            <div class="btn-wrap">
              <?php $link = get_field('button_discover') ?>
              <a href="#showrooms" class="btn-default btn-border btn-big" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
            </div>

					</div>
				</div>

			</div>
		</section>

		<?php get_template_part('parts/showrooms') ?>
		
		<?php get_template_part('parts/trustpilot') ?>

		<?php get_template_part('parts/trends') ?>

	</main>
	
<?php get_footer(); ?>