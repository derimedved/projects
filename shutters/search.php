<?php get_header() ?>

    <main>
        <section class="contact hover-block contact-result">
            <div class="bg"></div>
            <div class="content-width">

                <?php get_template_part('parts/breadcrumbs') ?>

                <div class="search-result">
                    <h1>Search result: <?= get_search_query() ?></h1>
                    <ul>

                        <?php if (have_posts()) :
                            while (have_posts()) : the_post(); ?>

                                <li>
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                    <?php the_excerpt() ?>
                                </li>
                                
                            <?php endwhile; ?>
                        <?php
                        else :
                            echo "Sorry. No results were found";
                        endif; ?>

                    </ul>
                </div>
            </div>
        </section>
    </main>

<?php get_footer() ?>