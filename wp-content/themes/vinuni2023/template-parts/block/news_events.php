<?php
// used for page articles

// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$block_content = $args['flexible']['block_content'] ?? '';
$select_article = $block_content['select_article'] ?? '0';

if ($select_article == '0'):
    // Category
    $class_list_news = 'col-12';
    $class_col_news = 'col-md-6';
    $link_event = $block_content['link_event'] ?? null;
    $title_event = $block_content['title_event'] ?? null;
    $important_dates = $block_content['featured_event'] ?? null;
    $featured_news = $block_content['featured_news'] ?? null;
    $posts_per_page = 4;
    $event_per_page = 2;

    if (!$featured_news) {
        $featured_news = get_posts(
            array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            )
        );
    }

    if (!$important_dates) {
        $current_date = date('Y-m-d');
        $important_dates = get_posts(
            array(
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
            )
        );
    }

    // build UI
    ?>
    <div class="newsEvent">
        <?php echo block_info($block_info); ?>
        <div class="row">
            <div class="<?php echo $class_list_news; ?>">
                <div class="newsEvent__listNews">
                    <?php if ($featured_news): ?>
                        <div class="row newsEvent__newsGutters">
                            <?php
                            foreach ($featured_news as $key => $post):
                                setup_postdata($post);
                                if (get_the_title() && has_post_thumbnail()):
                                    ?>
                                    <div class="newsEvent__col <?php echo $class_col_news; ?>">
                                        <?php get_template_part('template-parts/single/content-news'); ?>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            wp_reset_postdata();
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if ($title_event && $important_dates):
                        ?>
                        <div class="newsEvent__dateImp">
                            <div class="newsEvent__dateImpHeader">
                                <h3 class="newsEvent__dateImpTitle wow fadeInUp" data-wow-duration="1s">
                                    <?php echo $title_event; ?>
                                </h3>
                                <?php echo custom_btn_link($link_event) ?>
                            </div>

                            <?php if ($important_dates): ?>
                                <div class="newsEvent__dateImpPost">
                                    <div class="row">
                                        <?php
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
        </div>
    </div>
    <?php
    // Featured news by category
elseif ($select_article == '1'):
    $category = $block_content['category'] ?? null;
    $category_id = [];
    if ($category) {
        foreach ($category as $item) {
            if ($item->count > 0) {
                $category_id[] = $item->term_id;
            }
        }
    }

    // query post
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 12,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS'
            ),
        ),
    );

    if ($category_id) {
        $args['category__in'] = $category_id;
    }

    $query_news = new WP_Query($args);
    ?>
    <div class="newsEvent__listNews">
        <?php if ($query_news->have_posts()): ?>
            <div class="row newsEvent__newsGutters">
                <?php
                while ($query_news->have_posts()):
                    $query_news->the_post();
                    if (get_the_title()):
                        ?>
                        <div class="newsEvent__col col-md-6 col-lg-4">
                            <?php get_template_part('template-parts/single/content-news'); ?>
                        </div>
                        <?php
                    endif;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
    </div>


    <?php
endif;
?>