<?php
/**
 * Kite World Magazine template for displaying Single-Posts
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); 
wp_nav_menu( array('menu' => 'gallery-menu' ));
?>

<div class="container-fluid">
	<div class="row spacer">
	<div class="main-content-container general-article col-md-12">
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
