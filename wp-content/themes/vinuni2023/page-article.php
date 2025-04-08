<?php

/**
 * Template name: Sidebar
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */

// page redirection
$redirection = get_field('redirection') ?? null;
if ($redirection) {
    wp_redirect($redirection);
    exit;
}

get_header();
?>
<h1 class="pageTitle">
    <?php the_title(); ?>
</h1>

<!-- Banner -->
<?php
get_template_part('template-parts/content-banner-page');
?>
<!-- /End Banner -->

<div class="pageArticle space--bottom">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>
        <!-- /End Breadcrumbs -->

        <div class="row">
            <div class="col-lg-4">
                <?php get_template_part('template-parts/block/sidebar_menu'); ?>
            </div>
            <div class="col-lg-8 pageArticle__content">
                <?php get_template_part('template-parts/content-flexible'); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
