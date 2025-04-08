<?php
/**
 * clvinuni functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clvinuni
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * get currernt lang.
 */
define('LANG', function_exists('pll_current_language') ? pll_current_language('slug') : 'en');

// Sets up theme defaults and registers support for various WordPress features.
function clvinuni_setup()
{
	// theme support post
	load_theme_textdomain('clvinuni', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'clvinuni'),
			'footer-1' => esc_html__('Footer 1', 'clvinuni'),
			'footer-2' => esc_html__('Footer 2', 'clvinuni'),
			'footer-3' => esc_html__('Footer 3', 'clvinuni'),
			'menu-top' => esc_html__('Menu top', 'clvinuni'),
		)
	);
}
add_action('after_setup_theme', 'clvinuni_setup');

// Set the content width in pixels, based on the theme's design and stylesheet.
function clvinuni_content_width()
{
	$GLOBALS['content_width'] = apply_filters('clvinuni_content_width', 640);
}
add_action('after_setup_theme', 'clvinuni_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function clvinuni_scripts()
{
	wp_enqueue_style('clvinuni-style', get_stylesheet_uri(), array(), _S_VERSION);

	// add vendor js
	wp_enqueue_script('clvinuni-script-vendor', get_template_directory_uri() . '/assets/js/vendor.js', array(), _S_VERSION, true);

	// add select2
	wp_enqueue_style('clvinuni-style-select2', get_template_directory_uri() . '/assets/inc/select2/select2.css', array(), _S_VERSION);
	wp_enqueue_script('clvinuni-script-select2', get_template_directory_uri() . '/assets/inc/select2/select2.js', array(), _S_VERSION, true);

	// add fancybox
	wp_enqueue_style('clvinuni-style-fancybox', get_template_directory_uri() . '/assets/inc/fancybox/fancybox.css', array(), _S_VERSION);
	wp_enqueue_script('clvinuni-script-fancybox', get_template_directory_uri() . '/assets/inc/fancybox/fancybox.js', array(), _S_VERSION, true);

	// add wow
	wp_enqueue_style('clvinuni-style-wow', get_template_directory_uri() . '/assets/inc/wow/wow.css', array(), _S_VERSION);
	wp_enqueue_script('clvinuni-script-wow', get_template_directory_uri() . '/assets/inc/wow/wow.js', array(), _S_VERSION, true);

	//add custom main css/js
	wp_enqueue_style('clvinuni-style-main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);
	wp_enqueue_script('clvinuni-script-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

	// Add new library to Template Name - Financial Calculator
	if (is_page_template('page-financial-calculator.php')) {
		wp_enqueue_style('clvinuni-style-calculator_font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), _S_VERSION);
		wp_enqueue_style('clvinuni-style-calculator_main', get_template_directory_uri() . '/assets/inc/calculator/style.css', array(), _S_VERSION);
		wp_enqueue_script('clvinuni-script-calculator_chart', 'https://cdn.jsdelivr.net/npm/chart.js@2.8.0', array(), _S_VERSION, true);
		wp_enqueue_script('clvinuni-script-calculator_main', get_template_directory_uri() . '/assets/inc/calculator/script.js', array(), _S_VERSION, true);
	}
}
add_action('wp_enqueue_scripts', 'clvinuni_scripts');

/**
 * Functions security theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions block
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Create post type
 */
require get_template_directory() . '/inc/cpt-custom-role.php';

/**
 * Declare APIs for Vin research site
 */
require get_template_directory() . '/inc/api_vin_research.php';

/**
 * Google analytics
 */
require get_template_directory() . '/inc/google_ga.php';

/**
 * Functions people single
 */
require get_template_directory() . '/inc/func-people-single.php';

/**
 * Functions gallery 
 */
require get_template_directory() . '/inc/gallery-vin-functions.php';

/**
 * APIs for vinuni 
 */
if(is_main_site()){
	require get_template_directory() . '/inc/api_vin_functions.php';
}

/**
 * Functions gallery 
 */
require get_template_directory() . '/inc/single_post_author.php';