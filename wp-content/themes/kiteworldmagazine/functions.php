<?php
/**
 * Kite World Magazine functions file
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */


/******************************************************************************\
	Theme support, standard settings, menus and widgets
\******************************************************************************/

add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'link' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

/**
 * Print custom header styles
 * @return void
 */

function kiteworldmagazine_custom_header() {
	$styles = '';
	if ( $color = get_header_textcolor() ) {
		echo '<style type="text/css"> ' .
				'.site-header .logo .blog-name, .site-header .logo .blog-description {' .
					'color: #' . $color . ';' .
				'}' .
			 '</style>';
	}
}
add_action( 'wp_head', 'kiteworldmagazine_custom_header', 11 );

$custom_bg_args = array(
	'default-color' => 'fba919',
	'default-image' => '',
);
add_theme_support( 'custom-background', $custom_bg_args );

register_nav_menu( 'main-menu', __( 'Your sites main menu', 'kiteworldmagazine' ) );

if ( function_exists( 'register_sidebars' ) ) {
	register_sidebar(
		array(
			'id' => 'home-sidebar',
			'name' => __( 'Home widgets', 'kiteworldmagazine' ),
			'description' => __( 'Shows on home page', 'kiteworldmagazine' )
		)
	);

	register_sidebar(
		array(
			'id' => 'footer-sidebar',
			'name' => __( 'Footer widgets', 'kiteworldmagazine' ),
			'description' => __( 'Shows in the sites footer', 'kiteworldmagazine' )
		)
	);

	register_sidebar(
	array(
	'id' => 'right-sidebar',
	'name' => __( 'Right Side Bar', 'kiteworldmagazine' ),
	'description' => __( 'Shows adverts on right', 'kiteworldmagazine' )
	)
	);
	register_sidebar(
	array(
	'id' => 'left-sidebar',
	'name' => __( 'Left Side Bar', 'kiteworldmagazine' ),
	'description' => __( 'Shows elements on left', 'kiteworldmagazine' )
	)
	);
}

/***if ( ! isset( $content_width ) ) $content_width = 650; redfine for galleries**/
if ( ! isset( $content_width ) )
$content_width = 930;
/**
 * Include editor stylesheets
 * @return void
 */
function kiteworldmagazine_editor_style() {
    add_editor_style( 'css/wp-editor-style.css' );
}
add_action( 'init', 'kiteworldmagazine_editor_style' );


/******************************************************************************\
	Scripts and Styles
\******************************************************************************/

/**
 * Enqueue kiteworldmagazine scripts
 * @return void
 */
