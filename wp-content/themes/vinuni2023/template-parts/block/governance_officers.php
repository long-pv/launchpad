<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list_leaders = $args['flexible']['block_content']['leaders'] ?? '';
$title = $args['flexible']['block_content']['title'] ?? '';
$display_type = $args['flexible']['block_content']['display_type'] ?? '';
$class_bg = $display_type == 'gray' ? 'governanceOfficers--bgGray' : '';
$class_bg .= $display_type == 'pattern' ? 'section__bgImg' : '';

$page_current_id = get_the_ID();
?>

<div class="governanceOfficers <?php echo $class_bg; ?>">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($title): ?>
            <div class="governanceOfficers__subTitle">
                <div class="wow fadeInUp" data-wow-duration="1s">
                    <?php echo $title; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($list_leaders): ?>
            <div class="governanceOfficers__list">
                <div class="row governanceOfficers__gutters">
                    <?php
                    foreach ($list_leaders as $post):
                        setup_postdata($post);
                        if (get_post_status() == 'publish' && get_the_title() && get_the_post_thumbnail_url()):
                            ?>
                            <div class="col-md-6 col-xl-4">
                                <div class="governanceOfficers__item">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <div class="governanceOfficers__img">
                                                <a class="imgGroup imgGroup--noEffect governanceOfficers__image"
                                                    href="<?php the_permalink(); ?>" data-mh="governanceOfficers__image">
                                                    <img width="300" height="300" src="<?php the_post_thumbnail_url(); ?>"
                                                        alt="<?php the_title(); ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="governanceOfficers__content" data-mh="governanceOfficers__image">
                                                <h3 class="governanceOfficers__title wow fadeInUp" data-wow-duration="1s">
                                                    <a href="<?php echo get_permalink(); ?>" class="governanceOfficers__link">
                                                        <?php the_name_people(get_the_ID()); ?>
                                                    </a>
                                                </h3>

                                                <?php
                                                $position = get_position_people(get_the_ID(), $page_current_id);
                                                if ($position):
                                                    foreach ($position as $item):
                                                        ?>
                                                        <p class="governanceOfficers__position mt-1 wow fadeInUp" data-wow-duration="1s">
                                                            <?php echo $item; ?>
                                                        </p>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    $position = get_field('position') ?? null;
                                                    if ($position):
                                                        ?>
                                                        <p class="governanceOfficers__position mt-1 wow fadeInUp" data-wow-duration="1s">
                                                            <?php echo custom_text_people($position); ?>
                                                        </p>
                                                        <?php
                                                    endif;
                                                    $academic_name = get_academic_people(get_the_ID());
                                                    if ($academic_name):
                                                        ?>
                                                        <p class="governanceOfficers__position mt-1 wow fadeInUp" data-wow-duration="1s">
                                                            <?php echo $academic_name; ?>
                                                        </p>
                                                        <?php
                                                    endif;
                                                endif;
                                                ?>

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
            </div>
        <?php endif; ?>
    </div>
</div>