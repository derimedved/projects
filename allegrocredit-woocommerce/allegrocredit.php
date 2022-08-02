<?php
/*
 * Plugin Name: Allegrocredit WooCommerce
 * Description: Allegrocredit payment gateway for woocommerce
 * Version: 1.0
 * Author: Oleg Derimedved
 */




function add_allegrocredit_gateway_class($methods)
{
    require_once(__DIR__ . '/includes/class-wc-gateway-allegrocredit.php');
    $methods[] = 'WC_Allegro_Credit';
    return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_allegrocredit_gateway_class');


/**
 * allegro_assets
 */

function allegro_assets() {
    wp_enqueue_style(
        'allegro',
        plugins_url('/assets/css/allegro-styles.css' , __FILE__),
        [],
        rand(0, 99999)
    );
}

add_action( 'wp_enqueue_scripts', 'allegro_assets' );


/**
 * allegro_log post type
 */


function create_posttype() {

    register_post_type( 'allegro_log',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Allegro Log' ),
                'singular_name' => __( 'Log' )
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => false,
            'exclude_from_search' => true,
            'supports' => array(  'title', 'editor', 'excerpt','custom-fields'  ),
            'show_in_menu' => 'woocommerce',
            'menu_position' => 20,
        )
    );
}

add_action( 'init', 'create_posttype' );


/**
 * custom post columns
 */



add_filter('manage_allegro_log_posts_columns', function($columns) {
    return array_merge($columns,
        ['code' => ''],
        ['allegro_id' => 'Allegro ID'],
        ['order_id' => 'Order ID'],
        ['descr' => 'Description'],
        ['source' => 'Source'],
        ['allegro_status' => 'Allegro status'],
        ['status' => 'Woo status'],
        ['time' => 'Time'],
        ['view' => 'View'],


    );
}, 1    );



add_action('manage_allegro_log_posts_custom_column', function($column_key, $post_id) {
    if ($column_key == 'code') {
        $code = get_post_meta($post_id, 'code', true);
        if ($code == 200 || get_post_meta($post_id, 'source', true) == 'webhook') {
            $return = '<span style="color:darkgreen" class="dashicons dashicons-yes-alt"></span>';
        } else {
            $return = '<span style="color:red" class="dashicons dashicons-dismiss"></span>';
        }
        echo $return.$code ;
    }
    if ($column_key == 'allegro_id') {
        $allegro_id = get_post_meta($post_id, 'allegro_id', true);
        echo '<a target="_blank" href="https://secure.allegrocredittest.com/merchant-portal/applications/'.$allegro_id.'">'.$allegro_id . '</a>';
    }
    if ($column_key == 'order_id') {
        $order_id = get_post_meta($post_id, 'order_id', true);
        echo '<a target="_blank" href="/wp-admin/post.php?post='.$order_id.'&action=edit">'.$order_id . '</a>';

    }
    if ($column_key == 'descr') {
        $descr = get_post_meta($post_id, 'descr', true);
        echo $descr;
    }

    if ($column_key == 'source') {
        $source = get_post_meta($post_id, 'source', true);
        echo $source;
    }
    if ($column_key == 'allegro_status') {
        $status = get_post_meta($post_id, 'allegro_status', true);
        echo $status;
    }

    if ($column_key == 'status') {
        $status = get_post_meta($post_id, 'order_status', true);
        echo  ucfirst($status) ;
    }

    if ($column_key == 'time') {
        $time = the_time( 'g:i a, D, j F y' , $post_id);
        echo $time;
    }

    if ($column_key == 'view') {

        echo '<a class="log_toggle" data-post_id="'.$post_id.'" href="#"><span class="dashicons dashicons-menu-alt3"></span></a>';
    }


}, 10, 2);


add_filter('manage_edit-allegro_log_sortable_columns', function($columns) {
    $columns['allegro_id'] = 'allegro_id';
    $columns['order_id'] = 'order_id';
    return $columns;
});

add_action('pre_get_posts', function($query) {
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');
    if ($orderby == 'allegro_id') {
        $query->set('meta_key', 'allegro_id');
        $query->set('orderby', 'meta_value_num');
    }

    if ($orderby == 'order_id') {
        $query->set('meta_key', 'order_id');
        $query->set('orderby', 'meta_value_num');
    }
});


add_filter('manage_allegro_log_posts_columns', function($columns) {


    $keys = ['code', 'allegro_id', 'order_id' ,'descr', 'source' ,'allegro_status', 'status' ,'time','view' ];

    foreach ($columns as $key=>$column) {
        if (!in_array($key, $keys))
        unset($columns[$key]);
    }


    $taken_out = $columns['date'];
    unset($columns['date']);
    //$columns['date'] = $taken_out;


    return $columns;
}, 999);


