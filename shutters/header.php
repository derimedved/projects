<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
</head>
<body class="home">

<div class="preloader">
  <img src="<?php bloginfo('template_directory'); ?>/img/pre-1.svg" alt="">
  <img src="<?php bloginfo('template_directory'); ?>/img/pre-2.svg" alt="">
  <img src="<?php bloginfo('template_directory'); ?>/img/pre-3.svg" alt="">
</div>

  <?php
  $header_class = '';
  if(!is_front_page()) $header_class = 'header-color';
  ?>
  <header class="<?= $header_class ?>">
    <div class="top-line">
      <div class="content-width">
        <div class="logo-wrap">
          <a href="<?php echo get_home_url(); ?>">
            <img src="<?= get_field('logo_header', 'option')['url'] ?>" alt="">
          </a>
        </div>
        <nav class="top-menu">

          <!-- <?php wp_nav_menu( array(
           'theme_location'  => 'header',
           'menu'            => 'header', 
           'container'       => '',
           'items_wrap'      => '<ul>%3$s</ul>'
          ) ); ?> -->

          <?php 
          $terms = get_terms( [
            'taxonomy' => 'categories_product',
            'hide_empty' => true,
          ] ); ?>

          <ul>

            <?php foreach ($terms as $index => $term): ?>
              <li>
                <a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
              </li>
            <?php endforeach ?>

          </ul>

        </nav>
        <div class="right">
          <div class="tel-wrap">
            <?php $link = get_field('phone_number_header', 'option') ?>
            <a href="tel:<?= $link['url'] ?>"><span><i class="fas fa-phone"></i></span><b><?= $link['title'] ?></b></a>
          </div>
          <div class="product-wrap">
            <a href="#menu-mob"><span><img src="<?php bloginfo('template_directory'); ?>/img/plus.svg" alt=""><?php the_field('title_mobile_menu', 'option') ?></span></a>
          </div>
          <div class="search-btn">
            <a href="#"><i class="fal fa-search"></i></a>
          </div>
          <div class="btn-menu">
            <a href="#" class="menu-btn">
              <p>MENU</p>
              <p>CLOSE</p>
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
        </div>
        <div class="search-wrap" style="display: none;">
          <?php get_search_form(); ?>
        </div>
      </div>
      <nav class="sub-menu-wrap">
        <div class="content-width">
          <a href="#" class="close-sub-menu">
            <img src="<?php bloginfo('template_directory'); ?>/img/close.svg" alt="">
          </a>

          <?php foreach ($terms as $index => $term): ?>

            <?php $wp_query = new WP_Query(array(
              'post_type' => 'product', 
              'tax_query' => array(
                array(
                  'taxonomy' => 'categories_product',
                  'field'    => 'id',
                  'terms'    => $term->term_id
                )
              ), 
              'paged' => get_query_var('paged'))); ?>

                <div class="sub-menu sub-menu-<?= $index + 1 ?>" <?php if (!$wp_query->posts) echo 'style="display: none"' ?>>
                  <ul>

                    <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                        <li>
                          <a href="<?php the_permalink() ?>">
                            <figure>
                              <img src="<?php the_post_thumbnail_url() ?>" alt="">
                            </figure>
                            <span><i class="far fa-plus"></i><?php the_title() ?></span>
                          </a>
                        </li> 

                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>

                  </ul>
                </div>       

            <?php endforeach ?>

        </div>
      </nav>
      <div class="menu-responsive">
        <a href="#" class="close-responsive"><img src="<?php bloginfo('template_directory'); ?>/img/close.svg" alt=""></a>
        <div class="content-width top">

          <?php if( have_rows('menu_1_header', 'option') ): ?>
            <?php while( have_rows('menu_1_header', 'option') ): the_row(); ?>

              <div class="item item-1">
                <p><?php the_sub_field('title'); ?></p>

                <?php wp_nav_menu( array(
                 'theme_location'  => 'burger-menu-1',
                 'menu'            => 'burger-menu-1', 
                 'container'       => '',
                 'items_wrap'      => '<ul>%3$s</ul>'
                ) ); ?>

              </div>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php if( have_rows('menu_2_header', 'option') ): ?>
            <?php while( have_rows('menu_2_header', 'option') ): the_row(); ?>

              <div class="item item-2">
                <p><?php the_sub_field('title'); ?></p>

                <?php wp_nav_menu( array(
                 'theme_location'  => 'burger-menu-2',
                 'menu'            => 'burger-menu-2', 
                 'container'       => '',
                 'items_wrap'      => '<ul>%3$s</ul>'
                ) ); ?>

              </div>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php if( have_rows('menu_3_header', 'option') ): ?>
            <?php while( have_rows('menu_3_header', 'option') ): the_row(); ?>

              <div class="item item-3">
                <p><?php the_sub_field('title'); ?></p>
                <ul>
                  <li><?php the_sub_field('text'); ?></li>
                </ul>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php if( have_rows('menu_4_header', 'option') ): ?>
            <?php while( have_rows('menu_4_header', 'option') ): the_row(); ?>

              <div class="item item-4">
                <p><?php the_sub_field('title'); ?></p>
                <ul>
                  <li><?php the_sub_field('text'); ?></li>
                </ul>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>

          <div class="item item-5">
            <div class="tel-wrap">
              <?php $link = get_field('phone_number_header', 'option') ?>
              <a href="tel:<?= $link['url'] ?>"><span><i class="fas fa-phone"></i></span><?= $link['title'] ?></a>
            </div>
            <div class="soc-wrap">
              <ul class="soc">

                <?php if( have_rows('social_networks', 'option') ): ?>
                  <?php while( have_rows('social_networks', 'option') ): the_row(); ?>

                    <li><a href="<?php the_sub_field('social_link'); ?>"><i class="<?php the_sub_field('icon'); ?>"></i></a></li>

                  <?php endwhile; ?>
                <?php endif; ?>

              </ul>
            </div>
          </div>
        </div>
        <div class="bottom">
          <div class="content-width">
            <div class="text-wrap">
              <ul>

                <?php if( have_rows('text_botton_menu', 'option') ): ?>
                  <?php while( have_rows('text_botton_menu', 'option') ): the_row(); ?>
                
                    <li><?php the_sub_field('text'); ?> <span>|</span></li>

                  <?php endwhile; ?>
                <?php endif; ?>

              </ul>
            </div>
            <div class="btn-wrap">
              <?php $link = get_field('button_header', 'option') ?>
              <a href="<?= $link['url'] ?>" class="fancybox" target="<?= $link['target'] ?>" ><i class="far fa-plus"></i><?= $link['title'] ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="menu-mob" id="menu-mob" style="display: none">
    <div class="wrap">
      <ul class="accordion-menu">

        <?php foreach ($terms as $index => $term): ?>
            
            <li class="accordion-item ">
              <div class="accordion-thumb">
                <h6>
                  <a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
                </h6> 
                <a href="#" class="open"></a>
              </div>
              <div class="accordion-panel">

                <?php $wp_query = new WP_Query(array(
                  'post_type' => 'product', 
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'categories_product',
                      'field'    => 'id',
                      'terms'    => $term->term_id
                    )
                  ), 
                  'paged' => get_query_var('paged')));
                while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                
                  <p>
                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                  </p>

                <?php endwhile; ?>
                <?php wp_reset_query(); ?>

              </div>
            </li>

          <?php endforeach ?>

      </ul>
    </div>
  </div>