<?php 

/*

Template Name: Landing

*/

get_header();

$count = 0;

if( have_rows('content') ):

    while ( have_rows('content') ) : the_row();

        if( get_row_layout() == 'main_banner' ):
            $im = get_sub_field('banner_image');
            $v = get_sub_field('banner_video');
            $params = [ 'alt' => $im['alt'], 'class' => 'bg-img' ];
            ?>

            <section class="home-banner <?= !is_front_page()?'page-header':'';?>">
				<div class="bg">
		          	<?php if(get_sub_field('videoimage')):?>

			          	<div class="video-bg">
			            	<video poster="" autoplay="true" loop muted>
			              		<source src="<?= $v['url'];?>" type="video/mp4">
			            	</video>
			          	</div>
			      	<?php else:

						echo wp_get_attachment_image($im['ID'], 'large', false, $params);
					endif;?>

					<img src="<?= get_template_directory_uri();?>/img/bg-1-1.png" alt="" class="bottom-1">
					<img src="<?= get_template_directory_uri();?>/img/bg-1-2.png" alt="" class="bottom-2">
				</div>
				<div class="content-width">
					<h1><?php the_sub_field('title');?></h1>
					<?php if(get_sub_field('show_buttons')):?>
						<div class="btn-wrap">
							<a href="#call" class="btn-default fancybox"><?php the_sub_field('call_button');?></a>
							<a href="#insurance" class="btn-default btn-yellow fancybox"><?php the_sub_field('verify_button');?></a>
						</div>
					<?php endif;?>
				</div>
			</section>

        <?php elseif( get_row_layout() == 'call_back' ): 
        	$id = get_sub_field('id');?>

        	<section class="call-block" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/bg-2-1.png" alt="" class="img img-1">
					<img src="<?= get_template_directory_uri();?>/img/bg-2-2.png" alt="" class="img img-2">
					<img src="<?= get_template_directory_uri();?>/img/bg-2-3.png" alt="" class="img img-3">
					<img src="<?= get_template_directory_uri();?>/img/bg-2-4.png" alt="" class="img img-4">
				</div>
				<div class="content-width">
					<div class="content">
						<h2><?php the_sub_field('title');?></h2>
						<p><?php the_sub_field('subtitle');?></p>
						<?= do_shortcode(''.get_sub_field('form').'');?>
					</div>
				</div>
			</section>
        
        <?php elseif( get_row_layout() == 'logos_slider' ): 
        	$id = get_sub_field('id');

        	$count++;

        	$logos = get_sub_field('logos');?>

        	<section class="logo-slider-wrap" <?= $id?'id="'.$id.'"':'';?>>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<div class="slider-wrap">
						<div class="swiper logo-slider logo-slider-<?php echo $count; ?>">
							<div class="swiper-wrapper">

								<?php if( $logos ):

									foreach( $logos as $im ): ?>

										<div class="swiper-slide">
											<figure>
												<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
											</figure>
										</div>

									<?php endforeach;

								endif; ?>
								
							</div>
						</div>
						<div class="nav-wrap">
							<div class="swiper-button-next logo-slider-next-<?php echo $count; ?>"></div>
							<div class="swiper-button-prev logo-slider-prev-<?php echo $count; ?>"></div>
						</div>
						<div class="swiper-pagination logo-slider-pagination-<?php echo $count; ?>"></div>
					</div>
				</div>
			</section>

        <?php elseif( get_row_layout() == 'about_us' ):
        	$id = get_sub_field('id');
        	$sli1 = get_sub_field('slider');
        	$sli2 = get_sub_field('slider_2');
         ?>

        	<section class="about" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-1-1.png" alt="" class="img img-1">
					<img src="<?= get_template_directory_uri();?>/img/after-1-2.png" alt="" class="img img-2">
				</div>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<div class="content">
						<div class="slider-wrap slider-right">
								<div class="swiper img-slider img-slider-1">
									<div class="swiper-wrapper">
										<?php foreach ($sli1 as $sl1):
											$ism = $sl1['is_image'];
											$img = $sl1['image'];?>

											<div class="swiper-slide">
											<?php if(!$ism):?>
												<figure>
													<?php if($img):?>
														<img src="<?= $img;?>" alt="">
													<?php endif;?>
												</figure>
												
													
												
											<?php else:?>

												<div class="hover-block">

														<a href="#">
															<?php if($img):?>
																<img src="<?= $img;?>" alt="">
															<?php endif;?>
															<i class="fas fa-play"></i>
														</a>
													</div>

												<div class="video-wrap">
														<iframe width="1904" height="711" src="<?= $sl1['video'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>

													
											<?php endif;?>
										</div>
										<?php endforeach;?>
									</div>
								</div>
								<div class="nav-wrap">
									<div class="swiper-button-next img-next-1"></div>
									<div class="swiper-pagination img-pagination-1"></div>
									<div class="swiper-button-prev img-prev-1"></div>

								</div>
							</div>

						<?php the_sub_field('text');


						?>

						<div class="slider-wrap slider-left">
							<div class="swiper img-slider img-slider-2">
								<div class="swiper-wrapper">
									<?php foreach ($sli2 as $sl2):
											$ism2 = $sl2['is_image'];
											$img2 = $sl2['image'];
											?>

											<div class="swiper-slide">
											<?php if(!$ism2):?>

												<figure>
													<?php if($img2):?>
														<img src="<?= $img2;?>" alt="">
													<?php endif;?>
												</figure>
													
											<?php else:?>

												<div class="hover-block">

														<a href="#">
															<?php if($img2):?>
																<img src="<?= $img2;?>" alt="">
															<?php endif;?>
															<i class="fas fa-play"></i>
														</a>
													</div>
													<div class="video-wrap">
														<iframe width="1904" height="711" src="<?= $sl2['video'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
													</div>
													
												
											<?php endif;?>
										</div>
										<?php endforeach;?>
								</div>
							</div>
							<div class="nav-wrap">
								<div class="swiper-button-next img-next-2"></div>
								<div class="swiper-pagination img-pagination-2"></div>
								<div class="swiper-button-prev img-prev-2"></div>

							</div>
						</div>
						<?php the_sub_field('text_1');?>

					</div>
				</div>
			</section>

        <?php elseif( get_row_layout() == 'services' ): 
        	$id = get_sub_field('id');
        	$pos = get_sub_field('posts');?>

        	<section class="services" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-2-2.png" alt="" class="img img-1">
					<img src="<?= get_template_directory_uri();?>/img/after-2-1.png" alt="" class="img img-2">
				</div>

				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<p><?php the_sub_field('text');?></p>

					<?php if( $pos ): ?>

						<div class="content">
    
    						<?php foreach( $pos as $post): setup_postdata($post); ?>

    							<div class="item">
									<a href="<?php the_permalink();?>">
										<figure>
											<img src="<?php the_post_thumbnail_url();?>" alt="">
										</figure>
										<div class="text-wrap">
											<h4><?php the_title();?></h4>
											<p><?= get_the_excerpt();?></p>
										</div>
									</a>
								</div>

							<?php endforeach; 

							wp_reset_postdata(); ?>

						</div>

					<?php endif; ?>

				</div>
			</section>

		<?php elseif( get_row_layout() == 'programs' ): 
			$id = get_sub_field('id');
			$im = get_sub_field('image');
			$pos = get_sub_field('programs_list');
			?>

			<section class="programs" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-3-1.png" alt="" class="img img-1">
					<img src="<?= get_template_directory_uri();?>/img/after-3-2.png" alt="" class="img img-2">
				</div>
				<div class="content-width">
					<figure>
						<?= wp_get_attachment_image($im['ID'], 'large')?>
					</figure>
					<div class="title-wrap">
						<h2><?php the_sub_field('title');?></h2>
						<p><?php the_sub_field('text');?></p>
					</div>

					<?php if( $pos ): ?>

						<div class="content">
    
						    <?php foreach( $pos as $post): setup_postdata($post); 

						    	$im = get_field('icon');?>
						        
						        <a href="<?php the_permalink();?>" class="item">
									<div class="icon-wrap">
										<img src="<?= $im['url'];?>" alt="<?= $im['alt'];?>">
									</div>
									<h6><?php the_title(); ?></h6>
									<p><?php the_field('card_text');?></p>
									
								</a>
						           
						    <?php endforeach;

						    wp_reset_postdata(); ?>

						</div>
					
					<?php endif; ?>
					
				</div>
			</section>

        <?php elseif( get_row_layout() == 'treatments' ):
        	$id = get_sub_field('id');
        	$pos = get_sub_field('posts');?>

        	<section class="item-3-bg" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?= get_template_directory_uri();?>/img/after-5.png" alt="">
				</div>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<p><?php the_sub_field('text');?></p>
					<?php if( $pos ): ?>

						<div class="content">
    
    						<?php foreach( $pos as $post): setup_postdata($post); ?>

    							<div class="item">
									<figure>
										<img src="<?php the_post_thumbnail_url();?>" alt="">
									</figure>
									<a href="<?php the_permalink();?>">
										<div class="text-wrap">
											<h4><?php the_title();?></h4>
											<p><?= get_the_excerpt();?></p>
										</div>
									</a>
								</div>

							<?php endforeach; 

							wp_reset_postdata(); ?>

						</div>

					<?php endif; ?>
				</div>

			</section>

        <?php elseif( get_row_layout() == 'team' ): 
        	$id = get_sub_field('id');
        	$pos = get_sub_field('team_members');?>

			<section class="team" <?= $id?'id="'.$id.'"':'';?>>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>

					<?php if( $pos ): ?>

						<div class="slider-wrap">
							<div class="swiper team-slider">
								<div class="swiper-wrapper">
    
    								<?php foreach( $pos as $post): setup_postdata($post); ?>
        
        								<div class="swiper-slide">
											<figure>
												<img src="<?php the_post_thumbnail_url();?>" alt="">
											</figure>
											<div class="hover-block">
												<h5><?php the_title(); ?></h5>
												<div class="line"></div>
												<h6><?php the_field('card_title');?></h6>
												<p><?php the_field('card_text');?></p>
												<div class="link-wrap">
													<a href="<?php the_permalink(); ?>">Read More.</a>
												</div>
											</div>
										</div>
           
								    <?php endforeach;

								    wp_reset_postdata(); ?>

								</div>
							</div>
							<div class="nav-wrap">
								<div class="swiper-button-next team-next-"></div>
								<div class="swiper-button-prev team-prev"></div>
							</div>
							<div class="swiper-pagination team-pagination"></div>

						</div>

					<?php endif; ?>

				</div>
			</section>
        
        <?php elseif( get_row_layout() == 'admissions' ): 
        	$id = get_sub_field('id');
        	$adms = get_sub_field('items');
        	?>

        	<section class="progress-block" <?= $id?'id="'.$id.'"':'';?>>
				<div class="bg">
					<img src="<?php the_post_thumbnail_url();?>img/after-6.png" alt="">
				</div>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<p><?php the_sub_field('text');?></p>

					<?php if(isset($adms)):?>
					
						<div class="content">

							<?php foreach ($adms as $adm):?>
								<div class="item">
									<figure>
										<img src="<?= $adm['icon']['url'];?>" alt="<?= $adm['icon']['alt'];?>">
									</figure>
									<h4><?= $adm['title'];?></h4>
									<p><?= $adm['text'];?></p>
								</div>
							<?php endforeach;?>

						</div>

					<?php endif;?>

				</div>
			</section>

        <?php elseif( get_row_layout() == 'amenties' ):
        	$id = get_sub_field('id');
        	$ants = get_sub_field('list');?>

        	<section class="amenities" <?= $id?'id="'.$id.'"':'';?>>
				<div class="content-width">
					<h2><?php the_sub_field('title');?></h2>
					<p><?php the_sub_field('text');?></p>
					<?php if(isset($ants)):?>
					
						<div class="content">

							<?php foreach ($ants as $ant):?>
								<div class="item">
									<figure>
										<img src="<?= $ant['icon']['url'];?>" alt="<?= $ant['icon']['alt'];?>">
									</figure>
									<h4><?= $ant['title'];?></h4>
									<p><?= $ant['text'];?></p>
								</div>
							<?php endforeach;?>

						</div>

					<?php endif;?>
				</div>
			</section>

        <?php endif;

    endwhile;


endif;

get_template_part('parts/testimonials');

get_template_part('parts/verify');

get_footer();
