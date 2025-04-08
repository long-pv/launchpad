<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$cards = $args['flexible']['block_content']['list'] ?? '';
?>

<div class="container">
    <?php echo block_info($block_info); ?>

    <?php if ($cards): ?>
        <div class="cards">
            <div class="row cards__gutters">
                <?php
                foreach ($cards as $card):
                    if ($card['title'] && $card['image']):
                        $url = ($card['link'] && $card['link']['url']) ? $card['link']['url'] : 'javascript:void(0);';
                        $target = ($card['link'] && $card['link']['target']) ? $card['link']['target'] : '';
                        $class_img = ($card['link'] && $card['link']['url']) ? 'cardBlock__img' : 'cardBlock__img cursor-default ';
                        ?>
                        <div class="col-md-6">
                            <div class="cardBlock">
                                <?php echo custom_img_link($card['link'], $card['image'], $class_img, $card['title']); ?>

                                <div class="cardBlock__content">
                                    <?php if ($card['title']): ?>
                                        <h3 class="h5 titleLink cardBlock__title wow fadeInUp" data-mh="titleLink" data-wow-duration="1s">
                                            <?php if ($card['link']): ?>
                                                <a href="<?php echo $url; ?>" target="<?php echo $target; ?>">
                                                    <?php echo $card['title']; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $card['title']; ?>
                                            <?php endif; ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if ($card['description']): ?>
                                        <p class="cardBlock__desc wow fadeInUp" data-mh="cardBlock__desc" data-wow-duration="1s">
                                            <span class="line-3">
                                                <?php echo $card['description']; ?>
                                            </span>
                                        </p>
                                    <?php endif; ?>

                                    <?php echo custom_btn_link($card['link'], 'cardBlock__link') ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>