<?php
add_action('rest_api_init', function () {
    register_rest_route(
        'vin/v1',
        '/categories',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_categories',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/category_detail',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_category_detail',
            'permission_callback' => '__return_true',
        )
    );

    register_rest_route(
        'vin/v1',
        '/residential_life',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_residential_life',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/student_clubs_associations',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_student_clubs_associations',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/health_well_being',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_health_well_being',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/international_students',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_international_students',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/student_services_ssic',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_student_services_ssic',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/global_exchange',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_global_exchange',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/career_services',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_career_services',
            'permission_callback' => '__return_true',
        )
    );
    register_rest_route(
        'vin/v1',
        '/events',
        array(
            'methods' => 'GET',
            'callback' => 'vin_get_events',
            'permission_callback' => '__return_true',
        )
    );
});

// data response success
function cl_response_success($response)
{
    $response['status_code'] = 200;
    $response['status'] = 'OK';
    return $response;
}


// data response error
function cl_response_error($response)
{
    $response['status_code'] = 204;
    $response['status'] = 'False';
    $response['message'] = __('Not found', 'clvinuni');;
    return $response;
}

// get lang request
function get_param_lang($request)
{
    $language_code = $request->get_param('language_code') ?? null;
    if (function_exists('pll_default_language') && empty($language_code)) {
        $language_code = pll_default_language();
    }
    return $language_code;
}

// get data object post
function get_post_id_by_acf($request, $keyAcf)
{
    $lang = get_param_lang($request);
    $post_id = get_field('api_data_setting_' . $lang . '_' . $keyAcf, 'option');
    return $post_id ?: null;
}

// get code lang other, post id other
function get_other_code($language_code, $idpost)
{
    $codeLangOther = ($language_code == 'en') ? 'vi' : 'en';
    $otherID = function_exists('pll_get_post') && pll_get_post($idpost, $codeLangOther) ? pll_get_post($idpost, $codeLangOther) : null;
    $response = [
        'otherLangCode' => $codeLangOther,
        'otherID' => $otherID
    ];

    return $response;
}

// get code lang other, term id other
function get_other_term($language_code, $idpost)
{
    $codeLangOther = ($language_code == 'en') ? 'vi' : 'en';
    $otherID = function_exists('pll_get_term') && pll_get_term($idpost, $codeLangOther) ? pll_get_term($idpost, $codeLangOther) : null;
    $response = [
        'otherLangCode' => $codeLangOther,
        'otherID' => $otherID
    ];

    return $response;
}

// build category tree
function build_category_tree($lang, $categories, $parent_id = 0)
{
    $branch = array();

    foreach ($categories as $category) {
        if ($category->parent == $parent_id) {
            $children = build_category_tree($lang, $categories, $category->term_id);
            $otherCode = get_other_term($lang, $category->term_id );
            
            if ($children) {
                $category->children = $children;
            }
            $branch[] = [
                $lang . '_category_id' => $category->term_id,
                $otherCode['otherLangCode'] . '_category_id' => $otherCode['otherID'],
                'name' => $category->name,
                'parent_id' => $category->parent,
                'category_level' => count(get_ancestors($category->term_id, 'category')),
                'children' => isset($category->children) ? $category->children : [],
            ];
        }
    }
    return $branch;
}

/**
 * Get categories
 */
function vin_get_categories($request)
{
    $language_code = get_param_lang($request);

    $categories = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => true,
        'lang' => $language_code,
    ));

    $category_tree = build_category_tree($language_code, $categories, 0);
    $response['list'] = $category_tree;

    return cl_response_success($response);
}

