<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();


$shop = get_option( 'woocommerce_shop_page_id' );
$pcat = get_queried_object_id();

$seo = get_field('seo', $shop);
$desc = get_field('description', $shop);

$seo_cat = get_field('seo', 'product_cat_'.$pcat);
$desc_cat = get_field('description', $pcat);

woocommerce_output_all_notices();

$prices = get_filtered_price();
$min_pr = $prices['min'];
$max_pr = $prices['max'];

if (get_queried_object()->taxonomy)
    $link = get_term_link(get_queried_object()->term_id);
else
    $link = get_permalink(get_option( 'woocommerce_shop_page_id' ));



$order = [
    'menu_order' => 'תֶקֶן',
    'popularity' => 'פּוֹפּוּלָרִיוּת',
    'date' => 'החדש ביותר',
    'price-desc' => 'מחיר יורד',
    'price' => 'עליית מחירים',
];


$args['post_type'] = 'product';
$args['posts_per_page'] = 12;
$args['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$args['tax_query'] = [ 'relation' => 'AND'];

if($_GET['s']){
    $args['s'] = $_GET['s'];
}

if (get_queried_object()->taxonomy){
    $args['tax_query'][] = [
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => get_queried_object()->term_id,
        'operator' => 'IN',
    ];
}

if ($_GET['pcat']){
    $args['tax_query'][] = [
        'taxonomy' => 'product_cat',
        'field' => 'id',
        'terms' => $_GET['pcat'],
        'operator' => 'IN',
    ];
}

if($_GET['color']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_metal-colour',
        'field' => 'id',
        'terms' => $_GET['color'],
        'operator' => 'IN',
    ];
}

if($_GET['size']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_size',
        'field' => 'id',
        'terms' => $_GET['size'],
        'operator' => 'IN',
    ];
}

if($_GET['setting']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_setting',
        'field' => 'id',
        'terms' => $_GET['setting'],
        'operator' => 'IN',
    ];
}

if($_GET['fineness']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_fineness',
        'field' => 'id',
        'terms' => $_GET['fineness'],
        'operator' => 'IN',
    ];
}

if($_GET['kind']){
    $args['tax_query'][] = [
        'taxonomy' => 'pa_metal-kind',
        'field' => 'id',
        'terms' => $_GET['kind'],
        'operator' => 'IN',
    ];
}

if ($_GET['price']) {
    $args['meta_query'] = [ 'relation' => 'AND'];
    $a = $_GET['price'];

    $arr = explode(';', $a);

    $meta_query = [

        [
          'key' => '_price',
          'value' => array($arr[0], $arr[1]),
          'compare' => 'BETWEEN',
          'type' => 'NUMERIC'
        ]
      ];
    $args['meta_query'] = $meta_query  ;
}

if ($_GET['orderby']) {
        switch ($_GET['orderby']) :
            case 'menu_order' :

            break;
            case 'popularity' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                $args['meta_key'] = 'total_sales';             
            break;
            case 'date' :
                $args['orderby'] = 'date';
                $args['order'] = 'ASC';
            break;
            case 'price-desc' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'DESC';
                $args['meta_key'] = '_price';             
            break;
            case 'price' :
                $args['orderby'] = 'meta_value';
                $args['order'] = 'ASC';
                $args['meta_key'] = '_price';
            break;
        endswitch;
}

