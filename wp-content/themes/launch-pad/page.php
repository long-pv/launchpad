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
 * @package launch-pad
 */

// header template
get_header();
?>
<div class="container">
    <div class="page_wrap">
        <div class="page_inner">
            <?php
            get_template_part('template-parts/content-flexible');
            ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();
