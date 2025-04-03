<!-- Build sidebar Menu -->
<div class="sidebarMenu">
    <?php
    // Get parent page id
    $current_page_id = get_the_ID();
    $data_sidebar = get_data_sidebar(0);
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

        $icon = '<span class="icon"> 
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.4" d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z" fill="#1A4079"/>
<path d="M15.5 10.1311C15.9986 10.1311 16.4768 9.93302 16.8294 9.58045C17.1819 9.22789 17.38 8.7497 17.38 8.25109C17.38 7.75249 17.1819 7.2743 16.8294 6.92173C16.4768 6.56917 15.9986 6.37109 15.5 6.37109C15.0014 6.37109 14.5232 6.56917 14.1706 6.92173C13.8181 7.2743 13.62 7.75249 13.62 8.25109C13.62 8.7497 13.8181 9.22789 14.1706 9.58045C14.5232 9.93302 15.0014 10.1311 15.5 10.1311ZM8.5 10.1311C8.9986 10.1311 9.47679 9.93302 9.82936 9.58045C10.1819 9.22789 10.38 8.7497 10.38 8.25109C10.38 7.75249 10.1819 7.2743 9.82936 6.92173C9.47679 6.56917 8.9986 6.37109 8.5 6.37109C8.00139 6.37109 7.5232 6.56917 7.17063 6.92173C6.81807 7.2743 6.62 7.75249 6.62 8.25109C6.62 8.7497 6.81807 9.22789 7.17063 9.58045C7.5232 9.93302 8.00139 10.1311 8.5 10.1311ZM15.6 12.9221H8.4C7.7 12.9221 7.13 13.4921 7.13 14.2021C7.13 16.8921 9.32 19.0821 12.01 19.0821C14.7 19.0821 16.89 16.8921 16.89 14.2021C16.88 13.5021 16.3 12.9221 15.6 12.9221Z" fill="#1A4079"/>
</svg></span>
        ';

        echo '<li class="' . esc_attr($current_class) . '">';
        echo '<a href="' . esc_url($item['link']) . '" ' . $target . ' >' . $icon . esc_html($item['title']) . '</a>';

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
