<?php
$content = $args['content'];
$item = $args['people'];

if ($item->image && $item->title):

    $link = [
        'url' => $item->link,
        'target' => '',
        'title' => __('See more', 'clvinuni')
    ];

    if (!is_main_site()) {
        $link['target'] = '_blank';
    }
    ?>
    <div class="testimonialItem testimonialItem--new">
        <div class="testimonialItem__wrap testimonialItem--hover">
            <?php echo custom_img_link($link, $item->image, 'testimonialItem__img imgGroup--noEffect', $item->title); ?>

            <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
                <div class="testimonialItem__contentInner" data-mh="testimonialItem__contentInner">
                    <!-- title -->
                    <h3 class="h5 testimonialItem__title wow fadeInUp" data-wow-duration="1s">
                        <?php echo $item->title; ?>
                    </h3>

                    <!-- job positions in the department -->
                    <?php
                    $position = $item->position;
                    if ($position):
                        $position = implode('<br> ', $position);
                        ?>
                        <p class="testimonialItem__position wow fadeInUp" data-wow-duration="1s">
                            <?php echo $position; ?>
                        </p>
                        <?php
                    endif;

                    // description
                    if ($content):
                        ?>
                        <p style="font-weight:400;" class="testimonialItem__content wow fadeInUp" data-wow-duration="1s">
                            <span class="line-5">
                                <?php echo $content; ?>
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
<?php endif; ?>