<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$general = $args['flexible']['block_content']['general_information'] ?? [];
$general_title = $general['title'] ?? '';
$general_description = $general['description'] ?? '';
$general_image = $general['image'] ?? '';
$general_link = $general['link'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? [];
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';

// Build UI
?>
<div class="research">
    <div class="container">
        <div class="research__inner sectionSlider <?php echo $class_style; ?>">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>

            <!-- Block research general -->
            <?php if ($general_image || $general_title || $general_description): ?>
                <div class="researchGeneral">
                    <div class="row">
                        <div class="col-lg-7">
                            <?php if ($general_image): ?>
                                <div class="imgGroup imgGroup--noEffect researchGeneral__img">
                                    <img width="300" height="300" class="w-100 h-100" src="<?php echo $general_image; ?>"
                                        alt="<?php echo $general_title; ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-5">
                            <?php if ($general_title || $general_description): ?>
                                <div class="researchGeneral__content">
                                    <?php if ($general_title): ?>
                                        <h3 class="h3 researchGeneral__title wow fadeInUp" data-wow-duration="1s">
                                            <?php echo custom_title($general_title); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if ($general_description): ?>
                                        <p class="line-4 researchGeneral__desc wow fadeInUp" data-wow-duration="1s">
                                            <?php echo $general_description; ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php echo custom_btn_link($general_link, 'research__generalLink') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Block research list -->
            <?php if ($list): ?>
                <div class="research__list">
                    <div class="research__slider <?php echo (!$general_image && !$general_title && !$general_description) ? 'mt-0' : ''; ?>">
                        <?php
                        foreach ($list as $item):
                            if ($item['title'] && $item['image']):
                                $url = $item['link'] && $item['link']['url'] ? $item['link']['url'] : 'javascript:void(0);';
                                $title = $item['link'] && $item['link']['title'] ? $item['link']['title'] : __('See more', 'clvinuni');
                                $target = $item['link'] && $item['link']['target'] ? $item['link']['target'] : '_self';
                                $class_img = $item['link'] && $item['link']['url'] ? '' : 'imgGroup--noEffect cursor-default';
                            ?>
                                <div class="research__item">
                                    <div class="research__itemInner">
                                        <a class="imgGroup research__itemImg <?php echo $class_img; ?>" href="<?php echo $url; ?>"
                                            target="<?php echo $target; ?>" title="<?php echo $title; ?>"
                                            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 34.38%, rgba(0, 0, 0, 0.80) 100%), url(<?php echo $item['image']; ?>), lightgray 50%;"></a>
                                        <h3 class="h5 research__itemTitle wow fadeInUp" data-wow-duration="1s">
                                            <?php if ($item['link']): ?>
                                                <a href="<?php echo $item['link']['url'] ?? ''; ?>"
                                                    target="<?php echo $item['link']['target'] ?? ''; ?>">
                                                    <?php echo $item['title']; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $item['title']; ?>
                                            <?php endif; ?>
                                        </h3>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>