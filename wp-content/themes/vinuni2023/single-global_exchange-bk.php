<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

$select_templates = get_field('select_templates') ?? 'default';
if ($select_templates == 'default'):
    get_template_part('template-parts/content-flexible');
else:
    get_template_part('template-parts/content-page-article');
endif;

get_footer();
