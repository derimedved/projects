<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

define('ASSETS', get_template_directory_uri().'/assets/');
/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style("style",get_stylesheet_uri(), false, null);

    $styles= [
        "css/font.css",
        "css/normalize.css",
        "fonts/fontawesome-5-pro-master/css/all.css",
        "css/owl.theme.default.min.css",
        "css/owl.carousel.min.css",
        "css/nice-select.css",
        "css/datepicker.min.css",
        "css/ion.rangeSlider.css",
        "css/ion.rangeSlider.skinFlat.css",
        "css/swiper.min.css",
        "css/jquery.fancybox.min.css",
        "css/styles.css",
        "css/responsive.css",
    ];
    if($styles)
    foreach($styles as $style) {
        wp_enqueue_style($style, ASSETS.$style, false, null);
    }
    

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', ASSETS.'js/jquery.min.js');
    wp_enqueue_script( 'jquery' );

    $scripts = [
        "js/owl.carousel.js",
        "js/jquery.nice-select.min.js",
        "js/datepicker.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js",
        "js/ion.rangeSlider.js",
        "js/fixto.min.js",
        "js/swiper.js",
        "js/cuttr.min.js",
        "js/jquery.fancybox.min.js",
        "js/script.js",
    ];
    if($scripts)
    foreach($scripts as $script) {
        $path = str_contains($script, 'https')?$script:ASSETS.$script;
        wp_enqueue_script($script, $path, ['jquery'], null, true);
    }

    wp_enqueue_script('common.js', get_template_directory_uri().'/assets/js/common.js', ['jquery'], null, true);

    // if(basename(get_page_template()) == "template-contact.blade.php"){
    //     $gapikey=get_field('gapikey','options')?:'';
    //     wp_enqueue_script('google-map', "https://maps.googleapis.com/maps/api/js?key=$gapikey&callback=initMap&libraries=&v=weekly", ['app.js'], null, true);
    // }

    $args = [
        'url' => admin_url('admin-ajax.php'),
    ];

    wp_localize_script('common.js', 'global',
        $args
    );

}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    add_theme_support('soil', [
        'disable-asset-versioning',
        'disable-trackbacks',
        'nice-search',
        'relative-urls',
        'js-to-footer',
    ]);

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'top_navigation' => __('Top Navigation', 'sage'),
        'footer_navigation_1' => __('Footer Navigation 1', 'sage'),
        'footer_navigation_2' => __('Footer Navigation 2', 'sage'),
    ]);
    
    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);


/**
 * Custom thumb size.
 */
if ( function_exists( 'add_image_size' ) ) {
    $add_sizes=[
        [1920,1024],
        [1920,700],
        [680,420],
        [600,400],
        [390,300],
        [300,200],
        [250,150,false],
        [150,80,false],
        [150,100],
        [80,80,false],
    ];
    if($add_sizes) 
    foreach($add_sizes as $size) {
        add_image_size( $size[0].'x'.$size[1], $size[0], $size[1], isset($size[2])?$size[2]:true);
    }
}


/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});


if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}