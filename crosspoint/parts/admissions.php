<section class="progress-block">
	<div class="bg">
		<img src="<?= get_template_directory_uri();?>/img/after-6.png" alt="">
	</div>
	<div class="content-width">
		<h2><?php the_field('title_admission', 'options');?></h2>
		<p><?php the_field('text_admission', 'options');?></p>

		<?php $adms = get_field('cards_admission', 'options');
		if(isset($adms)):?>

			<div class="content">

				<?php foreach ($adms as $adm):?>

					<div class="item">
						<figure>
							<img src="<?= $adm['icon']['url'];?>" alt="<?= $adm['icon']['alt'];?>">
						</figure>
						<h4><?= $adm['title'];?></h4>
						<p><?= $adm['text'];?></p>
					</div>
				<?php endforeach;?>

			</div>

		<?php endif;?>

	</div>
</section>