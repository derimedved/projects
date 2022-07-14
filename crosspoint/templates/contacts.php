<?php 

/*

Template Name: Contacts Page

*/

get_header();


$thumb_id = get_post_thumbnail_id( get_the_ID() );

$params = [ 'class' => 'bg-img' ];

?>

		<section class="home-banner page-header">
			<div class="bg">
				<?= wp_get_attachment_image($thumb_id, 'full', false, $params);?>
				<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
				<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
			</div>
			<div class="content-width">
				<h1><?php the_title();?></h1>
			</div>
		</section>


		<section class="programs contact">

			<div class="content-width">
				<?php the_content();?>

				<?php if( have_rows('cards') ):?>

					<div class="content">

						<?php while ( have_rows('cards') ) : the_row();?>

        					<div class="item">
								<div class="icon-wrap">
									<?php $im = get_sub_field('icon');?>
									<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
								</div>
								<p>
									<?php $link = get_sub_field('link');

									if( $link ): 
										$link_url = $link['url'];
										$link_title = $link['title'];
										$link_target = $link['target'] ? $link['target'] : '_self';
										?>
										<a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a>
									<?php endif; ?>
								</p>
								<div class="link-wrap">
									<?php $link = get_sub_field('link_2');

									if( $link ): 
										$link_url = $link['url'];
										$link_title = $link['title'];
										$link_target = $link['target'] ? $link['target'] : '_self';
										?>
										<a class="" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a>
									<?php endif; ?>
								</div>
							</div>

    					<?php endwhile;?>
    						
    				</div>

				<?php endif;?>
				
			</div>
		</section>

		<div class="map-wrap">
			<div id="map"></div>
		</div>

		<?php $map = get_field('map');

		$lat = $map['lat'];
		$lng = $map['lng'];
		?>

	<script>
		function initMap() {

			var options = {lat: <?= $lat;?>, lng: <?= $lng;?>};

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 15,
				center: options,
				mapTypeControl: false,
				scrollwheel: false,
				zoomControl: false,
				disableDefaultUI: true,
			});

			var marker = new google.maps.Marker({
				position: options,
				map: map,

			});

		}
	</script>

	<script src="http://maps.google.com/maps/api/js?sensor=false"
					type="text/javascript"></script>

	<script async defer
					src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyT05YehIdz2LrV-QOeRa5M18WfKtlnY&callback=initMap">
	</script>

<?php get_footer();?>