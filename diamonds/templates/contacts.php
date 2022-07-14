<?php 

/*

Template Name: Contact Page

*/

get_header();

?>

		<section class="contact-block title1">
			<div class="content-width">
				<h1><?php the_title();?></h1>
				<p><?php the_content();?></p>

				<?php if( have_rows('contacts') ):
					$i=1;?>

					<div class="content">

 						<?php while ( have_rows('contacts') ) : the_row();?>

 							<div class="item item-<?= $i;?>">
								<?php the_sub_field('info');?>
							</div>

						<?php $i++;
						endwhile;?>

					</div>

				<?php endif;?>
				
			</div>
		</section>

		<section class="contact-form title2">
			<div class="content-width">
				<h2><?php the_field('form_title');?></h2>
				
				<?= do_shortcode(''.get_field('form').'');?>

			</div>
		</section>

<?php get_footer();?>