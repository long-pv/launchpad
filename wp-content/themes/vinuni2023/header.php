<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clvinuni
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- fonts style -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700&display=swap"
		rel="stylesheet">

	<?php wp_head(); ?>

	<?php
	$google_analytics = get_field('google_analytics', 'option') ?? '';
	if ($google_analytics) {
		echo $google_analytics;
	}
	?>

	<!-- Global site tag (gtag.js) - Google Analytics - CodLUCK -->
	<?php get_ga_multisite(); ?>
	<!-- end -->

	<!-- theme general -->
	<?php
	echo custom_root_style('color_theme', 'primary');
	echo custom_root_style('pattern_banner_1', 'pattern-banner-1', true);
	echo custom_root_style('pattern_banner_2', 'pattern-banner-2', true);
	echo custom_root_style('pattern_sliders', 'pattern-sliders', true);
	echo custom_root_style('pattern_cta', 'pattern-cta', true);
	?>

</head>

<body <?php body_class(); ?>>

	<!-- header general page -->
	<header id="header" class="header">
		<div class="header__top">
			<div class="container">
				<div class="header__topInner">
					<div class="header__topInnerLeft">
						<?php
						if (has_nav_menu('menu-top')) {
							wp_nav_menu(
								array(
									'theme_location' => 'menu-top',
									'container' => 'div',
									'container_class' => 'header__menuTop',
									'depth' => 1,
								)
							);
						}
						?>
					</div>

					<div class="header__topInnerRight">
						<!-- multi language -->
						<ul class="header__lang header__lang--top">
							<?php
							pll_the_languages(
								array(
									'show_flags' => 0,
									'show_names' => 1,
									'hide_if_empty' => 0,
									'display_names_as' => 'slug',
								)
							);
							?>
						</ul>

						<!-- search icon -->
						<div class="header__search">
							<div class="header__searchIcon header__searchIcon--open"></div>
							<div class="header__searchIcon header__searchIcon--close"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header__nav">
			<div class="container">
				<div class="header__navInner">
					<a href="<?php echo home_url(); ?>" class="header__logo">
						<?php
						$logo_url = get_template_directory_uri() . '/assets/images/logo.png';
						if (get_field('logo_header', 'option')) {
							$logo_url = get_field('logo_header', 'option');
						}
						?>
						<img src="<?php echo $logo_url; ?>" alt="logo">
					</a>

					<nav class="header__menu">
						<!-- multi language -->
						<ul class="header__lang header__lang--nav">
							<?php
							pll_the_languages(
								array(
									'show_flags' => 0,
									'show_names' => 1,
									'hide_if_empty' => 0,
									'display_names_as' => 'slug',
								)
							);
							?>
						</ul>

						<!-- main menu -->
						<?php
						if (has_nav_menu('menu-1')) {
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'container' => 'div',
									'container_class' => 'header__menuInner',
									'depth' => 2,
								)
							);
						}
						?>
					</nav>

					<!-- search icon for mobile -->
					<div class="header__searchSp">
						<div class="header__searchSpIcon header__searchSpIcon--open"></div>
						<div class="header__searchSpIcon header__searchSpIcon--close"></div>
					</div>

					<!-- button toggle menu mobile -->
					<div class="header__toggle">
						<span class="header__toggleItem header__toggleItem--open"></span>
						<span class="header__toggleItem header__toggleItem--close"></span>
					</div>

					<!-- form search -->
					<form class="header__formSearch" method="get" action="<?php echo get_url_search(); ?>"
						role="search">
						<input type="text" class="header__searchInput" aria-label="search"
							aria-describedby="search-addon" name="s" placeholder="<?php _e('Search', 'clvinuni'); ?>">
						<input type="text" class="d-none" name="q">
						<button type="submit" class="header__searchBtn"></button>
					</form>
				</div>
			</div>
		</div>
	</header>
	<!-- end header -->

	<!-- main content -->
	<main class="mainBodyContent">