<?php
/**
 * Kite World Magazine template for displaying the Front-Page
 * Template Name: Gear Results Page - Right Bar
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();

?>
<div class="container-fluid">
    <div class="row spacer">
        <div class="main-content-container general-listing-page col-md-12">
            <section class="top-box">
                 <div class="search-facility gear-search">
                  <h1 class="block-out">Filter Gear Reviews</h1>
                  <form class="" action="http://localhost:8804/?page_id=334" method="post">
                    <div class="form-items">
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
                    <div class="row">
                      <fieldset class="col-sm-8">
                          <h3>Skill Level</h3>

                          <?php
                          $args = array(
                              'type'                     => 'gear',
                              //'child_of'                 => 6,
                              'parent'                   => 164,
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
                              $option = '<input type="checkbox" name="level[]" value="'.$category->cat_ID.'"> '.$category->cat_name.'</br>';
                              echo $option;
                          }

                          wp_reset_query();
                          wp_reset_postdata();
                          ?>
                      </fieldset>
                      <fieldset class="col-sm-8">
                          <h3>Conditions</h3>

                          <?php
                          $args = array(
                              'type'                     => 'gear',
                              //'child_of'                 => 6,
                              'parent'                   => 165,
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
                              $option = '<input type="checkbox" name="condition[]" value="'.$category->cat_ID.'"> '.$category->cat_name.'</br>';
                              echo $option;
                          }
                          wp_reset_query();
                          wp_reset_postdata();
                          ?>
                      </fieldset>
                    </div>
                </div>
                   <fieldset class="btn-bar">
                        <input type="submit" name="search" value="search" />
                    </fieldset>
                  </form>
                </div>
        </section>
    <div class="page-ad first">
        <?php the_block( 'Top Ad', 'type: editor' ); ?>
    </div>
    <section class="page-content second">
            <h1>Gear Reviews</h1>

            <div class="post-container row">
            <div id="gear-results">
               <?php
               $search = null;
               if(!empty($_POST['gear-type'])):
                   $search .= $_POST['gear-type'];
               else:
                   $search .= '';
               endif;

               if(!empty($_POST['level'])):
                   $search .= ','.implode(',',$_POST['level']);
               else:
                   $search .= '';
               endif;
               if(!empty($_POST['condition'])):
                   $search .= ','.implode(',',$_POST['condition']);
               else:
                   $search .= '';
               endif;


               query_posts(
                   array(
                       'post_type' => 'gear',
                       'tax_query' => array(
                           array(
                               'taxonomy' => 'gear_name',
                               'field' => 'id',
                               'terms' => explode(',',$search)
                           )
                       )
                   )
               );
                if ( have_posts() ):
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'loop', get_post_type() );
                    endwhile;
               else :
                get_template_part( 'loop', 'empty' );
               endif;
               ?>

            </div>
            </div>

        </section>
        <section class="article-group page-content third">
            <h1 class="section-title">Featured</h1>
            <div class="post-container">
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
        <?php if ( function_exists( 'dynamic_sidebar' ) ) : dynamic_sidebar( 'right-sidebar' ); endif; ?>
        </div>
    </div>
    </div>
</div>

<?php get_footer(); ?>
