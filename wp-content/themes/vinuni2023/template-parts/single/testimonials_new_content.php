<?php
$item = $args['item'];

if ($item['title'] && $item['image']):

    $link = [
        'url' => ($item['link'] && $item['link']['url']) ? $item['link']['url'] : null,
        'target' => ($item['link'] && $item['link']['target']) ? $item['link']['target'] : '',
        'title' => ($item['link'] && $item['link']['title']) ? $item['link']['title'] : __('See more', 'clvinuni'),
    ];
    ?>
    <div class="testimonialItem testimonialItem--new">
        <div class="testimonialItem__wrap testimonialItem--hover">
            <?php echo custom_img_link($link, $item['image'], 'testimonialItem__img imgGroup--noEffect', $item['title']); ?>

            <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
                <div class="testimonialItem__contentInner" data-mh="testimonialItem__contentInner">
                    <!-- title -->
                    <h3 class="h5 testimonialItem__title wow fadeInUp" data-wow-duration="1s">
                        <?php echo $item['title']; ?>
                    </h3>

                    <!-- job positions in the department -->
                    <?php
                    if ($item['position']):
                        ?>
                        <p class="testimonialItem__position wow fadeInUp" data-wow-duration="1s">
                            <?php echo $item['position']; ?>
                        </p>
                        <?php
                    endif;

                    // description
                    if ($item['quote']):
                        ?>
                        <p class="testimonialItem__content wow fadeInUp" data-wow-duration="1s">
                            <span class="line-5">
                                <?php echo $item['quote']; ?>
                            </span>
                        </p>
                        <?php
                    endif;
                    ?>
                </div>

                <?php
                if ($link && $link['url']):
                    ?>
                    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"
                        class="btnSeeMore wow fadeInUp testimonialItem__link" data-wow-duration="1s">
                        <?php echo $link['title']; ?>
                    </a>
                    <?php
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
<?php endif; ?>