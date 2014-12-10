<?php
/**
 * Kite World Magazine template for displaying Search-Results-Pages
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); ?>
<div class="container-fluid">
	<div class="row spacer">
	<div class="main-content-container general-article col-md-12">
	<section class="primary" role="main"><?php

		if ( have_posts() ) : ?>

			<div class="search-title">
				<h1 ><?php printf( __( 'Search Results for: %s', 'kiteworldmagazine' ), get_search_query() ); ?></h1>

				<div class="second-search">
					<p>
						<?php _e( 'Not what you searched for? Try again with some different keywords.', 'kiteworldmagazine' ); ?>
					</p>

					<?php get_search_form(); ?>
				</div>
			</div><?php

			while ( have_posts() ) : the_post();

				get_template_part( 'loop-news', get_post_format() );

				wp_link_pages(
					array(
						'before'           => '<div class="linked-page-nav"><p>' . sprintf( __( '<em>%s</em> is separated in multiple parts:', 'kiteworldmagazine' ), get_the_title() ) . '<br />',
						'after'            => '</p></div>',
						'next_or_number'   => 'number',
						'separator'        => ' ',
						'pagelink'         => __( '&raquo; Part %', 'kiteworldmagazine' ),
					)
				);

			endwhile;

		else :

			get_template_part( 'loop', 'empty' );

		endif; ?>

		<div class="pagination">

			<?php get_template_part( 'template-part', 'pagination' ); ?>

		</div>
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