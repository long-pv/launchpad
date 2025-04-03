<?php
// -------------------- Ankt -----------------------//
// Set the number of posts per page in the archive to 12
function set_archive_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && is_archive()) {
        if (is_post_type_archive('event')) {
            $query->set('posts_per_page', 24);
            $query->set(
                'meta_query',
                array(
                    array(
                        'key' => 'event_date',
                        'value' => '',
                        'compare' => '!=',
                    ),
                )
            );
        } else {
            $query->set('posts_per_page', 12);
            $query->set(
                'meta_query',
                array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS',
                    ),
                )
            );
        }
    }
}
add_action('pre_get_posts', 'set_archive_posts_per_page');

function custom_convert_time($date_time, $format = "d/m/Y")
{
    $date_time_object = null;

    switch (true) {
        case (strpos($date_time, '/') !== false):
            // Format d/m/Y
            $date_time_object = DateTime::createFromFormat('d/m/Y', $date_time);
            break;
        case (strlen($date_time) === 8 && ctype_digit($date_time)):
            // Format Ymd
            $date_time_object = DateTime::createFromFormat('Ymd', $date_time);
            break;
        case (strpos($date_time, '-') !== false):
            // Format Y-m-d
            $date_time_object = DateTime::createFromFormat('Y-m-d', $date_time);
            break;
        case (strpos($date_time, '.') !== false):
            // Format d.m.Y or m.d.Y
            $date_time_object = DateTime::createFromFormat('d.m.Y', $date_time);
            if (!$date_time_object) {
                $date_time_object = DateTime::createFromFormat('m.d.Y', $date_time);
            }
            break;
        case (preg_match('/^(?:\d{1,2}\s)?(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s\d{4}$/', $date_time)):
            // Format M j, Y or j M Y
            $date_time_object = DateTime::createFromFormat('M j, Y', $date_time);
            if (!$date_time_object) {
                $date_time_object = DateTime::createFromFormat('j M Y', $date_time);
            }
            break;
        case (preg_match('/^(?:\d{1,2}\s)?(?:January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}$/', $date_time)):
            // Format j F Y
            $date_time_object = DateTime::createFromFormat('j F Y', $date_time);
            break;
        case (preg_match('/^(?:\d{1,2}\s)?(?:January|February|March|April|May|June|July|August|September|October|November|December)\s\d{1,2},\s\d{4}$/', $date_time)):
            // Format F j, Y
            $date_time_object = DateTime::createFromFormat('F j, Y', $date_time);
            break;
    }

    // If there's a date object, format it to the desired format
    if ($date_time_object instanceof DateTime) {
        return $date_time_object->format($format);
    } else {
        return false;
    }
}

$post_types_filter = array('club', 'faqs', 'people');

