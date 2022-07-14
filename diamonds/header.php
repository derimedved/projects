<!DOCTYPE html>
<html <?php language_attributes(); ?>  dir="rtl">
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo wp_get_document_title(); ?></title>
		<?php wp_head();?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body <?php body_class() ?>>
	  <header <?= (is_checkout()&&!is_wc_endpoint_url('order-received'))?'class="bg-blue"':'';?>>
	  	<?php if(!is_checkout()||is_wc_endpoint_url('order-received')):?>
			<div class="top-line">
				<div class="content-width">
					<nav class="menu">
						<?php wp_nav_menu([
						    'theme_location' => 'top-menu',
						    'container' => false,
						    'menu_class' => '',
                    	]);?>
					</nav>
					<div class="login-wrap">
						<?php if(!is_user_logged_in()):?>
							<a href="#login" class="inlogin">להתחבר <img src="<?= get_template_directory_uri();?>/img/icon-1.svg" alt=""></a>
						<?php else:?>
							<a href="<?= get_permalink(get_option( 'woocommerce_myaccount_page_id' ));?>">מִשׂרָד<img src="<?= get_template_directory_uri();?>/img/icon-1.svg" alt=""></a>
						<?php endif;?>
					</div>
				</div>
			</div>
		<?php endif;?>
		<div class="second-line">
			<div class="content-width">
				<div class="wrap">
					<div class="logo-wrap">
						<?php 
							$iml = get_field('logo', 'options');
							$imml = get_field('logo_mob', 'options');
						?>
						<a href="<?= get_home_url();?>">
							<img src="<?= $iml['url'];?>" alt="<?= $iml['alt'];?>">
							<img src="<?= $imml['url'];?>" alt="<?= $imml['alt'];?>" class="logo-mob">
						</a>

					</div>
					<?php if(!is_checkout()||is_wc_endpoint_url('order-received')):?>
						<nav class="top-menu">
							<?php wp_nav_menu([
							    'theme_location' => 'main-menu',
							    'container' => false,
							    'menu_class' => '',
	                    	]);?>
						</nav>
					<?php endif;?>
				</div>
				<div class="contact-wrap">
					<?php if(get_field('phone', 'options')):?>
						<div class="tel">
							<a href="viber://chat?number=+<?= phone_clear(get_field('phone', 'options'));?>" dir="ltr"><?php the_field('phone', 'options');?> <i class="fab fa-viber"></i></a>
						</div>
					<?php endif;?>
					<?php if(!is_checkout()):?>
						<div class="search-wrap">
							<a href="#"><img src="<?= get_template_directory_uri();?>/img/icon-3.svg" alt=""></a>
						</div>
						<div class="cart-wrap">
							<?php $total = number_format(WC()->cart->total, 0, '', ',') . get_woocommerce_currency_symbol();?>
							<a href="#cart"><img src="<?= get_template_directory_uri();?>/img/icon-2.svg" alt="">
								<span><?= $total;?></span></a>
						</div>
						<div class="open-menu">
							<a href="#menu-responsive">
								<span></span>
								<span></span>
								<span></span>
							</a>
						</div>
						<div class="top-search-form-wrap">
							<form action="<?= get_permalink(wc_get_page_id( 'shop' ));?>">
								<label for="top-search"></label>
								<input type="text" id="top-search" name="s">
								<button type="submit"><img src="<?= get_template_directory_uri();?>/img/icon-3.svg" alt=""></button>

							</form>
							<a href="#" class="close-search"><i class="fal fa-times"></i></a>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="sub-menu-wrap content-width" style="display: none">
			<div class="left">
				<ul>
					<li><p>זהב</p></li>
					<li><a href="#">של נשים</a></li>
					<li><a href="#">של גברים</a></li>
					<li><a href="#">זהב אדום</a></li>
					<li><a href="#">זהב לבן</a></li>
					<li><a href="#">עם סלעים</a></li>
					<li><a href="#">עם יהלומים</a></li>
				</ul>
				<ul>
					<li><p>כסף</p></li>
					<li><a href="#">של נשים</a></li>
					<li><a href="#">של גברים</a></li>
					<li><a href="#">עם סלעים</a></li>
					<li><a href="#">עם זרקוניה</a></li>
					<li><a href="#">תִינוֹק</a></li>
					<li><a href="#">עבור קסמים</a></li>
				</ul>
				<ul>
					<li><p>לפי עיצוב</p></li>
					<li><a href="#">עם חוט</a></li>
					<li><a href="#">עוֹר</a></li>
					<li><a href="#">עם תליונים</a></li>
					<li><a href="#">נוקשה</a></li>
					<li><a href="#">ברגל</a></li>
					<li><a href="#">טֶנִיס</a></li>
				</ul>
				<ul>
					<li><p>קלאסי אריגה</p></li>
					<li><a href="#">לְעַגֵן</a></li>
					<li><a href="#">ביסמרק</a></li>
					<li><a href="#">נָחָשׁ</a></li>
					<li><a href="#">נונה</a></li>
					<li><a href="#">Spikelet</a></li>
					<li><a href="#">מְעוּיָן</a></li>
				</ul>
			</div>
			<figure>
				<img src="<?= get_template_directory_uri();?>/img/img-4.jpg" alt="">
			</figure>
		</div>
  </header>



	<div class="menu-responsive" id="menu-responsive" style="display: none">
		<div class="content-menu">
			<a href="#" class="close-popup">
				<img src="<?= get_template_directory_uri();?>/img/icon-5.svg" alt="">
			</a>
			<h3>Menu</h3>
			<nav class="mob-menu">
				<?php wp_nav_menu([
					'theme_location' => 'mob-menu',
					'container' => false,
					'menu_class' => '',
					'walker' => new Mob_Menu()
				]);?>
			</nav>
			<?php if(get_field('phone', 'options')):?>
				<div class="tel">
					<a href="viber://chat?number=+<?= phone_clear(get_field('phone', 'options'));?>" dir="ltr"><?php the_field('phone', 'options');?> <i class="fab fa-viber"></i></a>
				</div>
			<?php endif;?>
		</div>
	</div>

	<main>