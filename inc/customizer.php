<?php
/**
 * Elegance Theme Customizer.
 *
 * @package Elegance
 */

function elegance_custom_header_and_background()
{
    $color_scheme = elegance_get_color_scheme();
    $default_background_color = trim($color_scheme[0], '#');
    $default_text_color = trim($color_scheme[3], '#');
    $default_header_textcolor = trim($color_scheme[9], '#');


    /**
     * Filter the arguments used when adding 'custom-background' support in Elegance.
     *
     * @since Elegance 1.0
     *
     * @param array $args {
     *     An array of custom-background support arguments.
     *
     * @type string $default -color Default color of the background.
     * }
     */
    add_theme_support('custom-background', apply_filters('elegance_custom_background_args', array(
        'default-color' => $default_background_color,
    )));

    /**
     * Set up the WordPress core custom header feature.
     *
     * @uses elegance_header_style()
     * @uses elegance_admin_header_style()
     * @uses elegance_admin_header_image()
     */
    add_theme_support( 'custom-header', apply_filters( 'elegance_custom_header_args', array(
        'default-color'          => $default_header_textcolor,
        'default-image'          => '',
        'width'                  => 1920,
        'height'                 => 280,
        'flex-height'            => false,
        'flex-width'             => false,
    ) ) );
}

