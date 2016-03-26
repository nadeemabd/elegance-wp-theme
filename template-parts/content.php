<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elegance
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    // Post thumbnail.
    elegance_post_thumbnail();
    ?>

    <header class="entry-header">

        <?php if (is_sticky() && is_home() && !is_paged()) : ?>
            <div class="sticky-post-wrapper"><span class="sticky-post"><?php _e('Featured', 'elegance'); ?></span></div>
        <?php endif; ?>

        <?php

        $categories_list = get_the_category_list(esc_html__(', ', 'elegance'));
        if ($categories_list && elegance_categorized_blog()) {
            printf('<span class="cat-links">' . esc_html__(' %1$s', 'elegance') . '</span>', $categories_list); // WPCS: XSS OK.
        }

        ?>
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php elegance_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>

    </header><!-- .entry-header -->

    <div class="entry-content">

        <?php
        the_content(sprintf(
        /* translators: %s: Name of current post. */
            wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'elegance'), array('span' => array('class' => array()))),
            the_title('<span class="screen-reader-text">"', '"</span>', false)
        ));
        ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'elegance'),
            'after' => '</div>',
        ));
        ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php elegance_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
