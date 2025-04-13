<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package launchpad
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header page -->
<header id="header" class="header">
    <div class="container">
        <div class="header__inner">
            <a href="<?php echo home_url(); ?>" class="header__logo">
                <?php
                $logo_url = get_template_directory_uri() . '/assets/images/logo-header.png';
                if (get_field('logo_header', 'option')) {
                    $logo_url = get_field('logo_header', 'option');
                }
                ?>
                <img src="<?php echo $logo_url; ?>" alt="logo">
                <h1 class="header__title">LaunchPad</h1>
            </a>

            <nav class="header__menu">
                <!-- main menu -->
                <?php
                if (has_nav_menu('menu-1')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'container' => 'div',
                            'container_class' => 'header__menuInner',
                            'depth' => 1,
                        )
                    );
                }

                // Check user login
                $current_user = wp_get_current_user();
                $hasUser = $current_user->exists();
                ?>
                <div class="header__login <?php echo $hasUser ? '' : 'header__login--noUser'; ?>">
                    <?php
                    if ($hasUser): ?>
                        <div>
                            <?php echo __('Hello, ', 'launchpad') . esc_html($current_user->user_login); ?>
                        </div>
                    <?php else: ?>
                        <div id="wpo365OpenIdRedirect" class="wpo365-mssignin-wrapper">
                            <div class="wpo365-mssignin-spacearound">
                                <button class="wpo365-mssignin-button" type="button" onclick="window.wpo365.pintraRedirect.toMsOnline('', location.href, '', '', false, document.getElementById('selectedTenant') ?
                                    document.getElementById('selectedTenant').value : null)">
                                    <div class="wpo365-mssignin-label">Login</div>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Button toggle menu mobile -->
            <div class="header__toggle">
                <span class="header__toggleItem header__toggleItem--open"></span>
                <span class="header__toggleItem header__toggleItem--close"></span>
            </div>
        </div>
    </div>
</header>
<!-- /End header -->

<!-- main content -->
<main class="mainContent">