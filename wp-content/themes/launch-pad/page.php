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
<div class="container_xxx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <?php
                $banner = get_field('banner') ?? '';
                if ($banner['image']):
                    ?>
                    <div class="banner" style="background-image: url('<?php echo $banner['image']; ?>');">
                        <div class="banner__content">
                            <div class="banner__social">
                                <?php if ($banner['social_network']['facebook']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['facebook']; ?>"
                                        class="banner__social-icon banner__social-icon--facebook"></a>
                                <?php endif; ?>
                                <?php if ($banner['social_network']['youtube']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['youtube']; ?>"
                                        class="banner__social-icon banner__social-icon--youtube"></a>
                                <?php endif; ?>
                                <?php if ($banner['social_network']['telegram']): ?>
                                    <a target="_blank" href="<?php echo $banner['social_network']['telegram']; ?>"
                                        class="banner__social-icon banner__social-icon--telegram"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                $title_block = get_field('title_block') ?: get_the_title();
                ?>
                <h1 class="sec_title">
                    <?php echo $title_block; ?>

                    <?php $class_page_mark = (isset($_COOKIE['bookmarked_pages']) && in_array(get_the_ID(), json_decode(stripslashes($_COOKIE['bookmarked_pages']), true) ?? [])) ? 'active' : ''; ?>
                    <div class="page_mark <?php echo $class_page_mark; ?>" data-id="<?php echo get_the_ID(); ?>"></div>
                </h1>

                <div class="page_body">
                    <div class="page_scroll">
                        <?php
                        get_template_part('template-parts/content-flexible');
                        ?>
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();
