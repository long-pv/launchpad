<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$block_content = $args['flexible']['block_content'] ?? '';
$title_news = $block_content['title_news'];

// Category
$categories = $block_content['category'] ?? null;
$class_list_news = $categories ? 'col-lg-8' : 'col-12';
$class_col_news = $categories ? 'col-md-6' : 'col-md-4';
$link_news = $block_content['link_news'] ?? null;
$link_media = $block_content['link_media'] ?? null;
$link_event = $block_content['link_event'] ?? null;
$title_event = $block_content['title_event'] ?? null;
$important_dates = $block_content['featured_event'] ?? null;
$posts_per_page = $categories ? 4 : 6;
$event_per_page = $categories ? 2 : 3;

// Featured news
$featured_news_arr = $block_content['featured_news'] ?? null;
$featured_news_id = [];
if ($featured_news_arr) {
    foreach ($featured_news_arr as $item) {
        if ($item->count > 0) {
            $featured_news_id[] = $item->term_id;
        }
    }
}

// Determines the post types to be retrieved from the main page
$post_type_arr = ['post'];
if (is_main_site()) {
    $post_type_arr[] = 'global_exchange_news';
}

// query post
$args = array(
    'post_type' => $post_type_arr,
    'posts_per_page' => $posts_per_page,
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS'
        ),
    ),
);

if ($featured_news_id) {
    $args['category__in'] = $featured_news_id;
}

$query_news = new WP_Query($args);

$current_date = date('Y-m-d');
$args_event = array(
    'post_type' => 'event',
    'posts_per_page' => $event_per_page,
    'meta_key' => 'event_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'value' => $current_date,
            'compare' => '>=',
            'type' => 'DATE',
        ),
    ),
);
$event_posts = new WP_Query($args_event);
?>

<div class="newsEvent">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <div class="row">
            <div class="<?php echo $class_list_news; ?>">
                <div class="newsEvent__listNews">
                    <?php if ($query_news->have_posts()): ?>
                        <div class="row newsEvent__newsGutters">
                            <?php
                            while ($query_news->have_posts()):
                                $query_news->the_post();
                                if (get_the_title()):
                                    ?>
                                    <div class="newsEvent__col <?php echo $class_col_news; ?>">
                                        <?php get_template_part('template-parts/single/content-news'); ?>
                                    </div>
                                    <?php
                                endif;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if ($important_dates || $event_posts->have_posts()):
                        ?>
                        <div class="newsEvent__dateImp">
                            <?php if ($title_event): ?>
                                <div class="newsEvent__dateImpHeader">
                                    <h3 class="newsEvent__dateImpTitle wow fadeInUp" data-wow-duration="1s">
                                        <?php echo $title_event; ?>
                                    </h3>
                                    <?php echo custom_btn_link($link_event) ?>
                                </div>

                                <div class="newsEvent__dateImpPost">
                                    <div class="row">
                                        <?php
                                        if ($important_dates):
                                            foreach ($important_dates as $index_post => $post):
                                                if ($event_per_page == $index_post) {
                                                    break;
                                                }

                                                setup_postdata($post);

                                                if (get_post_status($post) == 'publish' && get_field('event_date')):
                                                    ?>
                                                    <div class="<?php echo $class_col_news; ?>">
                                                        <?php get_template_part('template-parts/single/content-key_dates'); ?>
                                                    </div>
                                                    <?php
                                                endif;
                                            endforeach;
                                            wp_reset_postdata();
                                        else:
                                            if ($event_posts->have_posts()):
                                                while ($event_posts->have_posts()):
                                                    $event_posts->the_post();
                                                    if (get_field('event_date')):
                                                        ?>
                                                        <div class="<?php echo $class_col_news; ?>">
                                                            <?php get_template_part('template-parts/single/content-key_dates'); ?>
                                                        </div>
                                                        <?php
                                                    endif;
                                                endwhile;
                                                wp_reset_postdata();
                                            endif;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>

            <!-- Block categories -->
            <?php if ($categories): ?>
                <div class="col-lg-4">
                    <div class="newsEvent__newsSidebar">
                        <?php if ($title_news): ?>
                            <h2 class="h3 newsEvent__sidebarTitle wow fadeInUp" data-wow-duration="1s">
                                <?php echo $title_news; ?>
                            </h2>
                            <figure class="newsEvent__sidebarIcon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/academic-icon.png"
                                    alt="<?php echo $title_news; ?>">
                            </figure>
                        <?php endif; ?>

                        <ul class="newsEvent__sidebarList">
                            <?php
                            // Array to store the IDs of displayed posts
                            $displayed_post_ids = array();

                            foreach ($categories as $key_cate => $category):
                                if (($key_cate + 1) == 5)
                                    break;
                                $args_category = array(
                                    'posts_per_page' => 1,
                                    'post_type' => 'post',
                                    'cat' => $category->term_id,
                                    'post__not_in' => $displayed_post_ids,
                                );

                                $latest_post = get_posts($args_category);

                                // Check if the category has posts
                                if ($category->name && !empty($latest_post)):
                                    // Store the ID in the array
                                    $displayed_post_ids[] = $latest_post[0]->ID;
                                    ?>
                                    <li>
                                        <h3 class="h6 newsEvent__sidebarCat wow fadeInUp" data-wow-duration="1s">
                                            <?php if ($category->name): ?>
                                                <a href="<?php echo get_term_link($category); ?>" class="line-2">
                                                    <?php echo $category->name; ?>
                                                </a>
                                            <?php endif; ?>
                                        </h3>
                                        <?php
                                        foreach ($latest_post as $post):
                                            ?>
                                            <h4 class="h6 newsEvent__sidebarPost wow fadeInUp" data-wow-duration="1s">
                                                <?php if (get_the_title()): ?>
                                                    <?php get_template_part('template-parts/single/link-news-item'); ?>
                                                <?php endif; ?>
                                            </h4>
                                        <?php endforeach; ?>
                                    </li>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>

                        <?php
                        if ($link_news):
                            $url = $link_news['url'] ? $link_news['url'] : 'javascript:void(0);';
                            $title = $link_news['title'] ? $link_news['title'] : __('Read More', 'clvinuni');
                            $target = $link_news['target'] ? $link_news['target'] : '_self';
                            ?>
                            <div class="h6 newsEvent__moreNews wow fadeInUp" data-wow-duration="1s">
                                <a href="<?php echo $url; ?>" target="<?php echo $target; ?>">
                                    <?php echo $title; ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        if ($link_media):
                            $url = $link_media['url'] ? $link_media['url'] : 'javascript:void(0);';
                            $title = $link_media['title'] ? $link_media['title'] : __('For media', 'clvinuni');
                            $target = $link_media['target'] ? $link_media['target'] : '_self';
                            ?>
                            <div class="h6 newsEvent__forMedia wow fadeInUp" data-wow-duration="1s">
                                <a href="<?php echo $url; ?>" target="<?php echo $target; ?>">
                                    <?php echo $title; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End category -->
        </div>
    </div>
</div>