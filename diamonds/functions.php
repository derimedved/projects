<?php 

add_action( 'wp_enqueue_scripts', 'add_styles' );
add_action( 'wp_enqueue_scripts', 'add_scripts' );
add_action('after_setup_theme', 'theme_register_nav_menu');


function add_styles() {
	wp_enqueue_style('normalizecss', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('fontawesomecss', get_template_directory_uri().'/fonts/fontawesome-5-pro-master/css/all.css');
	wp_enqueue_style('fancyboxcss', get_template_directory_uri().'/css/jquery.fancybox.min.css');
  	wp_enqueue_style('swipercss', get_template_directory_uri().'/css/swiper.min.css' );
  	wp_enqueue_style('aoscss', get_template_directory_uri().'/css/aos.css' );
  	wp_enqueue_style('niceselectcss', get_template_directory_uri().'/css/nice-select.css');
  	wp_enqueue_style('rangeSlidercss', get_template_directory_uri().'/css/ion.rangeSlider.min.css');
  	wp_enqueue_style('styles', get_template_directory_uri().'/css/styles.css');
	wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style( 'theme', get_stylesheet_uri() );

}

function add_scripts() { 
	wp_enqueue_script( 'fancyboxjs', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'swiperjs', get_template_directory_uri() . '/js/swiper.js', array('jquery'), false, true);
	wp_enqueue_script( 'niceselectjs', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array('jquery'), false, true);	
	wp_enqueue_script( 'rangeSliderjs', get_template_directory_uri() . '/js/ion.rangeSlider.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), false, true);
    wp_enqueue_script('jqueryvalidation',  'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js', array(), false, 1);
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true);

	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true);

	wp_localize_script('main', 'globals',
		array(
			'url' => admin_url('admin-ajax.php'),
			'template' => get_template_directory_uri()
		)
	);


}




function theme_register_nav_menu(){
	register_nav_menus( array(
        'top-menu' => 'top',
        'main-menu' => 'header',
        'mob-menu'  => 'mobile',
        'foot-menu1' => 'footer1',
        'foot-menu2' => 'footer2',
       )
    );
	add_theme_support( 'post-thumbnails'); 
	add_theme_support( 'woocommerce'); 
}



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();

	acf_add_options_sub_page('Header&Footer');
}


function phone_clear($phone_num){ 
    $phone_num = preg_replace("![^0-9]+!",'',$phone_num);
    return($phone_num); 
}				


// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');


/*
*

Set Car Item QTY

*/

function set_cart_item_qty() {

    $key = $_GET['key'];
    $qty = (int)$_GET['qty'];
    WC()->cart->set_quantity( $key, $qty, true  );

    update_totals();

    wp_die();
}

add_action('wp_ajax_nopriv_set_cart_item_qty', 'set_cart_item_qty');
add_action('wp_ajax_set_cart_item_qty', 'set_cart_item_qty');


/**
* 
 Update Totals
*/ 


function update_totals() {

    WC()->cart->calculate_totals();

    $total = number_format(WC()->cart->total, 0, '', ',');

    wp_send_json_success(
        ['totals' => $html,
            'total' => $total . get_woocommerce_currency_symbol(),
        ]
    );


    die();
}

add_action('wp_ajax_update_totals', 'update_totals');
add_action('wp_ajax_nopriv_update_totals', 'update_totals');



/**
* 
 Update Mini Cart
*/

function update_mini_cart() {
    wc_get_template('cart/mini-cart.php');
    die();
}

add_action('wp_ajax_update_mini_cart', 'update_mini_cart');
add_action('wp_ajax_nopriv_update_mini_cart', 'update_mini_cart');



/**
* 
 Update Cart
*/


function update_cart() {



    WC()->cart->empty_cart();

    foreach ($_GET['products'] as $p) {
        $product_id = (int)$p[0];
        $qty = (int)$p[1];

        WC()->cart->add_to_cart($product_id, $qty);


    }

    ob_start();

    echo do_shortcode('[woocommerce_cart]');

    $content = ob_get_clean();

  	$total = number_format(WC()->cart->total, 0, '', ',');

  	wp_send_json([
      'content' => $content,
      'total' => $total
  ]);

    wp_die();
}
add_action('wp_ajax_update_cart', 'update_cart');
add_action('wp_ajax_nopriv_update_cart', 'update_cart');


/*
*

 GET MIN AND MAX PRICES 

 */

