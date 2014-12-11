<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World Travel Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="main-content-container general-listing-page col-md-12">
            <section class="top-box ">
                <div class="search-facility travel-search">
                   <h1 class="block-out">Search Travel Destinations</h1>
                <form action="http://kite-world.co.uk/?page_id=317" method="post">
                  <div class="row">
                    <div class="col-sm-5">
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
                        	       'taxonomy'                 => 'travel_name'
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
                    </div>
                    <div  class="col-sm-5">
                        <h3>Country</h3>
                        <select  id="countries" name="country" class="form-control">
                        <option value="">All</option>
                            <?php
                                $args = array(
                                	'type'                     => 'travel',
                                	'child_of'                 => 167,
                                	'orderby'                  => 'name',
                                	'order'                    => 'ASC',
                                	'taxonomy'                 => 'category',
                                    'hierarchical'             => 1,
                                    'hide_empty'               => 0,
                                    'taxonomy'                 => 'travel_name'
                                    );
                                $categories = get_categories($args);
                                foreach ($categories as $category) {
                                    if($category->cat_ID>=168){
                                  	$option = '<option value="'.$category->cat_ID.'">';
                                	$option .= $category->cat_name;
                                	$option .= '</option>';
                                	echo $option;
                                    }
                                  }
                            wp_reset_query();
                            wp_reset_postdata();
                             ?>
                        </select>
                    </div>
                    <fieldset class="col-sm-3">
                        <h3>Style</h3>
                         <?php
                         $args = array(
                        	'type'                     => 'travel',
                        	//'child_of'                 => 6,
                        	'parent'                   => 172,
                        	'orderby'                  => 'name',
                        	'order'                    => 'ASC',
                        	'hide_empty'               => 0,
                        	//'hierarchical'             => 1,
                        	//'exclude'                  => '',
                        	//'include'                  => '',
                        	//'number'                   => '',
                        	'taxonomy'                 => 'travel_name',
                        	//'pad_counts'               => false

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
                     <fieldset class="col-sm-3">
                         <h3>Season</h3>
                         <?php
                         $args = array(
                        	'type'                     => 'travel',
                        	'parent'                   =>  171,
                        	'orderby'                  => 'name',
                        	'order'                    => 'ASC',
                        	'hide_empty'               => 0,
                        	//'hierarchical'             => 1,
                        	//'exclude'                  => '',
                        	//'include'                  => '',
                        	//'number'                   => '',
                        	'taxonomy'                 => 'travel_name',
                        	//'pad_counts'               => false

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
                   </div>
                     <fieldset>
                        <button name="submit">Search</button>
                     </fieldset>
                </form>
            </div>
        </section>
    <div class="page-ad first">
        <?php the_block( 'Top Ad', 'type: editor' ); ?>
    </div>
    <section class="page-content second">
      <h1>Know where you want to go?</h1>
        <div class="post-container row">
          <div class="post-container">
            <?php
            $args = array(
              'posts_per_page' => 8,
              'post_type' => 'travel'
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
        <section class="article-group page-content third">
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
        <?php if ( function_exists( 'dynamic_sidebar' ) ) : dynamic_sidebar( 'right-sidebar' ); endif; ?>
        </div>
    </div>
    </div>
</div>

<?php get_footer(); ?>
