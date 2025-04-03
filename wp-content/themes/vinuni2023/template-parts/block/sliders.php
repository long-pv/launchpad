<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$sliders = $args['flexible']['block_content']['list'] ?? [];
$background = $args['flexible']['block_content']['background'] ?? '';
$slider_class = ($background == "yes") ? 'space slick--bg section__bgImg' : '';
$class_padding = ($block_info['title'] || $block_info['description']) ? '' : 'sectionSlider--noBlockInfo';
?>

<div class="sliders <?php echo $slider_class; ?>">
    <div class="container">
        <div class="sliders__inner sectionSlider <?php echo $class_padding; ?>">
            <?php echo block_info($block_info); ?>

            <?php if ($sliders): ?>
            <div class="sliders__list">
                <?php
                    foreach ($sliders as $slider):
                        if ($slider['image']):
                            // Get values
                            $title = $slider['title'] ? $slider['title'] : 'Slider item';
                            $url = ($slider['link'] && $slider['link']['url']) ? $slider['link']['url'] : 'javascript:void(0);';
                            $target = ($slider['link'] && $slider['link']['target']) ? $slider['link']['target'] : '';
                            $class_link = ($slider['link'] && $slider['link']['url']) ? '' : 'cursor-default';
                    ?>
                    <div class="sliders__itemInner" data-mh="sliders__itemInner">
                        <div class="sliders__item">
                            <a class="sliders__link <?php echo $class_link; ?>" href="<?php echo $url; ?>">
                                <img class="sliders__img" src="<?php echo $slider['image']; ?>" alt="<?php echo $title; ?>">
                            </a>
                        </div>
                    </div>
                <?php
                        endif;
                    endforeach;
                    ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>