<?php
/**
 * Kite World Magazine template for displaying an empty Loop
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */
?>

<article id="post-none" class="post empty">

	<h1 class="post-title"><?php _e( 'Nothing Found', 'kiteworldmagazine' ); ?></h1>

	<div class="post-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p>
				<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kiteworldmagazine' ), admin_url( 'post-new.php' ) ); ?>
			</p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kiteworldmagazine' ); ?>
			</p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p>
				<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kiteworldmagazine' ); ?>
			</p>

			<?php get_search_form(); ?>

		<?php endif; ?>

	</div>

</article>