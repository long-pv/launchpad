<?php
// register API for research
add_action('rest_api_init', function () {
    register_rest_route(
        'vin/v1',
        '/research',
        array (
            'methods' => 'GET',
            'callback' => 'vin_research_by_post_type',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/college',
        array (
            'methods' => 'GET',
            'callback' => 'vin_college',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/research_area',
        array (
            'methods' => 'GET',
            'callback' => 'vin_research_area',
            'permission_callback' => '__return_true',
        )
    );
});

function vin_research_by_post_type(WP_REST_Request $request)
{
    $data = [];
    $args = [
        'posts_per_page' => -1,
        'lang' => 'en',
        'post_type' => 'research',
    ];
    $posts = new WP_Query($args);
    while ($posts->have_posts()) {
        $posts->the_post();
        $item = array();
        $item['title'] = get_the_title();
        $item['content'] = get_the_content();

        $term = get_the_terms(get_the_ID(), 'research_type');
        $bg_color = get_field('color', 'research_type_' . $term[0]->term_id);
        $research_type = strip_tags(get_the_term_list(get_the_ID(), 'research_type', '', ', ', ''));
        $college = get_the_terms(get_the_ID(), array('college'));
        $research_area = strip_tags(get_the_term_list(get_the_ID(), 'research_area', '', ', ', ''));
        $item['bg_color'] = $bg_color;
        $item['research_type'] = $research_type;
        $item['college'] = $college ? $college : [];
        $item['research_area'] = explode(', ', $research_area);
        $short_title = get_field('short_title');
        $item['short_title'] = $short_title;
        $item['link'] = get_permalink();
        $item['thumbnail'] = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $data[] = $item;
    }
    wp_reset_postdata();

    // return json_encode($data);
    $response = new WP_REST_Response($data);
    $response->set_status(201);

    return $response;

}


function vin_college(WP_REST_Request $request)
{
    $term_ids = array(26, 28, 2, 3);

    $categories = get_terms(
        'college',
        array(
            'orderby' => 'count',
            'lang' => 'en',
            'hide_empty' => 0,
            'include' => $term_ids,
        )
    );
    // return $output;
    return new WP_REST_Response($categories, 200);
}

function vin_research_area(WP_REST_Request $request)
{
    $categories = get_terms(
        'research_area',
        array(
            'orderby' => 'count',
            'lang' => 'en',
            'hide_empty' => 0,
        )
    );
    $data_research_area = [];
    foreach ($categories as $term) {
        $college_field = get_field('college', $term);
        $item = array();
        $item['term_id'] = $term->term_id;
        $item['name'] = $term->name;
        $item['slug'] = $term->slug;
        $item['term_group'] = $term->term_group;
        $item['term_taxonomy_id'] = $term->term_taxonomy_id;
        $item['taxonomy'] = $term->taxonomy;
        $item['description'] = $term->description;
        $item['parent'] = $term->parent;
        $item['count'] = $term->count;
        $item['filter'] = $term->filter;
        $item['term_order'] = $term->term_order;
        $item['college_field'] = $college_field;
        if ($term->count > 0) {
            $data_research_area[] = $item;
        }
    }
    // return $output;
    return new WP_REST_Response($data_research_area, 200);
}
