<?php
// Get 8 lastest news post type post
$args_lastest_news = array(
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'meta_query'     => array(
        array(
            'key'     => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
);
$query_lastest_news = new WP_Query($args_lastest_news);
?>

<?php
    if ($query_lastest_news->have_posts()) :
    $query_lastest_news->the_post();
?>
<div class="latestNews">
    <div class="row">
        <div class="col-lg-8">
            <div class="latestNews__latest">
                <?php
                $args['excerpt'] = get_the_excerpt();
                get_template_part('template-parts/single/content-news', '', $args);
                ?>
            </div>
        </div>
        <div class="col-lg-4">
            <h2 class="h4 latestNews__title">
                <?php _e('Latest news', 'clvinuni'); ?>
            </h2>

            <ul class="latestNews__list">
                <?php
                // Reset the query to repeat from the beginning
                $query_lastest_news->rewind_posts();

                // Skip the first post
                $query_lastest_news->next_post();
                while ($query_lastest_news->have_posts()) : $query_lastest_news->the_post();
                    get_template_part('template-parts/single/latest-news_item');
                endwhile; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>