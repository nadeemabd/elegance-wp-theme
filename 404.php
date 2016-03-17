<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Elegance
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">
					<div class="error-content">
						<h1 class="error-header">404</h1>
						<p><?php esc_html_e( 'Lost? Maybe try a search? Go ', 'elegance' ); ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">home</a>
							<?php esc_html_e( ' maybe?', 'elegance' ); ?>
						</p>

						<?php get_search_form(); ?>

					</div><!-- .error-content -->
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