?>

		<section class="product">
			<div class="content-width">
				<div class="title title1">
					<h1><?php woocommerce_page_title(); ?></h1>
					<p><?php if(get_queried_object()->taxonomy && $desc_cat):
							echo $desc_cat;
						else:
							echo $desc;
						endif;?>
					</p>
				</div>
				<div class="content-wrap title2">
					<div class="sort-line">
						<div class="filter-btn">
							<a href="#"><img src="<?= get_template_directory_uri();?>/img/icon-9.svg" alt=""></a>
						</div>
						<div class="select-block ">
							<label class="form-label" for="sort-1"></label>
							 <select id="sort" name="sort">
							 	<?php foreach ($order as $key => $value):?>
							 		<option value="<?= $key;?>"><?= $value;?></option>
							 	<?php endforeach;?>
							 </select>
						</div>
					</div>
					<div class="content">
						<form action="<?= $link;?>" id="filter" class="filter-wrap">
                            <input type="hidden" name="action" value="filter">
                            <input type="hidden" name="orderby" value="" id="sorting">

                            <?php if(get_queried_object()->taxonomy){?>

                            	<input type="hidden" name="pcat" value="<?= get_queried_object_id();?>">

                            <?php }?>

							<div class="item-filter item-filter-1">
								<h6>מחיר</h6>
								<div class="filter">
									<div class="d-flex">
										<div>
											<label for="to"></label>
											<input type="text" name="price_to" class="inp js-to" id="to" value="<?= $min_pr;?>"/>
										</div>
										<div>
											<label for="from"></label>
											<input type="text" name="price_from" class="inp js-from" id="from" value="<?= $max_pr;?>"/>
										</div>

										<div class="range-slider">
											<label for="range"></label>
											<input type="text" class="js-range-slider" value="" id="range" name="price"/>
										</div>
									</div>
								</div>
							</div>

							<?php $mats = get_terms('pa_metal-kind');

							if(isset($mats)):?>
								<div class="item-filter item-filter-2">
									<h6>סוג מתכת</h6>
									<div class="filter">
										<div class="checkbox-wrap">
											<?php foreach ($mats as $mat):?>
												<p>
													<label>
														<input type="checkbox" <?php checked(1, in_array($mat->term_id, $_GET['kind'] ?? [])) ?> name="kind[]" value="<?= $mat->term_id;?>">
														<span></span>
														<?= $mat->name;?>
													</label>
												</p>
											<?php endforeach;?>
										</div>
									</div>
								</div>
							<?php endif;

							$finen = get_terms('pa_fineness');

							if(isset($finen)):?>

								<div class="item-filter item-filter-3">
									<h6>לְנַסוֹת</h6>
									<div class="filter">
										<div class="checkbox-wrap">

											<?php foreach ($finen as $fine):?>
												<p>
													<label>
														<input type="checkbox" <?php checked(1, in_array($fine->term_id, $_GET['fineness'] ?? [])) ?> name="fineness[]" value="<?= $fine->term_id;?>">
														<span></span>
														<?= $fine->name;?>
													</label>
												</p>
											<?php endforeach;?>

										</div>
									</div>
								</div>

							<?php endif;

							$color = get_terms('pa_metal-colour');

							if(isset($color)):?>

								<div class="item-filter item-filter-4">
									<h6>צבע מתכת</h6>
									<div class="filter">
										<div class="checkbox-wrap">

											<?php foreach ($color as $clr):?>
												<p>
													<label>
														<input type="checkbox" <?php checked(1, in_array($clr->term_id, $_GET['color'] ?? [])) ?> name="color[]" value="<?= $clr->term_id;?>">
														<span></span>
														<?= $clr->name;?>
													</label>
												</p>
											<?php endforeach;?>
											
										</div>
									</div>
								</div>

							<?php endif;

							$size = get_terms('pa_size');

							if(isset($size)):?>

								<div class="item-filter item-filter-5">
									<h6>לְהַכנִיס</h6>
									<div class="filter">
										<div class="checkbox-wrap">
											<?php foreach ($size as $sz):?>
												<p>
													<label>
														<input type="checkbox" <?php checked(1, in_array($sz->term_id, $_GET['size'] ?? [])) ?> name="size[]" value="<?= $sz->term_id;?>">
														<span></span>
														<?= $sz->name;?>
													</label>
												</p>
											<?php endforeach;?>
										</div>
									</div>
								</div>

							<?php endif;

							$setting = get_terms('pa_setting');

							if(isset($setting)):?>

								<div class="item-filter item-filter-6">
									<h6>הגודל</h6>
									<div class="filter">
										<div class="checkbox-wrap">
											<?php foreach ($setting as $set):?>
												<p>
													<label>
														<input type="checkbox" <?php checked(1, in_array($set->term_id, $_GET['setting'] ?? [])) ?> name="setting[]" value="<?= $set->term_id;?>">
														<span></span>
														<?= $set->name;?>
													</label>
												</p>
											<?php endforeach;?>
										</div>
									</div>
								</div>

							<?php endif;?>

						</form>
						<div class="wrap prod-wrap">
						
							<?php $wp_query = new WP_Query($args);

							if($wp_query->have_posts()){

								while ( $wp_query->have_posts() ) { $wp_query->the_post();

										wc_get_template_part( 'content', 'product' );
								}
							}else{
								do_action( 'woocommerce_no_products_found' );
							}
							?>

						</div>
						<div class="pagination-wrap">
							<?php $max_pages = $wp_query->max_num_pages;
							$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;  

							if( $paged < $max_pages ) {  ?>
								<div class="add-block">
									<a href="#" id="loadmore" data-max_pages="<?= $max_pages;?>" data-paged="<?= $paged;?>"><img src="<?= get_template_directory_uri();?>/img/icon-8.svg" alt="">טען עוד  </a>
								</div>

							<?php }?>	
							<ul class="pagination">
								<?php kama_pagenavi([], $wp_query, $_GET);?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php if($seo):?>
			<section class="text-block" data-aos="fade-up" data-aos-duration="1000">
				<div class="content-width">
					<div class="text-wrap">
						<?php if(get_queried_object()->taxonomy && $seo_cat):
							echo $seo_cat;
						else:
							echo $seo;
						endif;?>
						<a href="#" class="show-text"><span>יותר</span><span>hide text</span><i class="fas fa-chevron-down"></i></a>
					</div>
				</div>
			</section>
		<?php endif;?>

