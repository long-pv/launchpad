<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$background_image = $args['flexible']['block_content']['background_image'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? [];
?>
<div class="whyVinuni">
    <div class="section--bg space whyVinuni__inner" style="background: linear-gradient(0deg, rgba(26, 64, 121, 0.60) 0%, rgba(26, 64, 121, 0.60) 100%), url('<?php echo $background_image; ?>') var(--primary) 50% / cover no-repeat;">
        <div class="container">
            <!-- block info -->
            <?php echo block_info($block_info); ?>
        </div>
        <?php if ($list) : ?>
            <div class="slick--bg sectionSlider whyVinuni__list">
                <div class="whyVinuni__slide">
                    <?php foreach ($list as $index => $item) :
                        $image = $item['image'] ?? '';
                        $title = $item['title'] ?? '';
                        $description = $item['description'] ?? '';
                        $bg_color = $item['background_color'] ?? '';
                        $classColor = $index % 2 == 0 ? 'whyVinuni__item--colorImg' : 'whyVinuni__item--colorContent';
                        if ($image && ($title || $description)) :
                    ?>
                            <div class="whyVinuni__item">
                                <div class="<?php echo $classColor ?>">
                                    <div class="whyVinuni__content" style="--bg-slide-color: <?php echo $bg_color ?>;">
                                        <h3 class="h6 whyVinuni__title wow fadeInUp" data-mh="whyVinuni__title" data-wow-duration="1s"><?php echo $title; ?></h3>
                                        <p class="mb-0 wow fadeInUp" data-mh="whyVinuni__desc" data-wow-duration="1s"><?php echo $description; ?></p>
                                    </div>
                                    <div class="whyVinuni__imgWrap"  style="--bg-slide-color: <?php echo $bg_color ?>;">
                                        <div class="imgGroup imgGroup--noEffect whyVinuni__image">
                                            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>
                    <div class="whyVinuni__item whyVinuni__item--hidden"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>