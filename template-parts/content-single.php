<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elegance
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		if ( has_post_thumbnail() ) {
			printf( '<div class="hero-image">' . the_post_thumbnail('elegance-hero-image') .	'</div>');
		}
	?>

	<header class="entry-header">
		<?php

		$categories_list = get_the_category_list( esc_html__( ', ', 'elegance' ) );
		if ( $categories_list && elegance_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( ' %1$s', 'elegance' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php elegance_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elegance' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php elegance_entry_footer(); ?>


	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

