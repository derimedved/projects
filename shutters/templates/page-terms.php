<?php
/*
Template Name: Terms
*/
?>

<?php get_header(); ?>

	<main>
		<section class="terms text-block hover-block">
			<div class="bg"></div>
			<div class="content-width">
				
				<?php get_template_part('parts/breadcrumbs') ?>
				
				<div class="content">
					<h1><?php the_title() ?></h1>
					<?php the_content() ?>
				</div>
			</div>
		</section>
	</main>
	
<?php get_footer(); ?>