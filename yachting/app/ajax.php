<?php

namespace App;

use Sober\Controller\Controller;
use WC_AJAX;

class Ajax extends Controller
{
    public function __construct()
    {
        add_action('wp_ajax_post_handler', [$this, 'post_handler']);
        add_action('wp_ajax_nopriv_post_handler', [$this, 'post_handler']);

        add_action('wp_ajax_ajax_registration', [$this, 'ajax_registration']);
        add_action('wp_ajax_nopriv_ajax_registration', [$this, 'ajax_registration']);

        add_action('wp_ajax_ajax_login', [$this, 'ajax_login']);
        add_action('wp_ajax_nopriv_ajax_login', [$this, 'ajax_login']);

        add_action('wp_ajax_ajax_booking', [$this, 'ajax_booking']);
        add_action('wp_ajax_nopriv_ajax_booking', [$this, 'ajax_booking']);

        add_action('wp_ajax_ajax_add_yacht', [$this, 'ajax_add_yacht']);
        add_action('wp_ajax_nopriv_ajax_add_yacht', [$this, 'ajax_add_yacht']);

    }

    public function ajax_add_yacht()
    {

        check_ajax_referer( 'ajax-add-yacht', 'nonce' );
    
        if($_POST['title']&&$_POST['user_id']) {

            $user_id=(int)$_POST['user_id'];

            $post_data = array(
                'post_title'    => wp_strip_all_tags( $_POST['title'] ),
                'post_type' 	=> 'yachts',
                'post_status'   => 'draft',
                'post_author'   => $user_id,
            );		

            // $post_id = wp_insert_post( $post_data );

            var_dump($_POST['enquipment']);
            if ( !empty($_FILES) ) {
                $files = $_FILES;

                // var_dump($files);
                
                foreach($files as $file) {
                    $newfile = array (
                        'name' => $file['name'],
                        'type' => $file['type'],
                        'tmp_name' => $file['tmp_name'],
                        'error' => $file['error'],
                        'size' => $file['size']
                    );
        
                    $_FILES = array('upload'=>$newfile);
                    foreach($_FILES as $file => $array) {
                        $newupload = insert_attachment($file);
                    }
                }
            }

            if($post_id) {

                if(!empty($_POST['yacht_type'])&&isset($_POST['yacht_type'])&&is_array($_POST['yacht_type']))
                    wp_set_object_terms( $post_id, $_POST['yacht_type'], 'yacht_type' );
                
                    $_POST['price']=$_POST['price_p_h'];

                $acf_arr = array('capacity','boat_length','cabins','speed','captain','text','price_p_h','price_p_d','price');
                foreach($acf_arr as $acf) {
                    if(!isset($_POST[$acf])&&empty($_POST[$acf])) continue;
                    update_field($acf, $_POST[$acf], $post_id);
                }

                if($_POST['enquipment']) {

                }

                $data = array(
                    'update'=>true, 
                    'status' => '<p class="success">'.__('Successful','yachting').'</p>',
                    'fancybox' => '#send-ok',
                );

            } else {
                $data = array(
                    'update'=>false, 
                    'status' => '<p class="error">'.__('Failed','yachting').'</p>',
                );
            }
            
        } 

        if(empty($data))
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Unknow error','yachting').'</p>',
            );

        echo json_encode($data);
        
