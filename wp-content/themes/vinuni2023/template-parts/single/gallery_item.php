<?php
$primary_category = get_gallery_category_primary(get_the_ID());
$title = get_the_title();
$link = [
    'url' => get_permalink(),
    'target' => '_self',
    'title' => null
];
$image = get_the_post_thumbnail_url();
?>

<div class="galleryItem">
    <?php echo custom_img_link($link, $image, 'galleryItem__img imgGroup--noEffect', $title); ?>
    <div class="galleryItem__content">
        <?php if ($primary_category) : ?>
            <div class="galleryItem__cat wow fadeInUp" data-wow-duration="1s"><span class="galleryItem__icon"></span><?php echo $primary_category->name; ?></div>
        <?php endif; ?>
        <h3 class="galleryItem__title wow fadeInUp" data-wow-duration="1.2s" data-mh="galleryItem__title"><a href="<?php echo get_permalink(); ?>" class="postNews__link galleryItem__link line-2"><?php echo $title; ?></a></h3>
        <?php if (!is_singular('gallery')) : ?>
            <div class="wow fadeInUp" data-wow-duration="1.3s">
                <span class="galleryItem__date"><?php echo get_the_date('d-m-Y') ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>