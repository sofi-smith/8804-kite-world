<?php
/**
 * Kite World Magazine template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-block col-sm-8 col-lg-4'); ?> >
    <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 100,100 ), false, '' );?>
        <div class="post-image" style="background: url(<?php echo $src[0]; ?>) no-repeat center;background-size: cover;height:200px;"></div>
        <div class="post-info-container">
            <h2 class="post-title"><?php
                if ( is_singular() ) :
                    the_title();
                else : ?>
                    <?php
                    the_title(); ?>
                <?php

                endif; ?>
            </h2>
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 100,100 ), false, '' );?>
            <div class="post-content" >
                <?php echo get_excerpt(80); ?>
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
    </a>
</article>
</article>
