<?php
/**
 * Kite World Magazine template for displaying Single-Posts
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();
?>

<div class="container-fluid">
	<div class="row spacer">
	<div class="main-content-container general-article col-md-12">
        <section class="top-box">

            <div class="search-facility gear-search">
                <h2 class="block-out">Filter Gear Reviews</h2>
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
	<section class="primary push-right" role="main">

		<?php
			if ( have_posts() ) : the_post();

				get_template_part( 'loop', get_post_format() ); ?>

				<aside class="post-aside">

					<div class="post-links">
						<?php previous_post_link( '%link', __( '&laquo; Previous post', 'kiteworldmagazine' ) ) ?>
						<?php next_post_link( '%link', __( 'Next post &raquo;', 'kiteworldmagazine' ) ); ?>
					</div>

					<?php
						if ( comments_open() || get_comments_number() > 0 ) :
							comments_template( '', true );
						endif;
					?>

				</aside><?php

			else :

				get_template_part( 'loop', 'empty' );

			endif;
		?>

	</section>
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
