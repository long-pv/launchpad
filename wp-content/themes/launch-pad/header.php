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

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div class="container_full_screen">
		<header class="header" id="header">
			<div class="header_inner">
				<div class="header_form">
					xxx
				</div>
				<div class="header_nav">
					<div class="menu">
						<a class="menu_item menu_item_home" href="#">
							Home
						</a>
						<a class="menu_item menu_item_res" href="#">
							Resources
						</a>
						<a class="menu_item menu_item_login" href="#">
							Login
						</a>
					</div>
				</div>
			</div>
		</header>

		<div class="sidebar_left">
			<div class="top">
				<a href="<?php echo home_url(); ?>" class="top_logo">
					<?php $logo_url = get_template_directory_uri() . '/assets/images/logo_top.svg'; ?>
					<img src="<?php echo $logo_url; ?>" alt="logo">
				</a>
			</div>
			<?php get_template_part('template-parts/sidebar_menu'); ?>

			<div class="bottom">
				<a href="javascript:void(0);" class="logo">
					<?php $logo_url = get_template_directory_uri() . '/assets/images/logo_vin.svg'; ?>
					<img src="<?php echo $logo_url; ?>" alt="logo">
				</a>

				<div class="copyright">
					Copyright © 2019 VinUni. All Right Reserved.
				</div>
			</div>
		</div>