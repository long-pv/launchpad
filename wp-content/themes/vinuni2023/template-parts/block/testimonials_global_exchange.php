<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$background = $args['flexible']['block_content']['background'] ?? '';
$testimonials = $args['flexible']['block_content']['testimonials'] ?? '';
$class_bg = ($background == 'yes') ? 'space slick--bg section__bgImg' : '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : 'sectionSlider--noBlockInfo';
?>

<div class="testimonials <?php echo $class_bg; ?>">
    <div class="container">
        <div class="testimonials__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block testimonials -->
            <?php if ($testimonials): ?>
                <div class="testimonials__slider <?php echo $slick_bg; ?>">
                    <?php
                    foreach ($testimonials as $testimonial):
                        $link = $testimonial && $testimonial['link'] ? $testimonial['link'] : 'javascript:void(0);';
                        $title = $testimonial && $testimonial['title'] ? $testimonial['title'] : '';
                        $description = $testimonial && $testimonial['description'] ? $testimonial['description'] : '';
                        $image = $testimonial && $testimonial['image'] ? $testimonial['image'] : '';
                        $position = $testimonial && $testimonial['position'] ? $testimonial['position'] : '';
                    ?>
                        <?php if ($image): ?>
                            <div class="testimonialItem">
                                <div class="testimonialItem__wrap <?php echo ($testimonial && $testimonial['link']) ? 'testimonialItem--hover' : ''; ?>">
                                    <?php echo custom_img_link($link, $image, 'testimonialItem__img imgGroup--noEffect', $title); ?>

                                    <div class="testimonialItem__inner " data-mh="testimonialItem__inner">
                                        <div class="testimonialItem__contentInner" data-mh="testimonialItem__contentInner">
                                            <?php if ($title): ?>
                                                <h3 class="h5 testimonialItem__title wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $title; ?>
                                                </h3>
                                            <?php endif; ?>

                                            <?php if ($position): ?>
                                                <p class="testimonialItem__position wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $position; ?>
                                                </p>
                                            <?php
                                            endif;

                                            if ($description):
                                                ?>
                                                <p class="testimonialItem__content wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $description; ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <?php
                                        if ($testimonial && $testimonial['link']):
                                            echo custom_btn_link($link, 'testimonialItem__link');
                                        endif;
                                        ?>
                                    </div>

                                    <?php
                                    if ($link): ?>
                                        <a class="testimonialItem__linkContent" href="<?php echo $link['url'] ?? 'javascript:void(0);'; ?>"
                                            target="<?php echo $link['target'] ?? '_self'; ?>"></a>
                                        <?php
                                    endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>