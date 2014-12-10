<?php
/**
 * Kite World Magazine template for displaying Pages
 * Template name: Kite World Gear Page
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); ?>

<div class="container-fluid">
  <div class="row spacer">
    <div class="main-content-container general-listing-page col-md-12">
      <section class="top-box">

        <div class="search-facility gear-search">
          <h1 class="block-out">Filter Gear Reviews</h1>
          <form class="" action="./?page_id=334" method="post">
            <div class="form-items">
            <select name="gear" class="form-control">
              <option value=""><?php echo esc_attr(__('All types of equipment')); ?></option>
              <?php
                $args = array(
	                 'type'                     => 'gear',
                     //'child_of'                  => 163,
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
                  ?>
              </fieldset>
            </div>
          </div>
              <fieldset class="btn-bar">
                  <input type="submit" name="search" value="search"></input>
              </fieldset>
          </form>
        </div>
      </section>
      <div class="page-ad first">
        <?php
          the_block( 'Top Ad', 'type: editor' );
        ?>
      </div>
      <section class="article-group page-content second">
        <h1>Gear Reviews</h1>
          <div class="post-container row">
            <?php
            $args = array(
              'posts_per_page' => 8,
              'post_type' => 'gallery'
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
      <div class="page-ad third">
        <?php
			     the_block( 'Middle Ad', 'type: editor' );
		    ?>
      </div>
      <section class="article-group page-content fourth">
        <h1>Featured</h1>
        <div class="post-container row">
          <?php
          $args = array(
            'posts_per_page' => 8,
            'post_type' => 'gallery'
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
      <section class="page-content fifth row">

      </section>
      <section class="page-content sixth row">

      </section>
      <section class="page-content seventh row">

      </section>
      <section class="page-content eighth row">

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
