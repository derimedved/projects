	</main>


<footer>
		<div class="bg">
			<img src="<?= get_template_directory_uri();?>/img/after-8-1.png" alt="" class="img ">
			<img src="<?= get_template_directory_uri();?>/img/after-8-2.png" alt="" class="img">
		</div>
    <div class="content-width">
			<div class="logo-wrap">
				<?php $imlf = get_field('logo_footer', 'options');?>
				<a href="<?= get_home_url();?>">
					<img src="<?= $imlf['url'];?>" alt="<?= $imlf['alt'];?>">
				</a>
			</div>
			<nav class="footer-menu">
				<?php  if(is_page_template('templates/landing.php')):

					wp_nav_menu([
						'theme_location' => 'land-menu',
						'container' => false,
						'menu_class' => '',
						'walker' => new Selective_Walker(),
					]);

				else:

					wp_nav_menu([
					    'theme_location' => 'foot-menu',
					    'container' => false,
					    'menu_class' => '',
	                ]);

				endif;?>

			</nav>
			<div class="info-block">
				<?php 
					$adr = get_field('address_header', 'options');
					$tel = get_field('phone', 'options');
					$mail = get_field('mail_header', 'options');
				?>
				<ul>
					<?php if($mail):?>
						<li>
							<div class="icon-wrap">
								<img src="<?= get_template_directory_uri();?>/img/icon-8-1.svg" alt="">
							</div>
							<p><a href="mailto:<?= $mail;?>"><?= $mail;?></a></p>
						</li>
					<?php endif;?>
					<?php if($adr):?>
						<li>
							<div class="icon-wrap">
								<img src="<?= get_template_directory_uri();?>/img/icon-8-1.svg" alt="">
							</div>
							<div class="wrap">
								<?= $adr;?>
							</div>
						</li>
					<?php endif;?>

					<?php if($tel):?>
						<li>
							<div class="icon-wrap">
								<img src="<?= get_template_directory_uri();?>/img/icon-8-2.svg" alt="">
							</div>
							<div class="wrap">
								<?php $lf = get_field('landing_phone');
								?>
								<a href="tel:+<?= (is_page_template('templates/landing.php') && $lf)?phone_clear($lf):phone_clear($tel);?>">
									<p><?php the_field('phone_text', 'options');?></p>
									<p><?= (is_page_template('templates/landing.php') && $lf)?$lf:$tel;?></p>
								</a>
							</div>
						</li>
					<?php endif;?>
				</ul>
			</div>
			<?php $link = get_field('website_text', 'options');

			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<h5><a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a></h5>
			<?php endif; ?>
			<div class="bug-block">
				<?php $link = get_field('report_bug', 'options');

				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<h6><a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a></h6>
				<?php endif; ?>
				<?php 
					$im1 = get_field('icon_1_footer', 'options');
					$im2 = get_field('icon_2_footer', 'options');
				?>
				<ul>
					<?php if($im1):?>
						<li>
							<figure>
								<img src="<?= $im1['url'];?>" alt="<?= $im1['alt'];?>">
							</figure>
						</li>
					<?php endif;?>
					<?php if($im2):?>
						<li>
							<?= $im2;?>
						</li>
					<?php endif;?>

					
				</ul>
				<p style="opacity: 0;">This website uses cookies to provide better user experience </p>
				<p style="opacity: 0;"><a href="#">AGREE</a> <a href="#">DISAGREE</a></p>
			</div>
    </div>

</footer>

	<div id="call" class="popup-site popup-call" style="display: none">
		<div class="main-wrap">
			<div class="content">
				<button type="button" data-fancybox-close="" class="close-popup">
					<img src="<?= get_template_directory_uri();?>/img/icon-10.svg" alt="">
				</button>
				<h2><?php the_field('title_call', 'options');?></h2>
				<h6><?php the_field('subtitle_call', 'options');?></h6>
				<?= do_shortcode(''.get_field('form_call', 'options').'');?>
			</div>
		</div>
	</div>

	<div id="insurance" class="popup-site popup-insurance" style="display: none;">
		<div class="main-wrap">
			<section class="insurance">
				<div class="content">
					<button type="button" data-fancybox-close="" class="close-popup">
						<img src="<?= get_template_directory_uri();?>/img/icon-10.svg" alt="">
					</button>
					<h2><?php the_field('title_verify', 'options');?></h2>
					<p><?php the_field('subtitle_verify', 'options');?></p>
					<div class="top-img">
						<?php $imc = get_field('image_verify', 'options');?>
						<div class="bg-img">
							<?php if($imc):?>
								<img src="<?= $imc['url'];?>" alt="<?= $imc['alt'];?>">
							<?php endif;?>
						</div>
						<?php $images = get_field('slider_verify', 'options');

						if( $images ):?>

							<div class="slider-wrap">
								<div class="swiper img-slider img-slider-4">
									<div class="swiper-wrapper">

						    			<?php foreach( $images as $im ): ?>
									        <div class="swiper-slide">
									        	<figure>
									        		<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
									        	</figure>
									        </div>
									    <?php endforeach;?>
						
									</div>
								</div>
								<div class="nav-wrap">
									<div class="swiper-button-next img-next-4"></div>
									<div class="swiper-button-prev img-prev-4"></div>
								</div>
							</div>
							
						<?php endif; ?>
					</div>
					<?= do_shortcode(''.get_field('form_verify', 'options').'');?>
					
				</div>
			</section>
		</div>
	</div>

	<?php if( have_rows('bottom_menu', 'options') ):	

		$i=1;?>

	  <div class="fix-menu">
	    <div class="content-width">
	      <ul>

	      	<?php while ( have_rows('bottom_menu', 'options') ) : the_row();
	      		$im = get_sub_field('icon');
	      		$link = get_sub_field('link');

						if( $link ): 
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
							?>

							<li <?= $i==1?'class="open-menu-fix"':'';?>>
					          <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>" <?= get_sub_field('is_link')?'class="fancybox"':'';?>>
					            <figure>
					              <img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
					            </figure>
					            <p><?= esc_html($link_title); ?></p>
					          </a>
					        </li>

								<?php endif;
		    
			        $i++;

					endwhile;?>

	      </ul>
	    </div>
	  </div>

	<?php endif;?>

  <?php wp_footer(); ?>
	</body>
</html>
