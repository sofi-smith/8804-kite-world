<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World News Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
wp_nav_menu( array('menu' => 'news-menu' ));
?>

    <div class="container-fluid">
      <section class="page-slider slider row">
                <?php
                    the_block( 'Slider or Search', 'type: editor' );
                ?>
     </section>

       <div class="row spacer">
        <div class="main-content-container general-listing-page col-md-12">
         
            <div class="page-ad">
                <?php
        			the_block( 'Top Ad', 'type: editor' );
        		?>
            </div>




            <section class="article-group page-content primary">
                <h1 class="section-title">Kiteworld News</h1>
                 <div class="more-container">
                    <div class="more-btn">
                      <a class="btn btn-primary-fill" title="Read More Articles">
                        See more <span class="fa fa-angle-double-right"></span>
                      </a>
                    </div>
                </div>
                <div class="post-container row">

                    <?php
                    $args = array(
                      'posts_per_page' => 8,
                      'post_type' => 'news'
                    );
                    query_posts($args);
                    if ( have_posts() ):
                      while ( have_posts() ) :
                        the_post();
                        get_template_part( 'loop', get_post_type() );
                      endwhile;
                      else :
                        get_template_part( 'loop', 'empty' );
                      endif;
                      wp_reset_query();
                            ?>
                </div>
            </section>


            <section class="article-group page-content secondary">
              <h1 class="section-title">The Pros</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="/?news_name=the-pros" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
                  <?php
                  $args = array(
                    'posts_per_page' => 8,
                    'post_type' => 'news',
                    'news_name' => 'the-pros'
                  );
                  query_posts($args);
                  if ( have_posts() ):
                    while ( have_posts() ) :
                      the_post();
                      get_template_part( 'loop', get_post_type() );
                    endwhile;
                    else :
                      get_template_part( 'loop', 'empty' );
                    endif;
                    wp_reset_query();
                          ?>
              </div>
            </section>
            <div class="block-out-grey">Don't miss an issue, subscribe to Kiteworld Magazine today
              <a class="btn btn-success">Subscribe</a>
            </div>
            <div class="page-ad">
                <?php
			        the_block( 'Middle Ad', 'type: editor' );
                ?>
            </div>

            <section class="article-group page-content third">
              <h1 class="section-title">World Tour</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="/?news_name=world-tour" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'news',
                'news_name' => 'world tour'
              );
              query_posts($args);
              if ( have_posts() ):
                while ( have_posts() ) :
                  the_post();
                  get_template_part( 'loop', get_post_type() );
                endwhile;
                else :
                  get_template_part( 'loop', 'empty' );
                endif;
                wp_reset_query();
              ?>
            </div>
          </section>
          <section class="article-group page-content fourth">
            <h1 class="section-title">Gear</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="/?news_name=equipment" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'news',
                'news_name' => 'equipment'
              );
              query_posts($args);
              if ( have_posts() ):
                while ( have_posts() ) :
                  the_post();
                  get_template_part( 'loop', get_post_type() );
                endwhile;
                else :
                  get_template_part( 'loop', 'empty' );
                endif;
                wp_reset_query();
              ?>
          </div>
        </section>
        <div class="block-out-grey">Don't miss an issue, subscribe to Kiteworld Magazine today
          <a class="btn btn-success">Subscribe</a>
        </div>

            <div class="page-ad">
                <?php
			        the_block( 'Bottom Ad', 'type: editor' );
		        ?>
            </div>

            <section class="article-group page-content fourth">
              <h1 class="section-title">Travel</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="/?news_name=travel" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
                    <?php
                    $args = array(
                      'posts_per_page' => 8,
                      'post_type' => 'news',
                      'news_name' => 'travel'
                    );
                    query_posts($args);
                    if ( have_posts() ):
                      while ( have_posts() ) :
                        the_post();
                        get_template_part( 'loop', get_post_type() );
                      endwhile;
                      else :
                        get_template_part( 'loop', 'empty' );
                      endif;
                      wp_reset_query();
                            ?>
                </div>
            </section>
            <section class="article-group page-content fifth">
              <h1 class="section-title">Events</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="?news_name=events" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
                    <?php
                    //$events_query = new WP_Query( 'category_name=Event+News&posts_per_page=8');
					          $args = array(
                        'posts_per_page' => 8,
                        'post_type' => 'news',
                        'news_name' => 'events'
                    );
                    query_posts($args);
                    if ( have_posts() ):
                        while ( have_posts() ) : the_post();
                            get_template_part( 'loop', get_post_type() );
                        endwhile;
                    else :
                        get_template_part( 'loop', 'empty' );
                    endif;
                    wp_reset_query();
                    ?>
                </div>

            </section>
             <section class="article-group page-content sixth">
              <h1 class="section-title">Clinics</h1>
              <div class="more-container">
                <div class="more-btn">
                  <a href="?news_name=clinics" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
              </div>
              <div class="post-container row">
                    <?php
                    //$events_query = new WP_Query( 'category_name=Event+News&posts_per_page=8');
                    $args = array(
                        'posts_per_page' => 8,
                        'post_type' => 'news',
                        'news_name' => 'clinics'
                    );
                    query_posts($args);
                    if ( have_posts() ):
                        while ( have_posts() ) : the_post();
                            get_template_part( 'loop', get_post_type() );
                        endwhile;
                    else :
                        get_template_part( 'loop', 'empty' );
                    endif;
                    wp_reset_query();
                    ?>
                </div>

            </section>
            <section class="page-content seventh row">

            </section>
            <section class="page-content eigth row">

            </section>
            <section class="page-content nineth row">

            </section>
            <section class="page-content tenth row">

            </section>
            <div class="page-ad">
                <?php
        			the_block( 'Footer Ad', 'type: editor' );
        		?>
            </div>
        </div><!--END OF MAIN CONTENT CONTAINER-->

<!--SIDE BAR-->
            <div class="side-bar right-widget col-md-4">
                <div class="sidebar-container">

                    <?php
            		if ( function_exists( 'dynamic_sidebar' ) ) :
            			dynamic_sidebar( 'right-sidebar' );
            		endif;
                    ?>
                </div>
	       </div>
<!--END OF SIDEBAR-->
    </div>

    </div><!--end of container-fluid-->


<?php get_footer(); ?>