<script>
	jQuery(document).ready(function ($) {
	
		var $range = $(".js-range-slider"),
	    $from = $(".js-from"),
	    $to = $(".js-to"),
	    range,
	    min = <?= $min_pr;?>,
	    max = <?= $max_pr;?>,
	    from,
	    to;

		/*var updateValues = function () {
		    $from.prop("value", from);
		    $to.prop("value", to);
		};*/

    var updateValues = function () {
      $from.prop("value", from);
      $to.prop("value", to);
      console.log(to)
      console.log(from)
    };

    $range.ionRangeSlider({
      type: "double",
      min: min,
      max: max,
      skin: "round",
      prettify: function(num) {
        var tmp_min = min,
          tmp_max = max,
          tmp_num = num;




        if (min < 0) {

          tmp_min = 0;
          tmp_max = max - min;
          tmp_num = num - min;
          tmp_num = tmp_max - tmp_num;
          return tmp_num + min;


        }
        else {
          num = max + min - num ;
          return num;
        }
      },
      onChange: function (data) {
        from = max - data.from + min;
        to = max - data.to + min;
        updateValues();

      }
    });

    range = $range.data("ionRangeSlider");

    var updateRange = function (from, to) {


      from = max - from + min;
      to = max - to + min;

      range.update({
        from: from,
        to: to
      });

    };

    $from.on("change", function () {
      from = +$(this).prop("value");
      if (from > max) {
        from = max;
      }
      if (from < to) {
        from = to;

      }


      //  updateValues();
      updateRange(from, to);
      console.log(to)
      console.log(from)

    });

    $to.on("change", function () {
      to = +$(this).prop("value");
      if (to < min) {
        to = min;

      }
      if (to > from) {
        to = from;
      }

//    updateValues();
      updateRange(from, to);
      console.log(to)
      console.log(from)
    });

    $(document).on('change', '.js-range-slider', function(){


    })
	});
</script>

<?php get_footer();
