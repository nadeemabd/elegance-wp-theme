<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegance
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'elegance'); ?></a>

    <header id="masthead" class="site-header" role="banner">

        <?php if ( get_header_image() ) : ?>
            <?php
            /**
             * Filter the default elegance custom header sizes attribute.
             *
             * @since Elegance 1.0
             *
             * @param string $custom_header_sizes sizes attribute
             * for Custom Header. Default '(max-width: 709px) 85vw,
             * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
             */
            $custom_header_sizes = apply_filters( 'elegance_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 95vw, (max-width: 1362px) 100vw, 1920px' );
            ?>
            <div class="header-image">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 1920) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                </a>
            </div><!-- .header-image -->
        <?php endif; // End header image check. ?>

        <div class="site-branding">
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                      rel="home"><?php bloginfo('name'); ?></a></h1>
            <p class="site-description"><?php bloginfo('description'); ?></p>
        </div><!-- .site-branding -->
        
        <?php if (!is_404()): ?>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="site-header-wrapper">
                    <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu"
                            aria-expanded="false"><?php esc_html_e('Menu', 'elegance'); ?></button>
                    <div id="site-header-menu" class="site-header-menu">
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
                    </div>
                    <div id="search-container-wrapper" class="search-container-wrapper">
                        <div class="search-toggle">
                            <div class="search-icon"><i class="fa fa-search"></i></div>
                            <a href="#search-container"
                               class="screen-reader-text"><?php _e('Search', 'elegance'); ?></a>
                        </div>
                        <div id="search-container" class="search-box-wrapper">
                            <div class="search-box">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav><!-- #site-navigation -->
        <?php endif ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">


<!--        http://localhost:8080/wordpress/wp-content/uploads/2016/03/cropped-trr-1-300x39.jpg 300w-->
<!--        http://localhost:8080/wordpress/wp-content/uploads/2016/03/cropped-trr-1-768x100.jpg 768w-->
<!--        http://localhost:8080/wordpress/wp-content/uploads/2016/03/cropped-trr-1-1024x133.jpg 1024w-->
<!--        http://localhost:8080/wordpress/wp-content/uploads/2016/03/cropped-trr-1-1280x166.jpg 1280w-->