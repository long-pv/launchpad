<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package launchpad
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function launchpad_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'launchpad_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function launchpad_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'launchpad_pingback_header' );

/**
 * Replacing underscores and dashes with spaces, capitalizing the first letter of each word, and removing spaces.
 *
 * @param $input
 * @return string
 */
function custom_name_block($input)
{
    $normalized = str_replace(['_', '-'], ' ', $input);
    $ucwords = ucwords($normalized);
    $formatted = str_replace(' ', '', $ucwords);

    return 'section' . $formatted;
}

function custom_theme_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Custom Sidebar Weather', 'launchpad' ),
        'id'            => 'custom-sidebar-weather',
        'description'   => __( 'A custom sidebar for your theme.', 'launchpad' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'custom_theme_sidebar' );
