<?php
/**
 * Kite World Magazine template for displaying the Front-Page
 * Template Name: List Page - Right Bar
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
wp_nav_menu( array('menu' => 'magazine-menu' ));
?>
    <div class="container-fluid">
        <div class="row">
        <div class="main-content-container general-listing-page col-md-12">
            <section class="top-box">
                <?php
        			the_block( 'Slider or Search', 'type: editor' );
        		?>
            </section>
            <div class="page-ad first">
                <?php
        			the_block( 'Top Ad', 'type: editor' );
        		?>
            </div>
            <section class="article-group page-content second">
                <?php $latest = new WP_Query('showposts=8&category_name=Digital+Magazine'); ?>
                <?php while( $latest->have_posts() ) : $latest->the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </section>

            <section class="article-group page-content third">

                <div class="post-container row">
                <?php

                ?>
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