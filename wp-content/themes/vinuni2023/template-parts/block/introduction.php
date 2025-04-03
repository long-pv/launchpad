<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$image = $args['flexible']['block_content']['image'] ?? '';
$image_position = $args['flexible']['block_content']['image_position'] ?? '';
$nav_repeater = $args['flexible']['block_content']['navigate'] ?? '';
$class_order = $image_position == 'bottom' ? 'order-last' : '';
?>
<div class="admissionIntro">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($image || $nav_repeater): ?>
            <div class="row admissionIntro__row">
                <?php if ($image): ?>
                    <div class="col-12 <?php echo $class_order ?>">
                        <div class="admissionIntro__image">
                            <img width="600" height="400" class="w-100 h-100" src="<?php echo $image; ?>"
                                alt="<?php echo custom_title($title, false); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($nav_repeater): ?>
                    <div class="col-12">
                        <div class="admissionIntro__menu">
                            <div class="row admissionIntro__gutters">
                                <?php
                                foreach ($nav_repeater as $nav):
                                    if ($nav['title'] && $nav['menu'] && wp_get_nav_menu_object($nav['menu'])):
                                        ?>
                                        <div class="col-lg-6">
                                            <div class="admissionIntro__title wow fadeInUp" data-wow-duration="1s">
                                                <h4 class="secTitle">
                                                    <?php echo custom_title($nav['title']); ?>
                                                </h4>
                                                <span class="arrow"></span>
                                            </div>

                                            <?php
                                            wp_nav_menu(
                                                array(
                                                    'menu' => $nav['menu'],
                                                    'container' => 'nav',
                                                    'container_class' => 'admissionIntro__list',
                                                    'depth' => 2,
                                                )
                                            ); ?>
                                        </div>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>