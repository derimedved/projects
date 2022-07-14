<section class="latest-trends">
	<div class="content-width">
		<h4><?php the_field('title_insights'); ?></h4>
		<div class="content">

			<?php
			$featured_posts = get_field('insights');
			if( $featured_posts ): ?>

			    <?php foreach( $featured_posts as $post ): 

			        setup_postdata($post); ?>
			        <div class="item">
						<div class="text-wrap">
							<p class="date"><?= get_the_date() ?></p>
							<h6>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h6>
							<?php the_excerpt() ?>
							<p><a href="<?php the_permalink(); ?>"><span>+ </span> READ MORE</a></p>
						</div>
						<figure>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php the_post_thumbnail_url() ?>" alt="">
							</a>
						</figure>
					</div>
			    <?php endforeach; ?>
			    
			    <?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
		</div>
	</div>
</section>