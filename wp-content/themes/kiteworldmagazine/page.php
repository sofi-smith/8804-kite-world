<?php
/**
 * Kite World Magazine template for displaying Pages
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header(); ?>
<div class="container-fluid">
	<section class="page-slider slider row">
                <?php
                    the_block( 'Slider or Search', 'type: editor' );
                ?>
            </section>
	<div class="row spacer">
	<div class="main-content-container general-article col-md-12">

	<section class="primary" role="main">


		<?php
			if ( have_posts() ) : the_post();

				get_template_part( 'loop' ); ?>

				<aside class="post-aside"><?php

					wp_link_pages(
						array(
							'before'           => '<div class="linked-page-nav"><p>' . sprintf( __( '<em>%s</em> is separated in multiple parts:', 'kiteworldmagazine' ), get_the_title() ) . '<br />',
							'after'            => '</p></div>',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'pagelink'         => __( '&raquo; Part %', 'kiteworldmagazine' ),
						)
					); ?>

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
 <div class="side-bar right-widget col-md-4">
        <div class="sidebar-container">
        <?php if ( function_exists( 'dynamic_sidebar' ) ) : dynamic_sidebar( 'right-sidebar' ); endif; ?>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>