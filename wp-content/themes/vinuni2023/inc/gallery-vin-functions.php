<?php 

// custom query search title
add_filter('posts_where', 'gallery_title_filter', 10, 2);
function gallery_title_filter($where, $wp_query) {
    global $wpdb;
    $post_type = $wp_query->get('post_type');
    if ($post_type === 'vinuni_gallery') {
        if ($search_term = $wp_query->get('search_title')) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
        }
    }
    return $where;
}

// redirect tax in gallery  to home
function redirect_gallery_tax_to_home() {
    if (is_tax('gallery_category') || is_tax('gallery_college') || is_tax('gallery_year') || is_tax('gallery_tags')) {
        wp_redirect(home_url());
        exit();
    }
}
add_action('template_redirect', 'redirect_gallery_tax_to_home');

/**
 * Campus Gallery Generates a select dropdown with taxonomy terms, styled with customSelect2.
 *
 * @param string $taxonomy       - Taxonomy name.
 * @param string $placeholder    - Placeholder text for the select element.
 * @param string $optionFirst    - Option text first.
 * @return string                - HTML markup for the select element.
 */
function generate_select_options_with_tax_campusGallery($taxonomy, $placeholder, $optionFirst)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ]);

    ob_start();
    ?>
        <p class="campusGallery__label"><?php echo esc_attr($placeholder); ?></p>
        <div class="customSelect2">
            <select class="campusGallery__select" data-placeholder="<?php echo esc_attr($placeholder); ?>"
                data-noresult="<?php _e('No results found', 'clvinuni'); ?>" name="cp_<?php echo esc_attr($taxonomy); ?>"
                id="cp_<?php echo esc_attr($taxonomy); ?>">
                <!-- <option selected></option> -->
                <option value="all">
                    <?php echo esc_attr($optionFirst); ?>
                </option>
                <?php
                if ($terms):
                    foreach ($terms as $term):
                        ?>
                        <option value="<?php echo esc_attr($term->term_id); ?>">
                            <?php echo esc_html($term->name); ?>
                        </option>
                        <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
    <?php

    return ob_get_clean();
}

// get category primary of gallery
function get_gallery_category_primary($postID){
    $primary_category_id = get_post_meta($postID, '_yoast_wpseo_primary_gallery_category', true);
    $primary_category = null;
    if ($primary_category_id) {
        $primary_category = get_term($primary_category_id, 'gallery_category');
    } else {
        $gallery_category = get_the_terms($postID, 'gallery_category');
        $primary_category = $gallery_category ? $gallery_category[0] : null;
    }
    return $primary_category;
}