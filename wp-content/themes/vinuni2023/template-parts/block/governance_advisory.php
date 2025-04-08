<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list_leaders = $args['flexible']['block_content']['leaders'] ?? '';
$page_current_id = get_the_ID();
?>

<div class="container">
    <?php echo block_info($block_info); ?>

    <?php if ($list_leaders): ?>
        <div class="governanceAdvisory">
            <div class="governanceAdvisory__list">
                <div class="row governanceAdvisory__gutters">
                    <?php
                    foreach ($list_leaders as $post):
                        setup_postdata($post);
                        if (get_post_status() == 'publish' && get_the_title()):
                            ?>
                            <div class="col-md-6">
                                <div class="governanceAdvisory__item" data-mh="governanceAdvisory__item">
                                    <h3 class="h5 governanceAdvisory__title wow fadeInUp">
                                        <a href="<?php echo get_permalink(); ?>" class="governanceAdvisory__link">
                                            <?php the_name_people(get_the_ID()); ?>
                                        </a>
                                    </h3>

                                    <?php
                                    $position = get_position_people(get_the_ID(), $page_current_id);
                                    if ($position):
                                        $position = implode('<br> ', $position);
                                        ?>
                                        <p class="governanceAdvisory__position wow fadeInUp" data-wow-duration="1s">
                                            <?php echo $position; ?>
                                        </p>
                                        <?php
                                    else:
                                        $position = get_field('position') ?? null;
                                        if ($position):
                                            ?>
                                            <p class="governanceAdvisory__position wow fadeInUp" data-wow-duration="1s">
                                                <?php echo custom_text_people($position); ?>
                                            </p>
                                            <?php
                                        endif;
                                        $academic_name = get_academic_people(get_the_ID());
                                        if ($academic_name):
                                            ?>
                                            <p class="governanceAdvisory__position wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $academic_name; ?>
                                            </p>
                                            <?php
                                        endif;
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>