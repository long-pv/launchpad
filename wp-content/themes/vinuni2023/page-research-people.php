<?php

/**
 * Template name: Research People
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */

// page redirection
$redirection = get_field('redirection') ?? null;
if ($redirection) {
    wp_redirect($redirection);
    exit;
}

// Get article data
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$college = !empty ($_GET['college']) ? $_GET['college'] : '';
$research_area = !empty ($_GET['research_area']) ? $_GET['research_area'] : '';
$last_name = !empty ($_GET['last_name']) ? $_GET['last_name'] : '';

$college_categories = get_terms([
    'taxonomy' => 'college',
    'hide_empty' => true,
]);

$areas = get_terms([
    'taxonomy' => 'research_area',
    'hide_empty' => true
]);

$args = array(
    'post_type' => 'people',
    'posts_per_page' => -1,
    'paged' => $paged,
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
);

$check_query = false;
$tax_query = [];

foreach (['college', 'research_area'] as $taxonomy) {
    if ($$taxonomy && $$taxonomy != 'all') {
        $tax_query[] = ['taxonomy' => $taxonomy, 'field' => 'name', 'terms' => $$taxonomy];
        $check_query = true;
    }
}

if ($last_name && $last_name != 'all') {
    $args['s'] = $last_name;
}
if ($check_query) {
    $tax_query['relation'] = 'AND';
    $args['tax_query'] = $tax_query;
}

$people = new WP_Query($args);

get_header();
?>

<!-- Banner -->
<?php
get_template_part('template-parts/content-banner-page');
?>
<!-- /End Banner -->

<div class="pageResearchPeople space" data-url="<?php echo get_permalink(); ?>">
    <div class="container">
        <div class="pageResearchPeople__searchInner secHeading">
            <h1 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
                <?php echo custom_title(get_the_title()); ?>
            </h1>
            <div class="row justify-content-center pageResearchPeople__row">
                <div class="col-lg-8">
                    <div class="row pageResearchPeople__row">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="pageResearchPeople__group">
                                <div class="customSelect2">
                                    <select class="pageResearchPeople__select"
                                        data-placeholder="<?php _e('College', 'clvinuni'); ?>"
                                        data-noresult="<?php _e('No results found', 'clvinuni'); ?>" name="college"
                                        id="college">
                                        <option value="">None</option>
                                        <option value="all">
                                            <?php _e('All', 'clvinuni'); ?>
                                        </option>
                                        <?php
                                        foreach ($college_categories as $term):
                                            ?>
                                            <option <?php echo $college == $term->name ? 'selected' : ''; ?>
                                                value="<?php echo esc_attr($term->name); ?>">
                                                <?php echo esc_html($term->name); ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="pageResearchPeople__group">
                                <div class="customSelect2">
                                    <select class="pageResearchPeople__select"
                                        data-placeholder="<?php _e('Research area', 'clvinuni'); ?>"
                                        data-noresult="<?php _e('No results found', 'clvinuni'); ?>"
                                        name="research_area" id="research_area">
                                        <option value="">None</option>
                                        <option value="all">
                                            <?php _e('All', 'clvinuni'); ?>
                                        </option>
                                        <?php
                                        foreach ($areas as $term_area):
                                            ?>
                                            <option <?php echo $research_area == $term_area->name ? 'selected' : ''; ?>
                                                value="<?php echo esc_attr($term_area->name); ?>">
                                                <?php echo esc_html($term_area->name); ?>
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="pageResearchPeople__group">
                                <input type="text" id="last_name" name="last_name" class="pageResearchPeople__input"
                                    placeholder="<?php _e('Last name', 'clvinuni') ?>"
                                    value="<?php echo $last_name ?? ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row pageResearchPeople__row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a class="btnSeeMore btnCTA pageResearchPeople__search pageResearchPeople__btn">
                                <span>
                                    <?php _e('Search', 'clvinuni'); ?>
                                </span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="searchClub__btnWrap">
                                <a href="<?php echo get_permalink(); ?>"
                                    class="btnSeeMore btnCTA pageResearchPeople__viewAll pageResearchPeople__btn">
                                    <span>
                                        <?php _e('View all', 'clvinuni') ?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $args['page_url'] = get_permalink();
        if ($people->have_posts()):
            ?>
            <div class="pageResearchPeople__peopleInner">
                <div class="row pageResearchPeople__peopleGutter">
                    <?php
                    while ($people->have_posts()):
                        $people->the_post();
                        if (get_post_type() == 'people'):
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <?php get_template_part('template-parts/single/leaders', null, $args); ?>
                            </div>
                            <?php
                        endif;
                    endwhile;
                    ?>
                </div>
                <div class="pagination">
                    <?php
                    echo paginate_links(
                        array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total' => $people->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'show_all' => false,
                            'type' => 'plain',
                            'end_size' => 2,
                            'mid_size' => 1,
                            'prev_next' => true,
                            'prev_text' => sprintf('<span class="pagination__prev"></span>'),
                            'next_text' => sprintf('<span class="pagination__next"></span>'),
                            'add_args' => false,
                            'add_fragment' => '',
                        )
                    );
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        else:
            ?>
            <strong>
                <?php _e('Nothing Found', 'clvinuni') ?>
            </strong>
            <p>
                <?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clvinuni') ?>
            </p>
            <?php
        endif;
        ?>
    </div>
</div>
<?php
get_footer();
