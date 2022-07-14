<?php 

show_admin_bar( false );


function load_style_script(){
	wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;600;700&display=swap');
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/fonts/fontawesome-5-pro-master/css/all.css');
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css');
	wp_enqueue_style('nice-select', get_template_directory_uri() . '/css/nice-select.css');
	wp_enqueue_style('swiper', get_template_directory_uri() . '/css/swiper.min.css');
	wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.min.css');
	wp_enqueue_style('styles', get_template_directory_uri() . '/css/styles.css');
	wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');

	wp_enqueue_script('jquery');
    wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.js', array(), false, true);
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), false, true);
    wp_enqueue_script('nice-select', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array(), false, true);
    wp_enqueue_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), false, true);
    wp_enqueue_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), false, true);
    wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap.js', array(), false, true);
    wp_enqueue_script('ScrollTrigger', get_template_directory_uri() . '/js/ScrollTrigger.min.js', array(), false, true);
    wp_enqueue_script('rellax', get_template_directory_uri() . '/js/rellax.min.js', array(), false, true);
    wp_enqueue_script('dop', get_template_directory_uri() . '/js/dop.js', array(), false, true);
    wp_enqueue_script('valid', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), false, true);
    wp_enqueue_script('mask', get_template_directory_uri() . '/js/jquery.mask.min.js', array(), false, true);
    wp_enqueue_script('cuttr', get_template_directory_uri() . '/js/cuttr.min.js', array(), false, true);
    wp_enqueue_script('jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), false, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array(), false, true);
}



add_action('wp_enqueue_scripts', 'load_style_script');



add_action('after_setup_theme', function(){
	register_nav_menus( array(
		'header' => 'Header menu',
		'footer-1' => 'Footer menu-1',
		'footer-2' => 'Footer menu-2',
		'footer-3' => 'Footer menu-3',
		'footer-4' => 'Footer menu-4',
		'burger-menu-1' => 'Burger menu-1',
		'burger-menu-2' => 'Burger menu-2',
	) );
});



add_theme_support( 'title-tag' );



add_theme_support( 'post-thumbnails' ); 


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Main settings',
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


add_filter('wpcf7_autop_or_not', '__return_false');


remove_filter('term_description', 'wpautop');


function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyD7Q82l2QjSzJJk1uUW3OzUBGPTlbk8w1g');
}
add_action('acf/init', 'my_acf_init');