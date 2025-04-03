<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$leaders = $args['flexible']['block_content']['leaders'] ?? '';

$page_current_id = get_the_ID();
?>

<div class="leaders">
    <div class="leaders__heading sectionSlider">
        <div class="container">
            <?php echo block_info($block_info); ?>
        </div>
    </div>

    <?php if ($leaders): ?>
        <div class="leaders__slider sectionSlider">
            <?php
            foreach ($leaders as $post):
                setup_postdata($post);
                if (get_post_status() == 'publish' && get_the_title() && get_field('highlight_image')):
                    $class_post = get_the_content() ? '' : 'cursor-default';
                    $url_post = get_the_content() ? get_the_permalink() : 'javascript:void(0);';
                    ?>
                    <div class="leaders__item">
                        <div class="leaders__itemInner">
                            <div class="leaders__bg section__bgImg">
                                <div class="container">
                                    <div class="row no-gutters justify-content-end justify-content-lg-start">
                                        <div class="col-12 col-lg-6">
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <div class="leaders__content">
                                                        <h3 class="leaders__title">
                                                            <?php the_name_people(get_the_ID()); ?>
                                                        </h3>

                                                        <?php
                                                        $position = get_position_people(get_the_ID(), $page_current_id);
                                                        if ($position):
                                                            $position = implode('<br> ', $position);
                                                            ?>
                                                            <p class="leaders__desc">
                                                                <?php echo $position; ?>
                                                            </p>
                                                            <?php
                                                        else:
                                                            $position = get_field('position') ?? null;
                                                            if ($position):
                                                                ?>
                                                                <p class="leaders__desc">
                                                                    <?php echo custom_text_people($position); ?>
                                                                </p>
                                                                <?php
                                                            endif;
                                                        endif;
                                                        ?>

                                                        <?php if (get_field('quote')): ?>
                                                            <blockquote class="leaders__quote">
                                                                <?php echo get_field('quote'); ?>
                                                            </blockquote>
                                                        <?php endif; ?>

                                                        <?php if (get_the_content()): ?>
                                                            <?php echo custom_btn_link(['url' => get_the_permalink()], 'leaders__link') ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 col-lg-6 d-flex align-items-end leaders__imgInner">
                                            <div class="leaders__imgWrap">
                                                <div class="leaders__img">
                                                    <img width="500" height="500" src="<?php echo get_field('highlight_image'); ?>"
                                                        alt="<?php the_title(); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>
</div>