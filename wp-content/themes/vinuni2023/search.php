<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package clvinuni
 */

get_header();

$text_search = strip_tags(get_search_query());
$text_search_param = urlencode(get_search_query());
$link_search = get_url_search() . '?s=' . $text_search_param . '&q=' . $text_search_param;
// get param on url
if (!empty($_GET["post_type"])) {
    $postTypeSearch = $_GET['post_type'];
} else {
    $postTypeSearch = 'all';
}
?>

<div class="pageSearch space--bottom">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>

        <!-- form input search -->
        <form class="searchClub__inner secHeading" method="get" action="<?php echo get_url_search(); ?>" role="search">
            <div class="row no-gutters">
                <div class="col-md-7">
                    <input type="text" class="searchClub__input pageSearch__input" aria-label="search"
                        aria-describedby="search-addon" name="s" placeholder="Search by keyword"
                        value="<?php echo $text_search; ?>">
                    <input type="text" class="pageSearch__input d-none" name="q">
                </div>
                <div class="col-md-3">
                    <button type="submit"
                        class="btnSearch btnSeeMore btnCTA searchClub__btnSearch pageSearch__btnSeach">
                        <span>
                            <?php _e('Search', 'clvinuni'); ?>
                        </span>
                    </button>
                </div>
                <div class="col-md-2">
                    <div class="ml-md-2 ml-lg-3 searchClub__btnWrap">
                        <a class="btnSearch btnSeeMore btnCTA searchClub__btnReset pageSearch__btnReset">
                            <span>
                                <?php _e('Reset', 'clvinuni'); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- returns search results -->
            <?php
            if ($text_search):
                ?>
                <div class="pageSearch__result">
                    <?php _e('Search result for', 'clvinuni'); ?> <span class="pageSearch__resultHightlight">
                        <?php echo $text_search; ?>
                    </span>
                </div>
                <?php
            endif;
            ?>
        </form>

        <!-- list of post types -->
        <?php
        $arr_post_type = [
            [
                'key' => 'all',
                'label' => __('All', 'clvinuni'),
            ],
            [
                'key' => 'people',
                'label' => __('People', 'clvinuni'),
            ],
            [
                'key' => 'post',
                'label' => __('News', 'clvinuni'),
            ],
            [
                'key' => 'event',
                'label' => __('Events', 'clvinuni'),
            ],
        ];
        ?>
        <ul class="pageSearch__postType">
            <?php
            foreach ($arr_post_type as $item):
                $class_item = $item['key'] == $postTypeSearch ? 'active' : '';
                $link_item = $link_search . '&post_type=' . $item['key'];
                ?>
                <li class="<?php echo $class_item; ?>">
                    <a href="<?php echo $link_item; ?>">
                        <?php echo $item['label']; ?>
                    </a>
                </li>
                <?php
            endforeach;
            ?>
        </ul>

        <!-- search của google api -->
        <?php if ($postTypeSearch == 'all'): ?>
            <script async src="https://cse.google.com/cse.js?cx=254e1f1a911f14bb7"></script>
            <div class="gcse-searchresults-only"></div>
        <?php endif; ?>

        <?php
        if ($postTypeSearch !== 'all' && $postTypeSearch !== 'people'):
            ?>
            <!-- các bài viết được tìm kiếm -->
            <div class="pageSearch__posts my-4 my-lg-5">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        ?>
                        <div class="pageSearch__postsItem">
                            <h3 class="pageSearch__postsTitle">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <div class="pageSearch__postsDesc">
                                <?php
                                if (has_post_thumbnail()):
                                    ?>
                                    <div class="pageSearch__postsImg">
                                        <a href="<?php the_permalink(); ?>" class="imgGroup">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        </a>
                                    </div>
                                    <?php
                                endif;
                                ?>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
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

            <div class="pagination">
                <?php
                echo paginate_links(
                    array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total' => $wp_query->max_num_pages,
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
            <?php
        endif;
        ?>

        <?php
        if ($postTypeSearch == 'people'):
            $target = '';
            $id_college_for_site = get_field('id_college_for_site_' . LANG, 'option') ?? null;

            if (!is_main_site()) {
                $target = ' target="_blank" ';
            }

            // call api
            $endpoint = '/wp-json/wp/v2/search?post_type=people&search=' . $text_search;
            $data = custom_api_request($endpoint, 'GET');
            $data = (array) $data;
            ?>
            <div class="pageSearch__posts mt-4 mt-lg-5">
                <?php
                if ($data):
                    foreach ($data as $people):
                        $data = load_people_data([$people->id]);

                        if ($data):
                            $data = (array) $data;
                            $item = $data && $data[$people->id] ? $data[$people->id] : null;

                            if ((is_main_site() && $item) || (!is_main_site() && $item && $id_college_for_site && $item->college && in_array((int) $id_college_for_site, $item->college))):
                                ?>
                                <div class="pageSearch__postsItem">
                                    <h3 class="pageSearch__postsTitle">
                                        <a href="<?php echo $item->link; ?>" <?php echo $target; ?>>
                                            <?php echo $item->title; ?>
                                        </a>
                                    </h3>

                                    <div class="pageSearch__postsDesc">
                                        <?php
                                        if ($item->image):
                                            ?>
                                            <div class="pageSearch__postsImg">
                                                <a <?php echo $target; ?> href="<?php echo $item->link; ?>" class="imgGroup">
                                                    <img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>">
                                                </a>
                                            </div>
                                            <?php
                                        endif;
                                        ?>

                                        <?php if ($item->desc_search): ?>
                                            <p>
                                                <?php echo $item->desc_search; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endif;
                    endforeach;
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
            <?php
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
?>
<script>
    $(document).ready(function () {
        $('.pageSearch__btnReset').on('click', function () {
            $('.pageSearch__input').val('').focus();
        });
    })
</script>