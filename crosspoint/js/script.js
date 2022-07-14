jQuery(document).ready(function ($) {

  /*close line*/
  $(document).on('click', '.close-line', function (e){
    e.preventDefault();
    $('.line-info').slideUp();
  });

  $('.text-wrap blockquote').Cuttr({
    //options here
    truncate: 'words',
    length: 12,
    readMore: true,
    readMoreText: 'Read more',
    readMoreBtnTag: 'a',
    readLessText: 'Read less'
  });

 /* sticky heade*/
  $(".top-line").sticky({
    topSpacing:0
  });

 /* slider*/
  var swiperLogo1 = new Swiper(".logo-slider-1", {
    pagination: {
      el: ".logo-slider-pagination-1",
      clickable: true,
    },
    navigation: {
      nextEl: ".logo-slider-next-1",
      prevEl: ".logo-slider-prev-1",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 1,
      },
      575: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });

  var swiperLogo2 = new Swiper(".logo-slider-2", {
    pagination: {
      el: ".logo-slider-pagination-2",
      clickable: true,
    },
    navigation: {
      nextEl: ".logo-slider-next-2",
      prevEl: ".logo-slider-prev-2",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 1,
      },
      575: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });

  var swiperImg1 = new Swiper(".img-slider-1", {
    pagination: {
      el: ".img-pagination-1",
      clickable: true,
    },
    navigation: {
      nextEl: ".img-next-1",
      prevEl: ".img-prev-1",
    },
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
  });

  var swiperImg2 = new Swiper(".img-slider-2", {
    pagination: {
      el: ".img-pagination-2",
      clickable: true,
    },
    navigation: {
      nextEl: ".img-next-2",
      prevEl: ".img-prev-2",
    },
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
  });

  var swiperImg3 = new Swiper(".img-slider-3", {
    pagination: {
      el: ".img-pagination-3",
      clickable: true,
    },
    navigation: {
      nextEl: ".img-next-3",
      prevEl: ".img-prev-3",
    },

  });

  var swiperImg4 = new Swiper(".img-slider-4", {
    pagination: {
      el: ".img-pagination-4",
      clickable: true,
    },
    navigation: {
      nextEl: ".img-next-4",
      prevEl: ".img-prev-4",
    },
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    loop:true,
  });

  var swiperTeam = new Swiper(".team-slider", {
    pagination: {
      el: ".logo-slider-pagination-2",
      clickable: true,
    },
    navigation: {
      nextEl: ".logo-slider-next-2",
      prevEl: ".logo-slider-prev-2",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      575: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    },
  });

  var swiperServices = new Swiper(".services-slider", {
    pagination: {
      el: ".services-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".services-next",
      prevEl: ".services-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      575: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });

  var swiperTreat = new Swiper(".treat-slider", {
    pagination: {
      el: ".treat-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".treat-next",
      prevEl: ".treat-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      575: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });


  var swiperTestimonials = new Swiper(".testimonials-slider", {
    pagination: {
      el: ".testimonials-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".testimonials-next",
      prevEl: ".testimonials-prev",
    },

  });

  /*popup*/
  $(".fancybox").fancybox({
    touch:false,
    autoFocus:false,
    beforeShow : function(e){
      $('html').addClass('is-popup');
    },
    afterClose: function () {
      $('html').removeClass('is-popup');
    }
  });

  /*play video*/
  $(document).on('click', '.img-slider .swiper-slide .hover-block a', function (e){
    e.preventDefault();
    $(this).closest('.swiper-slide').addClass('is-play');
    $(this).closest('.swiper-slide').find('iframe')[0].src += "?autoplay=1";
  });

  /*menu*/
  $(".open-menu a, .open-menu-fix a").fancybox({
    touch:false,
    autoFocus:false,
   /* animationDuration : 600,
    animationEffect   : 'slide-in-out'*/
    afterShow : function(e){
      $('html').addClass('is-menu is-popup');
    },
    afterClose: function () {
      $('html').removeClass('is-menu is-popup');
    }
  });


  /*open/close sub menu on mobile*/
  $(document).on('click', '.level>li>span', function(e){
    if($(this).closest('li').hasClass('is-open')){

      $(this).find('is-open').removeClass('is-open');
      $(this).closest('li').removeClass('is-open');
      $(this).siblings('ul').slideUp();
    }else{
      $(this).closest('li').addClass('is-open');
      $(this).siblings('ul').slideDown();
    }
  });

  /*close-menu*/
  $(document).on('click', '.close-menu', function (e){
    e.preventDefault();
    $('html').removeClass('is-menu is-popup');
    setTimeout(function() {
      $.fancybox.close();
    }, 500);
  })



function Copy() {
  var dummy = document.createElement('input'),
    text = window.location.href;

document.body.appendChild(dummy);
dummy.value = text;
dummy.select();
document.execCommand('copy');
document.body.removeChild(dummy);
}

$('.clip').on('click', function(e){
    e.preventDefault();
    Copy();
    alert('URL Copied');
  })
});

