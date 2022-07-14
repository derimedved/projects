<?php get_header(); ?>

	<main>
		<section class="insights-detail hover-block">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<?php while( have_posts() ) : the_post(); ?>
			        
			        <div class="content">
						<p class="label"><b><?= wp_get_post_terms(get_the_ID(), 'category')[0]->name ?></b>   <span>//</span>   <?= get_the_date() ?></p>
						<div class="user-wrap">
							<div class="img-wrap">
								<img src="<?= get_avatar_url(get_the_author_meta('ID')) ?>" alt="">
							</div>
							<p class="name">Written by <b><?= get_the_author_meta('user_lastname') ?> <?= get_the_author_meta('user_firstname') ?></b></p>
						</div>
						<h1><?php the_title() ?></h1>
						<?php the_content() ?>
					</div>

			    <?php endwhile; ?>
				
			</div>
		</section>

		<section class="insights insights-more">
			<div class="content-width">
				<div class="content">
					<h2>Similar articles</h2>
					<div class="wrap">

						<?php $wp_query = new WP_Query(array('post_type' => 'post', 'orderby' => 'rand', 'post__not_in' => array(get_the_ID()), 'posts_per_page' => 3, 'paged' => get_query_var('paged')));
						while ($wp_query->have_posts()): $wp_query->the_post(); ?>

							<?php get_template_part('parts/posts') ?>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>

					</div>
				</div>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>