<?php
/**
 * Template name: Post archive
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
$slug_post_type = get_field('slug_post_type') ?? null;
if (empty ($slug_post_type)) {
    wp_redirect(home_url());
    exit;
}

get_header();
?>

<section class="space--bottom">
    <div class="container">
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>

        <div class="newsEvents">
            <?php get_template_part('template-parts/block/category'); ?>

            <div class="newsCate">
                <div class="newsCate__header">
                    <h1 class="newsCate__title">
                        <?php
                        echo custom_title(get_the_title());
                        ?>
                    </h1>
                </div>
                <div class="newsCate__listNews">
                    <div class="row newsCate__newsGutters">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type' => $slug_post_type,
                            'posts_per_page' => 12,
                            'paged' => $paged,
                            'meta_query' => array(
                                array(
                                    'key' => '_thumbnail_id',
                                    'compare' => 'EXISTS',
                                ),
                            ),
                        );
                        $posts = new WP_Query($args);
                        while ($posts->have_posts()):
                            $posts->the_post();
                            if (get_the_title() && has_post_thumbnail()):
                                ?>
                                <div class="col-md-6 col-lg-4">
                                    <?php get_template_part('template-parts/single/content-news'); ?>
                                </div>
                                <?php
                            endif;
                        endwhile;
                        ?>
                    </div>
                    <div class="pagination">
                        <?php
                        echo paginate_links(
                            array(
                                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'total' => $posts->max_num_pages,
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
            </div>
        </div>
    </div>
</section>

<?php
get_footer();