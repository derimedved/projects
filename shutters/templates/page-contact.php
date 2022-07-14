<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

	<main>
		<section class="contact hover-block">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="content">

					<?php if( have_rows('contact_details') ): ?>
					  <?php while( have_rows('contact_details') ): the_row(); ?>

						<div class="item">
							<figure>
								<img src="<?= get_sub_field('image')['url'] ?>" alt="">
							</figure>
							<div class="text-wrap">
								<h5><?php the_sub_field('title'); ?></h5>
								<p><?php the_sub_field('address'); ?></p>
								<p>
									<?php $link = get_sub_field('link') ?>
									<a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><span>+  </span> <?= $link['title'] ?></a>
								</p>
								<p class="tel">
									<?php $link = get_sub_field('phone_number') ?>
									<a href="tel:<?= $link['url'] ?>" target="<?= $link['target'] ?>"><span><i class="fas fa-phone"></i></span><b><?= $link['title'] ?></b></a>
								</p>
							</div>
						</div>

					  <?php endwhile; ?>
					<?php endif; ?>

					<ul class="soc-list">
						<li><?php the_field('title_follow_us'); ?></li>

						<?php if( have_rows('social_networks_1', 'option') ): ?>
				            <?php while( have_rows('social_networks_1', 'option') ): the_row(); ?>

				              <li><a href="<?= get_sub_field('social_link_1')['url']; ?>"><i class="<?php the_sub_field('icon_1'); ?>"></i></a></li>

				            <?php endwhile; ?>
				          <?php endif; ?>

					</ul>
				</div>
				<div class="popup-site popup-quote" >
					<div class="wrap">
						<?= do_shortcode('[contact-form-7 id="418" title="Enquiry form" html_class="default-form"]') ?>
					</div>
				</div>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>