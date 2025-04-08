<?php
$people = $args['people'];

$link = [
    'url' => $people->link,
    'target' => '_self',
    'title' => null
];

if (!is_main_site()) {
    $link['target'] = '_blank';
}

$page_current_id = $args['page_current_id'] ?? null;
?>
<div class="testimonialItem leaderItem">
    <div
        class="testimonialItem__wrap leaderItem__wrap <?php echo ($link && $link['url']) ? 'testimonialItem--hover' : ''; ?>">
        <?php echo custom_img_link($link, $people->image, 'testimonialItem__img leaderItem__img imgGroup--noEffect', $people->title); ?>

        <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
            <h3 class="h5 testimonialItem__title leaderItem__title wow fadeInUp" data-wow-duration="1s">
                <?php echo $people->title; ?>
            </h3>

            <?php
            $position = $people->position;
            if ($position):
                $position = implode('<br> ', $position);
                ?>
                <p class="testimonialItem__position leaderItem__position wow fadeInUp" data-wow-duration="1s">
                    <?php echo $position; ?>
                </p>
            <?php endif; ?>
        </div>

        <?php
        if ($link && $link['url']): ?>
            <a class="testimonialItem__linkContent" href="<?php echo $link['url']; ?>"
                target="<?php echo $link['target']; ?>"></a>
            <?php
        endif; ?>
    </div>
</div>