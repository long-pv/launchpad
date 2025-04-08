<div class="testimonialItem">
    <?php
    $display_detail = get_field('display_details') ?? 'yes';
    $link_page = get_field('link_page') ?? [];
    $link_default = [
        'url' => get_permalink(),
        'target' => '_self',
        'title' => null
    ];

    $link = ($display_detail == 'yes') ? $link_default : $link_page;
    ?>

    <div class="testimonialItem__wrap <?php echo ($link && $link['url']) ? 'testimonialItem--hover' : ''; ?>">
        <?php echo custom_img_link($link, get_the_post_thumbnail_url(), 'testimonialItem__img imgGroup--noEffect', get_the_title()); ?>

        <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
            <div class="testimonialItem__contentInner" data-mh="testimonialItem__contentInner">
                <h3 class="h5 testimonialItem__title wow fadeInUp" data-wow-duration="1s">
                    <?php echo get_the_title(); ?>
                </h3>
                <?php if (get_field('position')): ?>
                    <p class="testimonialItem__position wow fadeInUp" data-wow-duration="1s">
                        <?php echo get_field('position'); ?>
                    </p>
                    <?php
                endif;
                if (get_field('content')):
                    ?>
                    <p class="testimonialItem__content wow fadeInUp" data-wow-duration="1s">
                        <span class="line-5">
                            <?php echo get_field('content'); ?>
                        </span>
                    </p>
                    <?php
                endif;
                ?>
            </div>

            <?php echo custom_btn_link($link, 'testimonialItem__link'); ?>
        </div>

        <?php
        if ($link && $link['url']): ?>
            <a class="testimonialItem__linkContent" href="<?php echo $link['url']; ?>"
                target="<?php echo $link['target']; ?>"></a>
            <?php
        endif; ?>
    </div>
</div>