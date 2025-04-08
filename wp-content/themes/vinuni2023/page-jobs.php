<?php

/**
 * Template name: Page jobs
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

// header template
get_header();
?>
<h1 class="pageTitle">
    <?php the_title(); ?>
</h1>
<?php
// flexible content
get_template_part('template-parts/content-flexible');
?>
<!-- List jobs -->
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$job_division = isset($_GET['job_division']) ? $_GET['job_division'] : '';
$work_location = isset($_GET['work_location']) ? $_GET['work_location'] : '';

$tax_query = ($job_division || $work_location) ? ['relation' => 'AND'] : [];

if ($job_division && $job_division != 'all') {
    $tax_query[] = ['taxonomy' => 'job_division', 'field' => 'term_id', 'terms' => $job_division];
}
if ($work_location && $work_location != 'all') {
    $tax_query[] = ['taxonomy' => 'job_location', 'field' => 'term_id', 'terms' => $work_location];
}

$date = DateTime::createFromFormat('Ymd H:i:s', date('Ymd') . ' 00:00:00');
$time = $date ? $date->getTimestamp() * 1000 : 0;

$jobs = new WP_Query([
    'post_type' => 'job',
    'posts_per_page' => 10,
    'paged' => $paged,
    'tax_query' => $tax_query,
    'meta_query' => [
        [
            'key' => 'date_jobs',
            'value' => $time,
            'compare' => '>=',
        ]
    ],
    'orderby' => 'meta_value_num',
    'meta_key' => 'date_jobs',
    'order' => 'ASC'
]);
?>
<section class="space jobs">
    <div class="container">
        <div class="row secHeading">
            <div class="col-lg-7">
                <h2 class="h2 secTitle secHeading__title jobs__title">
                    <?php _e('List <span>Jobs</span>', 'clvinuni'); ?>
                </h2>
            </div>
            <div class="col-lg-5">
                <p class="h4 jobs__result">
                    <?php _e('Jobs matched with your search: ', 'clvinuni'); ?><span class="h2"><span
                            class="text-primary font-weight-bold">
                            <?php echo $jobs->found_posts; ?>
                        </span></span>
                </p>
            </div>
        </div>
        <?php if ($jobs->have_posts()): ?>
            <div class="d-none d-lg-block">
                <div class="row jobs__inner">
                    <div class="col-lg-7">
                        <p class="h3 jobs__headTitle">
                            <?php _e('Position', 'clvinuni'); ?>
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <p class="h3 jobs__headTitle text-lg-right">
                            <?php _e('Deadline', 'clvinuni'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="jobs__list">
                <?php
                while ($jobs->have_posts()):
                    $jobs->the_post();
                    get_template_part('template-parts/single/jobs_item');
                endwhile;
                wp_reset_query();
                ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <?php _e('No jobs found', 'clvinuni'); ?>
            </div>
        <?php endif; ?>
        <div class="pagination">
            <?php
            echo paginate_links(
                array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'total' => $jobs->max_num_pages,
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
</section>

<!-- Testimonials -->
<?php
$block_info = get_field('block_info')['block_info'] ?? [];
$customClass = $block_info['custom_class'] ?? '';
$testimonial_list = get_field('block_content')['testimonials'] ?? [];
if($block_info['title'] || $block_info['description'] || $testimonial_list):
?>
<section class="secSpace <?php echo $customClass; ?>">
    <?php
    $args['flexible']['block_info'] = $block_info;
    $args['flexible']['block_content'] = get_field('block_content');

    get_template_part('template-parts/block/testimonials', '', $args);
    ?>
</section>
<?php
endif;
// footer template
get_footer();
