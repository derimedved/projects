jQuery(document).ready(function ($) {

 /* select*/
  $('select').niceSelect();

  /*top search*/
  $(document).on('click', '.second-line .search-wrap a', function (e){
    e.preventDefault();
    $('.top-search-form-wrap').toggleClass('is-open');
  });

  $(document).on('click', '.close-search', function (e){
    e.preventDefault();
    $('.top-search-form-wrap').removeClass('is-open');
  });

  /*slider*/
  var swiperProduct = new Swiper(".product-slider", {
    slidesPerView: 4,
    spaceBetween: 1,
    pagination: {
      el: ".product-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".product-next",
      prevEl: ".product-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      600: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
      1281: {
        slidesPerView: 4,
      },
    },
  });

  /*show/hide text*/
  $(document).on('click', '.show-text', function (e){
    e.preventDefault();
    $('.text-block .text-wrap').toggleClass('is-open');
  });

 /* OPEN CART*/
  $(document).on('click', '.cart-wrap a', function (e){
    e.preventDefault();
    $.fancybox.open( $('#cart'), {
      touch:false,
      autoFocus:false,
      beforeShow : function(e){
        $('html').addClass('is-bg');
      },
      afterClose: function (e){
        $('html').removeClass('is-bg');
      },
      afterShow : function(e){
        $('html').addClass('is-popup-right');
      },

    });
  });

  /*fancybox*/

  $(".inlogin, .login-open").fancybox({
    touch:false,
    autoFocus:false,
    afterShow : function(e){
      $('html').addClass('is-popup-right');
    },
    beforeShow : function(e){
      $('html').addClass('is-bg');
    },
    afterClose: function (e){
      $('html').removeClass('is-bg');
    },
  });

  $(document).on('click', '.login', function (e){
    e.preventDefault();
    $.fancybox.close();
    $.fancybox.open( $('#login'), {
      touch:false,
      autoFocus:false,
      afterShow : function(e){
        $('html').addClass('is-popup-right');
      },
      beforeShow : function(e){
        $('html').addClass('is-bg');
      },
      afterClose: function (e){
        $('html').removeClass('is-bg');
      },
    });
  });

  $(document).on('click', '.registration', function (e){
    e.preventDefault();
    $.fancybox.close();
    $.fancybox.open( $('#registration'), {
      touch:false,
      autoFocus:false,
      afterShow : function(e){
        $('html').addClass('is-popup-right');
      },
      beforeShow : function(e){
        $('html').addClass('is-bg');
      },
      afterClose: function (e){
        $('html').removeClass('is-bg');
      },
    });
  });

  /*mob menu*/
  $(".open-menu a").fancybox({
    touch:false,
    autoFocus:false,
    afterShow : function(e){
      $('html').addClass('is-popup-right');
    },
    beforeShow : function(e){
      $('html').addClass('is-bg');
    },
    afterClose: function (e){
      $('html').removeClass('is-bg');
    },
  });

  /*close popup*/
  $(document).on('click', '.close-popup', function (e){
    e.preventDefault();
    $('html').removeClass('is-popup-right');
    setTimeout(function() {
      $.fancybox.close();
      $('html').removeClass('is-bg');
    }, 500);
  });


  // $(document).on('click', '.del-item', function (e) {
  //   e.preventDefault();
  //   $(this).closest('.item').hide()
  // });


 /* input col product*/
  $(document).on('click', '.btn-count-plus', function () {
    var e = $(this).parent().find("input");
    return e.val(parseInt(e.val()) + 1), e.change(), !1
  });
  $(document).on('click', '.btn-count-minus', function () {
    var e = $(this).parent().find("input"), t = parseInt(e.val()) - 1;
    return t = t < 1 ? 1 : t, e.val(t), e.change(), !1
  });


  /*show password*/
  $(document).on('click', '.show-pas', function (e) {
    e.preventDefault();
    if($(this).hasClass('is-show')){
      $('.show-pas').removeClass('is-show');
      $(this).siblings('input').attr("type", "password");
    }else{
      $('.show-pas').addClass('is-show');
      $(this).siblings('input').attr("type", "text");
    }

  });

//RANGE

  // var $range = $(".js-range-slider"),
  //   $from = $(".js-from"),
  //   $to = $(".js-to"),
  //   range,
  //   min = 0,
  //   max = 256000,
  //   from,
  //   to;

  // var updateValues = function () {
  //   $from.prop("value", from);
  //   $to.prop("value", to);
  // };

  // $range.ionRangeSlider({
  //   type: "double",
  //   min: min,
  //   max: max,
  //   /*hide_min_max: true,
  //   hide_from_to: true,*/
  //   skin: "round",
  //   /*prettify_enabled: false,*/
  //   prettify: function(num) {
  //     var tmp_min = min,
  //       tmp_max = max,
  //       tmp_num = num;

  //     if (min < 0) {
  //       tmp_min = 0;
  //       tmp_max = max - min;
  //       tmp_num = num - min;
  //       tmp_num = tmp_max - tmp_num;
  //       return tmp_num + min;
  //     } else {
  //       num = max - num;
  //       return num;
  //     }
  //   },
  //   onChange: function (data) {
  //     from = max - data.from ;
  //     to = max - data.to;
  //     updateValues();

  //   }
  // });

  // range = $range.data("ionRangeSlider");

  // var updateRange = function () {
  //   range.update({
  //     from: max - from,
  //     to: max - to
  //   });

  // };

  // $from.on("change", function () {
  //   from = +$(this).prop("value");
  //   if (from < min) {
  //     from = min;
  //   }
  //   if (from > to) {
  //     from = to;
  //   }

  //   updateValues();
  //   updateRange();
  // });

  // $to.on("change", function () {
  //   to = +$(this).prop("value");
  //   if (to > max) {
  //     to = max;
  //   }
  //   if (to < from) {
  //     to = from;
  //   }

  //   updateValues();
  //   updateRange();
  // });

  /*show hide filter*/
  $(document).on('click', '.filter-wrap .item-filter h6', function (e){
    e.preventDefault();
    $(this).closest('.item-filter').toggleClass('is-open');
    if($(this).closest('.item-filter').hasClass('is-open')){
      $(this).closest('.item-filter').find(".filter").slideDown();
    }else{
      $(this).closest('.item-filter').find(".filter").slideUp();
    }
  });

  $(document).on('click', '.filter-btn a', function (e){
    e.preventDefault();
    $('.filter-wrap').toggleClass('is-open')
  });



  $(document).on('click', '.text-menu a', function (e){
    e.preventDefault();
    $('.sub-menu-wrap').toggleClass('is-open')
  });

  /*slider*/
  var swiperSmall = new Swiper(".slider-small", {
    spaceBetween: 20,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    direction: "vertical",
  });
  var swiperBig = new Swiper(".slider-big", {
    spaceBetween: 10,
    thumbs: {
      swiper: swiperSmall,
    },
  });

  var swiperImg = new Swiper(".img-slider", {
    slidesPerView: 1,
    navigation: {
      nextEl: ".img-next",
      prevEl: ".img-prev",
    },
    pagination: {
      el: ".img-pagination",
      clickable: true,
    },
    keyboard: true,
  });

 /* accordion*/
  $(function() {
    $(".accordion > .accordion-item.is-active").children(".accordion-panel").slideDown();
    $(document).on('click', '.accordion > .accordion-item .accordion-thumb', function (e){
      $(this).parent('.accordion-item').siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
      $(this).parent('.accordion-item').toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
    })
  });

  /* animation*/
  AOS.init({
    disable: 'mobile',
  });

  $(document).on('click', '.menu-responsive .content-menu ul li span', function (e){
    e.preventDefault();
    $(this).closest('li').toggleClass('is-open');
    if($(this).closest('li').hasClass('is-open')){
      $(this).closest('li').find('ul').slideDown();
    }else{
      $(this).closest('li').find('ul').slideUp();
    }
  })
  
});

  