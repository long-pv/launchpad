<?php

/**
 * Template name: Events
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

// Get article data
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args_event = array(
    'post_type' => 'event',
    'posts_per_page' => 24,
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'value' => '',
            'compare' => '!=',
        ),
    ),
);
$event_posts = new WP_Query($args_event);
?>

<!-- Banner -->
<?php
get_template_part('template-parts/content-banner-page');
?>
<!-- /End Banner -->

<div class="archiveEvent space--bottom">
    <div class="container">
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>

        <?php
        if ($event_posts->have_posts()):
            ?>
            <div class="archiveEvent__events">
                <div class="archiveEvent__header">
                    <h1 class="archiveEvent__title">
                        <?php the_title(); ?>
                    </h1>
                </div>
                <div class="archiveEvent__list">
                    <div class="row archiveEvent__gutters">
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
                        ?>
                    </div>
                </div>
                <div class="pagination">
                    <?php
                    echo paginate_links(
                        array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total' => $event_posts->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'show_all' => false,
                            'type' => 'plain',
                            'end_size' => 2,
                            'mid_size' => 1,
                            'prev_next' => true,
                            'prev_text' => sprintf('<span class="pagination__prev"></span>'),
                            'next_text' => sprintf('<span class="pagination__next"></span>'),
                            'add_args' => false,
                            'add_fragment' => '',
                        )
                    );
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>
<?php
get_footer();