function get_filtered_price() {
  global $wpdb;

  $args       = wc()->query->get_main_query();

  $tax_query  = isset( $args->tax_query->queries ) ? $args->tax_query->queries : array();
  $meta_query = isset( $args->query_vars['meta_query'] ) ? $args->query_vars['meta_query'] : array();

  foreach ( $meta_query + $tax_query as $key => $query ) {
    if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
      unset( $meta_query[ $key ] );
    }
  }

  $meta_query = new \WP_Meta_Query( $meta_query );
  $tax_query  = new \WP_Tax_Query( $tax_query );

  $meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
  $tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

  $sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
  $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
  $sql .= "   WHERE {$wpdb->posts}.post_type IN ('product')
      AND {$wpdb->posts}.post_status = 'publish'
      AND price_meta.meta_key IN ('_price')
      AND price_meta.meta_value > '' ";
  $sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

  $search = \WC_Query::get_main_search_query_sql();
  if ( $search ) {
    $sql .= ' AND ' . $search;
  }

  $prices = $wpdb->get_row( $sql ); 

  return [
    'min' => floor( $prices->min_price ),
    'max' => ceil( $prices->max_price )
  ];
}


/*
*

FILTER

*/

function filter(){

$args['post_type'] = 'product';
$args['posts_per_page'] = 12;
$args['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args['tax_query'] = [ 'relation' => 'AND'];

if($_GET['s']){
    $args['s'] = $_GET['s'];
}

if ($_GET['pcat']){
    $args['tax_query'][] = [
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => $_GET['pcat'],
        'operator' => 'IN',
    ];
}

if($_GET['color']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_metal-colour',
        'field' => 'id',
        'terms' => $_GET['color'],
        'operator' => 'IN',
    ];
}

if($_GET['size']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_size',
        'field' => 'id',
        'terms' => $_GET['size'],
        'operator' => 'IN',
    ];
}

if($_GET['setting']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_setting',
        'field' => 'id',
        'terms' => $_GET['setting'],
        'operator' => 'IN',
    ];
}

if($_GET['fineness']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_fineness',
        'field' => 'id',
        'terms' => $_GET['fineness'],
        'operator' => 'IN',
    ];
}

if($_GET['kind']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_metal-kind',
        'field' => 'id',
        'terms' => $_GET['kind'],
        'operator' => 'IN',
    ];
}

// if ($_GET['price']) {
//     $args['meta_query'] = [ 'relation' => 'AND'];
//     $a = $_GET['price'];

//     $arr = explode(';', $a);

//     $meta_query = [

//         [
//           'key' => '_price',
//           'value' => array($arr[0], $arr[1]),
//           'compare' => 'BETWEEN',
//           'type' => 'NUMERIC'
//         ]
//       ];
//     $args['meta_query'] = $meta_query  ;
// }

if ($_GET['price_to'] && $_GET['price_from']) {
    $args['meta_query'] = [ 'relation' => 'AND'];
    // $a = $_GET['price'];

    // $arr = explode(';', $a);

    $meta_query = [

        [
          'key' => '_price',
          'value' => array($_GET['price_from'], $_GET['price_to']),
          'compare' => 'BETWEEN',
          'type' => 'NUMERIC'
        ]
      ];
    $args['meta_query'] = $meta_query  ;
}

if ($_GET['orderby']) {
        switch ($_GET['orderby']) :
            case 'menu_order' :

            break;
            case 'popularity' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                $args['meta_key'] = 'total_sales';             
            break;
            case 'date' :
                $args['orderby'] = 'date';
                $args['order'] = 'ASC';
            break;
            case 'price-desc' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                $args['meta_key'] = '_price';             
            break;
            case 'price' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'ASC';
                $args['meta_key'] = '_price';
            break;
        endswitch;
}





   ob_start();

  $wp_query = new WP_Query($args);

  if ( $wp_query->have_posts() ) {

    while ( $wp_query->have_posts() ) {

        $wp_query->the_post();

        wc_get_template_part( 'content', 'product' );

    }

    ?>
      
  <?php 

  }else {

      do_action( 'woocommerce_no_products_found' );

    }

  $content = ob_get_clean();

  ob_start();
  
  kama_pagenavi([], $wp_query, $_GET);

  $paginate = ob_get_clean();



  wp_send_json([
      'content' => $content,
      'paginate' => $paginate
  ]);

die();

}

add_action('wp_ajax_filter', 'filter');
add_action('wp_ajax_nopriv_filter', 'filter');

