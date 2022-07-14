<?php
/*
Template Name: Service
*/
?>

<?php get_header(); ?>

	<main>
		<section class="service-head hover-block">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="content">
					<h1><?php the_field('title_areas_we_service') ?></h1>
					<h6><?php the_field('text_areas_we_service') ?></h6>
				</div>
			</div>
		</section>

		<section class="map-wrap hover-block">
			<div class="bg"></div>
			<div class="content-width">
				<div class="top">
					<h2><?php the_field('title_locations') ?></h2>
					<p><?php the_field('text_locations') ?></p>
					<div class="menu-wrap">
						<div class="tabs">
							<div class="wrap">
								<ul class="tabs-menu">

									<?php if( have_rows('title_locations_1') ): ?>
									  <?php while( have_rows('title_locations_1') ): the_row(); ?>

										<li><span>+</span><?php the_sub_field('title_view'); ?></li>

									  <?php endwhile; ?>
									<?php endif; ?>

								</ul>
							</div>
							<div class="tab-content">

								<?php if( have_rows('title_locations_1') ): ?>
								  <?php while( have_rows('title_locations_1') ): the_row(); ?>

									<div class="item">
										<div class="text-wrap">
											<div class="wrap">

												<?php
												$featured_posts = get_sub_field('serveces');
												if( $featured_posts ): ?>

												    <?php foreach( $featured_posts as $post ): 

												        setup_postdata($post); ?><div class="office">
															<h4><?php the_title() ?></h4>
															<?php the_field('text_info') ?>
															<div class="btn-wrap">
																<a href="<?php the_permalink() ?>"><span>+</span>  VIEW LOCATION INFORMATION</a>
															</div>
															<div class="tel-wrap">
																<?php $link = get_field('link_phone_number') ?>
																<a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><i class="<?php the_field('icon_phone_number_1') ?>"></i></a>
															</div>
														</div>
												    <?php endforeach; ?>
												    
												    <?php wp_reset_postdata(); ?>
												<?php endif; ?>

											</div>
										</div>
										<div class="info-map">
											<div id="map1">

												<?php 

												$locations = get_sub_field('map');

												if( !empty($locations) ):
												?>
													<div class="acf-map">
													<?php foreach ($locations as $location): ?>
								                        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
								                    <?php endforeach ?>
													</div>
												<?php endif; ?>

											</div>
										</div>
									</div>

								  <?php endwhile; ?>
								<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-bottom-wrap">
				<div class="content-width">

					<?php if( have_rows('heading') ): ?>
					  <?php while( have_rows('heading') ): the_row(); ?>

					  	<?php if (get_row_index() == 1 || get_row_index() % 2 != 0): ?>
					  		<div class="col">
					  	<?php endif ?>
						
							<div class="text-item">
								<h2><?php the_sub_field('title_heading'); ?></h2>
								<?php the_sub_field('text_heading'); ?>
							</div>

						<?php if (get_row_index() % 2 == 0): ?>
					  		</div>
					  	<?php endif ?>

					  <?php endwhile; ?>
					<?php endif; ?>

				</div>
			</div>
		</section>
	</main>

	<?php get_template_part('parts/map') ?>
	
<?php get_footer(); ?>