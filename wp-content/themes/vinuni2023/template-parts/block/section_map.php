<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$iframe_map = $args['flexible']['block_content']['iframe_map'] ?? '';
$contact_info = $args['flexible']['block_content']['contact_info'] ?? '';
$editor = $args['flexible']['block_content']['content'] ?? '';
$image = $args['flexible']['block_content']['image'] ?? '';
$class_check_map = $iframe_map ? 'sectionMap--top' : '';
$class_check_block_info = $block_info['title'] ? '' : 'space--top';
?>

<div class="sectionMap <?php echo $class_check_map; ?>">
    <?php if ($iframe_map): ?>
        <div class="sectionMap__mapWrap">
            <?php echo $iframe_map; ?>
        </div>
    <?php endif; ?>

    <?php if ($contact_info || $editor || $block_info): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-lg-last">
                    <?php
                    $key_arr = ['icon', 'title', 'content'];

                    if ($contact_info && custom_count_array($contact_info, $key_arr) > 0):
                        ?>
                        <div class="sectionMap__info">
                            <ul class="sectionMap__list">
                                <?php
                                foreach ($contact_info as $info):
                                    if ($info['icon'] && $info['title'] && $info['content']):
                                        ?>
                                        <li class="sectionMap__item">
                                            <div class="sectionMap__iconInner wow fadeInUp" data-wow-duration="1s">
                                                <figure class="sectionMap__icon">
                                                    <img width=24 height=24 src="<?php echo $info['icon']; ?>"
                                                        alt="<?php echo $info['title'] ? $info['title'] : 'Icon'; ?>">
                                                </figure>
                                            </div>
                                            <div class="sectionMap__infoDetail">
                                                <h3 class="sectionMap__title wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $info['title']; ?>
                                                </h3>
                                                <div class="sectionMap__content wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $info['content']; ?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <?php if ($image): ?>
                        <div class="sectionMap__imgInner">
                            <img class="sectionMap__img wow fadeInUp" src="<?php echo $image; ?>" alt="Image" data-wow-duration="1s">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-8">
                    <?php echo block_info($block_info); ?>
                    <div class="wow fadeInUp <?php echo $class_check_block_info; ?>" data-wow-duration="1s">
                        <?php echo custom_editor($editor); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>