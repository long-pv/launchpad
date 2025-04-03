<?php
/**
 * The template for displaying all pages
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

// header template
get_header();
?>
<h1 class="pageTitle">
    <?php the_title(); ?>
</h1>
<?php
// flexible content
get_template_part('template-parts/content-flexible');
// footer template
get_footer();