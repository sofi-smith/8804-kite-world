<?php
/**
 * Kite World Magazine template for displaying Archives
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */

get_header();

		if ( get_post_type() == 'magazine' ) :
			wp_nav_menu( array('menu' => 'magazine-menu' ));
		elseif (get_post_type() == 'news') :
			wp_nav_menu( array('menu' => 'news-menu' ));
		elseif (get_post_type() == 'technique') :
			wp_nav_menu( array('menu' => 'technique-menu' ));
		elseif (get_post_type() == 'feature') :
			wp_nav_menu( array('menu' => 'fetaure-menu' ));
		elseif (get_post_type() == 'gallery') :
			wp_nav_menu( array('menu' => 'gallery-menu' ));
		elseif (get_post_type() == 'video') :
			wp_nav_menu( array('menu' => 'video-menu' ));
		endif;
?>

<div class="container-fluid">
    <div class="row spacer">
        <div class="main-content-container general-listing-page col-md-12">

	<section class=" primary" role="main">

		<?php if ( have_posts() ) : ?>

			<h1 class="archive-title">
				<?php
					if ( is_category() ):
						printf( __( 'Category Archives: %s', 'kiteworldmagazine' ), single_cat_title( '', false ) );

					elseif ( is_tag() ):
						printf( __( 'Tag Archives: %s', 'kiteworldmagazine' ), single_tag_title( '', false ) );

					elseif ( is_tax() ):
						$term     = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
						printf( __( '%s %s', 'kiteworldmagazine' ),  $term->name , $taxonomy->labels->singular_name );

					elseif ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'kiteworldmagazine' ), get_the_date() );

					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'kiteworldmagazine' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'kiteworldmagazine' ) ) );

					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'kiteworldmagazine' ), get_the_date( _x( 'Y', 'yearly archives date format', 'kiteworldmagazine' ) ) );

					elseif ( is_author() ) : the_post();
						printf( __( 'All posts by %s', 'kiteworldmagazine' ), get_the_author() );

					else :
						_e( 'Archives', 'kiteworldmagazine' );

					endif;
				?>
			</h1><?php

			if ( is_category() || is_tag() || is_tax() ):
				$term_description = term_description();
				if ( ! empty( $term_description ) ) : ?>

					<div class="archive-description"><?php
						echo $term_description; ?>
					</div><?php

				endif;
			endif;

			if ( is_author() && get_the_author_meta( 'description' ) ) : ?>

				<div class="archive-description">
					<?php the_author_meta( 'description' ); ?>
				</div><?php

			endif;

			while ( have_posts() ) : the_post();

				get_template_part( 'loop', get_post_type() );

			endwhile;

		else :

			get_template_part( 'loop', 'empty' );

		endif; ?>

		<div class="pagination">

			<?php get_template_part( 'template-part', 'pagination' ); ?>

		</div>
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
