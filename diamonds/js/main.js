jQuery(document).ready(function ($) {

    /**
     * login
     */

    $('.login-form').submit(function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            url: globals.url,
            data: data,
            type: 'POST',
            success: function(data){

                location.href = data.url

                $.fancybox.close();
            }
        })

    });


    
        if ( $(".register-form").length > 0)
            $(".register-form").validate({
                submitHandler: function(form) {

                    var data = $(".register-form").serialize();

                    $('.f-result').html('<i class="fab fab-spinner fab-spin"></i>')

                    $.ajax({
                        url: globals.url,
                        data: data,
                        type: 'POST',
                        success: function(data){

                            location.href = data.url;

                            $.fancybox.close();
                        }
                    })

                }
            });


    /**
    Filter

    */

    function filter(){

        $('.prod-wrap').animate({'opacity':0.6},300);

        var url =   $('#filter').attr('action');
        var query =   $('#filter').attr('action');
        newurl =  query;
        query = $('#filter').serialize()
        newurl = url + '?' + query;
        window.history.pushState({path:url },'?',newurl);

        $.ajax({
            type: "GET",
            url: globals.url,
            data : $('#filter').serialize(),

            success: function (data) {
             
                $('.prod-wrap').animate({'opacity': 1}, 300);
                
                $('.prod-wrap').html(data.content);
                $('.pagination').html(data.paginate);
              
            }
        });
        
    }


    $(document).on('change', '#filter', filter);

    $(document).on('change', '#sort', function(){

        var val = $(this).val();

        $('#sorting').val(val);

        filter();
    });


    /**
     * change shipping and payment methods
     */

    $(document).on('change', '#select-11', function(){
        var val = $(this).val();

        var inp = $('input.shipping_method[value="'+val+'"]');

        inp.trigger('click');
    })


    $(document).on('change', '#select-12', function(){
        var val = $(this).val();

        var inp = $('input.pay_method[value="'+val+'"]');

        inp.trigger('click');
    })


    /**
     * ajax cart qty upadte
     */

     $(document).on('change', '.woocommerce-cart-form input.qty', function(e){

        var val = $(this).val();
        var key = $(this).closest('.input-number').attr('data-key');


        var products = [];
         $('.content .item').each(function(){
           var product_id = $(this).find('input[name="product_id"]').val();
           var qty =  $(this).find('.qty').val();
           products.push([product_id,qty]);
         });



        $.ajax({
            type: "GET",
            url: woocommerce_params.ajax_url,
            data: {
                action : 'set_cart_item_qty',
                key:key,
                qty:val,
                products:products
            },

            success: function (data) {

                $('.cart-wrap>a>span').html(data.data.total)

                $( document.body ).trigger( 'wc_fragment_refresh' );

                $(document.body).trigger("update_checkout");

                ajax_mini_cart_update();
            }
        });
    });

    function ajax_mini_cart_update() {
        
        $.ajax({
            url:globals.url,
            data:{

                action:'update_mini_cart',
            },
            success:function(data){

                $('#cart .wrap').html(data);

            }
        })
    }



    $(document).on('change', '#cart input.qty', function(){

        var val = $(this).val();
        var key = $(this).closest('.input-number').attr('data-key');

        var products = [];
        $('.top .item').each(function(){
           var product_id = $(this).find('input[name="product_id"]').val();
           var qty =  $(this).find('.qty').val();
           products.push([product_id,qty]);
        });


        $.ajax({
            url: woocommerce_params.ajax_url,
            data:{
                products:products,
                action:'update_cart',
            },
            success:function(data){

                $( document.body ).trigger( 'wc_fragment_refresh' );

                $('.cart-block').html(data.content);
                $('.cart-wrap>a>span').html(data.total);

                ajax_mini_cart_update();

                $(document.body).trigger("update_checkout");

            }
        })

    })



    /*
    *
    Ajax Load Products
    */

    $(document).on('click', '#loadmore', function(e){

        event.preventDefault();

        $('.prod-wrap').animate({'opacity':0.6},300);
        $('#loadmore img').addClass('spin');

        var button = $( '#loadmore' ),
        paged = button.data( 'paged' ),
        maxPages = button.data( 'max_pages' );

        $.ajax({
            type : 'GET',
            url : globals.url,
            data : {
                paged : paged,
                action : 'loadmore'
            },
            success : function( data ){
 
                paged++;

                $('.prod-wrap').append( data );

                $('.prod-wrap').animate({'opacity':1},300);
                $('#loadmore img').removeClass('spin');
 
                if( paged == maxPages ) {
                    button.remove();
                }
 
            }
 
        });

    })

});