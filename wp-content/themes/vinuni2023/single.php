<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package clvinuni
 */
// get value data
$post_type = get_post_type();

// Handles conditions for post type on_media
if ($post_type == 'on_media') {
    $link_newspaper = get_field('on_media_link') ?? null;
    if ($link_newspaper) {
        wp_redirect($link_newspaper);
        exit;
    }
}

if ($post_type == 'testimonial') {
    $display_details = get_field('display_details') ?? 'yes';
    if ($display_details == 'no') {
        $link_page = get_field('link_page') ?? [];
        if ($link_page) {
            wp_redirect($link_page['url']);
            exit;
        } else {
            wp_redirect(home_url());
            exit;
        }
    }
}

if ($post_type == 'event') {
    $display_details = get_field('display_detail') ?? 'yes';
    if ($display_details == 'no') {
        wp_redirect(home_url());
        exit;
    }
}

// Check if the post type is 'event'
if ($post_type == 'event') {
    // Get the value of the 'event_date' field
    $event_date_field = get_field('event_date');
    $event_date = custom_convert_time($event_date_field);
}

$categories = get_the_category();
$related_posts = [];
if ($post_type == 'post' && !empty($categories)) {
    function get_category_level($category_id)
    {
        $ancestors = get_ancestors($category_id, 'category');
        return count($ancestors);
    }

    $category_levels = array();

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $level = get_category_level($category->term_id);

            if (!isset($category_levels[$level])) {
                $category_levels[$level] = array();
            }

            $category_levels[$level][] = $category->term_id;
        }
    }

    function get_related_posts($category_ids, $current_post_id, $per_page_post)
    {
        $related_posts = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => $per_page_post,
                'category__in' => $category_ids,
                'post__not_in' => array($current_post_id),
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
        return $related_posts;
    }

    $related_posts = null;
    $category_posts = null;
    $levels = array_keys($category_levels);
    rsort($levels);

    $per_page_post = 10;

    foreach ($levels as $level) {
        $category_ids = $category_levels[$level];
        $related_posts = get_related_posts($category_ids, get_the_ID(), $per_page_post);

        if ($related_posts->have_posts()) {
            $category_posts = $category_ids;
            break;
        }
    }
}

get_header();

// flexible content
if ($post_type == 'academics' || $post_type == 'student_life' || $post_type == 'aid' || $post_type == 'global_exchange'):
    $select_templates = get_field('select_templates') ?? 'default';
    if ($select_templates == 'default'):
        get_template_part('template-parts/content-flexible');
    else:
        get_template_part('template-parts/content-page-article');
    endif;
