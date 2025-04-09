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
		<div class="header_pc" id="header">
			<div class="header_inner">
				<div class="header_form">
					<form action="<?php echo home_url(); ?>" class="form_search">
						<input type="text" name="s" id="search__input" value="<?php echo get_search_query(); ?>" placeholder="Enter the keywords">
						<button class="styled-link" type="submit"></button>
					</form>
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
		</div>

		<div class="header_mb">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<a href="<?php echo home_url(); ?>" class="logo">
							<?php $logo_url = get_template_directory_uri() . '/assets/images/logo_top.svg'; ?>
							<img src="<?php echo $logo_url; ?>" alt="logo">
						</a>
					</div>
					<div class="col-6">
						<div class="content_right">
							<div class="bookmark_icon">
							</div>
							<div class="search_icon">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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

		<div class="sidebar_bottom">
			<div class="container">
				<div class="list">
					<a href="#" class="item">
						<div class="icon">
							<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M11.9998 18.7274V15.7274M10.0698 3.54739L3.13978 9.09739C2.35978 9.71739 1.85978 11.0274 2.02978 12.0074L3.35978 19.9674C3.59978 21.3874 4.95978 22.5374 6.39978 22.5374H17.5998C19.0298 22.5374 20.3998 21.3774 20.6398 19.9674L21.9698 12.0074C22.1298 11.0274 21.6298 9.71739 20.8598 9.09739L13.9298 3.55739C12.8598 2.69739 11.1298 2.69739 10.0698 3.54739Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="title">
							Home
						</div>
					</a>
					<a href="#" class="item">
						<div class="icon">
							<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.5 12.7273C13.5 15.9073 10.93 18.4773 7.75 18.4773C4.57 18.4773 2 15.9073 2 12.7273C2 9.54729 4.57 6.97729 7.75 6.97729" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M10 12.7273C10 9.41729 12.69 6.72729 16 6.72729C19.31 6.72729 22 9.41729 22 12.7273C22 16.0373 19.31 18.7273 16 18.7273" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
						<div class="title">
							Resources
						</div>
					</a>
					<a href="#" class="item item_logout">
						<div class="icon">
							<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M11.2599 2.72729C10.7799 2.72729 10.3999 3.10729 10.3999 3.58729V21.8773C10.3999 22.3473 10.7799 22.7373 11.2599 22.7373C17.1499 22.7373 21.2599 18.6273 21.2599 12.7373C21.2599 6.84729 17.1399 2.72729 11.2599 2.72729Z" fill="#2E2E2E" />
								<path d="M16.4002 12.2674L13.5602 9.41741C13.4191 9.27793 13.2287 9.19971 13.0302 9.19971C12.8318 9.19971 12.6414 9.27793 12.5002 9.41741C12.2102 9.70741 12.2102 10.1874 12.5002 10.4774L14.0602 12.0374H4.49023C4.08023 12.0374 3.74023 12.3774 3.74023 12.7874C3.74023 13.1974 4.08023 13.5374 4.49023 13.5374H14.0602L12.5002 15.1074C12.2102 15.3974 12.2102 15.8774 12.5002 16.1674C12.6502 16.3174 12.8402 16.3874 13.0302 16.3874C13.2202 16.3874 13.4102 16.3174 13.5602 16.1674L16.4002 13.3174C16.7002 13.0274 16.7002 12.5574 16.4002 12.2674Z" fill="#2E2E2E" />
							</svg>
						</div>
						<div class="title">
							Login
						</div>
					</a>
					<a href="#" class="item item_menu">
						<div class="icon">
							<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.5 7.72729H21.5M3.5 12.7273H21.5M3.5 17.7273H21.5" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" />
							</svg>
						</div>
						<div class="title">
							Menu
						</div>
					</a>
				</div>
			</div>
		</div>


		<div class="modal fade popup_search" id="popup_search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="box_search">
							<div class="container">
								Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto, tenetur iste quia quas beatae eius vitae quod incidunt sit. Ab sapiente accusantium placeat vitae, voluptatem dolorum distinctio tempora error voluptates?
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade popup_menu" id="popup_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
				<div class=" modal-content">
					<div class="modal-body">
						<div class="container">
							<div class="box_menu">
								<?php get_template_part('template-parts/sidebar_menu'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>