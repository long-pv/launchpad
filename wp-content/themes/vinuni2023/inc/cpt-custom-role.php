<?php
function register_cpt_post_types()
{
    $post_type_vinuni = [
        'academics' => [
            'labels' => __('Academic', 'clvinuni'),
            'cap' => true,
            'hierarchical' => true,
        ],
        'student_life' => [
            'labels' => __('Student Life', 'clvinuni'),
            'cap' => true,
            'hierarchical' => true,
        ],
        'global_exchange' => [
            'labels' => __('Global Exchange', 'clvinuni'),
            'cap' => true,
            'hierarchical' => true,
            'no' => 50
        ],
        'research' => [
            'labels' => __('Research', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'research_news' => [
            'labels' => __('Research News', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'career_services' => [
            'labels' => __('Career services', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'job_opportunity' => [
            'labels' => __('Jobs & Internship Opportunity', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'mentorship_program' => [
            'labels' => __('Mentorship Program', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'aid' => [
            'labels' => __('AID', 'clvinuni'),
            'cap' => true,
            'hierarchical' => true,
        ],
    ];

    $cpt_multisite = [
        'event' => [
            'labels' => __('Event', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'faqs' => [
            'labels' => __('FAQs', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'testimonial' => [
            'labels' => __('Testimonials', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'job' => [
            'labels' => __('Jobs', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'club' => [
            'labels' => __('Clubs', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'people' => [
            'labels' => __('People', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'on_media' => [
            'labels' => __('On Media', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
        'vinuni_gallery' => [
            'labels' => __('Gallery', 'clvinuni'),
            'cap' => true,
            'hierarchical' => false,
        ],
    ];

    $cpt_tax = [
        'faculty_stories_category' => [
            'labels' => __('Faculty stories category', 'clvinuni'),
            'cap' => true,
            'post_type' => ['testimonial']
        ],
        'testimonials_category' => [
            'labels' => __('Testimonials category', 'clvinuni'),
            'cap' => true,
            'post_type' => ['testimonial']
        ],
        'faqs_category' => [
            'labels' => __('FAQs category', 'clvinuni'),
            'cap' => true,
            'post_type' => ['faqs']
        ],
        'job_location' => [
            'labels' => __('Job Location', 'clvinuni'),
            'cap' => true,
            'post_type' => ['job']
        ],
        'employment_type' => [
            'labels' => __('Employment type', 'clvinuni'),
            'cap' => true,
            'post_type' => ['job']
        ],
        'club_category' => [
            'labels' => __('Club categories', 'clvinuni'),
            'cap' => true,
            'post_type' => ['club']
        ],
        'college' => [
            'labels' => __('Colleges', 'clvinuni'),
            'cap' => true,
            'post_type' => ['people', 'research', 'vinunian', 'post', 'event', 'on_media']
        ],
        'job_division' => [
            'labels' => __('Job division', 'clvinuni'),
            'cap' => true,
            'post_type' => ['job']
        ],
        'people_type' => [
            'labels' => __('Categories of People', 'clvinuni'),
            'cap' => true,
            'post_type' => ['people']
        ],
        'people_title' => [
            'labels' => __('People title', 'clvinuni'),
            'cap' => true,
            'post_type' => ['people']
        ],
        'position' => [
            'labels' => __('Position', 'clvinuni'),
            'cap' => true,
            'post_type' => ['people']
        ],
        'gallery_category' => [
            'labels' => __('Categories', 'clvinuni'),
            'cap' => true,
            'post_type' => ['vinuni_gallery']
        ],
        'gallery_college' => [
            'labels' => __('Colleges', 'clvinuni'),
            'cap' => true,
            'post_type' => ['vinuni_gallery']
        ],
        'gallery_year' => [
            'labels' => __('Year', 'clvinuni'),
            'cap' => true,
            'post_type' => ['vinuni_gallery']
        ],
        'gallery_tags' => [
            'labels' => __('Tags', 'clvinuni'),
            'cap' => true,
            'post_type' => ['vinuni_gallery']
        ],
    ];

    $cpt_tax_of_vinuni = [
        'research_type' => [
            'labels' => __('Research Types', 'clvinuni'),
            'cap' => true,
            'post_type' => ['research']
        ],
        'research_area' => [
            'labels' => __('Research Areas', 'clvinuni'),
            'cap' => true,
            'post_type' => ['research', 'people']
        ],
        'career_services_category' => [
            'labels' => __('Career services category', 'clvinuni'),
            'cap' => true,
            'post_type' => ['career_services', 'event_career']
        ],
        'industrial_insight_category' => [
            'labels' => __('Industrial insight category', 'clvinuni'),
            'cap' => true,
            'post_type' => ['industrial_insight']
        ],
    ];

    if (is_main_site()) {
        foreach ($post_type_vinuni as $post_type => $data) {
            register_cpt($post_type, $data);
        }
    }

    foreach ($cpt_multisite as $post_type => $data) {
        register_cpt($post_type, $data);
    }

    foreach ($cpt_tax as $ctx => $data) {
        register_ctx($ctx, $data);
    }

    if (is_main_site()) {
        foreach ($cpt_tax_of_vinuni as $ctx => $data) {
            register_ctx($ctx, $data);
        }
    }
}
add_action('init', 'register_cpt_post_types');

function register_cpt($post_type, $data = [])
{
    $hierarchical = $data['hierarchical'] ?? false;
    $has_archive = $data['has_archive'] ?? false;
    $attributes = $hierarchical ? 'page-attributes' : '';

    $labels = [
        'name' => $data['labels'],
        'singular_name' => $data['labels'],
        'menu_name' => $data['labels'],
    ];

    $args = array(
        'labels' => $labels,
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rest_base' => '',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'has_archive' => $has_archive,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'delete_with_user' => false,
        'exclude_from_search' => true,
        'map_meta_cap' => true,
        'hierarchical' => $data['labels'] ?: false,
        'rewrite' => array('slug' => $post_type, 'with_front' => true),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author', $attributes),
        'capability_type' => 'post',
        'can_export' => true,
    );

    if (!empty($data['tax'])) {
        $args['taxonomies'] = $data['tax'];
    }
    if (!empty($data['no'])) {
        $args['menu_position'] = $data['no'];
    }

    if (!empty($data['cap'])) {
        $capabilities = [
            'create_posts' => 'create_post_type_' . $post_type,
            'delete_others_posts' => 'delete_post_type_' . $post_type,
            'delete_posts' => 'delete_post_type_' . $post_type,
            'delete_private_posts' => 'delete_private_post_type_' . $post_type,
            'delete_published_posts' => 'delete_published_post_type_' . $post_type,
            'edit_others_posts' => 'edit_others_post_type_' . $post_type,
            'edit_posts' => 'edit_post_type_' . $post_type,
            'edit_private_posts' => 'edit_private_post_type_' . $post_type,
            'edit_published_posts' => 'edit_published_post_type_' . $post_type,
            'publish_posts' => 'publish_post_type_' . $post_type,
            'read_private_posts' => 'read_private_post_type_' . $post_type,
        ];
        $args['capabilities'] = $capabilities;
    }

    register_post_type($post_type, $args);
}

function register_ctx($ctx, $data)
{
    $labels = [
        'name' => $data['labels'],
        'singular_name' => $data['labels'],
    ];

    $args = [
        "label" => $ctx,
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => $ctx, 'with_front' => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
        'show_tagcloud' => true,
    ];

    if (!empty($data['cap'])) {
        $capabilities = [
            'manage_terms' => 'manage_taxonomy_' . $ctx,
            'edit_terms' => 'edit_taxonomy_' . $ctx,
            'delete_terms' => 'delete_taxonomy_' . $ctx,
            'assign_terms' => 'assign_taxonomy_' . $ctx,
        ];
        $args['capabilities'] = $capabilities;
    }

    register_taxonomy($ctx, $data['post_type'], $args);
}