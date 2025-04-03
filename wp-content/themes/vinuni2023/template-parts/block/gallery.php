<?php
$block_info = $args['flexible']['block_info'] ?? [];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$search_keyword = isset($_GET['search_keyword']) ? $_GET['search_keyword'] : '';

$cp_gallery_cat = isset($_GET['cp_gallery_cat']) ? $_GET['cp_gallery_cat'] : '';
$cp_gallery_college = isset($_GET['cp_gallery_college']) ? $_GET['cp_gallery_college'] : '';
$cp_year = isset($_GET['cp_year']) ? $_GET['cp_year'] : '';
$cp_tags = isset($_GET['cp_tags']) ? $_GET['cp_tags'] : '';

$tax_query = ($cp_gallery_cat || $cp_gallery_college || $cp_year || $cp_tags) ? ['relation' => 'AND'] : [];

if ($cp_gallery_cat && $cp_gallery_cat != 'all') {
    $tax_query[] = ['taxonomy' => 'gallery_category', 'field' => 'term_id', 'terms' => $cp_gallery_cat];
}
if ($cp_gallery_college && $cp_gallery_college != 'all') {
    $tax_query[] = ['taxonomy' => 'gallery_college', 'field' => 'term_id', 'terms' => $cp_gallery_college];
}
if ($cp_year && $cp_year != 'all') {
    $tax_query[] = ['taxonomy' => 'gallery_year', 'field' => 'term_id', 'terms' => $cp_year];
}
if ($cp_tags && $cp_tags != 'all') {
    $tax_query[] = ['taxonomy' => 'gallery_tags', 'field' => 'term_id', 'terms' => $cp_tags];
}

$args = array(
    'post_type' => 'vinuni_gallery',
    'posts_per_page' => 9,
    'paged' => $paged,
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
);

if (!empty($search_keyword)) {
    $args['search_title'] = $search_keyword;
}

if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}


$galleryPosts = new WP_Query($args);

$arr_tax = [
    [
        'gallery_college',
        __('College', 'clvinuni'),
        __('All College', 'clvinuni')
    ],
    [
        'gallery_category',
        __('Category', 'clvinuni'),
        __('All Category', 'clvinuni')
    ],
    [
        'gallery_year',
        __('Year', 'clvinuni'),
        __('All Year', 'clvinuni')
    ],
    [
        'gallery_tags',
        __('Tags', 'clvinuni'),
        __('All Tags', 'clvinuni')
    ],
];
?>

<div class="campusGallery" id="campusGallery">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <div class="campusGallery__inner">
            <div class="campusGallery__filterWrap">
                <div class="wow fadeInUp" data-wow-duration="2s">
                    <div class="row no-gutters justify-content-between">
                        <div class="col-md-3">
                            <div class="campusGallery__filter">
                                <a class="campusGallery__filterBtn"><?php _e('Filter','clvinuni') ?> +</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <input type="text" name="search_keyword" class="campusGallery__input" placeholder="<?php _e('Search by keyword', 'clvinuni') ?>">
                                </div>
                                <div class="col-md-6">
                                    <a href="javascript:void(0);" class="btnSearch btnSeeMore btnCTA campusGallery__btnSearch"><span><?php _e('Search', 'clvinuni') ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="campusGallery__filterCat">
                    <div class="row no-gutters">
                        <div class="col-lg-8">
                            <div class="campusGallery__filterCatWrap">
                                <div class="campusGallery__filterList">
                                    <div class="row">
                                        <?php foreach ($arr_tax as $i => $item) : ?>
                                            <div class="col-md-6">
                                                <div class="campusGallery__filterItem">
                                                    <?php echo generate_select_options_with_tax_campusGallery($item[0], $item[1], $item[2]); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="btnCTA btnSeeMore campusGallery__btnFilter"><?php _e('Apply Filters','clvinuni') ?></a>
                                <div class="text-center">
                                    <a href="javascript:void(0);" class="link campusGallery__btnReset"><?php _e('Reset','clvinuni') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            if ($galleryPosts->have_posts()) :
            ?>
                <div class="campusGallery__list">
                    <div class="row campusGallery__listRow">
                        <?php while ($galleryPosts->have_posts()) : $galleryPosts->the_post(); ?>
                            <div class="col-md-6 col-lg-4">
                                <?php get_template_part('template-parts/single/gallery_item'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="pagination">
                    <?php
                    echo paginate_links(
                        array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total' => $galleryPosts->max_num_pages,
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
                            'add_fragment' => '#campusGallery',
                        )
                    );
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif;
            remove_filter('posts_where', 'gallery_title_filter', 10, 2); ?>
        </div>
    </div>
</div>

<?php
if (isset($_GET['cp_gallery_cat']) || isset($_GET['gallery_college']) || isset($_GET['cp_year']) || isset($_GET['cp_tags']) || isset($_GET['search_keyword'])) {
    $scroll_key = 'true';
} else {
    $scroll_key = '';
}
?>
<div id="campusGalleryInfo" class="d-none" data-url="<?php echo get_permalink() ?>" data-scroll="<?php echo $scroll_key; ?>"></div>