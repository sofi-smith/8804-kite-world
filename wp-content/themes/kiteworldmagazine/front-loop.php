<?php
/**
 * Kiteworld Magazine template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage Kiteworld Magazine
 * @since Kiteworld Magazine 1.0
 */
?>
<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="col-md-2">

	<h2 class="post-title"><?php

		if ( is_singular() ) :
			the_title();
		else : ?>

			<?php
				the_title(); ?>
			<?php

		endif; ?>

	</h2>


	<div class="post-content">
        <!--
        <?php

		if ( '' != get_the_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?><?php
		endif; ?>
-->



		<?php
			wp_link_pages(
				array(
					'before'           => '<div class="linked-page-nav"><p>'. __( 'This article has more parts: ', 'kiteworldmagazine' ),
					'after'            => '</p></div>',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'pagelink'         => __( '&lt;%&gt;', 'kiteworldmagazine' ),
				)
			);
		?>

	</div>

</article>
    </a>