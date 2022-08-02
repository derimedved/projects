<?php
/**
 * Liqpay Payment Module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category        LiqPay
 * @package         liqpay/liqpay
 * @version         3.0
 * @author          Liqpay
 * @copyright       Copyright (c) 2014 Liqpay
 * @license         http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 *
 * EXTENSION INFORMATION
 *
 * LIQPAY API       https://www.liqpay.ua/documentation/en
 *
 */

/**
 * Payment method liqpay process
 *
 * @author      Liqpay <support@liqpay.ua>
 */

class Allegro {


    private $url = "https://api.allegrocredittest.com/api/v1/";
    public function __construct($keys)
    {
        $this->sandbox = $keys['sandbox'];
        $this->key = $keys['production_key'] ?? '';
        if ($keys['sandbox'] ) {
            $this->key = $keys['sandbox_key'];
        }


    }


    private function get($endpoint) {
        $url = $this->url . $endpoint;
        $key = $this->key;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $headers = array(
            "Accept: */*",
            "Content-type: application/json",
            "Authorization: $key",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->log(
            $httpcode.' - '.__FUNCTION__ . ' - endpoint - ' . $endpoint . PHP_EOL,
            'REQUEST ' . $url . PHP_EOL .
            'RESPONSE ' . json_encode($resp) . PHP_EOL

        );
        $resp = json_decode($resp);
        $post_id = $this->allegro_log('', $endpoint, 'GET', $url, $resp, $httpcode);


        $order_id = $this->get_order_id($resp->id);
        $order = wc_get_order($order_id);
        $order_status = $order->get_status();
        update_post_meta($post_id, 'descr', 'Update Application status'   );
        update_post_meta($post_id, 'allegro_id', $resp->id);
        update_post_meta($post_id, 'allegro_status', $resp->status    );
        update_post_meta($post_id, 'order_id', $order_id);
        update_post_meta($post_id, 'order_status', $order_status  );
        update_post_meta($post_id, 'code', $httpcode   );
        update_post_meta($post_id, 'source', 'api'  );


        return $resp;
    }

    private function post($endpoint, $body) {
        $url = $this->url . $endpoint;
        $key = $this->key;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $headers = array(
            "Accept: */*",
            "Content-type: application/json",
            "Authorization: $key",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        $this->log(
            $httpcode.' - '.__FUNCTION__ . ' - endpoint - ' . $endpoint . PHP_EOL,
            'REQUEST ' . json_encode($body) . PHP_EOL .
            'RESPONSE ' . json_encode($resp) . PHP_EOL

        );


        $resp = json_decode($resp);

        switch ($endpoint) {

            case 'application/':
                $order_id = $body['clientReference'];
                $order = wc_get_order($order_id);
                $order_status = $order->get_status();
                $post_id = $this->allegro_log($order_id, $endpoint, 'POST', $body, $resp, $httpcode);
                update_post_meta($post_id, 'allegro_id', $resp->id);
                update_post_meta($post_id, 'order_id', $order_id    );
                update_post_meta($post_id, 'allegro_status', $resp->status    );
                update_post_meta($post_id, 'code', $httpcode   );
                update_post_meta($post_id, 'descr', 'Create Application'   );
                update_post_meta($post_id, 'order_status', $order_status  );
                update_post_meta($post_id, 'source', 'api'  );
            break;

            case 'cart':
                $order_id = $this->get_order_id($resp->applicationId);
                $order = wc_get_order($order_id);
                $order_status = $order->get_status();
                $post_id = $this->allegro_log($order_id, $endpoint, 'POST', $body, $resp, $httpcode);
                update_post_meta($post_id, 'order_id', $order_id);
                update_post_meta($post_id, 'order_status', $order_status  );
                update_post_meta($post_id, 'allegro_id', $resp->applicationId);
                update_post_meta($post_id, 'descr', 'Post cart to application');
                update_post_meta($post_id, 'code', $httpcode   );
                update_post_meta($post_id, 'source', 'api'  );
            break;
        }





        return   $resp;
    }

    private function put($endpoint, $body) {
        $url = $this->url . $endpoint;
        $key = $this->key;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);



        $headers = array(
            "Accept: */*",
            "Content-type: application/json",
            "Authorization: $key",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->log(
            $httpcode.' - '.__FUNCTION__ . ' - endpoint - ' . $endpoint . PHP_EOL,
            'REQUEST' . json_encode($body) . PHP_EOL .
            'RESPONSE' . json_encode($resp) . PHP_EOL

            );


        return json_decode($resp);
    }

    public function application($order, $id='', $body = [])
    {

        $this->retailer_put();

        $endpoint = 'application/' . $id;

        if (empty($body))
            $body = [
               'clientReference' => $order->get_id(),
                'first' => $order->get_billing_first_name(),
                "last" => $order->get_billing_last_name(),
                "email" => $order->get_billing_email(),
                "phones" => [
                    [
                        "number" => $order->get_billing_phone(),
                        "type" => "home"
                    ]
                ],
                'agreeToTerms' => true,
                'physicalAddress' => [
                    'address1' => $order->get_billing_address_1(),
                    'city' =>  $order->get_billing_city(),
                    'state' => $order->get_billing_state(),
                    'zip'  => $order->get_billing_postcode(),
                ],

                'returnUrl' => home_url(). "/wc-api/return_url?order_id=" . $order->get_id(),
                'prequalify' => true,
            ];

        $resp = $this->post($endpoint, $body) ;

        $id = $resp->id;

        update_post_meta($order->get_id(), 'allegro_application_id', $id);

        $this->cart($id, $order);

        return $resp->links->cart;



    }

    public function application_get( $id='')
    {

        $endpoint = 'application/' . $id;

        $resp = $this->get($endpoint);

        return $resp;


    }

    public function retailer()
    {
        $endpoint = 'retailer';

        $resp = $this->get($endpoint);

    }


    public function retailer_put( $body = [])
    {
        $endpoint = 'retailer';
        $body = [

            "webhooks" => [
                "status" => [
                     "type" => "status",
                     "url" => home_url(). "/wc-api/allegro"
                ],
            ],

            'return_url' => [
                'signed' => 1,
                'declined' =>  1,
                'contact'  => 1,
            ]


        ];

        $resp = $this->put($endpoint, $body);


    }


    public function cart($id, $order)
    {
        $endpoint = 'cart';

        foreach ($order->get_items() as $item_id =>$item) {
            $product_id = $item->get_product_id();
            $product = wc_get_product($product_id);

            $products[] = [
                'type' => $product->get_title(),
                'price' => $product->get_price()
            ];

        }

        $body = [
            
            "applicationId" => $id,
            'products' => $products
            
        ];

        $resp = $this->post($endpoint, $body);

    }


    /**
     * Logs action
     *
     * @param string $context context.
     * @param string $message message.
     *
     * @return void
     */
    public function log( $context, $message, $type='api' ) {

        if ( empty( $this->log ) ) {
            $this->log = new WC_Logger();
        }

        $this->log->add(
            'woocommerce-gateway-allegro-' . $type ,
            $context . ' - ' . $message
        );

    }


    public function allegro_log( $order_id, $endpoint, $type, $body=[], $resp='', $code='' ) {


        ob_start();
        echo '<pre>';
        echo $type. ' ' . $endpoint . '<br>';
        print_r(json_encode($body, JSON_PRETTY_PRINT)) . '<br>';
        echo '<br>Response: <br>';
        print_r(json_encode($resp, JSON_PRETTY_PRINT));
        echo '</pre>';
        $content = ob_get_contents();

        $post_id = wp_insert_post([
            'post_type' => 'allegro_log',
            'post_status' => 'publish',
            'post_title' => $type. ' - ' . $endpoint . ' - ' . $order_id . ' - ' . $code,
            'post_content' => $content
        ]);


        update_post_meta($post_id, 'api_url', $this->url);
        update_post_meta($post_id, 'sandbox', $this->sandbox);

        return $post_id;

    }

    public function get_order_id($application_id) {
        $q = new WP_Query([
            'post_type' => 'shop_order',
            'post_status' => 'any',
            'meta_key' => 'allegro_application_id',
            'meta_value' => $application_id
        ]);


        return $q->posts[0]->ID;
    }




}


 