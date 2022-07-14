<div class="item">
  <p class="label"><span><?= wp_get_post_terms(get_the_ID(), 'category')[0]->name ?></span> // <?= get_the_date('F j') ?></p>
  <div class="user-wrap">
    <img src="<?= get_avatar_url(get_the_author_meta('ID')) ?>" alt="">
  </div>
  <h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
  <?php the_excerpt() ?>
  <figure>
    <a href="<?php the_permalink() ?>">
      <img src="<?php the_post_thumbnail_url() ?>" alt="">
    </a>
  </figure>
  <p><a href="<?php the_permalink() ?>"><span>+  </span> READ MORE</a></p>
</div>