<!-- Build sidebar Menu -->
<div class="sidebarMenu">
    <?php
    // Get parent page id
    $current_page_id = get_the_ID();
    $parent_page_id = wp_get_post_parent_id($current_page_id);

    while ($parent_page_id && wp_get_post_parent_id($parent_page_id)) {
        $parent_page_id = wp_get_post_parent_id($parent_page_id);
    }
    $data_sidebar = get_data_sidebar($parent_page_id);
    // Show sidebar
    ?>
    <div class="sidebarMenu__content">
        <?php display_sidebar_menu($data_sidebar); ?>
    </div>
</div>

<?php
// Display sidebar menu
function display_sidebar_menu($data_sidebar, $level = 1)
{
    echo '<ul class="sidebarMenu__level' . esc_attr($level) . '">';

    foreach ($data_sidebar as $item) {
        $current_class = (is_page($item['id']) || is_single($item['id'])) ? ' sidebarMenu--active' : '';
        $open_new_tab = get_field('open_new_tab', $item['id']);

        // open new tab function
        $target = '';
        if ($open_new_tab == true) {
            $target = 'target="_blank"';
        }

        echo '<li class="' . esc_attr($current_class) . '">';
        echo '<a href="' . esc_url($item['link']) . '" ' . $target . ' >' . esc_html($item['title']) . '</a>';

        // Check has child page
        if (!empty($item['sub_menu'])) {
            echo '<span class="sidebarMenu__icon"></span>';
            display_sidebar_menu($item['sub_menu'], $level + 1);
        }

        echo '</li>';
    }

    echo '</ul>';
}

// Get data sidebar by parent id
function get_data_sidebar($parent_id = 0, $level = 1, $max_level = 3)
{
    $data_result = [];

    $args = array(
        'post_type' => ['page'],
        'post_parent' => $parent_id,
        // 'meta_query' => array(
        //     array(
        //         'key' => 'sidebar_menu',
        //         'value' => 'yes',
        //     ),
        // ),
        'posts_per_page' => -1,
    );

    $sidebar_query = new WP_Query($args);

    if ($sidebar_query->have_posts() && $level <= $max_level) {
        while ($sidebar_query->have_posts()) {
            $sidebar_query->the_post();

            $data_item = [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_permalink(),
                'level' => $level
            ];

            $redirection = get_field('redirection') ?? null;
            if ($redirection) {
                $data_item['link'] = $redirection;
            }

            // Check for child pages recursively
            $child_data = get_data_sidebar(get_the_ID(), $level + 1);
            if (!empty($child_data)) {
                $data_item['sub_menu'] = $child_data;
            }

            $data_result[] = $data_item;
        }
    }

    wp_reset_postdata();
    return $data_result;
}
