jQuery(document).ready(function ($) {


    
     // standard ajax process
    function yachtingAjax(submitData,onSuccess,container=null,action='GET') {
        $.ajax({
            type: action,
            url: window.global.url,
            data: submitData,
            dataType: 'json',
            beforeSend: function (response) {
                // Add loader
                if(container) container.addClass('loading');
            },
            complete: function(response) {
                if(container) container.removeClass('loading');
            },
            success: onSuccess
        });
    }


    // // collects form data
    function getFilteringData(className='.filter_form') {
        if($(className).length<1) return;

        var serializeArray=Array();
        if($(className).length>1) {
            $(className).each(function() {
                serializeArray=serializeArray.concat($(this).serializeArray());
            });
        } else {
            serializeArray=$(className).serializeArray();
        }

        return serializeArray;
    }

    function submitFilteringData(additionalArgs=null) {
        var serialize = getFilteringData();
        if(additionalArgs) serialize.push(additionalArgs);
        if(serialize) {
            var container = $('.output_wrap');
            var submitData = serialize,
            onSuccess = function(data) {
                    if (data.update == true) {
                        if(data.output_html) {
                            if($('.btn-wrap').length)$('.btn-wrap').remove();
                            if(data.page>1) {
                                container.append(data.output_html)
                            } else {
                                container.html(data.output_html)
                            }
                            if($(".img-slider:not(already-init)").length) {
                                $(".img-slider:not(already-init)").owlCarousel({
                                    items: 1,
                                    nav: true,
                                    dots: true,
                                    loop: true,
                                    mouseDrag: false,
                                    touchDrag: false,
                                });
                                $(".img-slider:not(already-init)").addClass('already-init');

                            }
                        } 
                        
                        // if(data.redirect) window.location.href = data.redirect;
                    }
                };
            yachtingAjax(submitData, onSuccess, container);
        }
    }

    // filtering yacht
    $('.filter_form').on('submit',function(e){
        e.preventDefault();
        submitFilteringData();
    });
    $('input').on('filtering',function(){
        if($('.filter_form').length)
        submitFilteringData();
    });
    $('.checkbox').on('change','input',function(e){
        submitFilteringData();
    });
    $('.filter_form').on('change','select',function(e){
        e.preventDefault();
        submitFilteringData();
    });
    // auto search by key
    if (window.location.href.indexOf("capacity") > -1 && $('.filter_form').length) {
        submitFilteringData();
    }
    $(document).on('click','.remove_search_item',function(e){
        e.preventDefault();
        $(this).closest('.item').remove();
        submitFilteringData();
    });

    

    // ajax load more
    $(document).on('click','.load_more',function(e){
        e.preventDefault();
        var page = $(this).data('page');
        if(page&&$('.filter_form').length) submitFilteringData({
            name: 'page',
            value: page,
        });
        
    });


    $(document).on('submit', '.ajax_form', function(e) {
        e.preventDefault();
        var data = $(this).serializeArray(),
            container = $(this);
        

        var submitData = data,
            onSuccess = function(data) {
                if(data.status) container.find('.status').html(data.status);
                if (data.update == false) {
                }
                if (data.update == true) {
                    if(data.redirect) window.location.href = data.redirect;
                }
            };
            yachtingAjax(submitData, onSuccess, container, 'POST');
    });



    // booking
    $('.ajax_form').on('click','.book',function(e){
        e.preventDefault();
        var form = $(this).closest('form'),
            inputs = form.find('input'),
            allowed = true;
            inputs.each(function(index,el){
                var val = $(el).val();
                if(!val) {
                    allowed=false;
                    $(el).css('border-color','#e96387');
                } else {
                    $(el).css('border-color','#bfbfbf');
                }
            });
        if(allowed&&$('#confirm-order').length) {
            $('#confirm-order').find('.cost').html(form.find('.cost').html());
            var dateStr = $(inputs[0]).val()+' - '+$(inputs[1]).val();
            if(dateStr) $('#confirm-order .date span').text(dateStr);
            $.fancybox.open( $('#confirm-order'), {
                touch: false
            });
            $('#confirm-order').on('click','.btn-default',function(e){
                e.preventDefault();
                $.fancybox.close();
                form.submit();
                $('#confirm-order').unbind('click');
            });
        }
        
    })
    
    
});