add_action('after_setup_theme', 'elegance_custom_header_and_background');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elegance_customize_register($wp_customize)
{
    $color_scheme = elegance_get_color_scheme();

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';


    // Add color scheme setting and control.
    $wp_customize->add_setting('color_scheme', array(
        'default' => 'default',
        'sanitize_callback' => 'elegance_sanitize_color_scheme',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('color_scheme', array(
        'label' => __('Base Color Scheme', 'elegance'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => elegance_get_color_scheme_choices(),
        'priority' => 1,
    ));

    // Add page background color setting and control.
    $wp_customize->add_setting('page_background_color', array(
        'default' => $color_scheme[1],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_background_color', array(
        'label' => __('Page Background Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add menu hover background color setting and control.
    $wp_customize->add_setting('menu_hover_color', array(
        'default' => $color_scheme[2],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_hover_color', array(
        'label' => __('Menu Hover Background Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add submenu hover background color setting and control.
    $wp_customize->add_setting('submenu_hover_color', array(
        'default' => $color_scheme[3],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'submenu_hover_color', array(
        'label' => __('Submenu Hover Background Color', 'elegance'),
        'section' => 'colors',
    )));

    // Remove the core header textcolor control, as it shares the main text color.
//	$wp_customize->remove_control( 'header_textcolor' );

    // Add link color setting and control.
    $wp_customize->add_setting('link_color', array(
        'default' => $color_scheme[4],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label' => __('Link Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add main text color setting and control.
    $wp_customize->add_setting('main_text_color', array(
        'default' => $color_scheme[5],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_text_color', array(
        'label' => __('Main Text Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add secondary text color setting and control.
    $wp_customize->add_setting('secondary_text_color', array(
        'default' => $color_scheme[6],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_text_color', array(
        'label' => __('Secondary Text Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add navigation text color setting and control.
    $wp_customize->add_setting('navigation_text_color', array(
        'default' => $color_scheme[7],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navigation_text_color', array(
        'label' => __('Navigation Text Color', 'elegance'),
        'section' => 'colors',
    )));

    // Add navigation text color setting and control.
    $wp_customize->add_setting('navigation_text_hover_color', array(
        'default' => $color_scheme[8],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navigation_text_hover_color', array(
        'label' => __('Navigation Text Hover Color', 'elegance'),
        'section' => 'colors',
    )));
}

add_action('customize_register', 'elegance_customize_register', 11);

/**
 * Registers color schemes for Elegance.
 *
 * Can be filtered with {@see 'elegance_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Menu Hover Background Color
 * 4. Submenu Hover Background Color
 * 5. Link Color.
 * 6. Main Text Color.
 * 7. Secondary Text Color.
 * 8. Navigation Text Color
 * 9. Navigation Text Hover Color
 *
 * @since Elegance 1.0
 *
 * @return array An associative array of color scheme options.
 */
function elegance_get_color_schemes()
{
    /**
     * Filter the color schemes registered for use with Elegance.
     *
     * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
     *
     * @since Elegance 1.0
     *
     * @param array $schemes {
     *     Associative array of color schemes data.
     *
     * @type array $slug {
     *         Associative array of information for setting up the color scheme.
     *
     * @type string $label Color scheme label.
     * @type array $colors HEX codes for default colors prepended with a hash symbol ('#').
     *                              Colors are defined in the following order: Main background, page
     *                              background, link, main text, secondary text.
     *     }
     * }
     */
    return apply_filters('elegance_color_schemes', array(
        'default' => array(
            'label' => __('Default', 'elegance'),
            'colors' => array(
                '#2a344b',
                '#ffffff',
                '#303b57',
                '#3f4d69',
                '#45cebe',
                '#454547',
                '#7e7e7e',
                '#ffffff',
                '#ffffff',
                '#ffffff',
            ),
        ),
        'dark' => array(
            'label' => __('Dark', 'elegance'),
            'colors' => array(
                '#262626',
                '#1a1a1a',
                '#1a1a1a',
                '#111111',
                '#dd3333',
                '#e5e5e5',
                '#c1c1c1',
                '#686868',
                '#dd3333',
                '#e5e5e5',
            ),
        ),
        'light' => array(
            'label' => __('Light', 'elegance'),
            'colors' => array(
                '#ffffff',
                '#ffffff',
                '#f4f5f7',
                '#e8e9ea',
                '#f50063',
                '#4f4941',
                '#948e84',
                '#686868',
                '#4f4941',
                '#4f4941',
            ),
        ),
        'blue' => array(
            'label' => __('Blue', 'elegance'),
            'colors' => array(
                '#c8f0f1',
                '#ffffff',
                '#ffffff',
                '#f4f6f7',
                '#2eb6e4',
                '#4b5959',
                '#b1b5b6',
                '#4b5959',
                '#374443',
                '#ffffff',
            ),
        ),
        'red' => array(
            'label' => __('Red', 'elegance'),
            'colors' => array(
                '#f01f37',
                '#ffffff',
                '#d81c2f',
                '#ef5f5a',
                '#333333',
                '#333333',
                '#888888',
                '#ffffff',
                '#ffffff',
                '#ffffff',
            ),
        ),
        'green' => array(
            'label' => __('Green', 'elegance'),
            'colors' => array(
                '#dddddd',
                '#a3e948',
                '#ffffff',
                '#83e926',
                '#b40176',
                '#402b30',
                '#595959',
                '#686868',
                '#686868',
                '#333333',
            ),
        ),
    ));
}

if (!function_exists('elegance_get_color_scheme')) :
    /**
     * Retrieves the current Elegance color scheme.
     *
     * Create your own elegance_get_color_scheme() function to override in a child theme.
     *
     * @since Elegance 1.0
     *
     * @return array An associative array of either the current or default color scheme HEX values.
     */
    function elegance_get_color_scheme()
    {
        $color_scheme_option = get_theme_mod('color_scheme', 'default');
        $color_schemes = elegance_get_color_schemes();

        if (array_key_exists($color_scheme_option, $color_schemes)) {
            return array_map('strtolower', $color_schemes[$color_scheme_option]['colors']);
        }

        return array_map('strtolower', $color_schemes['default']['colors']);

    }
endif; // elegance_get_color_scheme

if (!function_exists('elegance_get_color_scheme_choices')) :
    /**
     * Retrieves an array of color scheme choices registered for Elegance.
     *
     * Create your own elegance_get_color_scheme_choices() function to override
     * in a child theme.
     *
     * @since Elegance 1.0
     *
     * @return array Array of color schemes.
     */
    function elegance_get_color_scheme_choices()
    {
        $color_schemes = elegance_get_color_schemes();
        $color_scheme_control_options = array();

        foreach ($color_schemes as $color_scheme => $value) {
            $color_scheme_control_options[$color_scheme] = $value['label'];
        }

        return $color_scheme_control_options;
    }
endif; // elegance_get_color_scheme_choices

if (!function_exists('elegance_sanitize_color_scheme')) :
    /**
     * Handles sanitization for Elegance color schemes.
     *
     * Create your own elegance_sanitize_color_scheme() function to override
     * in a child theme.
     *
     * @since Elegance 1.0
     *
     * @param string $value Color scheme name value.
     * @return string Color scheme name.
     */
    function elegance_sanitize_color_scheme($value)
    {
        $color_schemes = elegance_get_color_scheme_choices();

        if (!array_key_exists($value, $color_schemes)) {
            return 'default';
        }

        return $value;
    }
endif; // elegance_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_color_scheme_css()
{
    $color_scheme_option = get_theme_mod('color_scheme', 'default');

    // Don't do anything if the default color scheme is selected.
    if ('default' === $color_scheme_option) {
        return;
    }

    $color_scheme = elegance_get_color_scheme();

    // Convert main text hex color to rgba.
    $color_textcolor_rgb = elegance_hex2rgb($color_scheme[6]);
    $color_linkcolor_rgb = elegance_hex2rgb($color_scheme[4]);


    // If the rgba values are empty return early.
    if (empty($color_textcolor_rgb) || empty($color_linkcolor_rgb)) {
        return;
    }

    // If we get this far, we have a custom color scheme.
    $colors = array(
        'background_color' => $color_scheme[0],
        'page_background_color' => $color_scheme[1],
        'menu_hover_color' => $color_scheme[2],
        'submenu_hover_color' => $color_scheme[3],
        'link_color' => $color_scheme[4],
        'main_text_color' => $color_scheme[5],
        'secondary_text_color' => $color_scheme[6],
        'navigation_text_color' => $color_scheme[7],
        'navigation_text_hover_color' => $color_scheme[8],
        'header_textcolor' => $color_scheme[9],
        'color_link_hover_color' => vsprintf('rgba( %1$s, %2$s, %3$s, 0.8)', $color_linkcolor_rgb),
        'border_color' => vsprintf('rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb),

    );

    $color_scheme_css = elegance_get_color_scheme_css($colors);
    if ('default' !== $color_scheme_option) {
        wp_add_inline_style('elegance-style', $color_scheme_css);
    } else {
        return;
    }
}

add_action('wp_enqueue_scripts', 'elegance_color_scheme_css');

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Elegance 1.0
 */
function elegance_customize_control_js()
{
    wp_enqueue_script('color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array('customize-controls', 'iris', 'underscore', 'wp-util'), '20150926', true);
    wp_localize_script('color-scheme-control', 'colorScheme', elegance_get_color_schemes());
}

add_action('customize_controls_enqueue_scripts', 'elegance_customize_control_js');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elegance_customize_preview_js()
{
    wp_enqueue_script('elegance_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'elegance_customize_preview_js');

/**
 * Returns CSS for the color schemes.
 *
 * @since Elegance 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function elegance_get_color_scheme_css($colors)
{
    $colors = wp_parse_args($colors, array(
        'background_color' => '',
        'page_background_color' => '',
        'menu_hover_color' => '',
        'submenu_hover_color' => '',
        'link_color' => '',
        'main_text_color' => '',
        'secondary_text_color' => '',
        'navigation_text_color' => '',
        'navigation_text_hover_color' => '',
        'header_textcolor' => '',
        'color_link_hover_color' => '',
        'border_color' => '',
    ));

    return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	.site-branding .site-title a,
    .site-branding p {
        color: {$colors['header_textcolor']};
    }

	/* Page Background Color */
	.hentry,
	.widget,
	.post-navigation .nav-previous,
	.post-navigation .nav-next,
	.comments-area,
	.error-content,
	.pagination .nav-links {
		background-color: {$colors['page_background_color']};
	}

	.site-main #infinite-handle span {
	  border-color: {$colors['page_background_color']};
	}

	.site-main #infinite-handle span,
    .pagination .page-numbers.current,
	.page-header,
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.tagcloud a:hover,
	.tagcloud a:focus {
	  color: {$colors['page_background_color']};
	}

	/* Menu Hover Background Color */
    .main-navigation a:hover,
    .main-navigation a:focus,
    .search-toggle .search-icon:hover,
    .search-container-wrapper .search-toggle.active {
      	  background: {$colors['menu_hover_color']};
    }

	/* Link Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
    .page-header,
    .tagcloud a:hover,
	.tagcloud a:focus,
	.widget ul ul > li:hover::before,
	.widget ol ul > li:hover::before,
	.pagination .page-numbers.current,
	.menu-toggle:hover,
	.menu-toggle.toggled {
        background: {$colors['link_color']};
	}

	a:hover,
	a:focus,
	a:active,
	.site-branding .site-title a:hover,
	.widget .widget-title,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tags-links a:hover,
	.tags-links a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle.toggled::after {
		color: {$colors['link_color']};
	}

	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus {
		background: {$colors['color_link_hover_color']};
	}

	.entry-content a,
	.entry-summary a,
	.taxonomy-description a,
	.logged-in-as a,
	.comment-content a,
	.pingback .comment-body a,
	.textwidget a,
	.error-content a {
        color: {$colors['link_color']};
        border-color: {$colors['link_color']};
	}

    .entry-content a:hover,
    .entry-content a:focus,
    .entry-content a:active,
    .entry-summary a:hover,
    .entry-summary a:focus,
    .entry-summary a:active,
    .taxonomy-description a:hover,
    .taxonomy-description a:focus,
    .taxonomy-description a:active,
    .logged-in-as a:hover,
    .logged-in-as a:focus,
    .logged-in-as a:active,
    .comment-content a:hover,
    .comment-content a:focus,
    .comment-content a:active,
    .pingback .comment-body a:hover,
    .pingback .comment-body a:focus,
    .pingback .comment-body a:active,
    .textwidget a:hover,
    .textwidget a:focus,
    .textwidget a:active,
    .error-content a:hover,
    .error-content a:focus,
    .error-content a:active {
	    color: {$colors['color_link_hover_color']};
	    border-color: {$colors['color_link_hover_color']};
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.widget_rss li a:hover {
		border-color: {$colors['link_color']};
	}

	/* Main Text Color */
	body,
	a,
	a:visited,
	button,
	select,
	textarea,
	input,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	.site-footer,
	.error-content,
	.page-content,
	.menu-toggle:hover,
	.menu-toggle.toggled {
		color: {$colors['main_text_color']};
	}

	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.comments-title,
	ol.comment-list > .comment {
		border-color: {$colors['main_text_color']};
	}

	div.sharedaddy h3.sd-title::before {
        border-color: {$colors['main_text_color']} !important;
	}

	li.comment .children > li::before {
	    border-left-color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}

	blockquote,
	.post-password-form label,
	.post-navigation .meta-nav,
	.widget,
	.entry-footer,
	.sticky-post,
	.entry-caption,
	.comment-metadata,
	.comment-metadata a,
	.comment-form label,
	.comment-awaiting-moderation,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.tags-links,
	.tags-links a {
		color: {$colors['secondary_text_color']};
	}

	.contact-form label span {
	  color: {$colors['secondary_text_color']} !important;
	}


	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table th,
    table td,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	textarea,
	.post-navigation .nav-previous,
	.post-navigation .nav-next,
	.comments-title,
	.comment-navigation,
	ol.comment-list > .comment,
	.tagcloud a,
	.widget_rss li a,
	.widget_calendar caption,
	.wp-caption-text {
		border-color: {$colors['border_color']};
	}

	hr,
	code,
	.widget ul ul > li::before,
	.widget ol ul > li::before {
		background-color: {$colors['border_color']};
	}

    /* Navigation Text Colors */
	.main-navigation a,
	.search-toggle .search-icon i,
    .site-footer a,
    .menu-toggle,
    .dropdown-toggle,
    .dropdown-toggle:focus {
		color: {$colors['navigation_text_color']};
	}

    .menu-toggle {
      border-color: {$colors['navigation_text_color']};
    }

    /* Navigation Text Hover Colors */
	.main-navigation li:hover > a,
	.main-navigation li.focus > a,
	.site-footer a:hover,
	.site-footer a:focus {
		color: {$colors['navigation_text_hover_color']};
	}

	@media screen and (max-width: 899px) {
        .menu-toggle:hover,
        .menu-toggle.toggled,
        .main-navigation .sub-menu li {
             border-color: {$colors['link_color']};
        }

        .main-navigation li {
              border-color: {$colors['menu_hover_color']};
        }
    }

	@media screen and (min-width: 900px) {

        .main-navigation ul ul,
        .main-navigation li:hover > a,
        .main-navigation li.focus > a {
            background-color: {$colors['menu_hover_color']};
        }

        /* Submenu Hover Background Color */
        .main-navigation ul ul a:hover,
        .main-navigation ul ul a.focus,
        .main-navigation ul ul :hover > a,
        .main-navigation ul ul .focus > a {
            background-color: {$colors['submenu_hover_color']};
        }

	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Elegance 1.0
 */
function elegance_color_scheme_css_template()
{
    $colors = array(
        'background_color' => '{{ data.background_color }}',
        'page_background_color' => '{{ data.page_background_color }}',
        'menu_hover_color' => '{{ data.menu_hover_color }}',
        'submenu_hover_color' => '{{ data.submenu_hover_color }}',
        'link_color' => '{{ data.link_color }}',
        'main_text_color' => '{{ data.main_text_color }}',
        'secondary_text_color' => '{{ data.secondary_text_color }}',
        'navigation_text_color' => '{{ data.navigation_text_color }}',
        'navigation_text_hover_color' => '{{ data.navigation_text_hover_color }}',
        'header_textcolor' => '{{ data.header_textcolor }}',
        'color_link_hover_color' => '{{ data.color_link_hover_color }}',
        'border_color' => '{{ data.border_color }}',
    );
    ?>
    <script type="text/html" id="tmpl-elegance-color-scheme">
        <?php echo elegance_get_color_scheme_css($colors); ?>
    </script>
    <?php
}

add_action('customize_controls_print_footer_scripts', 'elegance_color_scheme_css_template');

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_page_background_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[1];
    $page_background_color = get_theme_mod('page_background_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($page_background_color === $default_color) {
        return;
    }

    $css = '
		/* Custom Page Background Color */
		.hentry,
		.widget,
		.post-navigation .nav-previous,
	    .post-navigation .nav-next,
		.comments-area,
		.error-content,
		.pagination .nav-links {
			background-color: %1$s;
		}

		.site-main #infinite-handle span {
          border-color: %1$s;
        }

        .site-main #infinite-handle span,
	    .pagination .page-numbers.current,
        .page-header,
        button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        .tagcloud a:hover,
	    .tagcloud a:focus {
          color: %1$s;
        }
	';

    wp_add_inline_style('elegance-style', sprintf($css, $page_background_color));
}

add_action('wp_enqueue_scripts', 'elegance_page_background_color_css', 11);

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_menu_hover_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[2];
    $menu_hover_color = get_theme_mod('menu_hover_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($menu_hover_color === $default_color) {
        return;
    }

    $css = '

        /* Custom Menu Hover Color */
        .main-navigation a:hover,
        .main-navigation a:focus,
        .search-toggle .search-icon:hover,
        .search-container-wrapper .search-toggle.active {
              background: %1$s;
        }

        @media screen and (max-width: 899px) {
            .main-navigation li {
                  border-color: %1$s;
            }
        }

        @media screen and (min-width: 900px) {
            .main-navigation ul ul,
            .main-navigation li:hover > a,
            .main-navigation li.focus > a {
                background-color: %1$s;
            }

		}
	';

    wp_add_inline_style('elegance-style', sprintf($css, $menu_hover_color));
}

add_action('wp_enqueue_scripts', 'elegance_menu_hover_color_css', 11);

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_submenu_hover_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[3];
    $submenu_hover_color = get_theme_mod('submenu_hover_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($submenu_hover_color === $default_color) {
        return;
    }

    $css = '
        @media screen and (min-width: 900px) {
            /* Custom Submenu Hover Color */
            .main-navigation ul ul a:hover,
            .main-navigation ul ul a.focus,
            .main-navigation ul ul :hover > a,
            .main-navigation ul ul .focus > a {
                background-color: %1$s;
            }
		}
	';

    wp_add_inline_style('elegance-style', sprintf($css, $submenu_hover_color));
}

add_action('wp_enqueue_scripts', 'elegance_submenu_hover_color_css', 11);

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_link_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[4];
    $link_color = get_theme_mod('link_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($link_color === $default_color) {
        return;
    }

    // Convert main text hex color to rgba.
    $link_color_rgb = elegance_hex2rgb($link_color);


    // If the rgba values are empty return early.
    if (empty($link_color_rgb)) {
        return;
    }

    // If we get this far, we have a custom color scheme.
    $link_hover_color = vsprintf('rgba( %1$s, %2$s, %3$s, 0.8)', $link_color_rgb);

    $css = '
		/* Custom Link Color */
		button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        .page-header,
        .tagcloud a:hover,
        .tagcloud a:focus,
        .widget ul ul > li:hover::before,
	    .widget ol ul > li:hover::before,
	    .pagination .page-numbers.current,
        .menu-toggle:hover,
	    .menu-toggle.toggled {
            background: %1$s;
        }

        a:hover,
        a:focus,
        a:active,
        .site-branding .site-title a:hover,
        .widget .widget-title,
        .post-navigation a:hover .post-title,
        .post-navigation a:focus .post-title,
        .tags-links a:hover,
	    .tags-links a:focus,
        .comment-metadata a:hover,
        .comment-metadata a:focus,
        .pingback .edit-link a:hover,
        .pingback .edit-link a:focus,
        .dropdown-toggle:hover,
        .dropdown-toggle.toggled::after {
			color: %1$s;
		}

		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus {
			background: %2$s;
		}

        .entry-content a,
        .entry-summary a,
        .taxonomy-description a,
        .logged-in-as a,
        .comment-content a,
        .pingback .comment-body a,
        .textwidget a,
        .error-content a {
            color: %1$s;
            border-color: %1$s;
        }

        .entry-content a:hover,
        .entry-content a:focus,
        .entry-content a:active,
        .entry-summary a:hover,
        .entry-summary a:focus,
        .entry-summary a:active,
        .taxonomy-description a:hover,
        .taxonomy-description a:focus,
        .taxonomy-description a:active,
        .logged-in-as a:hover,
        .logged-in-as a:focus,
        .logged-in-as a:active,
        .comment-content a:hover,
        .comment-content a:focus,
        .comment-content a:active,
        .pingback .comment-body a:hover,
        .pingback .comment-body a:focus,
        .pingback .comment-body a:active,
        .textwidget a:hover,
        .textwidget a:focus,
        .textwidget a:active,
        .error-content a:hover,
        .error-content a:focus,
        .error-content a:active {
            color: %2$s;
            border-color: %2$s;
        }


		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.widget_rss li a:hover {
			border-color: %1$s;
		}

		@media screen and (max-width: 899px) {
            .menu-toggle:hover,
            .menu-toggle.toggled,
            .main-navigation .sub-menu li {
                 border-color: %1$s;
            }
        }

		/*@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}*/
	';

    wp_add_inline_style('elegance-style', sprintf($css, $link_color, $link_hover_color));
}

add_action('wp_enqueue_scripts', 'elegance_link_color_css', 11);

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_main_text_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[5];
    $main_text_color = get_theme_mod('main_text_color', $default_color);
    $secondary_text_color = get_theme_mod('secondary_text_color', $default_color);


    // Don't do anything if the current color is the default.
    if ($main_text_color === $default_color) {
        return;
    }

    // Convert main text hex color to rgba.
    $secondary_text_color_rgb = elegance_hex2rgb($secondary_text_color);

    // If the rgba values are empty return early.
    if (empty($secondary_text_color_rgb)) {
        return;
    }

    // If we get this far, we have a custom color scheme.
    $border_color = vsprintf('rgba( %1$s, %2$s, %3$s, 0.2)', $secondary_text_color_rgb);

    $css = '
		/* Custom Main Text Color */
		body,
        a,
        a:visited,
        button,
        select,
        textarea,
		input,
        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="search"],
        input[type="tel"],
        input[type="number"],
		.site-footer,
		.error-content,
        .page-content,
        .menu-toggle:hover,
        .menu-toggle.toggled {
			color: %1$s
		}

		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
        .post-navigation .nav-previous,
        .post-navigation .nav-next,
        .comments-title,
		ol.comment-list > .comment,
		div.sharedaddy h3.sd-title::before {
			border-color: %1$s;
		}

		div.sharedaddy h3.sd-title::before {
            border-color: %1$s !important;
        }

		li.comment .children > li::before {
            border-left-color: %1$s;
        }

		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table th,
        table td,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
        .post-navigation .nav-previous,
        .post-navigation .nav-next,
        ol.comment-list > .comment,
        .comments-title,
        .comment-navigation,
		textarea,
		.tagcloud a,
		.widget_rss li a,
	    .widget_calendar caption,
	    .wp-caption-text {
			border-color: %2$s;
		}

		hr,
		code,
		.widget ul ul > li::before,
		.widget ol ul > li::before {
			background-color: %2$s;
		}
	';

    wp_add_inline_style('elegance-style', sprintf($css, $main_text_color, $border_color));
}

add_action('wp_enqueue_scripts', 'elegance_main_text_color_css', 11);

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_secondary_text_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[6];
    $secondary_text_color = get_theme_mod('secondary_text_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($secondary_text_color === $default_color) {
        return;
    }

    $css = '
		/* Custom Secondary Text Color */

		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		blockquote,
        .post-password-form label,
        .post-navigation .meta-nav,
        .widget,
        .entry-footer,
        .sticky-post,
        .entry-caption,
        .comment-metadata,
        .comment-metadata a,
        .comment-form label,
        .comment-awaiting-moderation,
        .wp-caption .wp-caption-text,
        .gallery-caption,
        .widget_calendar caption,
        .tags-links,
        .tags-links a {
			color: %1$s;
		}

		.contact-form label span {
			color: %1$s !important;
		}

	';

    wp_add_inline_style('elegance-style', sprintf($css, $secondary_text_color));
}

add_action('wp_enqueue_scripts', 'elegance_secondary_text_color_css', 11);

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_navigation_text_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[7];
    $navigation_text_color = get_theme_mod('navigation_text_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($navigation_text_color === $default_color) {
        return;
    }

    $css = '
		/* Custom Navigation Text Color */
		.main-navigation a,
		.search-toggle .search-icon i,
		.site-footer a,
		.menu-toggle,
		.dropdown-toggle,
		.dropdown-toggle:focus {
			color: %1$s;
		}

		.menu-toggle {
            border-color: %1$s;
        }
	';

    wp_add_inline_style('elegance-style', sprintf($css, $navigation_text_color));
}

add_action('wp_enqueue_scripts', 'elegance_navigation_text_color_css', 11);

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_navigation_text_hover_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[8];
    $navigation_text_hover_color = get_theme_mod('navigation_text_hover_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($navigation_text_hover_color === $default_color) {
        return;
    }

    $css = '
		/* Custom Navigation Text Hover Color */
		.main-navigation li:hover > a,
		.main-navigation li.focus > a,
		.site-footer a:hover,
	    .site-footer a:focus {
			color: %1$s;
		}
	';

    wp_add_inline_style('elegance-style', sprintf($css, $navigation_text_hover_color));
}

add_action('wp_enqueue_scripts', 'elegance_navigation_text_hover_color_css', 11);

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Elegance 1.0
 *
 * @see wp_add_inline_style()
 */
function elegance_header_text_color_css()
{
    $color_scheme = elegance_get_color_scheme();
    $default_color = $color_scheme[9];
    $header_textcolor = get_theme_mod('header_textcolor', $default_color);

    // Don't do anything if the current color is the default.
    if ($header_textcolor === $default_color) {
        return;
    }

    $css = '
		/* Custom Header Text Color */
		.site-branding .site-title a,
        .site-branding p {
            color: %1$s;
        }
	';

    wp_add_inline_style('elegance-style', sprintf($css, $header_textcolor));
}

add_action('wp_enqueue_scripts', 'elegance_header_text_color_css', 11);