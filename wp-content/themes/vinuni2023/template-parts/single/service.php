<?php
$items =  $args['item'];
$link = [
    'url' => $items['link'],
    'target' => '_self',
    'title' => null
];
$title = $items['title'] ?? '';
$description = $items['description'] ?? '';
$image = $items['image'] ?? '';
?>
<div class="testimonialItem serviceItem">

    <div class="testimonialItem__wrap <?php echo ($link && $link['url']) ? 'testimonialItem--hover' : ''; ?>">
        <?php echo custom_img_link($link, $image, 'testimonialItem__img serviceItem__img imgGroup--noEffect', $title); ?>

        <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
            <h3 class="h5 testimonialItem__title serviceItem__title wow fadeInUp" data-mh="serviceItem__title" data-wow-duration="1s">
                <?php echo $title; ?>
            </h3>
            <?php if ($description) : ?>
                <p class="testimonialItem__position serviceItem__desc wow fadeInUp" data-mh="serviceItem__desc" data-wow-duration="1s">
                    <?php echo $description; ?>
                </p>
            <?php
            endif;
            ?>
        </div>

        <?php
        if ($link && $link['url']) : ?>
            <a class="testimonialItem__linkContent" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"></a>
        <?php
        endif; ?>
    </div>
</div>