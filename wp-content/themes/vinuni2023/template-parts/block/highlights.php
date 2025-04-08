<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$display_type_info = $args['flexible']['block_info']['display_type'] ?? '';
$layout = $args['flexible']['block_content']['layout'] ?? '';
$background = $args['flexible']['block_content']['background'] ?? '';
$sliders = $args['flexible']['block_content']['sliders'] ?? [];
$class_background = ($background == "yes") ? 'space slick--bg section--bg' : '';
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';
$highlights_gallery = '';
$background_image = $args['flexible']['block_content']['background_image'] ?? [];
$style_bg = '';

if ($background == 'yes' && $background_image) {
    $style_bg = 'background: linear-gradient(0deg, rgba(26, 64, 121, 0.60) 0%, rgba(26, 64, 121, 0.60) 100%), url(' . $background_image . ') var(--primary) 50% / cover no-repeat;';
}
?>
<div class="highlights <?php echo $class_background; ?>" style="<?php echo $style_bg; ?>">
    <div class="<?php echo get_container_class(); ?>">
        <div class="highlights__inner sectionSlider <?php echo $class_style; ?>">
            <?php echo block_info($block_info); ?>

            <?php if ($sliders): ?>
                <div class="highlights__slider">
                    <?php
                    foreach ($sliders as $key_slider => $slider):
                        if ($slider['title'] && $slider['image']): ?>
                            <div class="highlights__item" data-index="<?php echo $key_slider; ?>"
                                data-layout="<?php echo $layout; ?>">
                                <div class="highlights__itemInner <?php echo ($slider['link'] || $slider['gallery']) ? 'highlights--hover' : ''; ?>">
                                    <div class="highlights__img"
                                        style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 34.38%, rgba(0, 0, 0, 0.80) 100%), url(<?php echo $slider['image']; ?>), lightgray 50%;">
                                    </div>
                                    <h3 class="highlights__title wow fadeInUp" data-wow-duration="1s">
                                        <span class="line-3">
                                            <?php echo $slider['title']; ?>
                                        </span>
                                    </h3>
                                    <?php
                                    if ($layout == "slider_img"):
                                        echo custom_btn_link($slider['link'], 'highlights__link');
                                    elseif ($layout == "slider_gallery" && $slider['gallery']):
                                        $highlights_gallery .= '<div data-index="' . $key_slider . '" class="highlights__galleryList highlights__galleryList--' . $key_slider . '">';
                                        foreach ($slider['gallery'] as $key => $gallery_item):
                                            $highlights_gallery .= '<a data-fancybox="gallery-' . $key_slider . '" href="' . $gallery_item . '" data-caption="' . custom_caption_image($gallery_item) . '">';
                                            $highlights_gallery .= '<img src="' . $gallery_item . '" alt="gallery-' . $key_slider . '-' . $key . '" />';
                                            $highlights_gallery .= '</a>';
                                        endforeach;
                                        $highlights_gallery .= '</div>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php
        if ($highlights_gallery) {
            echo $highlights_gallery;
        }
        ?>
    </div>
</div>