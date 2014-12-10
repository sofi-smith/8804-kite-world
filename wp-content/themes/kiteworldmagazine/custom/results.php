<?php

    define('WP_USE_THEMES', false);
    if (file_exists("../../../../wp-load.php")):
        require_once('../../../../wp-load.php');
    endif;
    $arg = array(
        'category__and' => array(168)
    );
    $query = new WP_Query( $arg );
    while ( $query->have_posts() ) :
        $query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    endwhile;

