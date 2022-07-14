<?php 

$thumb_id = get_post_thumbnail_id( get_the_ID() );

$publish = get_the_time('F d, Y');
$update = get_the_modified_date( 'F d, Y', get_the_ID() );

$a_img = get_field('photo');

?>
<div class="item">
	<figure>
		<a href="<?php the_permalink();?>">
			<?= wp_get_attachment_image($thumb_id, 'large')?>
		</a>
	</figure>
	<div class="text-wrap">
		<h3><?php if($a_img):?><img src="<?= $a_img['url'];?>" alt="<?= $a_img['alt'];?>"><?php endif;?><?php the_title();?></h3>
		<p class="date">Published: <?= $publish;?></p>
		<?php if($update):?>
			<p class="date">Updated: <?= $update;?></p>
		<?php endif;?>
		<p class="text"><?= get_the_excerpt();?></p>
		<div class="btn-wrap">
			<a href="<?php the_permalink();?>" class="btn-default">Learn More</a>
		</div>
	</div>
</div>