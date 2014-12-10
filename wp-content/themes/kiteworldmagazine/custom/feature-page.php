<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World Features Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
wp_nav_menu( array('menu' => 'features-menu' ));
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
                the_block('Top Ad', 'type: editor');
            ?>
        </div>
        <section class="article-group page-content second">
            <h1 class="section-title">Interviews</h1>
            <div class="more-container">
                <div class="more-btn">
                  <a href="/?feature_name=interview" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
            </div>
            <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'feature',
                'feature_name' => 'interview'
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
            <h1 class="section-title">Regulars</h1>
             <div class="more-container">
                <div class="more-btn">
                  <a href="/?feature_name=regular" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
            </div>
            <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'feature',
                'feature_name' => 'Regular'
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
            <h1 class="section-title">Travel </h1>
             <div class="more-container">
                <div class="more-btn">
                  <a href="/?cat=47" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
            </div>
            <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'feature',
                'feature_name' => 'Travel'
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
            <h1 class="section-title">Best of the Rest </h1>
             <div class="more-container">
                <div class="more-btn">
                  <a href="/?cat=48" class="btn btn-primary-fill" title="Read More Articles">
                    See more <span class="fa fa-angle-double-right"></span>
                  </a>
                </div>
            </div>
            <div class="post-container row">
              <?php
              $args = array(
                'posts_per_page' => 8,
                'post_type' => 'feature',
                'feature_name' => 'Other'
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


       
        <div class="page-ad twelfth">

        </div>
 </div>


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

   </div>

<?php get_footer(); ?>