// Get category detail
function vin_get_category_detail($request)
{
    $id = $request->get_param('category_id') ?? '';
    $page = $request->get_param('page') ?? '1';
    $language_code = get_param_lang($request);
    $posts_per_page = get_option('posts_per_page');
    $data = [];
    $response = [];
    if (!$id) {
        return cl_response_error($response);
    }
    $news = new WP_Query(
        array(
            'post_type' => 'post',
            'category__in' => $id,
            'paged' => max($page, get_query_var('paged')),
            'post_status' => 'publish',
            'lang' => $language_code,
            'meta_query' => array(
                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS',
                ),
            ),
            'orderby' => 'date',
            'order' => 'DESC',
        )
    );
    if (!$news->have_posts()) {
        return cl_response_error($response);
    }

    if ($news->have_posts()) {
        $total_posts = $news->found_posts;
        while ($news->have_posts()) {
            $news->the_post();
            $display_detail = get_field('display_details', get_the_ID()) ?? 'yes';
            $link_page = get_field('link_page', get_the_ID()) ?? [];
            $link = null;
            if ($display_detail == 'yes') {
                $link = get_permalink() . '?view=mobi';
            } else {
                if ($link_page && $link_page['url']) {
                    $link = $link_page['url'] . '?view=mobi';
                }
            }
            $otherCode = get_other_code($language_code, get_the_ID());
            $data[] = [
                $language_code . '_post_id' => get_the_ID(),
                $otherCode['otherLangCode'] . '_post_id' => $otherCode['otherID'],
                'publish_date' => get_the_date('d/m/Y'),
                'post_name' => get_the_title(),
                'featured_img' => get_the_post_thumbnail_url(),
                'webview_link' => $link,
            ];
        }
        wp_reset_postdata();
        $response['current_page'] = $page;
        $response['post_per_page'] = $posts_per_page;
        $response['total_post'] = $total_posts;
        $response['list'] = $data;
    }
    return cl_response_success($response);
}

function vin_get_page_in_student_life($request, $keyAcf)
{
    $response = [];
    $data = [];
    $post_id = get_post_id_by_acf($request, $keyAcf);
    if (empty($post_id)) {
        return $response;
    }
    $language_code = get_param_lang($request);

    $id = function_exists('pll_get_post') ? pll_get_post($post_id, $language_code) : '';
    $otherCode = get_other_code($language_code, $post_id);
    if (empty($id)) {
        return $response;
    }
    $data[] = [
        $language_code . '_post_id' => $post_id,
        $otherCode['otherLangCode'] . '_post_id' => $otherCode['otherID'],
        'title' => get_the_title($post_id),
        'webview_link' => get_permalink($post_id) . '?view=mobi'
    ];
    $response['list'] = $data;
    return $response;
}

// get api page residential_life
function vin_get_residential_life($request)
{
    $response = vin_get_page_in_student_life($request, 'residential_life');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page student_clubs_associations
function vin_get_student_clubs_associations($request)
{
    $response = vin_get_page_in_student_life($request, 'student_clubs_associations');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page health_well_being
function vin_get_health_well_being($request)
{
    $response = vin_get_page_in_student_life($request, 'health_well_being');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page international_students
function vin_get_international_students($request)
{
    $response = vin_get_page_in_student_life($request, 'international_students');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page student_services_ssic
function vin_get_student_services_ssic($request)
{
    $response = vin_get_page_in_student_life($request, 'student_services_ssic');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page global_exchange
function vin_get_global_exchange($request)
{
    $response = vin_get_page_in_student_life($request, 'global_exchange');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}

// get api page career_services
function vin_get_career_services($request)
{
    $response = vin_get_page_in_student_life($request, 'career_services');
    if (empty($response)) {
        return cl_response_error($response);
    }
    return cl_response_success($response);
}
// get api page career_services
function vin_get_events($request)
{
    $response = [];
    $language_code = get_param_lang($request);
    $page = $request->get_param('page') ?? '1';
    $posts_per_page = 24;
    $args_event = array(
        'post_type' => 'event',
        'posts_per_page' => $posts_per_page,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'paged' => max($page, get_query_var('paged')),
        'lang' => $language_code,
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'value' => '',
                'compare' => '!=',
            ),
        ),
    );
    $event_posts = new WP_Query($args_event);
    if (!$event_posts->have_posts()) {
        return cl_response_error($response);
    }
    if ($event_posts->have_posts()) {
        $total_posts = $event_posts->found_posts;
        while ($event_posts->have_posts()) {
            $event_posts->the_post();
            $link = get_permalink() . '?view=mobi';
            $otherCode = get_other_code($language_code, get_the_ID());
            $data[] = [
                $language_code . '_post_id' => get_the_ID(),
                $otherCode['otherLangCode'] . '_post_id' => $otherCode['otherID'],
                'post_name' => get_the_title(),
                'event_date' => get_field('event_date') ?? '',
                'featured_img' => get_the_post_thumbnail_url() ?: "",
                'webview_link' => $link,
            ];
        }
        wp_reset_postdata();
        $response['current_page'] = $page;
        $response['post_per_page'] = $posts_per_page;
        $response['total_post'] = $total_posts;
        $response['list'] = $data;
    }


    return cl_response_success($response);
}
