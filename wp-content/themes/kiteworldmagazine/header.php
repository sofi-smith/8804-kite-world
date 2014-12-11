<?php
/**
 * Kite World Magazine template for displaying the header
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="viewport" content="width=device-width" />
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


	</head>
	<body <?php body_class(); ?>>
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

		<div class="site">
		<div class="container-fluid">

			<header class="site-header">
                <div class="header-decorative">
                <div class="row">
					<div class="logo-container col-xs-10">
	                <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
						<img class="logo" src="/wp-content/themes/kiteworldmagazine/images/kiteworld-logo.jpg" alt="Kiteworld Magazine">
					</a>
					</div>
					<div class="header-promo-container col-xs-6">
	 				<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
						<img class="promo-link" src="/wp-content/themes/kiteworldmagazine/images/subscribe-img.jpg" alt="Kiteworld Magazine">
					</a>
					</div>
				</div>
				</div>

			</div>
<div class="nav-trace">
			<nav class="navbar navbar-default" role="navigation">

			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>

			    </div>

		        <?php
		            wp_nav_menu( array(
		                'menu'              => 'primary',
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'div',
		                'container_class'   => 'collapse navbar-collapse',
		        		'container_id'      => 'navbar-collapse',
		                'menu_class'        => 'nav navbar-nav',
						'items_wrap' => '<ul class="%2$s">%3$s</ul>',
						'theme_location' => 'main-menu',
						'fallback_cb' => '__return_false',
								)
							); ?>
				</nav>
			</div>
			</header>
