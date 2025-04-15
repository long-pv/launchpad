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

                <div class="page_body">
                    <div class="page_scroll d-block">
                        <!-- .... -->
                    </div>
                </div>
            </div>

            <?php get_template_part('template-parts/page_bottom'); ?>
        </div>
    </div>
</div>
<?php
get_footer();
