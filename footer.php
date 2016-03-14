<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegance
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<span class="sep"> / </span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'elegance' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'elegance' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'elegance' ); ?>">
				<?php
				wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
				) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>
		<div class="theme-info">
			<?php printf( esc_html__( 'Theme: %1$s %2$s', 'elegance' ), 'elegance', '
			<span class="sep"> / </span>
			Designed by:
			<a href="https://github.com/nadeemabd" rel="designer">Nadeem Abdulla</a>' ); ?>
		</div><!-- .theme-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
