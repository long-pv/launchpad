<?php

/**
 *  * Template Name: Home
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
            $banner = get_field('banner') ?? '';
            if ($banner['image']):
            ?>
                <div class="imgGroup banner">
                    <img src="<?php echo $banner['image']; ?>" alt="banner">

                    <div class="social_network">
                        <a href="">

                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $title_block = get_field('title_block') ?? '';
            ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();
