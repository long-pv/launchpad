<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$displayContent = $args['flexible']['block_content']['display_content'] ?? '';
$display_image = $args['flexible']['block_content']['display_image'] ?? '';
$title = $args['flexible']['block_content']['title'] ?? '';
$content = $args['flexible']['block_content']['content'] ?? '';
$image = $args['flexible']['block_content']['image'] ?? '';
$galleries = $args['flexible']['block_content']['gallery'] ?? '';
$background = $args['flexible']['block_content']['background'] ?? '';
$style_title = $background == "yes" ? false : true;
$class_block = $background == "yes" ? 'about--bg space section--bg' : '';
$class_text = $background == "yes" ? 'text-white' : '';
$class_content = $displayContent == 'right' ? 'order-lg-2' : '';
$class_image = $displayContent == 'right' ? 'order-lg-1' : '';
$class_block .= ($display_image == 'gallery' && $galleries) ? 'sectionSlider' : '';
$class_position = $displayContent == 'left' && $galleries ? 'about__left' : 'about__right';
$class_position_dots = $displayContent == 'right' ? '' : 'about__dots--left';
?>

<div class="about <?php echo $class_block; ?>">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($title || $display_image == 'image' && $image || $display_image == 'gallery' && $galleries || $content): ?>
            <div class="row justify-content-center">
                <div class="col-lg-6 <?php echo $class_content; ?>">
                    <div class="about__content <?php echo $class_text; ?>">
                        <h2 class="h2 secTitle wow fadeInUp <?php echo $class_text; ?>" data-wow-duration="1s">
                            <?php echo custom_title($title, $style_title); ?>
                        </h2>
                        <div class="wow fadeInUp" data-wow-duration="1s">
                            <?php echo custom_editor($content); ?>
                        </div>
                        <?php if ($display_image == 'gallery' && $galleries): ?>
                            <div class="about__dots <?php echo $class_position_dots; ?> slick-slider-dots"></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6 <?php echo $class_image; ?>">
                    <div class="about__sticky">
                        <?php if ($display_image == 'image' && $image): ?>
                            <div class="about__image">
                                <img width="200" height="200" class="w-100 h-100" src="<?php echo $image; ?>"
                                    alt="<?php echo custom_title($title, false); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if ($display_image == 'gallery' && $galleries): ?>
                            <div class="about__slider <?php echo $class_position; ?>">
                                <?php foreach ($galleries as $key => $gallery): ?>
                                    <div class="about__item">
                                        <img src="<?php echo $gallery; ?>" alt="<?php echo 'Gallery ' . ($key + 1); ?>">
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>