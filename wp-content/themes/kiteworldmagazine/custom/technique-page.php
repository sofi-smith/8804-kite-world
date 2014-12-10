<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World Technique Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
wp_nav_menu( array('menu' => 'technique-menu' ));
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
            <section class="article-group page-content second">
                <h1 class="section-title">Techniques</h1>
                <div class="post-container row">
                  <?php
                  $args = array(
                    'posts_per_page' => 8,
                    'post_type' => 'technique'
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
                <div class="post-container row">
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
                </div>
            </section>
            <section class="page-content fourth row">

            </section>
            <section class="page-content fifth row">

            </section>
            <section class="page-content sixth row">

            </section>
            <section class="page-content seventh row">

            </section>
            <section class="page-content eigth row">

            </section>
            <section class="page-content nineth row">

            </section>
            <section class="page-content tenth row">

            </section>
            <section class="page-content eleventh row">

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
