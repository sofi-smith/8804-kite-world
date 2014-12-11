<?php
/**
 * Kite World Magazine template for displaying the footer
 *
 * @package WordPress
 * @subpackage Kite World Magazine
 * @since Kite World Magazine 1.0
 */
?>

<footer>
					<div class="footer-container container-fluid">
						<div class="row">
							<div class="footer-group col-sm-3">
								<ul class="footer-links">
									<li class="footer-title">Read More</li>
									<?php
		            wp_nav_menu( array(
		                'menu'              => 'primary',
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'ul',
		                'container_class'   => 'footer-links',
		        		'container_id'      => 'footer-nav',
		                'menu_class'        => 'footer-nav',

						'theme_location' => 'main-menu',
						'fallback_cb' => '__return_false',
								)
							); ?>
								</ul>
							</div>
							<div class="footer-group col-sm-3">
								<ul class="footer-links">
									<li class="footer-title">Kiteworld Extras</li>

								</ul>
							</div>
							<div class="footer-group col-sm-3">
								<ul class="footer-links">
									<li class="footer-title">Subscribe</li>
									<p>Never miss an issue, subscribe today. Kiteworld Magazine is available across all devices!</p>
									<a class="btn btn-lg btn-success">subscribe today</a>
								</ul>
							</div>
							<div class="footer-group col-sm-3">

							</div>
							<div class="footer-group footer-details col-sm-4">
								<div class="logo-footer">
									<img src="/wp-content/themes/kiteworldmagazine/images/kiteworld-logo-green.png" alt="Kiteworld Magazine">

								</div>
								<address>
									+44 (0)1273 808601
								</address>
								<address>
									5 St Georges Place<br/>
									Brighton BN1 4GA UK
								</address>
								<address>
									<a href="mailto:sop@kiteworldmag.com">shop@kiteworldmag.com</a>
								</address>
								<ul class="social-icons">
									<li>
									<a class="footer-icon fa fa-twitter" href="https://twitter.com/kiteworldmag/" target="_blank">
										<span>Twitter</span>
									</a>
									</li>
									<li>
									<a class="footer-icon fa fa-facebook" href="https://www.facebook.com/kiteworldmagazine" target="_blank">
										<span>Facebook</span>
									</a>
									</li>
								</ul>
							</div>


						</div>
					</div>




				</footer>

			</div><!--end of site-->
		<?php wp_footer(); ?>

				<script>
		jQuery(document).ready(function() {
var stickyNavTop = jQuery('.nav-trace').offset().top;

var stickyNav = function(){
var scrollTop = jQuery(window).scrollTop();

if (scrollTop > stickyNavTop) {
    jQuery('.nav-trace').addClass('sticky');
} else {
    jQuery('.nav-trace').removeClass('sticky');
}
};

stickyNav();

jQuery(window).scroll(function() {
    stickyNav();
});
});
		</script>

		<script type='text/javascript'>
		(function (d, t) {
			var pp = d.createElement(t), s = d.getElementsByTagName(t)[0];
			pp.src = 'https://app.pageproofer.com/overlay/js/853/531';
			pp.type = 'text/javascript';
			s.parentNode.insertBefore(pp, s);
		})(document, 'script');
		</script>
	</body>
</html>
