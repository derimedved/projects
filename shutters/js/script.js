jQuery(document).ready(function ($) {
  $( function() {
    var availableTags = [
      "ACT",
      "NSW",
      "NT",
      "QLD",
      "SA",
      "TAS",
      "VIC",
      "WA",

    ];
    $( "#state" ).autocomplete({
      source: availableTags
    });
  } );


 if(window.innerWidth > 1199 && $('.discover').length){

   if($('.discover .bottom .item').length > 6){
     let sections = gsap.utils.toArray(".discover .bottom .item");

     gsap.to(sections, {
       xPercent: -100 * (sections.length - 5),
       ease: "none",
       scrollTrigger: {
         trigger: ".discover .bottom",
         pin: true,
         scrub: 1,
         snap: 1 / (sections.length - 1),
         // base vertical scrolling on how wide the container is so it feels more natural.
         end: () => "+=" + document.querySelector(".discover .bottom").offsetWidth
       }
     });
   }else{
     $('.discover .btn-wrap').hide();
   }

 }

  $('.top-line .right .tel-wrap a b, .contact .item p.tel a b').mask("0000 000 000");
  $('footer .footer-menu-wrap ul li.tel a b').mask("0000 000 000");
  $('.default-form input.tel').mask("0000 000 000");

/*  $(document).on('click', '.input-wrap-next a', function (e){
    e.preventDefault();
    $('.popup-site .step-1').hide();
    $('.popup-site .step-2').show();
  })*/

  $('select').niceSelect();

  $(".top-line").sticky({
    topSpacing:0
  });

  $(".domestic-head  .st, .service-internal-head .st").sticky({
    topSpacing:120
  });



  $(document).on('click', '.top-line .search-btn a', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    $('.search-wrap').toggleClass('is-active');
    $('.top-menu li.sub').removeClass('is-active');
    $('.sub-menu-wrap').removeClass('is-active');
    $('.menu-responsive').removeClass('is-active');
    $('.top-line .btn-menu a').removeClass('is-active');
    $('.top-line .right .product-wrap a').removeClass('is-active');
  });

  //.top-menu li.sub a

  $(document).on('mouseenter', '.top-menu ul li a', function (e){
    let item = $(this).parent('li'),
      itemIndex = $(this).parent('li').index() + 1,
      itemActive = itemIndex + 1;

    if(itemIndex !== 2){

      if(item.hasClass('is-active')){
        $('.sub-menu-wrap').removeClass('is-active');
        $('.top-menu ul li').removeClass('is-active');
        $(".sub-menu-wrap .sub-menu").removeClass('is-active');
      }else{
        $('.sub-menu-wrap').removeClass('is-active');
        $('.top-menu ul li').removeClass('is-active');
        $(".sub-menu-wrap .sub-menu").removeClass('is-active');
        $('.sub-menu-wrap').addClass('is-active');
        $(this).parent('li').addClass('is-active');
        $(".sub-menu-wrap .sub-menu:nth-child(" + itemActive + ")").addClass('is-active');
      }
    }else{
      $('.sub-menu-wrap').removeClass('is-active');
      $('.top-menu ul li').removeClass('is-active');
      $(".sub-menu-wrap .sub-menu").removeClass('is-active');
    }


    $('.top-line .search-btn a').removeClass('is-active');
    $('.search-wrap').removeClass('is-active');
    $('.menu-responsive').removeClass('is-active');
    $('.top-line .btn-menu a').removeClass('is-active');
  });

  $(document).on('mouseenter', '.sub-menu-wrap', function (e){
    e.stopPropagation();
  })

  $(document).on('mouseleave', '.sub-menu-wrap', function (e){
    $('.sub-menu-wrap').removeClass('is-active');
    $('.top-menu ul li').removeClass('is-active');
    $(".sub-menu-wrap .sub-menu").removeClass('is-active');
  });

/*  $(document).on('click', '.top-line .right .product-wrap a', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    $('.sub-menu-wrap').toggleClass('is-active');
    $('.top-line .search-btn a').removeClass('is-active');
    $('.search-wrap').removeClass('is-active');
    $('.menu-responsive').removeClass('is-active');
    $('.top-line .btn-menu a').removeClass('is-active');
  })*/

  $(document).on('click', '.domestic-head .bottom .btn-default', function (e){
    e.preventDefault();

    $.fancybox.open( $('#popup-gallery'), {
      touch: false,
      autoFocus:false,
    });
  })


  var swiperImg = new Swiper(".slider-img", {
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,

    breakpoints: {
      320: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      600: {
        slidesPerView: 4,
        spaceBetween: 20,
      },

      960: {
        slidesPerView: 6,
        spaceBetween: 20,
      },
      1300: {
        slidesPerView: 6,
        spaceBetween: 30,
      },

    },
  });
  var swiperImg2 = new Swiper(".slider-img-2", {
    spaceBetween: 10,
    pagination: {
      el: ".img-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".img-next",
      prevEl: ".img-prev",
    },
    thumbs: {
      swiper: swiperImg,
    },
  });

  $(".top-line .right .product-wrap a").fancybox({
    touch:false,
    autoFocus:false,
    animationDuration : 600,
    animationEffect   : 'slide-in-out'
  });

  $(document).on('click', '.top-line .btn-menu a', function (e){
    e.preventDefault();
   if(window.innerWidth > 767){
     $(this).toggleClass('is-active');
   }
    $('.menu-responsive').toggleClass('is-active');
    $('.top-menu li.sub').removeClass('is-active');
    $('.sub-menu-wrap').removeClass('is-active');
    $('.top-line .search-btn a').removeClass('is-active');
    $('.search-wrap').removeClass('is-active');
    $('.top-line .right .product-wrap a').removeClass('is-active');
  });

  $(document).on('click', '.close-sub-menu', function (e){
    e.preventDefault();
    $('.sub-menu-wrap').removeClass('is-active');
  });

  $(document).on('click', '.close-responsive', function (e){
    e.preventDefault();
    $('.menu-responsive').removeClass('is-active');
  });

  var swiperHomeTop = new Swiper(".home-top-slider", {
    loop:true,
    pagination: {
      el: ".home-top-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".home-top-next",
      prevEl: ".home-top-prev",
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
  });

  var swiperWhy = new Swiper(".why-slider", {
    loop:true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  var swiperPromotion = new Swiper(".promotion-slider", {
    slidesPerView: 1.41,
    loop:true,
    spaceBetween: 30,
    pagination: {
      el: ".promotion-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".promotion-next",
      prevEl: ".promotion-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      361: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      601: {
        slidesPerView: 1.16,
        spaceBetween: 20,
      },
      961: {
        slidesPerView: 1.16,
        spaceBetween: 20,
      },
      1201: {
        slidesPerView: 1.41,
        spaceBetween: 30,
      },
    },
  });

  $(function() {
    $(".accordion > .accordion-item.is-active").children(".accordion-panel").slideDown();
    $(".accordion > .accordion-item .accordion-thumb").click(function() {
      $(this).parent('.accordion-item').siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
      $(this).parent('.accordion-item').toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
    });
  });

  $(function() {
    $(".accordion-menu > .accordion-item.is-active").children(".accordion-panel").slideDown();
    $(".accordion-menu > .accordion-item .accordion-thumb .open").click(function() {
      $(this).closest('.accordion-item').siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
      $(this).closest('.accordion-item').toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
    });
  });

  $(".fancybox").fancybox({
    touch:false,
    autoFocus:false,

    afterShow : function(e){
      $('.popup-quote .default-form').validate({
        rules: {
          text814: {
            minlength: 2,
            required: true,
          },
          text815: {
            minlength: 2,
            required: true,
          },
          email764: {
            minlength: 5,
            required: true,
          },
          text816:{
            minlength: 9,
            required: true,
          },
          text817:{
            minlength: 5,
            required: true,
          },
          text818:{
            minlength: 3,
            required: true,
          },
          text819:{
            minlength: 3,
            required: true,
          },
          text820:{
            minlength: 3,
            required: true,
          },
          text821:{
            minlength: 3,
            required: true,
          },
        },
        messages: {
          text814: {
            required: "Please enter your first name",
          },
          text815: {
            required: "Please enter your last name",
          },
          email764: {
            required: "Please enter your email",
          },
          text816: {
            required: "Please enter your phone",
          },
          text817: {
            required: "Please enter your phone",
          },
          text818: {
            required: "Please enter Suburb",
          },
          text819: {
            required: "Please enter your State",
          },
          text820: {
            required: "Please enter your Postcode",
          },
          text821: {
            required: "Please enter your Message",
          },
        }
      });




    },
  });



  function initialize() {
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setComponentRestrictions({'country': ['aus']});
  }

  google.maps.event.addDomListener(window, 'load', initialize);



  (function($){
    jQuery.fn.lightTabs = function(options){

      var createTabs = function(){
        tabs = this;
        i = 0;

        showPage = function(i){
          $(tabs).find(".tab-content").children("div").hide();
          $(tabs).find(".tab-content").children("div").eq(i).show();
          $(tabs).find(".tabs-menu").children("li").removeClass("is-active");
          $(tabs).find(".tabs-menu").children("li").eq(i).addClass("is-active");
        }

        showPage(0);

        $(tabs).find(".tabs-menu").children("li").each(function(index, element){
          $(element).attr("data-page", i);
          i++;
        });

        $(tabs).find(".tabs-menu").children("li").click(function(){
          showPage(parseInt($(this).attr("data-page")));
        });
      };
      return this.each(createTabs);
    };
  })(jQuery);
  $(".tabs").lightTabs();

  $(".tab-content .item .text-wrap .wrap").niceScroll({
    cursoropacitymin: 1,
    cursorwidth: "2px",
    cursorcolor: "#cf3339",
    cursorborder: "0 solid #fff", // css definition for cursor border
  });



  $(window).on('load', function (e){
    $('.preloader img').hide(500);
    var setTime = setTimeout(function() {
      $('.preloader').addClass('is-load');
    }, 600);

  });

  var rellax = new Rellax('.rellax');

  $(document).on('click', '.insights .nice-select .option', function (e){
    let item = $(this).index() + 1;
    console.log(item)
    $('.insights .wrap').removeClass('is-active');
    $('.insights .wrap:nth-child(' + item + ')').addClass('is-active');

  });

  $(window).on('load', function (e){
    $('.insights .wrap:nth-child(1)').addClass('is-active');
  });

  $(document).on('click', '.discover .btn-wrap a', function (e) {
    e.preventDefault();
    var id  = $(this).attr('href'),
      top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
  });

  $('.fancybox-container .popup-quote .default-form').validate({
    rules: {
      text814: {
        minlength: 2,
        required: true,
      },
      text815: {
        minlength: 2,
        required: true,
      },
      email764: {
        minlength: 5,
        required: true,
      },
      text816:{
        minlength: 9,
        required: true,
      },
      text817:{
        minlength: 5,
        required: true,
      },
      text818:{
        minlength: 3,
        required: true,
      },
      text819:{
        minlength: 3,
        required: true,
      },
      text820:{
        minlength: 3,
        required: true,
      },
      text821:{
        minlength: 3,
        required: true,
      },
    },
    messages: {
      text814: {
        required: "Please enter your first name",
      },
      text815: {
        required: "Please enter your last name",
      },
      email764: {
        required: "Please enter your email",
      },
      text816: {
        required: "Please enter your phone",
      },
      text817: {
        required: "Please enter your phone",
      },
      text818: {
        required: "Please enter Suburb",
      },
      text819: {
        required: "Please enter your State",
      },
      text820: {
        required: "Please enter your Postcode",
      },
      text821: {
        required: "Please enter your Message",
      },
    }
  });

  $('.contact .popup-quote .default-form').validate({
    rules: {
      text814: {
        minlength: 2,
        required: true,
      },
      text815: {
        minlength: 2,
        required: true,
      },
      email764: {
        minlength: 5,
        required: true,
      },
      text816:{
        minlength: 9,
        required: true,
      },
      text817:{
        minlength: 5,
        required: true,
      },
      text818:{
        minlength: 3,
        required: true,
      },
      text819:{
        minlength: 3,
        required: true,
      },
      text820:{
        minlength: 3,
        required: true,
      },
      text821:{
        minlength: 3,
        required: true,
      },
    },
    messages: {
      text814: {
        required: "Please enter your first name",
      },
      text815: {
        required: "Please enter your last name",
      },
      email764: {
        required: "Please enter your email",
      },
      text816: {
        required: "Please enter your phone",
      },
      text817: {
        required: "Please enter your phone",
      },
      text818: {
        required: "Please enter Suburb",
      },
      text819: {
        required: "Please enter your State",
      },
      text820: {
        required: "Please enter your Postcode",
      },
      text821: {
        required: "Please enter your Message",
      },
    }
  });

  function init() {
    var input = document.getElementById('address1');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setComponentRestrictions({'country': ['aus']});
  }

  google.maps.event.addDomListener(window, 'load', init);

  $(document).on('click', '.fancybox-container .popup-site .step-1 .input-wrap-next a.btn-next', function (e){

    init();

    if($(".fancybox-container .popup-quote .step-1 input").valid()){
      e.preventDefault()

      $('.fancybox-container .popup-site .step-1').hide();
      $('.fancybox-container .popup-site .step-2').show();
    }else{

      e.preventDefault();

    }

  });

  $(document).on('click', '.contact .step-1 .input-wrap-next a.btn-next', function (e){

    if($(".contact .step-1 input").valid()){
      e.preventDefault()
      $('.contact .step-1').hide();
      $('.contact .step-2').show();
    }else{

      e.preventDefault();
    }

  });

  $(document).on('click', '.input-wrap-next .btn-prev', function (e){
    e.preventDefault();
    $('.popup-site .step-1').show();
    $('.popup-site .step-2').hide();
  });

  $('.breadcrumb li:last-child').Cuttr({

    truncate: 'characters',
    length: 35
  });


});