function kiteworldmagazine_enqueue_scripts() {
	wp_enqueue_style( 'kiteworldmagazine-styles', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0', true );
    wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', array(), '1.0', true );
	wp_enqueue_script( 'default-scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0', true );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'kiteworldmagazine_enqueue_scripts' );


/******************************************************************************\
	Content functions
\******************************************************************************/

/**
 * Displays meta information for a post
 * @return void
 */
function kiteworldmagazine_post_meta() {
	if ( get_post_type() == 'post' ) {
		echo sprintf(
			__( 'Posted %s in %s%s by %s. ', 'kiteworldmagazine' ),
			get_the_time( get_option( 'date_format' ) ),
			get_the_category_list( ', ' ),
			get_the_tag_list( __( ', <b>Tags</b>: ', 'kiteworldmagazine' ), ', ' ),
			get_the_author_link()
		);
	}
	edit_post_link( __( ' (edit)', 'kiteworldmagazine' ), '<span class="edit-link">', '</span>' );
}
function custom_excerpt_length( $length ) {
    return 15;
}

function get_excerpt($count){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, $count);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = $excerpt.'...';
return $excerpt;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Magazine
function custom_post_magazine() {
	$labels = array(
		'name'               => _x( 'Magazine Articles', 'post type general name' ),
		'singular_name'      => _x( 'Article', 'post type singular name' ),
		'add_new'            => _x( 'Add To Magazine', 'magazine' ),
		'add_new_item'       => __( 'Add New Magazine Article' ),
		'edit_item'          => __( 'Edit Magazine Article' ),
		'new_item'           => __( 'New Magazine Article' ),
		'all_items'          => __( 'All Magazine' ),
		'view_item'          => __( 'View Magazine Articles' ),
		'search_items'       => __( 'Search Magazine Articles' ),
		'not_found'          => __( 'No magazine articles found' ),
		'not_found_in_trash' => __( 'No articles found in the Trash' ),
		'parent_item_colon'  => 'Posts',
		'menu_name'          => 'Magazine'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the magazine articles data',
		'public'        => true,
	        'menu_position' => 30,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' , 'tags'),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'magazine', 'with_front' => true ),
	);
	register_post_type( 'magazine', $args );
	flush_rewrite_rules( false );
}
function taxonomies_magazine() {
	$labels = array(
		'name'              => _x( 'Magazine Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Magazine', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Magazine Categories' ),
		'all_items'         => __( 'All Magazine Categories' ),
		'parent_item'       => __( 'Parent Magazine Category' ),
		'parent_item_colon' => __( 'Parent Magazine Category:' ),
		'edit_item'         => __( 'Edit Magazine Category' ),
		'update_item'       => __( 'Update Magazine Category' ),
		'add_new_item'      => __( 'Add New Magazine Category' ),
		'new_item_name'     => __( 'New Magazine Category' ),
		'menu_name'         => __( 'Magazine Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'has_archive'   => true,
	);
	register_taxonomy( 'magazine_name', 'magazine', $args );
}

// News
function custom_post_news() {
	$labels = array(
		'name'               => _x( 'News Items', 'post type general name' ),
		'singular_name'      => _x( 'News', 'post type singular name' ),
		'add_new'            => _x( 'Add New News', 'news' ),
		'add_new_item'       => __( 'Add New News Item' ),
		'edit_item'          => __( 'Edit News Item' ),
		'new_item'           => __( 'New News Item' ),
		'all_items'          => __( 'All News' ),
		'view_item'          => __( 'View News' ),
		'search_items'       => __( 'Search News Items' ),
		'not_found'          => __( 'No news items found' ),
		'not_found_in_trash' => __( 'No news items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'News'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the magazine articles data',
		'public'        => true,
	        'menu_position' => 30,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'news', 'with_front' => true ),
	);
	register_post_type( 'news', $args );
	flush_rewrite_rules( false );
}
function taxonomies_news() {
	$labels = array(
		'name'              => _x( 'News Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'News', 'taxonomy singular name' ),
		'search_items'      => __( 'Search News Categories' ),
		'all_items'         => __( 'All News Categories' ),
		'parent_item'       => __( 'Parent News Category' ),
		'parent_item_colon' => __( 'Parent News Category:' ),
		'edit_item'         => __( 'Edit News Category' ),
		'update_item'       => __( 'Update News Category' ),
		'add_new_item'      => __( 'Add New News Category' ),
		'new_item_name'     => __( 'New News Category' ),
		'menu_name'         => __( 'News Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'news_name', 'news', $args );
}

// Gear
function custom_post_gear() {
	$labels = array(
		'name'               => _x( 'Gear Items', 'post type general name' ),
		'singular_name'      => _x( 'Gear', 'post type singular name' ),
		'add_new'            => _x( 'Add New Gear', 'gear' ),
		'add_new_item'       => __( 'Add New Gear Item' ),
		'edit_item'          => __( 'Edit Gear Item' ),
		'new_item'           => __( 'New Gear Item' ),
		'all_items'          => __( 'All Gear' ),
		'view_item'          => __( 'View Gear' ),
		'search_items'       => __( 'Search Gear' ),
		'not_found'          => __( 'No gear items found' ),
		'not_found_in_trash' => __( 'No gear items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Gear'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the gear data',
		'public'        => true,
	        'menu_position' => 30,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'gear', 'with_front' => true ),
	);
	register_post_type( 'gear', $args );
	flush_rewrite_rules( false );
}
function taxonomies_gear() {
	$labels = array(
		'name'              => _x( 'Gear Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gear', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Gear Categories' ),
		'all_items'         => __( 'All Gear Categories' ),
		'parent_item'       => __( 'Parent Gear Category' ),
		'parent_item_colon' => __( 'Parent Gear Category:' ),
		'edit_item'         => __( 'Edit Gear Category' ),
		'update_item'       => __( 'Update Gear Category' ),
		'add_new_item'      => __( 'Add New Gear Category' ),
		'new_item_name'     => __( 'New Gear Category' ),
		'menu_name'         => __( 'Gear Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'gear_name', 'gear', $args );
}

// Travel
function custom_post_travel() {
	$labels = array(
		'name'               => _x( 'Travel Items', 'post type general name' ),
		'singular_name'      => _x( 'Travel', 'post type singular name' ),
		'add_new'            => _x( 'Add New Travel', 'travel' ),
		'add_new_item'       => __( 'Add New Travel Item' ),
		'edit_item'          => __( 'Edit Travel Item' ),
		'new_item'           => __( 'New Travel Item' ),
		'all_items'          => __( 'All Travel' ),
		'view_item'          => __( 'View Travel' ),
		'search_items'       => __( 'Search Travel Items' ),
		'not_found'          => __( 'No travel items found' ),
		'not_found_in_trash' => __( 'No travel items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Travel'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the magazine articles data',
		'public'        => true,
	        'menu_position' => 30,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'travel', 'with_front' => true ),
	);
	register_post_type( 'travel', $args );
	flush_rewrite_rules( false );
}
function taxonomies_travel() {
	$labels = array(
		'name'              => _x( 'Travel Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Travel', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Travel Categories' ),
		'all_items'         => __( 'All Travel Categories' ),
		'parent_item'       => __( 'Parent Travel Category' ),
		'parent_item_colon' => __( 'Parent Travel Category:' ),
		'edit_item'         => __( 'Edit Travel Category' ),
		'update_item'       => __( 'Update Travel Category' ),
		'add_new_item'      => __( 'Add New Travel Category' ),
		'new_item_name'     => __( 'New Travel Category' ),
		'menu_name'         => __( 'Travel Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'travel_name', 'travel', $args );
}

// Technique
function custom_post_technique() {
	$labels = array(
		'name'               => _x( 'Technique Items', 'post type general name' ),
		'singular_name'      => _x( 'Techniques', 'post type singular name' ),
		'add_new'            => _x( 'Add New Technique', 'technique' ),
		'add_new_item'       => __( 'Add New Technique Item' ),
		'edit_item'          => __( 'Edit Technique Item' ),
		'new_item'           => __( 'New Technique Item' ),
		'all_items'          => __( 'All Techniques' ),
		'view_item'          => __( 'View Techiques' ),
		'search_items'       => __( 'Search Techniques' ),
		'not_found'          => __( 'No techniques found' ),
		'not_found_in_trash' => __( 'No techniques found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Technique'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the techniques data',
		'public'        => true,
	        'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' => array( 'technique' => 'zombies', 'with_front' => true ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_post_type( 'technique', $args );
	flush_rewrite_rules( false );
}
function taxonomies_technique() {
	$labels = array(
		'name'              => _x( 'Technique Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Techniques', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Technique Categories' ),
		'all_items'         => __( 'All Technique Categories' ),
		'parent_item'       => __( 'Parent Technique Category' ),
		'parent_item_colon' => __( 'Parent Technique Category:' ),
		'edit_item'         => __( 'Edit Technique Category' ),
		'update_item'       => __( 'Update Technique Category' ),
		'add_new_item'      => __( 'Add New Technique Category' ),
		'new_item_name'     => __( 'New Technique Category' ),
		'menu_name'         => __( 'Technique Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'technique_name', 'technique', $args );
}

// Features
function custom_post_feature() {
	$labels = array(
		'name'               => _x( 'Feature Items', 'post type general name' ),
		'singular_name'      => _x( 'Features', 'post type singular name' ),
		'add_new'            => _x( 'Add New Feature', 'feature' ),
		'add_new_item'       => __( 'Add New Feature Item' ),
		'edit_item'          => __( 'Edit Feature Item' ),
		'new_item'           => __( 'New Feature Item' ),
		'all_items'          => __( 'All Features' ),
		'view_item'          => __( 'View Features' ),
		'search_items'       => __( 'Search Features' ),
		'not_found'          => __( 'No features found' ),
		'not_found_in_trash' => __( 'No features found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Features'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the features data',
		'public'        => true,
	        'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'feature', 'with_front' => true ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_post_type( 'feature', $args );
	flush_rewrite_rules( false );
}
function taxonomies_feature() {
	$labels = array(
		'name'              => _x( 'Feature Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Features', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Feature Categories' ),
		'all_items'         => __( 'All Feature Categories' ),
		'parent_item'       => __( 'Parent Feature Category' ),
		'parent_item_colon' => __( 'Parent Feature Category:' ),
		'edit_item'         => __( 'Edit Feature Category' ),
		'update_item'       => __( 'Update Feature Category' ),
		'add_new_item'      => __( 'Add New Feature Category' ),
		'new_item_name'     => __( 'New Feature Category' ),
		'menu_name'         => __( 'Features Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'feature_name', 'feature', $args );
}

// Galleries
function custom_post_gallery() {
	$labels = array(
		'name'               => _x( 'Gallery Items', 'post type general name' ),
		'singular_name'      => _x( 'Gallery', 'post type singular name' ),
		'add_new'            => _x( 'Add New Gallery', 'gallery' ),
		'add_new_item'       => __( 'Add New Gallery Item' ),
		'edit_item'          => __( 'Edit Gallery Item' ),
		'new_item'           => __( 'New Gallery Item' ),
		'all_items'          => __( 'All Galleries' ),
		'view_item'          => __( 'View Galleries' ),
		'search_items'       => __( 'Search Galleries' ),
		'not_found'          => __( 'No galleries found' ),
		'not_found_in_trash' => __( 'No galleries found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Gallery'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the galleries data',
		'public'        => true,
	        'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'gallery', 'with_front' => true ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_post_type( 'gallery', $args );
	flush_rewrite_rules( false );
}
function taxonomies_gallery() {
	$labels = array(
		'name'              => _x( 'Gallery Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Galleries', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Gallery Categories' ),
		'all_items'         => __( 'All Gallery Categories' ),
		'parent_item'       => __( 'Parent Gallery Category' ),
		'parent_item_colon' => __( 'Parent Gallery Category:' ),
		'edit_item'         => __( 'Edit Gallery Category' ),
		'update_item'       => __( 'Update Gallery Category' ),
		'add_new_item'      => __( 'Add New Gallery Category' ),
		'new_item_name'     => __( 'New Gallery Category' ),
		'menu_name'         => __( 'Gallery Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'gallery_name', 'gallery', $args );
}

// Videos
function custom_post_videos() {
	$labels = array(
		'name'               => _x( 'Video Items', 'post type general name' ),
		'singular_name'      => _x( 'Video', 'post type singular name' ),
		'add_new'            => _x( 'Add New Video', 'video' ),
		'add_new_item'       => __( 'Add New Video Item' ),
		'edit_item'          => __( 'Edit Video Item' ),
		'new_item'           => __( 'New Video Item' ),
		'all_items'          => __( 'All Videos' ),
		'view_item'          => __( 'View Videos' ),
		'search_items'       => __( 'Search Videos' ),
		'not_found'          => __( 'No videos found' ),
		'not_found_in_trash' => __( 'No videos found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Videos'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the videos data',
		'public'        => true,
	        'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'video', 'with_front' => true ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_post_type( 'video', $args );
	flush_rewrite_rules( false );
}
function taxonomies_videos() {
	$labels = array(
		'name'              => _x( 'Video Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Videos', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Video Categories' ),
		'all_items'         => __( 'All Video Categories' ),
		'parent_item'       => __( 'Parent Video Category' ),
		'parent_item_colon' => __( 'Parent Video Category:' ),
		'edit_item'         => __( 'Edit Video Category' ),
		'update_item'       => __( 'Update Video Category' ),
		'add_new_item'      => __( 'Add New Video Category' ),
		'new_item_name'     => __( 'New Video Category' ),
		'menu_name'         => __( 'Video Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'video_name', 'video', $args );
}

// Kiteshow
function custom_post_kiteshow() {
	$labels = array(
		'name'               => _x( 'Kite Show Items', 'post type general name' ),
		'singular_name'      => _x( 'Kite Show', 'post type singular name' ),
		'add_new'            => _x( 'Add New Kite Show', 'kiteshow' ),
		'add_new_item'       => __( 'Add New Kite Show Item' ),
		'edit_item'          => __( 'Edit Kite Show Item' ),
		'new_item'           => __( 'New Kite Show Item' ),
		'all_items'          => __( 'All Kite Show' ),
		'view_item'          => __( 'View Kite Show' ),
		'search_items'       => __( 'Search Kite Show' ),
		'not_found'          => __( 'No Kite Show items found' ),
		'not_found_in_trash' => __( 'No Kite Show items found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Kite Show'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the Kite Show data',
		'public'        => true,
		'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' => array( 'slug' => 'kiteshow', 'with_front' => true ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_post_type( 'kiteshow', $args );
	flush_rewrite_rules( false );
}
function taxonomies_kiteshow() {
	$labels = array(
		'name'              => _x( 'Kite Show Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Kite Show', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Kite Show Categories' ),
		'all_items'         => __( 'All Kite Show Categories' ),
		'parent_item'       => __( 'Parent Kite Show Category' ),
		'parent_item_colon' => __( 'Parent Kite Show Category:' ),
		'edit_item'         => __( 'Edit Kite Show Category' ),
		'update_item'       => __( 'Update Kite Show Category' ),
		'add_new_item'      => __( 'Add New Kite Show Category' ),
		'new_item_name'     => __( 'New Kite Show Category' ),
		'menu_name'         => __( 'Kite Show Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'tags' ),
	);
	register_taxonomy( 'kiteshow_name', 'kiteshow', $args );
}

// Register post types
add_action( 'init', 'custom_post_magazine' );
add_action( 'init', 'custom_post_news' );
add_action( 'init', 'custom_post_gear' );
add_action( 'init', 'custom_post_travel' );
add_action( 'init', 'custom_post_technique' );
add_action( 'init', 'custom_post_feature' );
add_action( 'init', 'custom_post_gallery' );
add_action( 'init', 'custom_post_videos' );
add_action( 'init', 'custom_post_kiteshow' );

// Register taxonomy categories
add_action( 'init', 'taxonomies_magazine', 0 );
add_action( 'init', 'taxonomies_news', 0 );
add_action( 'init', 'taxonomies_gear', 0 );
add_action( 'init', 'taxonomies_travel', 0 );
add_action( 'init', 'taxonomies_technique', 0 );
add_action( 'init', 'taxonomies_feature', 0 );
add_action( 'init', 'taxonomies_gallery', 0 );
add_action( 'init', 'taxonomies_videos', 0 );
add_action( 'init', 'taxonomies_kiteshow', 0 );


// Adding extra box to posts
add_action( 'add_meta_boxes', 'kiteworld_param_meta_box_add' );
function kiteworld_param_meta_box_add() {
    add_meta_box( 'kiteworld_param_post10', 'The Lure', 'kiteworld10_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post1', 'Setup Content', 'kiteworld1_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post2', 'Weather', 'kiteworld2_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post3', 'Shops & Schools', 'kiteworld3_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post4', 'Accommodation', 'kiteworld4_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post5', 'Activities', 'kiteworld5_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post6', 'Practicalities', 'kiteworld6_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post7', 'Spare 1', 'kiteworld7_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post8', 'Spare 2', 'kiteworld8_param_post_meta_box_cb', 'travel', 'normal', 'high' );
    add_meta_box( 'kiteworld_param_post9', 'Location Ratings', 'kiteworld9_param_post_meta_box_cb', 'travel', 'normal', 'high' );
}
function kiteworld10_param_post_meta_box_cb( $post )
{
  $values = get_post_custom( $post->ID );
  if ( isset( $values['kiteworld_lure'] ) ) {
    $kiteworld1_meta_description_text = esc_attr( $values['kiteworld_lure'][0] );
  }
  wp_nonce_field( 'meta_box_nonce', 'meta_box_nonce' );

  ?>
  <table class="form-table">
    <tr valign="top">
      <?php
      $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_lure", "editor_class" => "post_editor_custom");
      wp_editor($kiteworld1_meta_description_text, "my_editor_10", $args);
      ?>
    </tr>
  </table>

  <?php
} // close m_param_post_meta_box_cb function
function kiteworld1_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_setup'] ) ) {
        $kiteworld1_meta_description_text = esc_attr( $values['kiteworld_setup'][0] );
    }
    wp_nonce_field( 'meta_box_nonce', 'meta_box_nonce' );

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_setup", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld1_meta_description_text, "my_editor_1", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function

//
function kiteworld2_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_weather'] ) ) {
        $kiteworld2_meta_description_text = esc_attr( $values['kiteworld_weather'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_weather", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld2_meta_description_text, "my_editor_2", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function

//
function kiteworld3_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_shops'] ) ) {
        $kiteworld3_meta_description_text = esc_attr( $values['kiteworld_shops'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_shops", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld3_meta_description_text, "my_editor_3", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function


//
function kiteworld4_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_accommodation'] ) ) {
        $kiteworld4_meta_description_text = esc_attr( $values['kiteworld_accommodation'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_accommodation", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld4_meta_description_text, "my_editor_4", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function


//
function kiteworld5_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_activities'] ) ) {
        $kiteworld5_meta_description_text = esc_attr( $values['kiteworld_activities'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_activities", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld5_meta_description_text, "my_editor_5", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function

//
function kiteworld6_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_practicalities'] ) ) {
        $kiteworld6_meta_description_text = esc_attr( $values['kiteworld_practicalities'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_practicalities", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld6_meta_description_text, "my_editor_6", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function


//
function kiteworld7_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_spare1'] ) ) {
        $kiteworld7_meta_description_text = esc_attr( $values['kiteworld_spare1'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">
            <?php
            $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_spare1", "editor_class" => "post_editor_custom");
            wp_editor($kiteworld7_meta_description_text, "my_editor_7", $args);
            ?>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function


//
function kiteworld8_param_post_meta_box_cb( $post )
{
    $values = get_post_custom( $post->ID );
    if ( isset( $values['kiteworld_spare2'] ) ) {
        $kiteworld8_meta_description_text = esc_attr( $values['kiteworld_spare2'][0] );
    }

    ?>
    <table class="form-table">
        <tr valign="top">

            <td>
                <?php
                $args = array("textarea_rows" => 5, "textarea_name" => "kiteworld_spare2", "editor_class" => "post_editor_custom");
                wp_editor($kiteworld8_meta_description_text, "my_editor_8", $args);
                ?>
            </td>
        </tr>
    </table>

<?php
} // close m_param_post_meta_box_cb function

function kiteworld9_param_post_meta_box_cb( $post ) {
    $value1 = get_post_meta( $post->ID, 'kiteworld_condition_rating', true );
    $value2 = get_post_meta( $post->ID, 'kiteworld_weather_rating', true );
    ?>
    <label for="kiteworld_condition_rating"><?php _e( "Choose Condition Rating:", 'choose_value' ); ?></label>
    <br />
    <input type="radio" name="kiteworld_condition_rating" value="1" <?php checked( $value1, '1' ); ?> >1<br>
    <input type="radio" name="kiteworld_condition_rating" value="2" <?php checked( $value1, '2' ); ?> >2<br>
    <input type="radio" name="kiteworld_condition_rating" value="3" <?php checked( $value1, '3' ); ?> >3<br>
    <input type="radio" name="kiteworld_condition_rating" value="4" <?php checked( $value1, '4' ); ?> >4<br>
    <input type="radio" name="kiteworld_condition_rating" value="5" <?php checked( $value1, '5' ); ?> >5<br>

    <label for="kiteworld_condition_rating"><?php _e( "Choose Weather Rating:", 'choose_value' ); ?></label>
    <br />
    <input type="radio" name="kiteworld_weather_rating" value="1" <?php checked( $value2, '1' ); ?> >1<br>
    <input type="radio" name="kiteworld_weather_rating" value="2" <?php checked( $value2, '2' ); ?> >2<br>
    <input type="radio" name="kiteworld_weather_rating" value="3" <?php checked( $value2, '3' ); ?> >3<br>
    <input type="radio" name="kiteworld_weather_rating" value="4" <?php checked( $value2, '4' ); ?> >4<br>
    <input type="radio" name="kiteworld_weather_rating" value="5" <?php checked( $value2, '5' ); ?> >5<br>
<?php

}


add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    $allowed_post = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'p' => array()
    );
    // Make sure your data is set before trying to save it
    if( isset( $_POST['kiteworld_setup'] ) ) {
        update_post_meta( $post_id, 'kiteworld_lure', wp_kses( $_POST['kiteworld_lure'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_setup', wp_kses( $_POST['kiteworld_setup'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_weather', wp_kses( $_POST['kiteworld_weather'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_shops', wp_kses( $_POST['kiteworld_shops'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_accommodation', wp_kses( $_POST['kiteworld_accommodation'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_activities', wp_kses( $_POST['kiteworld_activities'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_practicalities', wp_kses( $_POST['kiteworld_practicalities'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_spare1', wp_kses( $_POST['kiteworld_spare1'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_spare2', wp_kses( $_POST['kiteworld_spare2'], $allowed_post ) );
        update_post_meta( $post_id, 'kiteworld_condition_rating', wp_kses( $_POST['kiteworld_condition_rating'], $allowed_post ));
        update_post_meta( $post_id, 'kiteworld_weather_rating', wp_kses( $_POST['kiteworld_weather_rating'], $allowed_post ));
    }
}
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );
