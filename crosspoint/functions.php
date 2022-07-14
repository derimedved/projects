<?php 

add_action( 'wp_enqueue_scripts', 'add_styles' );
add_action( 'wp_enqueue_scripts', 'add_scripts' );
add_action('after_setup_theme', 'theme_register_nav_menu');


function add_styles() {
	wp_enqueue_style('normalizecss', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('fontawesomecss', get_template_directory_uri().'/fonts/fontawesome-5-pro-master/css/all.css');
	wp_enqueue_style('fancyboxcss', get_template_directory_uri().'/css/jquery.fancybox.min.css');
    wp_enqueue_style('swipercss', get_template_directory_uri().'/css/swiper.min.css' );
  wp_enqueue_style('niceselectcss', get_template_directory_uri().'/css/nice-select.css');
  wp_enqueue_style('styles', get_template_directory_uri().'/css/styles.css');
	wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style( 'theme', get_stylesheet_uri() );

}

	
function add_scripts() {

	wp_enqueue_script( 'fancyboxjs', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'swiperjs', get_template_directory_uri() . '/js/swiper.js', array('jquery'), false, true);
	wp_enqueue_script( 'niceselectjs', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), false, true);
	wp_enqueue_script( 'cuttr', get_template_directory_uri() . '/js/cuttr.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true);


}



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();

	acf_add_options_sub_page('Theme Settings');
}


function phone_clear($phone_num){ 
    $phone_num = preg_replace("![^0-9]+!",'',$phone_num);
    return($phone_num); 
}				

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyDiyT05YehIdz2LrV-QOeRa5M18WfKtlnY'); 
}

add_action('acf/init', 'my_acf_init');

/**
excerpts
*/

add_filter( 'excerpt_more', function( $more ) {
    return '';
} );

function isacustom_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'team')
    return 110;
    else
    return 70;
}

add_filter('excerpt_length', 'isacustom_excerpt_length', 100);



/**

	MENU

*/


	function theme_register_nav_menu(){
		register_nav_menus( array(
	        'main-menu' => 'header',
	        'mob-menu'  => 'mobile',
	        'foot-menu' => 'footer',
	        'land-menu' => 'landing',
	       )
	    );
		add_theme_support( 'post-thumbnails'); 
	}

	/* Main Menu */


		function special_nav_class($classes, $item){
		    if( in_array('current-menu-item', $classes) ){
		        $classes[] = 'current-page';
		    }
		    return $classes;
		}
		add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

		class Selective_Walker extends Walker_Nav_Menu {
		    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		        $id_field = $this->db_fields['id'];

		        if ( is_object( $args[0] ) ) {
		            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
		        }

		        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		    }

		    
		    function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {	
		        if ( $args->has_children ) {
		            $item->classes[] = 'sub-li';
		        }

		        parent::start_el($output, $item, $depth, $args);
		    }
		}

	/* Mobile Menu */

	class Mob_Menu extends Walker_Nav_Menu {

		function start_lvl( &$output, $depth = 0, $args = NULL ) {

			$output .= '<ul class="level level-2">';
		}
		

		function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
			global $wp_query;           
			

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	 
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->walker->has_children ) {
				$class_names = ' class="' . esc_attr( $class_names ) . ' sub-li"';
			}else{
				$class_names = ' class="' . esc_attr( $class_names ) . '"';
	 		}
			
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
	 
			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	 
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

			if ( $args->walker->has_children ) {
				$item_output .= '</a><span></span>';
			}else{
				$item_output .= '</a>';
			}

			$item_output .= $args->after;
	 
	 		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

/**  END MENU */

/** PAGINATION */
	
	/**
 * Альтернатива wp_pagenavi. Создает ссылки пагинации на страницах архивов.
 *
 * @version 2.8
 * @author  Тимур Камаев
 * @link    https://wp-kama.ru/8
 *
 * @param array    $args      Аргументы функции.
 * @param WP_Query $wp_query  Объект WP_Query на основе которого строится пагинация. По умолчанию глобальная переменная $wp_query.
 *
 * @return string Pagination HTML code.
 */