/**
 * remove post actions
 */


add_filter( 'post_row_actions', 'allegro_page_row_actions', 9999, 2 );
function allegro_page_row_actions( $actions, $post )
{
    if ( 'allegro_log' == $post->post_type ) {
        return array();
    }
    return $actions;
}

/**
 * remove views_edit
 */


add_filter( 'views_edit-allegro_log', function( $views )
{

    foreach(   $views as $key=>$view )
        unset( $views[$key] );

    return $views;
}, 999 );


add_action( 'restrict_manage_posts', 'allegro_log_admin_posts_filter_restrict_manage_posts' );



/**
 * allegro_log_admin_posts_filter_restrict_manage_posts

 */
function allegro_log_admin_posts_filter_restrict_manage_posts(){
    $type = 'allegro_log';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('allegro_log' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
        $values = array(
            'Api' => 'api',
            'Webhook' => 'webhook',
             
        );
        ?>
        <select name="source">
            <option value=""><?php _e('Source', 'allegro_log'); ?></option>
            <?php
            $current_v = isset($_GET['source'])? $_GET['source']:'';
            foreach ($values as $label => $value) {
                printf
                (
                    '<option value="%s"%s>%s</option>',
                    $value,
                    $value == $current_v? ' selected="selected"':'',
                    $label
                );
            }
            ?>
        </select>
        <?php
    }
}


add_filter( 'parse_query', 'allegro_log_posts_filter' );



/**
 * allegro_log_posts_filter

 *
 */
function allegro_log_posts_filter( $query ){
    global $pagenow;
    $type = 'allegro_log';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'allegro_log' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['source']) && $_GET['source'] != '') {
        $query->query_vars['meta_key'] = 'source';
        $query->query_vars['meta_value'] = $_GET['source'];
    }
}


/**
 * allegro_scripts
 */



add_action('admin_footer', 'allegro_scripts');

function allegro_scripts() {

    if ($_GET['post_type'] == 'allegro_log') {
        ?>

        <style>
            .allegro_log_detail
            .spinner {
                visibility: visible !important;
            }

            #wpseo-readability-filter,
            #wpseo-filter {
                display: none !important;
            }

            th#view {
                width: 4%;
            }
        </style>
        <script>
            jQuery(document).ready(function($){
                $('tr.type-allegro_log').each(function(i, val){
                    var id = $(this).attr('id')
                    $('<tr style="display:none" class="allegro_log_detail ' + id + '"><td collspan="4"><span class="spinner"></span></td></tr>').insertAfter($(this))
                });





                $(document).on('click', '.log_toggle', function(e){
                    e.preventDefault();
                    $('tr.allegro_log_detail').hide();
                    var post_id = $(this).attr('data-post_id');
                    $('tr.allegro_log_detail.post-' + post_id  ).show();
                    $(this).addClass('active');

                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        data: {
                            action: 'allegro_log_details',
                            post_id: post_id
                        },
                        success: function(data) {
                            $('tr.allegro_log_detail.post-' + post_id + ' td').html(data)
                        }
                    })
                });

                $(document).on('click', '.log_toggle.active', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation() ;
                    var post_id = $(this).attr('data-post_id');
                    $('tr.allegro_log_detail.post-' + post_id  ).hide();
                    $(this).removeClass('active');
                    return false;
                });






            })


        </script>
        <?php

    }
}


/**
 * allegro_log_details
 */


function allegro_log_details() {
    $post_id = $_GET['post_id'];
    echo get_post($post_id)->post_content;
    die();
}

add_action('wp_ajax_allegro_log_details', 'allegro_log_details');


/**
 * link to settings
 */


add_filter( 'views_edit-allegro_log', function( $views )
{
    ?>

    <div style="padding-bottom: 30px">
        <a class="export_orders_toggle" href="/wp-admin/admin.php?page=wc-settings&tab=checkout&section=allegrocredit">Allegro Settings</a>

    </div>

    <?php

    return $views;
} );



     add_action('init',   'retailer');

    function retailer() {


      //  $order = new WC_Order(14661);

        if (isset($_GET['test_a'])) {



            require_once(__DIR__ . '/includes/classes/AllegroCredit.php');

            $keys = [

                'sandbox' =>  1,
                'sandbox_key' =>  'a11fc881-0ca8-3850-e3ba8feada24c461'
            ];


            echo '<pre>';
            $allegro = new Allegro($keys);

            $order = new WC_Order(15100);

            $url = $allegro->application(  $order  );
            print_r($url);



            echo '<br><br>';
           // $allegro->retailer();
            die();
        }
    }