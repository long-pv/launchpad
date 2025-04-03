<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package launch-pad
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="container_full_screen">
		<header class="header" id="header">
			Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci accusamus illum quae, reprehenderit eius laborum eveniet nulla veritatis provident non repudiandae, vero dolorem. Quidem provident quis error ipsam similique natus!
		</header>

		<div class="sidebar_left">
			<?php get_template_part('template-parts/sidebar_menu'); ?>
		</div>