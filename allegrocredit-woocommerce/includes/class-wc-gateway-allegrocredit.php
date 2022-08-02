<?php
/**
 * Class WC_Allegro_Credit file.
 *
 * @package WooCommerce\Gateways
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * WC_Allegro_Credit Class.
 */
class WC_Allegro_Credit extends WC_Payment_Gateway
{

    /**
     * Constructor for the gateway.
     */
    public function __construct()
    {
        // Setup general properties.
        $this->setup_properties();

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        // Get settings.
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->instructions = $this->get_option('instructions');
        $this->min_order = $this->get_option('min_order');
        $this->max_order = $this->get_option('max_order');

        $this->keys = [
            'production_key' => $this->get_option('public_key_production'),
            'sandbox' =>  $this->get_option('sandbox'),
            'sandbox_key' =>  $this->get_option('public_key_sandbox')
        ];


        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
        add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);
        add_action( 'woocommerce_api_allegro', array( $this, 'webhook' ) );
        add_action( 'woocommerce_api_return_url', array( $this, 'return_url' ) );
        
        add_filter( 'woocommerce_available_payment_gateways',  array( $this, 'set_min_max_order' ));
        add_action('template_redirect', array( $this, 'order_message'));
        add_action('woocommerce_api_allegro_check', array( $this,'check_allegro_order'));
        //add_action('wp_ajax_check_allegro_order',  array( $this,'check_allegro_order'));
        add_action('wp_footer', array( $this, 'check_allegro_status'));


    }






    /**
     * Setup general properties for the gateway.
     */
    protected function setup_properties()
    {
        $this->id = 'allegrocredit';
        $this->icon = apply_filters('woocommerce_cod_icon', '');
        $this->method_title = 'AllegroCredit';
        $this->method_description = '';
        $this->has_fields = false;
    }

    /**
     * Get gateway icon.
     *
     * @return string
     */
    public function get_icon()
    {

            $icon_html = '<img src="' . plugin_dir_url(__DIR__) . 'assets/img/logo.svg' . '" alt="' . esc_attr__('AllegroCredit', 'woocommerce') . '" />';

        return apply_filters('woocommerce_gateway_icon', $icon_html, $this->id);
    }

    /**
     * Get gateway icon.
     *
     * @return string
     */
    public function get_description()
    {

        $html = '<div class="allegro_description">';
        $html .= '<img src="' . plugin_dir_url(__DIR__) . 'assets/img/icon.svg' . '" alt="' . esc_attr__('AllegroCredit', 'woocommerce') . '" />';
        $html .= '<p>After clicking “Place order”, you will be redirected to Allegro to complete your purchase securely.</p>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Initialise Gateway Settings Form Fields.
     */
    public function init_form_fields()
    {

        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'woocommerce'),
                'label' => 'Enable Allegro',
                'type' => 'checkbox',
                'description' => '',
                'default' => 'no',
            ),
            'title' => array(
                'title' => __('Title', 'woocommerce'),
                'type' => 'text',
                'description' => 'Allegro Credit',
                'default' => 'Allegro Credit',
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => __('Description', 'woocommerce'),
                'type' => 'textarea',
                'description' => '',
                'default' => 'From $87/m for 36 months',
                'desc_tip' => true,
            ),

            'public_key_production' => array(
                'title' => __('Production API key', 'woocommerce'),
                'type' => 'text',
                'description' => '',
                'default' => '',
                'desc_tip' => true,
                'placeholder' => '',
            ),
            'public_key_sandbox' => array(
                'title' => __('Sandbox API key', 'woocommerce'),
                'type' => 'text',
                'description' => '',
                'default' => '',
                'desc_tip' => true,
                'placeholder' => '',
            ),
            'sandbox' => array(
                'title' => __('Allegro Sandbox', 'woocommerce'),
                'label' => 'Allegro Sandbox',
                'type' => 'checkbox',
                'description' => '',
                'default' => 'no',
            ),
            'min_order' => array(
                'title' => __('Order minimum', 'woocommerce'),
                'type' => 'number',
                'description' => 'Set min amount for Allegro to appear at checkout.',
                'default' => '500',
                'desc_tip' => true,
                'placeholder' => '',
            ),
            'max_order' => array(
                'title' => __('Order maximum', 'woocommerce'),
                'type' => 'number',
                'description' => 'Set max amount for Allegro to appear at checkout.',
                'default' => '10000',
                'desc_tip' => true,
                'placeholder' => '',
            ),
            'logs' => array(
                'title' => __('View logs', 'woocommerce'),
                'type' => 'title',
                /* translators: %s: URL */
                'description' =>  '<a href="/wp-admin/edit.php?s&post_status=all&post_type=allegro_log&action=-1&m=0&source=api&filter_action=Filter&paged=1&action2=-1">API log</a> 
                <a href="/wp-admin/edit.php?s&post_status=all&post_type=allegro_log&action=-1&m=0&source=webhook&filter_action=Filter&paged=1&action2=-1">Webhook log</a>',
            ),


        );
    }


    /**
     * Process the payment and return the result.
     *
     * @param int $order_id Order ID.
     * @return array
     */
    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);

        require_once(__DIR__ . '/classes/AllegroCredit.php');
        $AllegroCredit = new Allegro($this->keys);

        $url = $AllegroCredit->application($order);

        return array(
            'result' => 'success',
            'redirect' => $url,
        );
    }




    /**
     * webhook
     *
     */

    public function webhook() {

        $json = file_get_contents('php://input');

        $data = json_decode($json);

        if ($order_id = $data->clientReference) {
            $order = wc_get_order($order_id);
            $notes = wp_list_pluck(wc_get_order_notes([ 'order_id' => $order_id]), 'content');
            update_post_meta($order_id, 'allegro_status', $data->status);


            if (!in_array($json, $notes)) {
                $order->add_order_note($json);
                require_once(__DIR__ . '/classes/AllegroCredit.php');
                $AllegroCredit = new Allegro($this->keys);

                $AllegroCredit->log(
                     ' - webhook - '   . PHP_EOL,
                    $json   , 'webhook'


                );

                $data = json_decode($json);
                $post_id = $AllegroCredit->allegro_log($order_id, 'webhook', '','webhook',  $data, '200');
                update_post_meta($post_id, 'allegro_id', $data->id);
                update_post_meta($post_id, 'order_id', $order_id    );
                update_post_meta($post_id, 'allegro_status', $data->status    );
                update_post_meta($post_id, 'descr', 'Webhook'   );
                update_post_meta($post_id, 'source', 'webhook'  );

            }

            if ($data->status === 'Approved & Signed') {
                $order->payment_complete();
                WC()->cart->empty_cart();
            }

            if ($data->status === 'Closed') {
                $order->update_status('wc-cancelled' );
            }

            if ($data->status === 'Return Approved') {
                $order->update_status('wc-refunded' );
            }

            $order->save();

            update_post_meta($post_id, 'order_status', $order->get_status()  );

        }






    }


    /**
     * return_url
     * 
     */


    public function return_url() {

        echo 'Processing.. PLease wait..';

        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $order = wc_get_order($order_id);
            $allegro_application_id = get_post_meta($order_id, 'allegro_application_id', 1);
            require_once(__DIR__ . '/classes/AllegroCredit.php');
            $AllegroCredit = new Allegro($this->keys);

            $data = $AllegroCredit->application_get(  $allegro_application_id  );

            $json = json_decode($data);

            $AllegroCredit->log(
                ' RETURN URL '   . PHP_EOL,
                $json

            );

            $url = wc_get_checkout_url() . '?order_id='. $order_id;
            if ($data->success) {

                switch ($data->status) {
                    case 'declined':
                        $order->update_status('wc-failed');
                        $url .= '&allegro_status_rejected=true';
                    break;

                    case 'pending':
                        $order->update_status('wc-on-hold' );
                        $url .= '&allegro_status_pending=true';
                    break;

                    case 'approved & signed':
                        $order->payment_complete();
                        WC()->cart->empty_cart();
                        $url = $order->get_checkout_order_received_url();
                    break;

                    default:
                        $url .= '&allegro_status_other=true';
                    break;
                }

            } else {
                $url .= '&allegro_status_other=true';
            }

            $order->save();
            wp_safe_redirect($url);


            die();
        }


    }

    /**
     * set_min_max_order
     *
     * @param $available_gateways
     * @return mixed
     */

    public function set_min_max_order( $available_gateways ) {

        if( is_admin() ) {
            return $available_gateways;
        }


        if( is_wc_endpoint_url( 'order-pay' ) ) { // Pay for order page

            $order_id = wc_get_order_id_by_order_key( $_GET[ 'key' ] );
            $order = wc_get_order( $order_id );
            $order_total = $order->get_total();

        } else {
            $order_total = WC()->cart->total;
        }

        if ( $order_total > $this->max_order || $order_total < $this->min_order) {
            unset( $available_gateways[ 'allegrocredit' ] ); // unset Cash on Delivery
        }

        return $available_gateways;

    }


    /**
     * order error message
     */



    public function order_message() {
        if ( is_checkout() && ! is_wc_endpoint_url() ) {

            if ( isset($_GET['allegro']) ) {
                if ( get_post_meta($_GET['order_id'], 'allegro_status', 1) == 'Approved') {
                    $order = wc_get_order($_GET['order_id']);
                    wp_safe_redirect($order->get_checkout_order_received_url());
                    die();
                }

                wc_add_notice( __('Checking approval status. Please wait..' ), 'notice' );
            }

            if ( isset($_GET['allegro_status_rejected']) ) {
                wc_add_notice( __('Unfortunately your Allegro Credit application was declined. Please try another payment method' ), 'error' );
            }

            if ( isset($_GET['allegro_status_other']) ) {
                wc_add_notice( __('Your Allegro application could not be processed at this time. Please try another payment method' ), 'error' );
            }

            if ( isset($_GET['allegro_status_pending']) ) {
                $order_id =  ($_GET['order_id']);
                $id = get_post_meta($order_id, 'allegro_application_id', 1);
                wc_add_notice( __('Your Allegro application is pending. Please call Allegro at 1-877-744-2290 during business hours to provide additional details or try another payment method. Your Allegro reference number is ' . $id ), 'error' );
            }

        }

        if ( is_checkout() && isset($_GET['key']) ) {
            $order_id = wc_get_order_id_by_order_key($_GET['key']);
            $status = get_post_meta($order_id, 'allegro_status', 1);
            if ($status === 'Rejected')
                wp_safe_redirect('/checkout?order_id=' . $order_id);
        }
    }

    public function check_allegro_status() {

        if ( is_checkout() && ! is_wc_endpoint_url() ) {

            if ( isset($_GET['allegro']) ) {
               ?>
                <script>
                    jQuery(document).ready(function($){
                        $('.woocommerce form').addClass( 'processing' ).block( {
                            message: null,
                            overlayCSS: {
                                background: '#fff',
                                opacity: 0.6
                            }
                        } );

                        setTimeout(function(){

                            setInterval(function(){

                                $.ajax({
                                    url: '/wc-api/allegro_check',
                                    data: {
                                        action: 'check_allegro_order',
                                        order_id: <?= $_GET['order_id'] ?>,
                                    },
                                    success: function (data) {
                                       // console.log(data)

                                        if (data.status == 'Rejected') {
                                            location.href = "<?=  wc_get_checkout_url() . '?order_id='. $_GET['order_id'] . '&allegro_status_rejected=true' ?>"
                                        }

                                        if (data.status == 'Pending') {
                                            location.href = "<?=  wc_get_checkout_url() . '?order_id='. $_GET['order_id'] . '&allegro_status_pending=true' ?>"
                                        }

                                        if (data.status !== 'Pending' && data.status !== 'Rejected') {
                                            location.href = "<?=  wc_get_checkout_url() . '?order_id='. $_GET['order_id'] . '&allegro_status_other=true' ?>"
                                        }

                                    }
                                })

                            }, 1000)

                        }, 1000)


                    })
                </script>
                <?php
            }
        }

    }





}
