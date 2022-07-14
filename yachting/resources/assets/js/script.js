jQuery(document).ready(function ($) {
  $('select').niceSelect();

  var $start = $('#start'),
      $end = $('#end');



  var picker = $start.datepicker({
    minDate: new Date(),
    autoClose: true,
    language:"en",
    dateFormat: 'DD dd MM yyyy',
    onSelect: function (fd, dates) {
      var date = fd.split(',')
      $('#start').val(date[0]);
      $('#end').val(date[1]);

      if (date[0])
        $('#end').addClass('active')
      $('#end').addClass('selected')
      $('#start').addClass('selected')
      $('#start').addClass('active')

    },
    onHide: function(inst, animationCompleted) {
      $('#end').removeClass('active')
      $('#start').removeClass('active')
    }
  });

  $end.click(function () {
    picker.show();
    $start.focus();
  });

  var $start1 = $('.start-1'),
    $end1 = $('.end-1');



  var picker1 = $start1.datepicker({
    minDate: new Date(),
    autoClose: true,
    language:"en",
    dateFormat: 'D dd MM yyyy',
    onSelect: function (fd, dates) {
      var date = fd.split(',')
      $('#start-1').val(date[0]);
      $('#end-1').val(date[1]);

      if (date[0])
        $('#end-1').addClass('active')
      $('#end-1').addClass('selected')
      $('#start-1').addClass('selected')
      $('#start-1').addClass('active')

      if($('.end-1').val()) {
        $('.end-1').trigger( "filtering" );
      }
      
    },
    onHide: function(inst, animationCompleted) {
      $('#end-1').removeClass('active')
      $('#start-1').removeClass('active')
    }
  });

  $end1.click(function () {
    picker1.show();
    $start1.focus();
  });

  //RANGE

  var $range1 = $(".js-range-slider");


  $range1.ionRangeSlider({
    min: 1,
    max: 100,
    from: 60,
    onFinish: function (data) {
      $range1.trigger( "filtering" );
    }

  });

  var $range2 = $(".js-range-slider-1");


  $range2.ionRangeSlider({
    min: 1000,
    max: 20000,
    type: "double",
    prettify_separator: ".",
    hide_min_max:true,
    onFinish: function (data) {
      $range2.trigger( "filtering" );
      console.log('filtering')
    }
  });

  var $range3 = $(".js-range-slider-2");


  $range3.ionRangeSlider({
    min: 50,
    max: 200,
    type: "double",
    hide_min_max:true,
    onFinish: function (data) {
      $range3.trigger( "filtering" );
    }
  });

  var $range4 = $(".js-range-slider-3");


  $range4.ionRangeSlider({
    min: 1,
    max: 500,
    type: "double",
    hide_min_max:true,
    onFinish: function (data) {
      $range4.trigger( "filtering" );
    }
  });

  var $range5 = $(".js-range-slider-4");


  $range5.ionRangeSlider({
    min: 4,
    max: 50,
    type: "double",
    hide_min_max:true,
    onFinish: function (data) {
      $range5.trigger( "filtering" );
    }
  });

  var $range6 = $(".js-range-slider-5");


  $range6.ionRangeSlider({
    min: 4,
    max: 50,
    type: "double",
    hide_min_max:true,
    onFinish: function (data) {
      $range6.trigger( "filtering" );
    }
  });


  var yachtsSlider=$(".yachts-slider-js");
  yachtsSlider.owlCarousel({
    items: 1,
    nav: true,
    dots: true,
    loop: true,
    smartSpeed: 700,
    autoplay:true,
    autoplayTimeout:10000,
    responsiveClass:true,
    margin: 35,
    responsive:{
      0:{
        items:1
      },
      700:{
        items:2
      },
      1025:{
        items:3
      },
      1600:{
        items:4
      }
    }
  });

  var imgSlider=$(".img-slider");
  imgSlider.owlCarousel({
    items: 1,
    nav: true,
    dots: true,
    loop: true,
    mouseDrag: false,
    touchDrag: false,
  });

  var reviewsSlider=$(".reviews-slider");
  reviewsSlider.owlCarousel({
    items: 1,
    nav: true,
    dots: true,
    loop: true,
  });

  $(document).on('click', '.menu-btn', function (e) {
    e.preventDefault();
    $(".menu-responsive").toggleClass('is-active');
  });

  $(document).on('click', '.close-menu', function (e) {
    e.preventDefault();
    $(".menu-responsive").toggleClass('is-active');
  });

  $(document).on('click', '.line-item-view', function (e){
    e.preventDefault();

    $('.tile-item-view').removeClass('is-active');
    $(this).addClass('is-active');
    $('.yachts-slider-content').addClass('is-line');
    imgSlider.trigger('refresh.owl.carousel');
  });

  $(document).on('click', '.tile-item-view', function (e){
    e.preventDefault();
    $('.line-item-view').removeClass('is-active');
    $(this).addClass('is-active');
    $('.yachts-slider-content').removeClass('is-line');
    imgSlider.trigger('refresh.owl.carousel');
  });

  $(document).on('click', '.btn-filter a', function (e){
    e.preventDefault();
    $('.yachts-wrap').toggleClass('is-filter-open');
    $(this).closest('.btn-filter').toggleClass('is-filter-open');
  });

  var galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 15,
    slidesPerView: 4,
  /*  loop: true,*/
    freeMode: true,
 /*   loopedSlides: 5, //looped slides should be the same*/
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: '.swiper-button-next-2',
      prevEl: '.swiper-button-prev-2',
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 15,
      }
    }
  });
  var galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    /*loop: true,
    loopedSlides: 5, //looped slides should be the same*/
   /* navigation: {
      nextEl: '.swiper-button-next-1',
      prevEl: '.swiper-button-prev-1',
    },*/
    thumbs: {
      swiper: galleryThumbs,
    },
  });

  $('.wrap-collapse').Cuttr({
    truncate: 'words',
    length: 70,
    readMoreText: 'SHOW MORE',
    readLessText: 'COLLAPSE',
    readMore: true,
  });

  $(document).on('click', '.cuttr-readmore', function (e){
    $(this).toggleClass('is-active');
    $(this).closest('.item').toggleClass('is-active');
    if($(this).hasClass('is-active')){
      $(this).text('COLLAPSE');
    }else{
      $(this).text('SHOW MORE');
    }
  });

  $('.product-inner .right').fixTo('.product-inner .content-width',{
    top: 30,
  });

  $(".fancybox").fancybox({
    touch:false,
    autoFocus:false,
    afterShow : function(e){

      var $start2 = $('#start-2'),
        $end2 = $('#end-2');



      var picker2 = $start2.datepicker({
        minDate: new Date(),
        autoClose: true,
        language:"en",
        dateFormat: 'D dd MM yyyy',
        onSelect: function (fd, dates) {
          var date = fd.split(',')
          $('#start-2').val(date[0]);
          $('#end-2').val(date[1]);

          if (date[0])
            $('#end-2').addClass('active')
          $('#end-2').addClass('selected')
          $('#start-2').addClass('selected')
          $('#start-2').addClass('active')

        },
        onHide: function(inst, animationCompleted) {
          $('#end-2').removeClass('active')
          $('#start-2').removeClass('active')
        }
      });

      $end2.click(function () {
        picker2.show();
        $start2.focus();
      });
    }
  });

  $('.fancybox1').on('click', function() {
    $.fancybox.close();
    $.fancybox.open( $('#register'), {
      touch: false
    });
  });
  $('.fancybox2').on('click', function() {
    $.fancybox.close();
    $.fancybox.open( $('#login'), {
      touch: false
    });
  });

