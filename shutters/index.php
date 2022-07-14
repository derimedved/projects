<?php get_header(); ?>

	<main>
		<section class="insights hover-block">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>

				<div class="content">
					<?php
					$my_postid = 440;
					$content_post = get_post($my_postid);
					echo $content_post->post_content;
					$categories = get_categories();
					?>
					<div class="select-block ">
						<label class="form-label" for="lang"></label>
						<select id="lang">

							<?php foreach ($categories as $index => $category): ?>
								<option value="<?= $index ?>" <?php if($index == 0) echo "data-display='" . $category->name . "'" ?>><?= $category->name ?></option>
							<?php endforeach ?>

						</select>
					</div>
          <div class="wrap-block">
            <?php foreach ($categories as $key => $category): ?>
              <div class="wrap">

                <?php $wp_query = new WP_Query(array(
                  'cat' => $category->term_id,
                  'orderby' => 'date',
                  'order' => 'DESC',
                  'paged' => get_query_var('paged')
                ));
                while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                  <?php get_template_part('parts/posts') ?>

                <?php endwhile; ?>
                <?php wp_reset_query(); ?>

              </div>

            <?php endforeach ?>
          </div>

				<?php
				    $args = array(
						'show_all'     => false,
						'end_size'     => 1,
						'mid_size'     => 1,
						'prev_next'    => true,
						'prev_text'    => __('Previous'),
						'next_text'    => __('Next'),
						'add_args'     => false,
						'add_fragment' => '',
						'screen_reader_text' => __( 'Posts navigation' ),
					);
				    the_posts_pagination($args); 
				?>
					
				</div>
			</div>
		</section>


	</main>
	
<?php get_footer(); ?>