<section class="showrooms" id="showrooms">
	<div class="bg"><img src="<?php bloginfo('template_directory'); ?>/img/bg-3.png" alt="" ></div>
	<div class="bg-1"><img src="<?= get_field('background', 'option')['url'] ?>" alt=""></div>
	<div class="content-width">
		<div class="left">
			<h4><?php the_field('title_contact', 'option') ?></h4>
			<ul>

				<?php if( have_rows('contact_information', 'option') ): ?>
				  <?php while( have_rows('contact_information', 'option') ): the_row(); ?>

					<li>
						<h6><?php the_sub_field('city'); ?></h6>
						<p><?php the_sub_field('address'); ?></p>
					</li>

				  <?php endwhile; ?>
				<?php endif; ?>

			</ul>
		</div>
		<div class="right">
			<h3><?php the_field('title_discover', 'option') ?></h3>
			<p><?php the_field('text', 'option') ?></p>
			<div class="btn-wrap">
				<?php $link = get_field('button_contact', 'option') ?>
				<a href="<?= $link['url'] ?>" class="btn-default" target="<?= $link['target'] ?>"><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?= $link['title'] ?></a>
			</div>
		</div>
	</div>
</section>