<?php
/**
 * Kite World Magazine template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h2 class="post-title"><?php

		if ( is_singular() ) :
			the_title();
		else : ?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php
				the_title(); ?>
			</a><?php

		endif; ?>

	</h2>

	<div class="sharing">

<?php
if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 
if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
}
?>
</div>	

	

	<div class="post-content"><?php

		if ( '' != get_the_post_thumbnail() ) :

            the_post_thumbnail();

        else:
           the_content();

		endif; ?>



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