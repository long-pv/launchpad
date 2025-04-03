<?php
$excerpt = $args['excerpt'] ?? null;
$display_detail = get_field('display_details', get_the_ID()) ?? 'yes';
$link_page = get_field('link_page', get_the_ID()) ?? [];

$url_post = 'javascript:void(0);';
$target_post = '';

if ($display_detail == 'yes') {
    $url_post = get_permalink();
} else {
    if ($link_page && $link_page['url']) {
        $url_post = $link_page['url'];
        $target_post = '_blank';
    }
}

// Handles conditions for post type on_media
if (get_post_type() == 'on_media') {
    $link_newspaper = get_field('on_media_link') ?? null;
    if ($link_newspaper) {
        $url_post = $link_newspaper;
        $target_post = '_blank';
    }
}

$link = [
    'url' => $url_post,
    'target' => $target_post,
    'title' => get_the_title()
];
?>

<div class="postNews">
    <?php echo custom_img_link($link, get_the_post_thumbnail_url(), 'imgGroup--noEffect'); ?>

    <?php
    $tags = wp_get_post_tags(get_the_ID());
    if ($tags):
        ?>
        <div class="postNews__tags">
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

    <?php if ($link): ?>
        <h3 class="h5 postNews__title wow fadeInUp" data-wow-duration="1s">
            <a href="<?php echo $link['url']; ?>" target="<?php echo $target_post; ?>" class="postNews__link line-2">
                <?php the_title(); ?>
            </a>
        </h3>
    <?php endif; ?>

    <?php if ($excerpt): ?>
        <p class="postNews__desc wow fadeInUp" data-wow-duration="1s">
            <?php echo esc_html($excerpt); ?>
        </p>
    <?php endif; ?>
</div>