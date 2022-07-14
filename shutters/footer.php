  <footer>
    <div class="bg">
      <picture>
        <source srcset="<?php bloginfo('template_directory'); ?>/img/bg-4.png" media="(min-width: 1500px)">
        <source srcset="<?php bloginfo('template_directory'); ?>/img/bg-4-1.png" media="(min-width: 1199px)">
        <source srcset="<?php bloginfo('template_directory'); ?>/img/bg-4-2.png" media="(min-width: 950px)">
        <source srcset="<?php bloginfo('template_directory'); ?>/img/bg-4-3.png" media="(min-width: 600px)">
        <img src="<?php bloginfo('template_directory'); ?>/img/bg-4-4.png" alt="">
      </picture>

    </div>
    <div class="content-width">
      <div class="logo-wrap">
        <a href="<?php echo get_home_url(); ?>"><img src="<?= get_field('logo_footer', 'option')['url'] ?>" alt=""></a>
      </div>
      <nav class="footer-menu-wrap">

        <?php if( have_rows('menu_1_footer', 'option') ): ?>
          <?php while( have_rows('menu_1_footer', 'option') ): the_row(); ?>

            <div class="footer-menu">
              <p><?php the_sub_field('title'); ?></p>

              <?php wp_nav_menu( array(
               'theme_location'  => 'footer-1',
               'menu'            => 'footer-1', 
               'container'       => '',
               'items_wrap'      => '<ul>%3$s</ul>'
              ) ); ?>

            </div>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('menu_2_footer', 'option') ): ?>
          <?php while( have_rows('menu_2_footer', 'option') ): the_row(); ?>

            <div class="footer-menu">
              <p><?php the_sub_field('title'); ?></p>

              <?php wp_nav_menu( array(
               'theme_location'  => 'footer-2',
               'menu'            => 'footer-2', 
               'container'       => '',
               'items_wrap'      => '<ul>%3$s</ul>'
              ) ); ?>

              <!-- <?php if( have_rows('menu_3', 'option') ): ?>
                <?php while( have_rows('menu_3', 'option') ): the_row(); ?>

                    <?php $link = get_sub_field('link') ?>
                    <ul>
                      <li>
                        <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><b><?= $link['title'] ?></b></a>
                      </li>
                    </ul> 

                <?php endwhile; ?>
              <?php endif; ?> -->

              <?php wp_nav_menu( array(
               'theme_location'  => 'footer-4',
               'menu'            => 'footer-4', 
               'container'       => '',
               'items_wrap'      => '<ul class="bold">%3$s</ul>'
              ) ); ?>

            </div>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if( have_rows('menu_4_footer', 'option') ): ?>
          <?php while( have_rows('menu_4_footer', 'option') ): the_row(); ?>

            <div class="footer-menu">
              <p><?php the_sub_field('title'); ?></p>

              <?php wp_nav_menu( array(
               'theme_location'  => 'footer-3',
               'menu'            => 'footer-3', 
               'container'       => '',
               'items_wrap'      => '<ul>%3$s</ul>'
              ) ); ?>

            </div>

          <?php endwhile; ?>
        <?php endif; ?>

        <ul>

          <?php if( have_rows('menu_5_footer', 'option') ): ?>
            <?php while( have_rows('menu_5_footer', 'option') ): the_row(); ?>

              <li><p><b><?php the_sub_field('title'); ?></b></p></li>

              <?php if( have_rows('texts') ): ?>
                <?php while( have_rows('texts') ): the_row(); ?>

                  <li><p><?php the_sub_field('text'); ?></p></li>

                <?php endwhile; ?>
              <?php endif; ?>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php if( have_rows('menu_6_footer', 'option') ): ?>
            <?php while( have_rows('menu_6_footer', 'option') ): the_row(); ?>

              <li><p><b><?php the_sub_field('title'); ?></b></p></li>

              <?php if( have_rows('texts') ): ?>
                <?php while( have_rows('texts') ): the_row(); ?>

                  <li><p><?php the_sub_field('text'); ?></p></li>

                <?php endwhile; ?>
              <?php endif; ?>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php $link = get_field('phone_number_1', 'option') ?>
          <li class="tel"><a href="tel:<?= $link['url'] ?>"><span><i class="fas fa-phone"></i></span><b><?= $link['title'] ?></b></a></li>
        </ul>
      </nav>

      <div class="footer-soc-wrap">
        <ul class="soc">

          <?php if( have_rows('social_networks_1', 'option') ): ?>
            <?php while( have_rows('social_networks_1', 'option') ): the_row(); ?>

              <li><a href="<?= get_sub_field('social_link_1')['url']; ?>"><i class="<?php the_sub_field('icon_1'); ?>"></i></a></li>

            <?php endwhile; ?>
          <?php endif; ?>

        </ul>
      </div>
    </div>
    <div class="content-width bottom">

      <?php if( have_rows('certificate_left', 'option') ): ?>
        <?php while( have_rows('certificate_left', 'option') ): the_row(); ?>

          <div class="left">
            <ul>
              <li><p><?php the_sub_field('text'); ?></p> <span>|</span></li>
              <?php $link = get_sub_field('link') ?>
              <li><a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a> <span>|</span></li>
            </ul>
          </div>

        <?php endwhile; ?>
      <?php endif; ?>


      <div class="right">
        <ul>

          <?php if( have_rows('certificate_right', 'option') ): ?>
            <?php while( have_rows('certificate_right', 'option') ): the_row(); ?>
      
              <?php $link = get_sub_field('text') ?>
              <li><a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a> <span>-</span></li>

            <?php endwhile; ?>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </footer>

  <div class="bottom-line">
    <div class="content-width">
      <ul>

        <?php $images = get_field('logo_companies', 'option');
        if( $images ): ?>
        <?php foreach( $images as $image ): ?>

          <li><img src="<?php echo esc_url($image['url']); ?>" alt=""></li>

        <?php endforeach; ?>
        <?php endif; ?>

      </ul>
    </div>
  </div>

  <div id="popup-quote" class="popup-site popup-quote" style="display: none;">
    <a href="#" data-fancybox-close class="close-popup"><span>CLOSE</span><img src="<?php bloginfo('template_directory'); ?>/img/close-white.svg" alt=""></a>
    <div class="bg"></div>
    <div class="wrap">
      <?= do_shortcode('[contact-form-7 id="423" title="Free Measure & Quote" html_class="default-form product-form"]') ?>
    </div>
  </div>

  <div id="popup-quote-2" class="popup-site popup-quote" style="display: none;">
    <a href="#" data-fancybox-close class="close-popup"><span>CLOSE</span><img src="<?php bloginfo('template_directory'); ?>/img/close-white.svg" alt=""></a>
    <div class="bg"></div>
    <div class="wrap">
      <?= do_shortcode('[contact-form-7 id="423" title="Free Measure & Quote" html_class="default-form product-form"]') ?>
    </div>
  </div>

  <div id="popup-gallery" class="popup-site popup-gallery" style="display: none;">
    <a href="#" data-fancybox-close class="close-popup"><span>CLOSE</span><img src="<?php bloginfo('template_directory'); ?>/img/close-white.svg" alt=""></a>
    <div class="bg-wrap">

    </div>
   <div class="wrap">
     <p>Lorem ipsum dolor sit amet</p>
     <div class="swiper slider-img-2">
       <div class="swiper-wrapper">
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
         </div>
       </div>
       <div class="nav-wrap">
         <div class="content-width">
           <div class="nav-section">
             <div class="wrap">
               <div class="nav">
                 <div class="swiper-button-next img-next"></div>
                 <div class="swiper-button-prev img-prev"></div>
               </div>
               <div class="pagination">
                 <div class="swiper-pagination img-pagination"></div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div thumbsSlider="" class="swiper slider-img">
       <div class="swiper-wrapper">
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
         </div>
         <div class="swiper-slide">
           <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
         </div>
       </div>
     </div>
   </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>