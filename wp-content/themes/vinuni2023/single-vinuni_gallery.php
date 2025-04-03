<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package clvinuni
 */

get_header();

$choose_type = get_field('choose_type')['value'] ?? '';
$primary_category = get_gallery_category_primary(get_the_ID());
$primary_category_id = $primary_category ? $primary_category->term_id : '';
$related_posts = new WP_Query(
    [
        'post_type' => 'vinuni_gallery',
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()],
        'meta_query' => [
            [
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS',
            ],
        ],
        'tax_query' => [
            [
                'taxonomy' => 'gallery_category',
                'field' => 'term_id',
                'terms' => $primary_category_id,
            ],
        ],
    ]
);
$iframe_video = get_field('iframe_video') ?? '';
$gallery_image = get_field('gallery_image') ?? '';
$featured_image = get_the_post_thumbnail_url();
$background_image = $featured_image ? 'style="background-image: url(' . $featured_image . ');"' : '';
$valid_iframe_condition = $choose_type == 'video' && $iframe_video;
$valid_gallary_image_condition = $choose_type == 'image' && $gallery_image;
?>
<section class="gallerySingle space--bottom">
    <div class="gallerySingle__banner <?php echo $valid_iframe_condition ? 'gallerySingle__bannerVideo' : '' ?>">
        <div class="container">
            <?php if ($valid_iframe_condition) :
                $parsedUrl = parse_url($iframe_video);
                $path = $parsedUrl['path'];
                $parts = explode('/', trim($path, '/'));
                $videoId = end($parts);
            ?>
                <div class="videoBlock gallerySingle__videoWrap">
                    <iframe src="<?php echo $iframe_video . '?playlist=' . $videoId . '&listType=playlist&mute=1'; ?>" class="gallerySingle__videoIframe" frameborder="0" allowfullscreen></iframe>
                    <?php if ($background_image) : ?>
                        <div class="gallerySingle__videoPreview" <?php echo $background_image; ?>>
                            <div class="container">
                                <div class="gallerySingle__videoAction">
                                    <button class="gallerySingle__playAction">
                                        <img class="gallerySingle__playButton" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/video-play.png" alt="Video play">
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($valid_gallary_image_condition) : ?>
                <div class="sectionSlider">
                    <div class="gallerySingle__slider">
                        <?php foreach ($gallery_image as $item) : ?>
                            <div class="gallerySingle__item">
                                <a href="<?php echo $item['url'] ?>" data-fancybox="gallery-image" class="gallerySingle__image" data-thumb="<?php echo $item['url'] ?>">
                                    <img src="<?php echo $item['url'] ?>" width="1440" height="480" alt="<?php echo $item['alt'] ?: get_the_title(); ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="spaceContent">
        <div class="container">
            <article>
                <div class="editor">
                    <?php
                    the_title('<h1 class="h2">', '</h1>');
                    the_content(); ?>
                </div>
            </article>
            <?php if ($related_posts->have_posts()) : ?>
                <div class="relatedPosts spaceContent">
                    <h2 class="h3 relatedPosts__title secTitle">
                        <?php echo custom_title(__('Related [{albums}]', 'clvinuni')); ?>
                    </h2>
                    <div class="row relatedPosts__gutters">
                        <?php
                        while ($related_posts->have_posts()) :
                            $related_posts->the_post();
                            if (get_the_title()) :
                        ?>
                                <div class="col-md-6 col-lg-4">
                                    <?php get_template_part('template-parts/single/gallery_item'); ?>
                                </div>
                        <?php
                            endif;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
get_footer();
