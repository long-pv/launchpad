<?php

/**
 * Template name: News and Events
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

$args_event = array(
    'post_type' => 'event',
    'posts_per_page' => 9,
    'orderby' => 'event_date',
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'value' => '',
            'compare' => '!=',
        ),
    ),
);
$event_posts = new WP_Query($args_event);

get_header();
?>
<h1 class="pageTitle">
    <?php the_title(); ?>
</h1>
<div class="newsEvents">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>
        <!-- End Breadcrumbs -->

        <!-- Category -->
        <?php get_template_part('template-parts/block/category'); ?>
        <!-- End category -->

        <div class="newsEvents__latestNews space--bottom">
            <?php get_template_part('template-parts/block/latest_news'); ?>
        </div>

        <div class="newsCate space--bottom">
            <?php
            $categories = get_categories(
                array(
                    'hide_empty' => 1,
                    'parent' => 0,
                )
            );
            foreach ($categories as $category_key => $category):
                $args_news = array(
                    'post_type' => 'post',
                    'posts_per_page' => '6',
                    'cat' => $category->term_id,
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS',
                        ),
                    ),
                );

                $query_news = new WP_Query($args_news);
                ?>
                <div class="newsCate__list">
                    <div class="newsCate__header">
                        <h3 class="newsCate__title">
                            <?php echo esc_html($category->name); ?>
                        </h3>

                        <a href="<?php echo get_category_link($category->term_id); ?>" class="btnSeeMore">
                            <?php _e('See more', 'clvinuni'); ?>
                        </a>
                    </div>

                    <!-- News by category -->
                    <?php if ($query_news->have_posts()): ?>
                        <div class="newsCate__listNews">
                            <div class="row newsCate__newsGutters">
                                <?php
                                while ($query_news->have_posts()):
                                    $query_news->the_post();
                                    if (get_the_title() && has_post_thumbnail()):
                                        ?>
                                        <div class="col-md-6 col-lg-4">
                                            <?php get_template_part('template-parts/single/content-news'); ?>
                                        </div>
                                        <?php
                                    endif;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End news by category -->
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($event_posts->have_posts()): ?>
            <div class="newsEvents__events space--bottom">
                <div class="events">
                    <div class="secHeading events__header">
                        <h2 class="secTitle secHeading__title">
                            <?php _e('Events', 'clvinuni'); ?>
                        </h2>

                        <?php
                        $archive_event_link = get_post_type_archive_link('event');
                        if ($archive_event_link):
                            ?>
                            <div class="secHeading__link">
                                <a href="<?php echo $archive_event_link; ?>" class="btnSeeMore ">
                                    <?php _e('See more', 'clvinuni'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="events__list">
                        <div class="row events__gutters">
                            <?php
                            while ($event_posts->have_posts()):
                                $event_posts->the_post();
                                if (get_field('event_date')):
                                    ?>
                                    <div class="col-md-4">
                                        <?php get_template_part('template-parts/single/content-key_dates'); ?>
                                    </div>
                                    <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();