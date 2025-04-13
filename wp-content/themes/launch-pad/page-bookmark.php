<?php

/**
 * Template Name: Bookmark
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
                <h1 class="sec_title sec_title_mark">
                    <?php _e('Bookmark management', 'launch-pad'); ?>
                </h1>

                <div class="page_body">
                    <div class="page_scroll d-block">
                        <?php
                        if (!empty($_COOKIE['bookmarked_pages'])) {
                            $ids = json_decode(stripslashes($_COOKIE['bookmarked_pages']), true);

                            if ($ids) {
                                $query = new WP_Query([
                                    'post_type' => ['page', 'clubs'],
                                    'post__in' => $ids,
                                    'orderby' => 'post__in'
                                ]);

                                if ($query->have_posts()) {
                                    ?>
                                    <div class="list_mark">
                                        <div class="list_mark__intro">
                                            <?php _e('All your bookmarks are listed here:', 'launch-pad'); ?>
                                        </div>

                                        <?php
                                        $index = 1;
                                        while ($query->have_posts()):
                                            $query->the_post();
                                            $post_id = get_the_ID();
                                            $post_title = get_the_title();
                                            $permalink = get_permalink($post_id);
                                            ?>
                                            <div class="list_mark__item" data-id="<?php echo $post_id; ?>">
                                                <div class="list_mark__content">
                                                    <span class="list_mark__index"><?php echo $index++; ?>.</span>
                                                    <span class="list_mark__title"><?php echo esc_html($post_title); ?></span>
                                                </div>
                                                <div class="list_mark__actions">
                                                    <a href="<?php echo esc_url($permalink); ?>"
                                                        class="list_mark__action list_mark__action--visit" target="_blank">
                                                        <?php _e('Visit', 'launch-pad'); ?>
                                                    </a>
                                                    <a href="#" class="list_mark__action list_mark__action--remove remove-bookmark"
                                                        data-id="<?php echo $post_id; ?>">
                                                        <?php _e('Remove', 'launch-pad'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                    <?php
                                } else {
                                    echo '<div>No pages have been bookmarked yet.</div>';
                                }
                            } else {
                                echo '<div>No pages have been bookmarked yet.</div>';
                            }
                        } else {
                            echo '<div>No pages have been bookmarked yet.</div>';
                        }
                        ?>

                        <?php
                        wp_reset_postdata();
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
