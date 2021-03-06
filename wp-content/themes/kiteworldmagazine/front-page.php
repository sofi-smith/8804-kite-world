<?php
/**
 * Kite World Magazine template for displaying the Front-Page
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); ?>

	<div class="container-fluid">
           <section class="page-slider slider row">
                <?php
                    the_block( 'Slider or Search', 'type: editor' );
                ?>
            </section>
    <div class="row spacer">
        <div class="main-content-container home col-md-12">

            <section class="intro">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </section>
            <div class="page-ad first">
                <?php
                    if(function_exists('drawAdsPlace')) drawAdsPlace(array('id' => 6), true);
                ?>
            </div>

            <section class="page-content news-home second">
              <h1 class="section-title">Latest News</h1>
              <div class="more-container">
                <div class="more-btn">
									<a a href="./?page_id=23" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>

              <div class="row">
                    <div class="news-list col-md-5">
                         <?php
                            //$news_query = new WP_Query( 'category_name=News&posts_per_page=4'); add back $news_query->
                            $args = array(
                                'posts_per_page' => 4,
                                'post_type' => 'news'
                            );
                            query_posts($args);
                            if ( have_posts() ):
                                while ( have_posts() ) :
                                    the_post();
                                    get_template_part( 'home-news-loop', get_post_type() );
                                endwhile;
                            else :
                                get_template_part( 'home-news-loop', 'empty' );
                            endif;
                            wp_reset_query();
                        ?>

                    </div>
                    <div class="news-image col-md-11">
                        <div>
                            <?php
                                the_block( 'News Right', 'type: editor' );
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <div class="block-out-grey third">Don't miss an issue, subscribe to Kiteworld Magazine today
							<a class="btn btn-success">Subscribe</a>
						</div>

            <section class="page-content kiteshow fourth">
              <h1>The Kiteshow</h1>
              <div class="more-container">
                <div class="more-btn">
									<a href="./the-kite-show-home/" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>

              <div class="section-blurb">
                            <?php
                                the_block( 'Kiteshow blurb', 'type: editor' );
                            ?>
                </div>
                <div class="kiteshow-container row">
                    <div class="col-sm-11">
                        <div class="video-item">
                          <?php
                                the_block( 'Kiteshow video large left', 'type: editor' );
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="video-item">
                            <?php
                                the_block( 'Kiteshow video small right top', 'type: editor' );
                            ?>
                        </div>
                        <div class="video-item">
                            <?php
                                the_block( 'Kiteshow video small right bottom', 'type: editor' );
                            ?>
                        </div>
                    </div>

                <div>

            </section>

            <section class="page-content travel fifth">
              <h1>Where do you want to go?</h1>
							<div class="more-container">
                <div class="more-btn">
									<a a href="./travel-home/" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>
              <div class="section-blurb">
                            <?php
                                the_block( 'travel blurb', 'type: editor' );
                            ?>
                </div>
                <div class="row spacer">
                <div class="col-md-11">
                    <?php
                                the_block( 'travel image area left', 'type: editor' );
                            ?>
                </div>
                <div class="search-facility col-md-5">
                <form action="/kite-world.co.uk/?page_id=317" method="post" onsubmit="searchResult()" >
                    <div>
                        <h3>Location</h3>
                        <select name="continent" class="form-control" onchange="showCountry(this.options[this.selectedIndex].value)">
                            <option value=""><?php echo esc_attr(__('All')); ?></option>
                            <?php
                            $args = array(
                                'type'                     => 'travel',
                                'parent'                   => 167,
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'hide_empty'               => 0,
                                'taxonomy'                 => 'travel_name',
																'hide_empty'               => 0
                            );
                            $categories = get_categories($args);
                            foreach ($categories as $category) {
                                $option = '<option value="'.$category->cat_ID.'">';
                                $option .= $category->cat_name;
                                $option .= '</option>';
                                echo $option;
                            }
                            wp_reset_query();
                            ?>
                        </select>
                    </div>
                    <div>
                        <h3>Country</h3>
                        <select  id="countries" class="form-control" name="country">
                            <option value="">All</option>
                            <?php
                            $args = array(
                                'type'                     => 'travel',
                                'child_of'                 => '167',
                                'orderby'                  => 'name',
                                'order'                    => 'ASC',
                                'taxonomy'                 => 'travel_name',
                                'hide_empty'               => 0
                            );
                            $categories = get_categories($args);
                            foreach ($categories as $category) {
                                if($category->cat_ID>=66){
                                    $option = '<option value="'.$category->cat_ID.'">';
                                    $option .= $category->cat_name;
                                    $option .= '</option>';
                                    echo $option;
                                }
                            }
                            wp_reset_query();
                            ?>
                        </select>
                    </div>
                    <fieldset>
                        <h3>Style</h3>
												<?php
												$args = array(
													'type'                     => 'travel',
													//'child_of'                 => 6,
													'parent'                   => 172,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 0,
													'taxonomy'                 => 'travel_name',


												);
												$categories = get_categories($args);
												foreach ($categories as $category) {
													$option = '<input type="checkbox" name="style[]" value="'.$category->cat_ID.'"> '.$category->cat_name.'</br>';
													echo $option;
												}
												wp_reset_query();
												wp_reset_postdata();
												?>
                    </fieldset>
                    <fieldset>
                        <h3>Season</h3>
												<?php
												$args = array(
													'type'                     => 'travel',
													'parent'                   =>  171,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 0,
													'taxonomy'                 => 'travel_name',


												);
												$categories = get_categories($args);
												foreach ($categories as $category) {
													$option = '<input type="checkbox" name="season[]" value="'.$category->cat_ID.'"> '.$category->cat_name.'</br>';
													echo $option;
												}
												wp_reset_query();
												wp_reset_postdata();
												?>
                    </fieldset>
                    <fieldset style="margin: 20px 0" class="btn-bar">
                        <button name="submit" class="btn btn-primary-fill">Search</button>
                    </fieldset>
                </form>
            </div>
            </div>
            </section>
            <section class="article-group travel post-container sixth row">

                <?php

                    $args = array(
                            'posts_per_page' => 100,
                            'post_type' => 'travel'
                        );
                        query_posts($args);
                    if ( have_posts() ):
                        while ( have_posts() ) : the_post();
                            get_template_part( 'home-3col-loop', get_post_type() );
                        endwhile;
                    else :
                        get_template_part( 'home-3col-loop', 'empty' );
                    endif;
                    wp_reset_query();
                ?>
            </section>
            <section class="page-content seventh">
              <h1>Equipment</h1>
              <div class="more-container">
                <div class="more-btn">
									<a a href="./?page_id=23" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>
              <div class="section-blurb">
                            <?php
                                        the_block( 'gear blurb', 'type: editor' );
                                    ?>
                        </div>

                        <div class="gear-container">
                            <div class="gear-img">
                             <?php
                                the_block( 'gear image bg', 'type: editor' );
                            ?>
                            </div>
                            <div class="gear-form-overlay">

															<form class="" action="http://kite-world.co.uk/?page_id=334" method="post">

                                    <fieldset>
                                        <h3>Choose your weapon &hellip;</h3>
																				<select name="gear-type" class="col-sm-16 form-control">
																					<option value=""><?php echo esc_attr(__('All types of equipment')); ?></option>
																				<?php
																				$args = array(
																					'type'                     => 'gear',
																					//'child_of'                 => 5,
																					'parent'                   => 163,
																					'orderby'                  => 'name',
																					'order'                    => 'ASC',
																					'hide_empty'               => 0,
																					//'hierarchical'             => 1,
																					//'exclude'                  => '',
																					//'include'                  => '',
																					//'number'                   => '',
																					'taxonomy'                 => 'gear_name',
																					//'pad_counts'               => false
																				);
																				$categories = get_categories($args);
																				foreach ($categories as $category) {
																					$option = '<option value="'.$category->cat_ID.'">';
																					$option .= $category->cat_name;
																					$option .= '</option>';
																					echo $option;
																				}
																				wp_reset_query();
																				wp_reset_postdata();
																				?>
																			</select>
                                    </fieldset>
																		<fieldset class="btn-bar" style="margin: 20px 0">
																			<input type="submit" name="search" value="Select &raquo;" class="btn btn-primary-fill" />
																		</fieldset>


                                </form>

                            </div>


                        </div>


                  <section class="article-group gear post-container row">
                    <?php

                        $args = array(
                            'posts_per_page' => 8,
                            'post_type' => 'gear'
                        );
                        query_posts($args);
                        if ( have_posts() ):
                            while ( have_posts() ) : the_post();
                                get_template_part( 'home-3col-loop', get_post_type() );
                            endwhile;
                        else :
                            get_template_part( 'home-3col-loop', 'empty' );
                        endif;
                        wp_reset_query();
                    ?>
                    </section>

            </section>
            <section class="page-content eighth ">
              <h1>Readers Quote</h1>
              <div class="more-container">
                <div class="more-btn">
									<a a href="./?page_id=23" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>
              <div class="section-blurb">
                    <?php
                        the_block( 'Readers quote', 'type: editor' );
                    ?>
                </div>
            </section>

            <div class="block-out-grey">Don't miss an issue, subscribe to Kiteworld Magazine today <a class="btn btn-success">Subscribe</a></div>

            <section class="page-content video">
              <h1>Latest Video</h1>
              <div class="more-container">
                <div class="more-btn">
									<a a href="./video-home/" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>
                <div class="row">
                    <?php

                        $args = array(
                            'posts_per_page' => 2,
                            'post_type' => 'video'
                        );
                        query_posts($args);
                        if ( have_posts() ):
                            while ( have_posts() ) : the_post();
                                get_template_part( 'home-video-loop', get_post_type() );
                            endwhile;
                        else :
                            get_template_part( 'home-video-loop', 'empty' );
                        endif;
                        wp_reset_query();
                    ?>
                </div>

            </section>
            <section class="page-content home-featured tenth row">
              <h1>Featured Photographer</h1>
              <div class="more-container">
                <div class="more-btn">
									<a a href="./gallery-home/" class="btn btn-primary-fill" title="Read More Articles">
										See more <span class="fa fa-angle-double-right"></span>
									</a>
								</div>
              </div>
              <div class="row">
                <div class="col-md-11">
                   <?php
                        the_block( 'featured photographer', 'type: editor' );
                    ?>
                </div>

                <div class="col-md-5 ad-area-container">
                    <div class="ad-area">
                    <?php
                        the_block( 'ad area top', 'type: editor' );
                    ?>
                    </div>
                    <div class="ad-area">
                    <?php
                        the_block( 'ad area bottom', 'type: editor' );
                    ?>
                    </div>
                </div>
            </div>
            </section>

        </div>
        <div class="side-bar right-sidebar col-md-4">
            <div class="sidebar-container">
            <?php
        		if ( function_exists( 'dynamic_sidebar' ) ) :
        			dynamic_sidebar( 'right-sidebar' );
        		endif;
            ?>
            </div>
	   </div>
    </div>
    </div>

<?php get_footer(); ?>