        wp_die();
    }


    public function ajax_booking()
    {

    
        if($_POST['date_from']&&$_POST['date_to']) {

            $user_id=(int)$_POST['user_id'];
            $date_from=date('Y-m-d',strtotime($_POST['date_from']));
            $date_to=date('Y-m-d',strtotime($_POST['date_to']));


            $title = [];
            $title[] = 'Booking: ';
            $title[] = $date_from.'/'.$date_to;
            $title[] = 'user('.$user_id.')';
            $title = implode(" ", $title);

            $post_data = array(
                'post_title'    => wp_strip_all_tags( $title ),
                'post_type' 	=> 'booking',
                'post_status'   => 'publish',
                'post_author'   => 1,
            );		

            $post_id = wp_insert_post( $post_data );

            if($post_id) {
                
                $acf_data=[
                    'user' => $user_id,
                    'date_from' => $date_from,
                    'date_to' => $date_to,
                ];
                if(!empty($acf_data))
                foreach($acf_data as $key => $value) {
                    if (!$value) continue;
                    update_field($key, $value, $post_id);
                }

                $data = array(
                    'update'=>true, 
                    'status' => '<p class="success">'.__('Successful booking','yachting').'</p>',
                );

            } else {
                $data = array(
                    'update'=>false, 
                    'status' => '<p class="error">'.__('Booking failed','yachting').'</p>',
                );
            }
            
        } else {
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Select date','yachting').'</p>',
            );
        }

        if(empty($data))
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Unknow error','yachting').'</p>',
            );

        echo json_encode($data);
        
        wp_die();
    }
    


    public function post_handler()
    {


        $output_html = '';
        $btn_html = '';
        $post_type = $_GET['post_type'];
		
        $paged = $_GET['page'] ? (int)$_GET['page'] : 1;

		$args = array(
			'post_type' => $post_type,
            'paged' => $paged,
        );

        if($_GET['orderby']=='price_asc') {
            $args['orderby']='meta_value_num';
            $args['meta_key']='price';
            $args['order']='asc';
        }
        if($_GET['orderby']=='price_desc') {
            $args['orderby']='meta_value_num';
            $args['meta_key']='price';
            $args['order']='desc';
        }

		if($_GET['posts_per_page']) $args['posts_per_page'] = (int)$_GET['posts_per_page'];
		if($_GET['post__in']) $args['post__in'] = $_GET['post__in'];
        if($_GET['s']) $args['s'] = $_GET['s'];
        
        $tax_query=[];
        $taxonomies=get_object_taxonomies($post_type)?:[];
        if($taxonomies)
        foreach($taxonomies as $taxonomy) {
            if(isset($_GET[$taxonomy])&&!empty($_GET[$taxonomy])){
                $tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'terms' => $_GET[$taxonomy],
                ];
            }
        }
        if(!empty($tax_query)) $args['tax_query']=$tax_query;

        $meta_query=[];
        $range_meta=['price','boat_length','berths','cabins','capacity'];
        if($range_meta);
        foreach($range_meta as $meta) {
            if(isset($_GET[$meta])&&!empty($_GET[$meta])){
                $meta_arr=explode(';',$_GET[$meta])?:[];            
                if(!empty($meta_arr))
                $meta_query[] = [
                    'key' => $meta,
                    'value' => array((int)$meta_arr[0], (int)$meta_arr[1]),
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                ];
            }
        }
        if(!empty($meta_query)) $args['meta_query']=$meta_query;

        // var_dump($args);
        
        $loop = new \WP_Query($args);
		if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) { $loop->the_post(); 
                $output_html .= template('partials.content-' . $post_type);
            }
            wp_reset_postdata(); 
        } else {
            $output_html .= template('partials.content-none');
        }

        if ($loop->max_num_pages>$paged):
            $new_page=$paged;
            $output_html .= sprintf('<div class="btn-wrap">
                <a href="#" data-page="%s" class="btn-default  btn-border load_more">%s</a>
            </div>',
            ++$new_page,
            __('Load more','yachting'));
        endif;

        $data = array(
            'update'=>true, 
            'output_html' => $output_html,
            'page' => $paged,
        );

        echo json_encode($data);

        wp_die();
    }


    public function ajax_registration()
    {

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-registration-nonce', 'security' );
    
        if($_POST['email']&&$_POST['password']) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role']?:'customer';
            $login = explode('@',$email)[0];
            $i=1;

            while (username_exists( $login )) {
                ++$i;
                $login = $login.$i;
            }

            $user = get_user_by('email', $email);

            
            if(empty($user)){

                $user_data = [
                    'user_login' => $login,
                    'user_pass'  => $password,
                    'user_email' => $email,
                    'role'  => $role,
                    'show_admin_bar_front' => false,
                ];
            
                $user_id = wp_insert_user($user_data);

                if($user_id) {

                    // $fields=['billing_phone','billing_first_name','billing_last_name','billing_email'];

                    // if($fields)
                    // foreach($fields as $field) {
                    //     if(!isset($_POST[$field])&&!empty($_POST[$field])) continue;
                    //     update_user_meta( $user_id, $field, $_POST[$field] );
                    // }

                    $data = array(
                        'update'=>true, 
                        'status' => '<p class="success">'.__('Registration completed successfully','yachting').'</p>',
                        'redirect' => get_home_url(  ),
                    );


                    if($user = get_user_by( 'id', $user_id )) {
                        wp_set_current_user( $user->ID );
                        wp_set_auth_cookie( $user->ID, true );
                        do_action( 'wp_login', $user->user_login, $user );
                    }

                    
                }
                
            } else {
                $data = array(
                    'update'=>false, 
                    'status' => '<p class="error">'.__('Email already registered','yachting').'</p>',
                );
            }
        } else {
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Email and password fields are required','yachting').'</p>',
            );
        }

        if(empty($data))
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Unknow error','yachting').'</p>',
            );

        echo json_encode($data);
        
        wp_die();
    }


    public function ajax_login()
    {

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-login-nonce', 'security' );
    
        // Nonce is checked, get the POST data and sign user on
        $email = $_POST['email'];
        $password = $_POST['password'];
        $auth = wp_authenticate( $email, $password );
    
        if ( is_wp_error( $auth ) ) {
            $data = array(
                'update' => false, 
                'status' => '<p class="error">'.__('Incorrect login or password','yachting').'</p>',
            );
        }
        else {
            wp_set_current_user( $auth->ID );
            wp_set_auth_cookie( $auth->ID, true );
            do_action( 'wp_login', $auth->user_login, $auth );
            $data = array(
                'update' => true, 
                'status' => '<p class="success">'.__('Please wait...','yachting').'</p>',
                'redirect' => get_home_url(),
            );
        }

        if(empty($data))
            $data = array(
                'update'=>false, 
                'status' => '<p class="error">'.__('Unknow error','yachting').'</p>',
            );

        echo json_encode($data);
        
        wp_die();
    }

}

new Ajax();