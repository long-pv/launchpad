<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$events = $args['flexible']['block_content']['events'] ?? '';
?>

<div class="container">
    <?php echo block_info($block_info); ?>

    <?php if ($events): ?>
        <div class="keyDateList">
            <div class="row keyDatesList__gutters">
                <?php
                foreach ($events as $post):
                    setup_postdata($post);
                    if (get_post_status($post) == 'publish' && get_field('event_date')):
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <?php get_template_part('template-parts/single/content-key_dates'); ?>
                        </div>
                        <?php
                    endif;
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    else:
        $current_date = date('Y-m-d');
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 12,
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
        $event_posts = new WP_Query($args);

        if ($event_posts):
            ?>
            <div class="keyDateList">
                <div class="row keyDatesList__gutters">
                    <?php
                    while ($event_posts->have_posts()):
                        $event_posts->the_post();
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <?php get_template_part('template-parts/single/content-key_dates'); ?>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        endif;
    endif;
    ?>
</div>