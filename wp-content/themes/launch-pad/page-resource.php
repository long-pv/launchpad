<?php
/**
 * Template Name: Resource
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package launch-pad
 */

get_header();
?>

<div class="container_xx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="container">
                <?php
                $title_block = get_field('title_block') ?: get_the_title();
                ?>
                <h1 class="sec_title">
                    <?php echo $title_block; ?>

                    <?php $class_page_mark = (isset($_COOKIE['bookmarked_pages']) && in_array(get_the_ID(), json_decode(stripslashes($_COOKIE['bookmarked_pages']), true) ?? [])) ? 'active' : ''; ?>
                    <div class="page_mark <?php echo $class_page_mark; ?>" data-id="<?php echo get_the_ID(); ?>"></div>
                </h1>

                <div class="page_body_xx page_body_resource">
                    <div class="page_scroll page_scroll_resource d-block">
                        <div id="sectionPortal">
                            <?php
                            $categories = get_terms(
                                array(
                                    'taxonomy' => 'category_link',
                                    'hide_empty' => false,
                                    'terms' => array('name', 'count'),
                                )
                            );

                            if (!empty($categories)):
                                ?>
                                <div class="portal">
                                    <div class="container_xx">
                                        <div class="row portal_row">
                                            <?php
                                            foreach ($categories as $category):
                                                setup_postdata($category);
                                                if ($category->count > 0):
                                                    ?>
                                                    <div class="col-lg-4 col-md-6 portal__col">
                                                        <?php
                                                        $args = array('category' => $category);
                                                        get_template_part('template-parts/single/category-item', '', $args);
                                                        ?>
                                                    </div>
                                                    <?php
                                                endif;
                                            endforeach;
                                            wp_reset_postdata();
                                            ?>
                                        </div>
                                        <div class="portal__noResult">
                                            <p><?php _e('No search results found.', 'launchpad') ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>
<?php
get_footer();
