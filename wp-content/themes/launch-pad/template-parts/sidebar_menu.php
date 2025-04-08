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

<script>
    jQuery(document).ready(function($) {
        // Add active class to all parent anchors
        var sidebarMenu_active = $(".sidebarMenu--active");
        if (sidebarMenu_active.length > 0) {
            sidebarMenu_active.each(function() {
                var parentAnchors = $(this).parents("ul");

                // Close all other ul elements
                $(".sidebarMenu > ul").not(parentAnchors).hide();

                // Show and active element
                parentAnchors.show().css('display', 'flex');
                $(this).children("ul").show().css('display', 'flex');
                parentAnchors.closest("li").addClass("sidebarMenu--active");
                parentAnchors.closest("li").find(".sidebarMenu__icon").addClass("sidebarMenu--open");
            });
        } else {
            // $(".sidebarMenu .sidebarMenu__content > ul > li > ul").hide();
        }

        // Click show/hide sub sidebar
        $(".sidebarMenu__icon").on("click", function() {
            let sidebar = $(this).siblings("ul");
            sidebar.slideToggle("swing");
            // sidebar.find("ul").slideUp("swing");
            sidebar.css('display', 'flex');

            // Check if the clicked icon is in an open state
            let is_open = $(this).hasClass("sidebarMenu--open");

            // Toggle the class sidebarMenu--open
            $(this).toggleClass("sidebarMenu--open", !is_open);

            // Close all sub-sidebar when closing the parent
            sidebar.find(".sidebarMenu__icon").removeClass("sidebarMenu--open");
        });

        // Click tab to show/hide sidebar with SP
        $(".sidebarMenu__tab").on("click", function() {
            $(".sidebarMenu__content").slideToggle(1000);

            // Open/close icon
            let sidebar_icon = $(".sidebarMenu__tab .sidebarMenu__icon");
            let is_open_icon = sidebar_icon.hasClass("sidebarMenu--open");
            sidebar_icon.toggleClass("sidebarMenu--open", !is_open_icon);
        });
    });
</script>

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

        $icon_sidebar = get_template_directory_uri() . '/assets/images/icon_sidebar.png';

        $icon = '<img class="icon" src="' . $icon_sidebar . '" >';

        echo '<li class="' . esc_attr($current_class) . '">';
        echo '<a href="' . esc_url($item['link']) . '" ' . $target . ' >' . $icon . esc_html($item['title']) . '</a>';

        // Check has child page
        if (!empty($item['sub_menu'])) {
            echo '<span class="sidebarMenu__icon ' . ($current_class ? 'sidebarMenu--open' : '') . '"></span>';
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