function kama_pagenavi( $args = array(), $wp_query = null , $get = []){

   
    $default = array(
        'before'          => '',
        'after'           => '',
        'echo'            => true,
        'text_num_page'   => '',
        'num_pages'       => 7,       
        'step_link'       => 0,
        'dotright_text'   => '…',
        'dotright_text2'  => '…',
        'back_text'       => 0,
        'next_text'       => 0,
        'first_page_text' => 0,
        'last_page_text'  => '0',
    
    );

    if( ($fargs = func_get_args()) && is_string( $fargs[0] ) ){
        $default['before'] = isset($fargs[0]) ? $fargs[0] : '';
        $default['after']  = isset($fargs[1]) ? $fargs[1] : '';
        $default['echo']   = isset($fargs[2]) ? $fargs[2] : true;
        $args              = isset($fargs[3]) ? $fargs[3] : array();
        $wp_query = $GLOBALS['wp_query']; 
    }

    if( ! $wp_query ){
        wp_reset_query();
        global $wp_query;
    }

    if( ! $args ) $args = array();
    if( $args instanceof WP_Query ){
        $wp_query = $args;
        $args     = array();
    }

    $default = apply_filters( 'kama_pagenavi_args', $default );

    $rg = (object) array_merge( $default, $args );

    $paged          = (int) $wp_query->get('paged');
    $max_page       = $wp_query->max_num_pages;

    if( $max_page <= 1 )
        return false;

    if( empty( $paged ) || $paged == 0 )
        $paged = 1;

    $pages_to_show = intval( $rg->num_pages );
    $pages_to_show_minus_1 = $pages_to_show-1;

    $half_page_start = floor( $pages_to_show_minus_1/2 );
    $half_page_end   = ceil(  $pages_to_show_minus_1/2 );

    $start_page = $paged - $half_page_start;
    $end_page   = $paged + $half_page_end;

    if( $start_page <= 0 )
        $start_page = 1;
    if( ($end_page - $start_page) != $pages_to_show_minus_1 )
        $end_page = $start_page + $pages_to_show_minus_1;
    if( $end_page > $max_page ) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = (int) $max_page;
    }

    if( $start_page <= 0 )
        $start_page = 1;

    $link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );


    $params =  http_build_query($get);
    $link_base = get_permalink(get_option( 'woocommerce_shop_page_id' ));

    $first_url = get_pagenum_link( 1 );
    if( false === strpos( $first_url, '?') )
        $first_url = user_trailingslashit( $first_url );

    $els = array();

    if( $rg->text_num_page ){
        $rg->text_num_page = preg_replace( '!{current}|{last}!', '%s', $rg->text_num_page );
        $els['pages'] = sprintf( '<li><span class="pages">'. $rg->text_num_page .'</span></li>', $paged, $max_page );
    }
   
    if ( $rg->back_text && $paged != 1 )
        $els['prev'] = '<li><a class="prev" href="'. ( ($paged-1)==1 ? $first_url : str_replace( '___', ($paged-1), $link_base ) ) .'">'. $rg->back_text .'</a></li>';


    for( $i = $start_page; $i <= $end_page; $i++ ) {
        if( $i == $paged )
            $els['current'] = '<li class="active">'. $i .'</li>';
        elseif( $i == 1 )
            $els[] = '<li><a href="'. $first_url .'">1</a></li>';
        else
            $els[] = '<li><a href="'. str_replace( '___', $i, $link_base   . 'page/'.$i . '?' . $params ) .'">'. $i .'</a></li>';
    }


    $dd = 0;
    if ( $rg->step_link && $end_page < $max_page ){
        for( $i = $end_page + 1; $i <= $max_page; $i++ ){



            if( $i % $rg->step_link == 0 && $i !== $rg->num_pages ) {
                if ( ++$dd == 1 )
                    $els[] = '<li><span class="extend">'. $rg->dotright_text2 .'</span></li>';


                if ($rg->step_link == $i)
                    $i = $max_page;


                $els[] = '<li><a href="'. str_replace( '___', $i, $link_base  . '/page/'.$i . '?' . $params  ) .'">'. $i .'</a></li>';
            }
        }
    }

    if ( $rg->next_text && $paged != $end_page )
        $els['next'] = '<li><a class="next" href="'. str_replace( '___', ($paged+1), $link_base   . '/page/'.$i . '?' . $params) .'">'. $rg->next_text .'</a></li>';

    $els = apply_filters( 'kama_pagenavi_elements', $els );

    $out = $rg->before . implode( ' ', $els ) . $rg->after;

    $out = apply_filters( 'kama_pagenavi', $out );

    if( $rg->echo ) echo $out;
    else return $out;
}


/*
*
Mob Menu
*/

class Mob_Menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = NULL ) {
 
        $output .= '<span></span><ul>';
    }

}

/* REGISTER*/

add_action('wp_ajax_registration_validation', 'registration_validation');
add_action('wp_ajax_nopriv_registration_validation', 'registration_validation');

function registration_validation(  )  {

    $reg_errors = new WP_Error;
    $first_name = esc_attr($_POST['billing_first_name']);
    $email      =   sanitize_email($_POST['email']);
    $password   =   esc_attr($_POST['password']);
    $phone    =   esc_attr($_POST['billing_phone']);



    if ( empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field','Required form field is missing');
    }



    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email Already in use');
    }

    if (  !empty($reg_errors->errors ) )  {
        echo '<div class="container">';
        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div><strong>';
            echo $error . '</strong><br/>';

            echo '</div>';
        }
        echo '</div>';
    } else {

        complete_registration( $password, $email, $first_name, $phone);

    }



    die();
}

function complete_registration(  $password, $email, $first_name, $phone) {


        $userdata = array(
        'user_login'    =>  $phone,
        'user_email'    =>  $email,
        'user_pass'     =>  $password,
        );
        $user_id = wp_insert_user( $userdata );

        update_user_meta( $user_id, 'billing_phone', $phone );
        update_user_meta( $user_id, 'billing_first_name', $first_name );

        nocache_headers();
        wp_clear_auth_cookie();
        wp_set_auth_cookie( $user_id );

         wp_send_json([
            'url' => get_permalink(58),
        ]);

}

/* LOGIN*/


function my_login_action()  {



  if(!isset($_POST['action']) || $_POST['action'] !== 'my_login_action')
    return;

    $info = array();
    $info['user_login'] = $_POST['log'];
    $info['user_password'] = $_POST['password'];

  $result = wp_signon( $info, false );

  if(is_wp_error($result))

      wp_send_json([
          'msg' => 'Login failed. Wrong password or user name?',
      ]);

  else

    wp_send_json([
        'url' => get_permalink(58),
    ]);
  
  exit;
};


add_action('wp_ajax_my_login_action', 'my_login_action');
add_action('wp_ajax_nopriv_my_login_action', 'my_login_action');

/* LOGOUT*/

add_action('wp_logout','auto_redirect_after_logout');

function auto_redirect_after_logout(){
  wp_safe_redirect( home_url() );
  exit;
}

/* AJAX LOAD PRODUCTS*/

add_action( 'wp_ajax_loadmore', 'loadmore' );
add_action( 'wp_ajax_nopriv_loadmore', 'loadmore' );
 
function loadmore() {
 
    $paged = ! empty( $_GET[ 'paged' ] ) ? $_GET[ 'paged' ] : 1;
    $paged++;

    $args['tax_query'] = [ 'relation' => 'AND'];

    if($_GET['s']){
        $args['s'] = $_GET['s'];
    }

    if (get_queried_object()->taxonomy){
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => get_queried_object()->term_id,
            'operator' => 'IN',
        ];
    }

    if ($_GET['product_cat']){
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $_GET['product_cat'],
            'operator' => 'IN',
        ];
    }

    if($_GET['color']){
        $args['tax_query'][] = [
            'taxonomy' => 'pa_metal-colour',
            'field' => 'id',
            'terms' => $_GET['color'],
            'operator' => 'IN',
        ];
    }

    if($_GET['size']){
        $args['tax_query'][] = [
            'taxonomy' => 'pa_size',
            'field' => 'id',
            'terms' => $_GET['size'],
            'operator' => 'IN',
        ];
    }

    if($_GET['setting']){
        $args['tax_query'][] = [
            'taxonomy' => 'pa_setting',
            'field' => 'id',
            'terms' => $_GET['setting'],
            'operator' => 'IN',
        ];
    }

    if($_GET['fineness']){
        $args['tax_query'][] = [
            'taxonomy' => 'pa_fineness',
            'field' => 'id',
            'terms' => $_GET['fineness'],
            'operator' => 'IN',
        ];
    }

    if($_GET['kind']){
        $args['tax_query'][] = [
            'taxonomy' => 'pa_metal-kind',
            'field' => 'id',
            'terms' => $_GET['kind'],
            'operator' => 'IN',
        ];
    }

    if ($_GET['price']) {
        $args['meta_query'] = [ 'relation' => 'AND'];
        $a = $_GET['price'];

        $arr = explode(';', $a);

        $meta_query = [

            [
              'key' => '_price',
              'value' => array($arr[0], $arr[1]),
              'compare' => 'BETWEEN',
              'type' => 'NUMERIC'
            ]
          ];
        $args['meta_query'] = $meta_query  ;
    }

    if ($_GET['orderby']) {
            switch ($_GET['orderby']) :
                case 'menu_order' :

                break;
                case 'popularity' :
                    $args['orderby'] = 'meta_value';
                    $args['order'] = 'DESC';
                    $args['meta_key'] = 'total_sales';             
                break;
                case 'date' :
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                break;
                case 'price-desc' :
                    $args['orderby'] = 'meta_value';
                    $args['order'] = 'DESC';
                    $args['meta_key'] = '_price';             
                break;
                case 'price' :
                    $args['orderby'] = 'meta_value';
                    $args['order'] = 'ASC';
                    $args['meta_key'] = '_price';
                break;
            endswitch;
    }
 
    $args = array(
        'paged' => $paged,
        'post_type' => 'product',
        'posts_per_page' => 12,
        'post_status' => 'publish',
    );
 
    $wp_query = new WP_Query($args);
 
    while( $wp_query->have_posts() ) : $wp_query->the_post();

        wc_get_template_part( 'content', 'product' );

    endwhile;
 
    die;
 
}