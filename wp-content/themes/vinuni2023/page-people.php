<?php

/**
 * Template name: People - Directory
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

get_header();
?>
<!-- Banner -->
<?php
get_template_part('template-parts/content-banner-page');
?>
<!-- /End Banner -->

<?php
// Get article data
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$key = !empty($_GET['key']) ? $_GET['key'] : '';

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

if ($key) {
    $args['s'] = $key;
}

$people = new WP_Query($args);
?>

<div class="archiveEvent space">
    <div class="container">
        <form class="searchClub__inner secHeading">
            <h1 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
                <?php echo custom_title(get_the_title()); ?>
            </h1>
            <div class="row no-gutters">
                <div class="col-md-9">
                    <input type="text" class="searchClub__input pageSearch__input" placeholder="Search by keyword"
                        value="<?php echo $key; ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btnSearch btnSeeMore btnCTA pageSearch__btnSeach">
                        <span>
                            <?php _e('Search', 'clvinuni'); ?>
                        </span>
                    </button>
                </div>
            </div>

            <!-- returns search results -->
            <?php
            if ($key):
                ?>
                <div class="pageSearch__result">
                    <?php _e('Search result for', 'clvinuni'); ?> <span class="pageSearch__resultHightlight">
                        <?php echo $key; ?>
                    </span>
                </div>
                <?php
            endif;
            ?>
        </form>

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
?>
<script>
    $(document).ready(function () {
        var url = '<?php the_permalink(); ?>';
        var searchClub__inner = $('.searchClub__inner');
        var pageSearch__input = $('.pageSearch__input');

        searchClub__inner.on('submit', function (e) {
            e.preventDefault();
            var search_val = pageSearch__input.val();
            window.location.href = url + "?key=" + search_val;
        });
    });
</script>