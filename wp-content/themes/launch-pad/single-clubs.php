<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package launch-pad
 */

get_header();
?>


<div class="container_xx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <?php
                $title_block = get_the_title();
                ?>
                <h1 class="sec_title">
                    <?php echo $title_block; ?>

                    <?php $class_page_mark = (isset($_COOKIE['bookmarked_pages']) && in_array(get_the_ID(), json_decode(stripslashes($_COOKIE['bookmarked_pages']), true) ?? [])) ? 'active' : ''; ?>
                    <div class="page_mark <?php echo $class_page_mark; ?>" data-id="<?php echo get_the_ID(); ?>"></div>
                </h1>
                <div class="page_body">
                    <div class="page_scroll page_scroll_club_single d-block">
                        <div class="card_club">
                            <div class="row card_club_row">
                                <div class="col-lg-4">
                                    <div class="card_club__image-wrapper">
                                        <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                            alt="<?php the_title_attribute(); ?>" class="card_club__image" />
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="editor">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>

<?php
get_footer();
