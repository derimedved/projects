</main>

<?php if(!is_checkout()||is_wc_endpoint_url('order-received')):?>
  <footer>
    <div class="content-width">
			<div class="logo-wrap">
				<?php $iml = get_field('logo', 'options');?>
				<a href="<?= get_home_url();?>">
					<img src="<?= $iml['url'];?>" alt="<?= $iml['alt'];?>">
				</a>
			</div>
			<nav class="footer-menu-wrap">
				<?php wp_nav_menu([
					'theme_location' => 'foot-menu1',
					'container' => false,
					'menu_class' => '',
	      ]);?>

				<?php wp_nav_menu([
					'theme_location' => 'foot-menu2',
					'container' => false,
					'menu_class' => '',
	      ]);?>
			</nav>
			<?php if(get_field('phone', 'options')):?>
				<div class="tel-wrap">
					<a href="viber://chat?number=+<?= phone_clear(get_field('phone', 'options'));?>"><?php the_field('phone', 'options');?> <i class="fab fa-viber"></i></a>
				</div>
			<?php endif;?>
		</div>

  </footer>
<?php endif;?>
	<div id="cart" class="popup-site-right popup-cart" style="display: none">
		<div class="main-wrap">
			<div class="wrap">
				<?php wc_get_template_part('cart/mini-cart');?>
			</div>
		</div>
	</div>

	<div id="login" class="popup-site-right popup-login" style="display: none">
		<div class="main-wrap">
			<a href="#" class="close-popup">
				<img src="<?= get_template_directory_uri();?>/img/icon-5.svg" alt="">
			</a>
			<div class="form-wrap">
				<h3><?php the_field('login_title', 'options');?></h3>
				<p><?php the_field('login_subtitle', 'options');?></p>
				<form action="/" method="post" class="default-form login-form">
					<div class="input-wrap">
						<label for="tel"></label>
						<input type="text" name="log" id="user_login" class="tel" autocomplete="username" placeholder="טֵלֵפוֹן">
					</div>
					<div class="input-wrap">
						<label for="password"></label>
						<input type="password" name="password" id="password" placeholder="שם מלא">
						<span class="show-pas">
							<i class="fal fa-eye"></i>
						</span>
					</div>
					<div class="text">
						<p><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">שכחת ססמה?</a></p>
					</div>
					<div class="input-wrap-submit">
						<button type="submit" class="btn-blue">להיכנס</button>
					</div>
					<input type="hidden" name="action" value="my_login_action" />
				</form>
				<div class="bottom-link">
					<a href="#registration" class="registration">הירשם</a>
				</div>
			</div>
		</div>
	</div>

	<div id="registration" class="popup-site-right popup-login" style="display: none">
		<div class="main-wrap">
			<a href="#" class="close-popup">
				<img src="<?= get_template_directory_uri();?>/img/icon-5.svg" alt="">
			</a>
			<div class="form-wrap">
				<h3><?php the_field('register_title', 'options');?></h3>
				<p><?php the_field('register_subtitle', 'options');?></p>
				<form action="/" class="register-form default-form" method="post">
					
					<div class="input-wrap">
						<label for="tel-1"></label>
						<input type="text" name="billing_phone" id="tel-1" class="tel" placeholder="שֵׁם    ">
					</div>
					<div class="input-wrap input-wrap-50">
						<label for="name-p"></label>
						<input type="text" name="billing_first_name" id="name-p" placeholder="טֵלֵפוֹן">
					</div>
					<div class="input-wrap input-wrap-50">
						<label for="email-p"></label>
						<input type="email" name="email" id="email-p" placeholder="שאימייל">
					</div>

					<div class="input-wrap">
						<label for="password-1"></label>
						<input type="password" name="password" id="password-1" placeholder="שם מלא">
						<span>
						<i class="fal fa-eye"></i>
					</span>
					</div>
					<input type="hidden" name="action" value="registration_validation">
					<div class="input-wrap-submit">
						<button type="submit" class="btn-blue">להיכנס</button>
					</div>
				</form>
				<div class="bottom-link">
					<a href="#login" class="login">כְּנִיסָה</a>
				</div>
			</div>
		</div>
	</div>

  <?php wp_footer(); ?>
	</body>
</html>
