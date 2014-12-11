<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World Gallery Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
wp_nav_menu( array('menu' => 'gallery-menu' ));
?>
<div class="container-fluid">
        <section class="page-slider slider row">
                <?php
                    the_block( 'Slider or Search', 'type: editor' );
                ?>
            </section>
       <div class="row spacer">
        <div class="main-content-container general-listing-page col-md-12">

            <div class="page-ad first">
                <?php
			the_block( 'Top Ad', 'type: editor' );
		?>
            </div>

            <section class="artcile-group page-content second">
                <h1 class="section-title">Lens Galleries</h1>
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
                    'post_type' => 'gallery',
                    'gallery_name' => 'lens-master'
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

            <section class="article-group page-content third">
              <h1 class="section-title">Readers Galleries</h1>
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
                  'post_type' => 'gallery',
                  'gallery_name' => 'readers-gallery'
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
                <h1 class="section-title">Featured</h1>
                <div class="post-container">
                    <?php

                    $args = array(
                        'post_type' => array('news','gear','travel','feature','gallery','magazine','technique','video'),
                        'posts_per_page' => 8,
                        'meta_key' => 'featured',
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
            <section class="page-content fifth ">

            </section>
            <section class="page-content sixth ">

            </section>
            <section class="page-content seventh ">

            </section>
            <section class="page-content eigth ">

            </section>
            <section class="page-content nineth ">

            </section>
            <section class="page-content tenth ">

            </section>
            <section class="page-content eleventh ">

            </section>
            <div class="page-ad twelfth">

            </div>
        </div>
        <div class="side-bar right-widget col-md-4">
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