function kama_pagenavi( $args = [], $wp_query = null ){

	$default = [
		'echo'            => true,
		'num_pages'       => 4,
		'step_link'       => 0,
		'dotright_text'   => '',         
		'dotright_text2'  => '', 
		'back_text'       => '<i class="fas fa-chevron-left"></i> Prev', 
		'next_text'       => 'Next <i class="fas fa-chevron-right"></i>',
		'first_page_text' => 0,
		'last_page_text'  => 0,
	];

	$fargs = func_get_args();
	if( $fargs && is_string( $fargs[0] ) ){
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

	if( ! $args ){
		$args = [];
	}

	if( $args instanceof WP_Query ){
		$wp_query = $args;
		$args = [];
	}

	$default = apply_filters( 'kama_pagenavi_args', $default );

	$rg = (object) array_merge( $default, $args );

	$paged = (int) $wp_query->get( 'paged' ) ?: 1;
	$max_page = $wp_query->max_num_pages;

	if( $max_page < 2 ){
		return '';
	}

	$pages_to_show = (int) $rg->num_pages;
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1 / 2 ); 
	$half_page_end   = ceil(  $pages_to_show_minus_1 / 2 ); 

	$start_page = $paged - $half_page_start; 
	$end_page   = $paged + $half_page_end;   

	if( $start_page <= 0 ){
		$start_page = 1;
	}
	if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ){
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if( $end_page > $max_page ){
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 ){
		$start_page = 1;
	}

	$link_base = str_replace( PHP_INT_MAX, '___', get_pagenum_link( PHP_INT_MAX ) );
	$first_url = get_pagenum_link( 1 );
	if( false === strpos( $first_url, '?' ) ){
		$first_url = user_trailingslashit( $first_url );
	}

	$els = [];

	if( $rg->text_num_page ){
		$rg->text_num_page = preg_replace( '!{current}|{last}!', '%s', $rg->text_num_page );
		$els['pages'] = sprintf( '<span class="pages">' . $rg->text_num_page . '</span>', $paged, $max_page );
	}
	// назад
	if( $rg->back_text && $paged !== 1 ){
		$els['prev'] = '<li class="first"><a class="prev" href="' . ( ( $paged - 1 ) == 1 ? $first_url : str_replace( '___', ( $paged - 1 ), $link_base ) ) . '">' . $rg->back_text . '</a></li>';
	}
	if( $start_page >= 2 && $pages_to_show < $max_page ){
		$els['first'] = '<a class="first" href="' . $first_url . '">' . ( $rg->first_page_text ?: 1 ) . '</a>';
		if( $rg->dotright_text && $start_page !== 2 ){
			$els[] = '<span class="extend">' . $rg->dotright_text . '</span>';
		}
	}
	for( $i = $start_page; $i <= $end_page; $i++ ){
		if( $i === $paged ){
			$els['current'] = '<li class="active">' . $i . '</li>';
		}
		elseif( $i === 1 ){
			$els[] = '<li><a href="' . $first_url . '">1</a></li>';
		}
		else{
			$els[] = '<li><a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</a></li>';
		}
	}

	$dd = 0;
	if( $rg->step_link && $end_page < $max_page ){
		for( $i = $end_page + 1; $i <= $max_page; $i++ ){
			if( 0 === ( $i % $rg->step_link) && $i !== $rg->num_pages ){
				if( ++$dd === 1 ){
					$els[] = '<span class="extend">' . $rg->dotright_text2 . '</span>';
				}
				$els[] = '<a href="' . str_replace( '___', $i, $link_base ) . '">' . $i . '</a>';
			}
		}
	}
	
	if( $end_page < $max_page ){
		if( $rg->dotright_text && $end_page !== ( $max_page - 1 ) ){
			$els[] = '<span class="extend">' . $rg->dotright_text2 . '</span>';
		}
		$els['last'] = sprintf( '<a class="last" href="%s">%s</a>',
			str_replace( '___', $max_page, $link_base ),
			$rg->last_page_text ?: $max_page
		);
	}
	
	if( $rg->next_text && $paged !== $end_page ){
		$els['next'] = sprintf( '<li class="last"><a href="%s">%s</a></li>',
			str_replace( '___', ( $paged + 1 ), $link_base ),
			$rg->next_text
		);
	}

	$els = apply_filters( 'kama_pagenavi_elements', $els );

	$html = $rg->before . '<ul class="pagination">' . implode( '', $els ) . '</ul>' . $rg->after;

	$html = apply_filters( 'kama_pagenavi', $html );

	if( ! $rg->echo ){
		return $html;
	}

	echo $html;
}

/* end pagination */