<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo wp_get_document_title(); ?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Raleway:wght@400;500&display=swap" rel="stylesheet">
	
	<?php wp_head();?>

</head>

<body <?php body_class() ?>>

	<?php if(get_field('show_admissions_line', 'options')):?>

		<div class="line-info">
			<div class="content-width">
				<div class="left">
					<p><?= date("m-d-Y");?> <?php the_field('admissions_text', 'options');?> </p>
				</div>
				<div class="btn-wrap">
					<?php $link = get_field('admissions_link', 'options');

					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="btn" href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>"><?= esc_html($link_title); ?></a>
					<?php endif; ?>
					<a href="#" class="close-line"><img src="<?= get_template_directory_uri();?>/img/icon-1.svg" alt=""></a>
				</div>
			</div>
		</div>

	<?php endif;?>

  	<header>
		<div class="top-line">
			<div class="top">
				<div class="content-width">
					<div class="logo-wrap">
						<?php $iml = get_field('logo_header', 'options');?>
						<div class="img-wrap">
							<?php if($iml):?>
								<img src="<?= $iml['url'];?>" alt="<?= $iml['alt'];?>">
							<?php endif;?>
						</div>
						<div class="text-wrap">
							<p><?php the_field('logo_text_header', 'options');?></p>
						</div>
					</div>
					<div class="contact-wrap">

						<?php 

							$adr = get_field('address_header', 'options');
							$tel = get_field('phone', 'options');

						?>

						<ul>
							<?php if($adr):?>
								<li>
									<div class="icon-wrap">
										<img src="<?= get_template_directory_uri();?>/img/icon-2-1.svg" alt="">
									</div>
									<div class="wrap">
										<a href="<?php the_field('address_header_link', 'options');?>">
											<?= $adr;?>
										</a>
									</div>
								</li>
							<?php endif;?>

							<?php if($tel):?>
								<li>
									<div class="icon-wrap">
										<img src="<?= get_template_directory_uri();?>/img/icon-2-2.svg" alt="">
									</div>
									<div class="wrap">
										<a href="tel:+<?= phone_clear($tel);?>">
											<p><?php the_field('phone_text', 'options');?></p>
											<p><?= $tel;?></p>
										</a>
									</div>
								</li>
							<?php endif;?>
						</ul>
						<div class="open-menu">
							<a href="#menu-responsive">
								<span></span>
								<span></span>
								<span></span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="nav-wrap">
				<div class="content-width">
					<nav class="top-menu-wrap">

						<?php 

						if(is_page_template('templates/landing.php')):

							wp_nav_menu([
							    'theme_location' => 'land-menu',
							    'container' => false,
							    'menu_class' => 'top-menu land-menu',
							    'walker' => new Selective_Walker(),
							]);

						else:

							wp_nav_menu([
							    'theme_location' => 'main-menu',
							    'container' => false,
							    'menu_class' => 'top-menu',
							    'walker' => new Selective_Walker(),
							]);

						endif;

						?>

					</nav>
					<div class="soc-wrap">
						<?php if( have_rows('socials_header', 'options') ):?>

							<ul class="soc">

								<?php while ( have_rows('socials_header', 'options') ) : the_row();?>

        							<li><a href="<?php the_sub_field('link');?>" target="_blank"><i class="<?php the_sub_field('icon');?>"></i></a></li>

    							<?php endwhile;?>
    								
    						</ul>

						<?php endif;?>
						
					</div>
				</div>
			</div>
		</div>
  </header>


	<div class="menu-responsive" id="menu-responsive" style="display: none">
		<div class="content-menu">
			<nav class="mob-menu">
				<a href="#" class="close-menu" ><span class="img-wrap"><img src="<?= get_template_directory_uri();?>/img/icon-10.svg" alt=""></span></a>

				<?php  if(is_page_template('templates/landing.php')):

					wp_nav_menu([
						'theme_location' => 'land-menu',
						'container' => false,
						'menu_class' => 'level level-1',
						'walker' => new Selective_Walker(),
					]);

				else:

					wp_nav_menu([
						'theme_location' => 'mob-menu',
						'container' => false,
						'menu_class' => 'level level-1',
						'walker' => new Mob_Menu(),
					]);

				endif;?>

			</nav>
			<div class="soc-wrap">
				<?php if( have_rows('socials_header', 'options') ):?>

					<ul class="soc">

						<?php while ( have_rows('socials_header', 'options') ) : the_row();?>

        					<li><a href="<?php the_sub_field('link');?>" target="_blank"><i class="<?php the_sub_field('icon');?>"></i></a></li>

    					<?php endwhile;?>
    								
    				</ul>

				<?php endif;?>
			</div>
			<div class="contact-wrap">
				<ul>
					<?php if($adr):?>
						<li>
							<div class="icon-wrap">
								<img src="<?= get_template_directory_uri();?>/img/icon-2-1.svg" alt="">
							</div>
							<div class="wrap">
								<?= $adr;?>
							</div>
						</li>
					<?php endif;?>
					<?php if($tel):?>
						<li>
							<div class="icon-wrap">
								<img src="<?= get_template_directory_uri();?>/img/icon-2-2.svg" alt="">
							</div>
							<div class="wrap">
								<a href="tel:+<?= phone_clear($tel);?>">
									<p><?php the_field('phone_text', 'options');?></p>
									<p><?= $tel;?></p>
								</a>
							</div>
						</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</div>

	<main>