/*  $(document).on('click', 'footer .item-1 .default-list li:first-child a, footer .item-2 .default-list li:nth-child(2) a, footer .item-2 .default-list li:nth-child(3) a', function (e) {
    e.preventDefault();
    var id  = $(this).attr('href'),
      top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
  });*/

  /*----NEW-27.04.21--*/
  $('.only-time').datepicker({
    dateFormat: ' ',
    timepicker: true,
    classes: 'only-timepicker'
  });

  $('.fancybox-ok').on('click', function() {
    $.fancybox.open( $('#send-ok'), {
      touch: false
    });
  });

  /*  $('.add-yacht .total-info').fixTo('.add-yacht .form-default',{
      top: 30,
    });*/
  var $range7 = $(".js-range-slider-7");


  $range7.ionRangeSlider({
    min: 1,
    max: 100,
  });

  $(document).on('click', '.add-yacht .btn-wrap a', function (e){
    e.preventDefault();
    $('.add-yacht .check-wrap').toggleClass('is-all');
    $('.add-yacht .btn-wrap').toggleClass('is-all');
  });

  Dropzone.autoDiscover = false;

  $("#dZUpload").dropzone({
    url: "js",
    addRemoveLinks: true,

  });

  $('.tel').mask('000 000 0000');
  $('.number-card').mask('0000 0000 0000 0000');
  $('.card-date').mask('00/00');
  $('.ccv').mask('000');

  var input = document.querySelector("#phone-code");
  window.intlTelInput(input, {
    allowDropdown: true,
    autoHideDialCode: true,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["ru"],
    // formatOnDisplay: false,
    geoIpLookup: function(callback) {
      $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        var countryCode = (resp && resp.country) ? resp.country : "";
        callback(countryCode);
      });
    },
    // hiddenInput: "full_number",
    initialCountry: "auto",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    //preferredCountries: ['ru'],
    separateDialCode: true,

  });


});