else:
    ?>
    <section class="space--bottom">
        <div class="container">
            <div class="breadcrumbsBlock">
                <?php wp_breadcrumbs(); ?>
            </div>

            <div class="row justify-content-center">
                <?php
                if ($post_type == 'course'):
                    ?>
                    <div class="col-lg-4">
                        <?php get_template_part('template-parts/block/sidebar_menu'); ?>
                    </div>
                    <?php
                endif;
                ?>

                <?php
                if ($post_type == 'course') {
                    $class_content_bar = 'col-lg-8';
                } else {
                    $class_content_bar = 'col-lg-12';
                }
                ?>

                <div class="<?php echo $class_content_bar; ?>">

                    <?php
                    if ($post_type == 'post') {
                        echo '<div class="row justify-content-center">';
                        echo '<div class="col-lg-9">';
                        echo '<div class="contentEditorPost">';
                    }
                    ?>

                    <?php
                    if ($post_type == 'post'):
                        $display_top_media = get_field('display_top_media') ?? 'no';

                        if ($display_top_media === '1'):
                            $iframe_youtube = get_field('iframe_youtube');
                            $iframe_caption = get_field('iframe_caption');

                            if ($iframe_youtube):
                                $attr = 'src="' . $iframe_youtube . '?controls=1&autoplay=0&mute=1&playsinline=1&loop=1"';
                                ?>
                                <div class="storiesItem__video mb-3">
                                    <iframe <?php echo $attr; ?>></iframe>
                                    <?php
                                    if ($iframe_caption) {
                                        echo '<p class="postContent__imgCaption wp-caption-text">' . $iframe_caption . '</p>';
                                    }
                                    ?>
                                </div>
                                <?php
                            endif;

                        elseif ($display_top_media === '0'):
                            if (has_post_thumbnail()):
                                $caption = get_the_post_thumbnail_caption(get_the_ID());
                                ?>
                                <div class="postContent__img">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

                                    <?php if ($caption): ?>
                                        <p class="postContent__imgCaption wp-caption-text">
                                            <?php echo $caption; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <?php
                            endif;
                        endif;
                    endif;
                    ?>

                    <h1 class="h2 font-weight-bold postContent__title">
                        <?php the_title(); ?>
                    </h1>

                    <?php
                    if (is_multisite() && is_main_site() && $post_type == 'post'):
                        $authors = get_field('author') ?? null;
                        by_author_post($authors);
                    endif;
                    ?>

                    <?php if ($post_type == 'post'): ?>
                        <div class="h6 font-weight-normal mb-4 postContent__date">
                            <?php echo LANG == 'vi' ? the_time('d/m/Y') : the_time('F j, Y'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Event start date in post event -->
                    <?php
                    if ($post_type == 'event') {
                        echo isset($event_date) ? '<p><strong>' . __('Event date') . ': ' . $event_date . '</strong></p>' : '';
                    }
                    ?>
                    <!-- end -->

                    <?php
                    if ($post_type == 'post') {
                        echo '<div class="d-lg-flex justify-content-center">';
                        echo '<div class="postContent__inner">';
                    }
                    ?>

                    <div class="editor">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    if ($post_type == 'post'):
                        if (get_field('next_article_link')):
                            if (LANG == 'vi') {
                                $title_next_post = 'Nhấn vào đây để đọc bài tiếp theo';
                            } else {
                                $title_next_post = 'Click here to read the next article';
                            }

                            if (get_field('next_article_title')) {
                                $title_next_post = get_field('next_article_title');
                            }
                            ?>
                            <div class="d-flex justify-content-end postContent__next">
                                <a href="<?php echo get_field('next_article_link'); ?>" class="btnSeeMore wow fadeInUp"
                                    data-wow-duration="1s">
                                    <?php echo $title_next_post; ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        echo '</div></div>';


                        if (is_multisite() && is_main_site()):
                            if (get_field('author') || get_field('reference')):
                                $authors = get_field('author') ?? null;
                                $reference = get_field('reference') ?? null;
                                ?>
                                <div class="faqs faqs--people secSpace mb-0">
                                    <div class="faqs__inner">
                                        <div class="accordion" id="accordionFAQs">
                                            <?php
                                            if ($authors):
                                                ?>
                                                <div class="faqs__item">
                                                    <div class="faqs__header" id="accordionHeader--author">
                                                        <h3 class="faqs__title">
                                                            <button class="faqs__btn btn btn-link btn-block text-left" type="button"
                                                                data-toggle="collapse" data-target="#collapse--author" aria-expanded="true"
                                                                aria-controls="collapse--author">
                                                                <?php _e('Author', 'clvinuni'); ?>
                                                            </button>
                                                        </h3>
                                                    </div>

                                                    <div id="collapse--author" class="collapse show"
                                                        aria-labelledby="accordionHeader--author" data-parent="#accordionFAQs">
                                                        <div class="faqs__body postContent__authors">
                                                            <?php accordion_author_post($authors); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endif;

                                            if ($reference):
                                                ?>
                                                <div class="faqs__item">
                                                    <div class="faqs__header" id="accordionHeader--Reference">
                                                        <h3 class="faqs__title">
                                                            <button class="faqs__btn btn btn-link btn-block text-left" type="button"
                                                                data-toggle="collapse" data-target="#collapse--Reference"
                                                                aria-expanded="false" aria-controls="collapse--Reference">
                                                                <?php _e('Reference', 'clvinuni'); ?>
                                                            </button>
                                                        </h3>
                                                    </div>

                                                    <div id="collapse--Reference" class="collapse"
                                                        aria-labelledby="accordionHeader--Reference" data-parent="#accordionFAQs">
                                                        <div class="faqs__body">
                                                            <div class="editor">
                                                                <?php echo $reference; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endif;
                    endif;
                    ?>

                    <?php
                    $tags = wp_get_post_tags(get_the_ID());
                    if ($tags):
                        ?>
                        <div class="postNews__tags">
                            <span>
                                <?php _e('Tags:', 'clvinuni'); ?>
                            </span>
                            <?php
                            foreach ($tags as $tag):
                                ?>
                                <a class="postNews__tagsItem" href="<?php echo get_tag_link($tag->term_id); ?>">
                                    <span>
                                        <?php echo $tag->name; ?>
                                    </span>
                                </a>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if ($post_type == 'post') {
                        echo '</div></div></div>';
                    }
                    ?>

                    <!-- Additional information of the Course -->
                    <?php
                    if ($post_type == 'course'):
                        $link = get_field('course_link_' . LANG, 'option') ?? null;
                        $content = get_field('course_content_' . LANG, 'option') ?? null;

                        if ($link || $content):
                            ?>
                            <div class="courseContent mt-4">
                                <?php if ($link): ?>
                                    <div class="d-flex justify-content-center mb-4">
                                        <?php echo custom_btn_link($link, 'btnCTA'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($content): ?>
                                    <div class="editor">
                                        <?php echo $content; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($post_type == 'post' && $related_posts->have_posts()):
        ?>
        <section class="space relatedPosts__bg">
            <div class="container">
                <div class="relatedPosts relatedPosts--slider sectionSlider">
                    <div class="secHeading">
                        <h2 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
                            <?php
                            if (LANG == 'vi') {
                                echo 'Có thể <span class="character">bạn thích</span>';
                            } else {
                                echo 'You might <span class="character">also like</span>';
                            }
                            ?>
                        </h2>

                        <?php
                        if ($category_posts && is_array($category_posts)):
                            $category_link = get_category_link($category_posts[0]);
                            ?>
                            <div class="secHeading__link">
                                <a href="<?php echo $category_link; ?>" class="btnSeeMore wow fadeInUp" data-wow-duration="1s">
                                    <?php _e('See more', 'clvinuni'); ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>

                    <div class="relatedPostsList">
                        <?php
                        while ($related_posts->have_posts()):
                            $related_posts->the_post();
                            if (get_the_title()):
                                echo '<div class="relatedPostsList__item">';
                                get_template_part('template-parts/single/content-news');
                                echo '</div>';
                            endif;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endif;
    ?>

<?php endif; ?>

<?php
get_footer();
