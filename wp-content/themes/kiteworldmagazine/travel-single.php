<?php
/**
 * Kiteworld Magazine template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage Kiteworld Magazine
 * @since Kiteworld Magazine 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-meta"><?php
        kiteworldmagazine_post_meta(); ?>
    </div>

    <h1 class="post-title"><?php

        if ( is_singular() ) :
            the_title();
        else : ?>

            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php
            the_title(); ?>
            </a><?php

        endif; ?>

    </h1>

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

    <div class="post-content">
        <div class="travel-article-container">
        <section class="page-slider slider">
            <?php
            the_block( 'Slider or Search', 'type: editor' );
            ?>
        </section>
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav travel-nav">
                <li>The Lure</li>
                <li>The Setup</li>
                <li>Weather</li>
                <li>Shops &amp; Schools</li>
                <li>Accomodation</li>
                <li>No Wind Activities</li>
                <li>Practicalities</li>

            </ul>
        </nav>

    <div class="row">
        <section class="initial col-sm-3">
            
                <img src="wp-content/uploads/2014/12/glace-header.png">
                <?php
                 $kiteworld_wave = get_post_meta($post->ID, 'kiteworld_wave_rating', true);
                 echo $kiteworld_wave;
                ?>

            <?php

            if ( '' != get_the_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?><?php
            endif; ?>

            <?php if ( is_front_page() || is_category() || is_archive() || is_search() ) : ?>

                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'kiteworldmagazine' ); ?></a>

            <?php else : ?>

            <?php the_content( __( 'Continue reading &raquo', 'kiteworldmagazine' ) ); ?>
          
        </section>
        <section class="travel-content col-sm-13">
      
        <section class="lure">
            <?php
            $kiteworld_setup = get_post_meta($post->ID, 'kiteworld_lure', true);
            echo $kiteworld_setup;
            ?>
        </section>

            <section class="setup">
                <?php
                $kiteworld_setup = get_post_meta($post->ID, 'kiteworld_setup', true);
                echo $kiteworld_setup;
                ?>
            </section>
            <section class="weather">
                <?php
                $kiteworld_weather = get_post_meta($post->ID, 'kiteworld_weather', true);
                echo $kiteworld_weather;
                ?>
            </section>
            <section class="accommodation">
                <?php
                $kiteworld_accommodation = get_post_meta($post->ID, 'kiteworld_accommodation', true);
                echo $kiteworld_accommodation;
                ?>
            </section>
            <section class="shops">
                <?php
                $kiteworld_shops = get_post_meta($post->ID, 'kiteworld_shops', true);
                echo $kiteworld_shops;
                ?>
            </section>
       
    </section>
    </div>
</div>


        <?php endif; ?>

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

        <div class="block-out-grey">Don't miss an issue, subscribe to Kiteworld Magazine today <a class="btn btn-success" href="http://www.cross-country-int.com/subs/index.php/site/magazine?magazine_id=5" title="Subscribe to Kiteworld Magazine">Subscribe</a></div>
    </div>

</article>