function hide_all_seo_score_dropdown()
{
    global $post_types_filter;

    if (is_admin() && in_array(get_current_screen()->post_type, $post_types_filter)) {
        ?>
        <style>
            /* Hide dropdown "All SEO Scores" */
            #wpseo-filter,
            #wpseo-readability-filter {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('admin_head-edit.php', 'hide_all_seo_score_dropdown');

function custom_filter_by_post_type($post_type)
{
    global $post_types_filter;

    // Only proceed if the post type is in the list of allowed post types
    if (in_array($post_type, $post_types_filter)) {
        // Get the list of taxonomies for the post type
        $taxonomies = get_object_taxonomies($post_type, 'objects');
        $tax_ignore = [
            'language',
            'post_translations',
        ];

        // Display the list of taxonomies as dropdowns
        foreach ($taxonomies as $taxonomy) {
            if (in_array($taxonomy->name, $tax_ignore)) {
                continue;
            }

            // Get terms for the taxonomy
            $terms = get_terms(
                array(
                    'taxonomy' => $taxonomy->name,
                    'hide_empty' => true,
                )
            );

            // If no terms found, display the default option
            if (empty($terms)) {
                echo "<select name='{$taxonomy->name}_filter'>";
                echo "<option value='0'>" . __("All {$taxonomy->label}") . "</option>";
                echo "</select>";
            } else {
                // Display dropdown list of categories
                wp_dropdown_categories(
                    array(
                        'show_option_all' => __("All {$taxonomy->label}"),
                        'taxonomy' => $taxonomy->name,
                        'name' => "{$taxonomy->name}_filter",
                        'orderby' => 'name',
                        'selected' => isset($_GET["{$taxonomy->name}_filter"]) ? $_GET["{$taxonomy->name}_filter"] : '',
                        'show_count' => false,
                        'hide_empty' => false,
                    )
                );
            }
        }
    }
}
add_action('restrict_manage_posts', 'custom_filter_by_post_type');

function custom_filter_by_post_type_query($query)
{
    // Apply only for search queries on the admin post management page
    if (is_admin() && $query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] !== '') {
        // Get the post type from the query string
        $post_type = $_GET['post_type'];

        // Check if this post type is allowed to use dropdown taxonomy filter
        $allowed_post_types = array('club', 'faqs', 'people');
        if (in_array($post_type, $allowed_post_types)) {
            // Loop through the taxonomies of the selected post type
            $taxonomies = get_object_taxonomies($post_type, 'objects');

            if (count($taxonomies) > 0) {
                foreach ($taxonomies as $taxonomy) {
                    // Check if a value is selected from the dropdown taxonomy filter
                    if (isset($_GET["{$taxonomy->name}_filter"]) && $_GET["{$taxonomy->name}_filter"] !== '') {
                        // Add search condition for this taxonomy
                        if ($_GET["{$taxonomy->name}_filter"] != '0') {
                            $query->set(
                                'tax_query',
                                array(
                                    array(
                                        'taxonomy' => $taxonomy->name,
                                        'field' => 'term_id',
                                        'terms' => $_GET["{$taxonomy->name}_filter"],
                                    ),
                                )
                            );
                        }
                    }
                }
            }
        }
    }
}
add_action('pre_get_posts', 'custom_filter_by_post_type_query');

// ------------------ End Ankt ---------------------//
function custom_api_request($path, $method = 'GET', $body_args = null, $headers = [])
{
    $url = 'https://vinuni.edu.vn' . $path;

    $args = array(
        'method' => $method,
        'timeout' => 30
    );

    // Check is $headers
    if ($headers) {
        $args['headers'] = $headers;
    } else {
        $args['headers'] = array(
            'Content-Type' => 'application/json'
        );
    }

    // Check has body request
    if ($body_args) {
        $args['body'] = $body_args;
    }

    // Call api request
    $response = wp_remote_request($url, $args);
    $body = wp_remote_retrieve_body($response);

    if ($body) {
        return json_decode($body);
    }

    return false;
}

function load_people_data($list_id)
{
    $subsite = 'main';
    if (!is_main_site()) {
        $subsite = 'subsite';
    }

    $lang = LANG;
    $permalink = get_permalink() ?? home_url();
    $people = [];

    if ($list_id) {
        foreach ($list_id as $person_id) {
            switch_to_blog(get_main_site_id());
            $args = array(
                'post_type' => 'people',
                'post__in' => [(int) $person_id],
                'posts_per_page' => 1,
            );

            if ($lang) {
                $args['lang'] = $lang;
            }

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $people[get_the_ID()] = (object) [
                        'title' => get_name_people(get_the_ID()),
                        'image' => get_the_post_thumbnail_url(),
                        'position' => get_position_people(get_the_ID(), $permalink, $subsite),
                        'link' => get_permalink(),
                        'excerpts' => get_field('excerpts'),
                        'desc_search' => get_the_excerpt(),
                        'college' => wp_get_post_terms(get_the_ID(), 'college', array('fields' => 'ids')) ?? [],
                        'subsite' => $subsite
                    ];
                }
            }
            wp_reset_postdata();
            restore_current_blog();
        }
    }

    return $people;
}

$data_people = [];
function load_all_people_admin_init()
{
    global $data_people;

    if (is_main_site()) {
        $data_people = get_all_data_people();
    } else {
        switch_to_blog(get_main_site_id());
        $data_people = get_all_data_people();
        restore_current_blog();
    }
}
add_action('admin_init', 'load_all_people_admin_init');

function get_all_data_people()
{
    $data = [];

    $args = array(
        'post_type' => 'people',
        'posts_per_page' => -1,
        'lang' => ''
    );
    $people_query = new WP_Query($args);

    if ($people_query->have_posts()) {
        while ($people_query->have_posts()) {
            $people_query->the_post();
            $lang = function_exists('pll_get_post_language') ? (pll_get_post_language(get_the_ID()) ?: 'en') : '';
            $data[get_the_ID()] = get_the_title() . ($lang ? ' - ' . $lang : '');
        }
        wp_reset_postdata();
    }

    return $data;
}

function cl_people_acf_load_field($field)
{
    global $data_people;

    if ($data_people) {
        $field['choices'] = $data_people;
    }

    return $field;
}
// server production
add_filter('acf/load_field/key=field_661630a723740', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_66162fc709916', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_661630028bef7', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_66163053b11e7', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_66164688748cd', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_661632d287c92', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_66163303824a5', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_662b2ccb51966', 'cl_people_acf_load_field');
add_filter('acf/load_field/key=field_6683bcc9631ba', 'cl_people_acf_load_field');
