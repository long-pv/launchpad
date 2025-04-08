<?php
$link = [
    'url' => get_permalink(),
    'target' => '_self',
    'title' => null
];

$page_url = $args['page_url'] ?? null;
?>
<div class="testimonialItem leaderItem">
    <div
        class="testimonialItem__wrap leaderItem__wrap <?php echo ($link && $link['url']) ? 'testimonialItem--hover' : ''; ?>">
        <?php echo custom_img_link($link, get_the_post_thumbnail_url(), 'testimonialItem__img leaderItem__img imgGroup--noEffect', get_the_title()); ?>

        <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
            <h3 class="h5 testimonialItem__title leaderItem__title wow fadeInUp" data-wow-duration="1s">
                <?php the_name_people(get_the_ID()); ?>
            </h3>

            <?php
            $position = get_position_people(get_the_ID(), $page_url);
            if ($position):
                $position = implode('<br> ', $position);
                ?>
                <p class="testimonialItem__position leaderItem__position wow fadeInUp" data-wow-duration="1s">
                    <?php echo $position; ?>
                </p>
                <?php
            else:
                $position = get_field('position') ?? null;
                if ($position):
                    ?>
                    <p class="testimonialItem__position leaderItem__position wow fadeInUp" data-wow-duration="1s">
                        <?php echo custom_text_people($position); ?>
                    </p>
                    <?php
                endif;
                $academic_name = get_academic_people(get_the_ID());
                if ($academic_name):
                    ?>
                    <p class="testimonialItem__position leaderItem__position wow fadeInUp" data-wow-duration="1s">
                        <?php echo $academic_name; ?>
                    </p>
                    <?php
                endif;
            endif;
            ?>
        </div>

        <?php
        if ($link && $link['url']): ?>
            <a class="testimonialItem__linkContent" href="<?php echo $link['url']; ?>"
                target="<?php echo $link['target']; ?>"></a>
            <?php
        endif; ?>
    </div>
</div>