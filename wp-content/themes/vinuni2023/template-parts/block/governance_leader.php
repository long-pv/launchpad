<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$sub_title = $args['flexible']['block_content']['subtitle'] ?? '';
$list_leaders = $args['flexible']['block_content']['leaders'] ?? '';

$page_current_id = get_the_ID();
?>

<?php
if (!is_page_template(array('page-article.php'))):
    ?>
    <div class="container">
        <?php
endif;
?>
    <?php echo block_info($block_info); ?>

    <div class="governanceLeader">
        <?php if ($sub_title): ?>
            <div class="governanceLeader__subTitle wow fadeInUp" data-wow-duration="1s">
                <?php echo $sub_title; ?>
            </div>
        <?php endif; ?>

        <?php if ($list_leaders): ?>
            <div class="governanceLeader__list">
                <?php
                $counter = 1;
                foreach ($list_leaders as $post):
                    setup_postdata($post);
                    if (get_post_status() == 'publish' && get_the_title() && get_the_post_thumbnail_url()):
                        if (is_page_template(array('page-article.php'))) {
                            $order_class_content = 'order-2';
                            $order_class_img = 'order-1';
                            $class_col_content = 'col-md-8';
                            $class_col_img = 'col-md-4';
                        } else {
                            $order_class_content = ($counter % 2 == 0) ? 'order-md-2' : '';
                            $order_class_img = ($counter % 2 == 0) ? 'order-md-1' : '';
                            $class_col_content = 'col-md-6';
                            $class_col_img = 'col-md-6';
                        }
                        ?>
                        <div class="governanceLeader__item">
                            <div class="row">
                                <div class="<?php echo $class_col_content; ?> <?php echo $order_class_content; ?>">
                                    <div class="governanceLeader__content">
                                        <h3 class="governanceLeader__title wow fadeInUp" data-wow-duration="1s">
                                            <a href="<?php echo get_permalink(); ?>" class="governanceLeader__link">
                                                <?php the_name_people(get_the_ID()); ?>
                                            </a>
                                        </h3>

                                        <?php
                                        $position = get_position_people(get_the_ID(), $page_current_id);
                                        if ($position):
                                            $position = implode('<br> ', $position);
                                            ?>
                                            <div class="governanceLeader__position wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $position; ?>
                                            </div>
                                            <?php
                                        else:
                                            $position = get_field('position') ?? null;
                                            if ($position):
                                                ?>
                                                <div class="governanceLeader__position wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo custom_text_people($position); ?>
                                                </div>
                                                <?php
                                            endif;
                                            $academic_name = get_academic_people(get_the_ID());
                                            if ($academic_name):
                                                ?>
                                                <div class="governanceLeader__position wow fadeInUp" data-wow-duration="1s">
                                                    <?php echo $academic_name; ?>
                                                </div>
                                                <?php
                                            endif;
                                        endif;
                                        ?>

                                        <?php if (get_field('excerpts')): ?>
                                            <p class="governanceLeader__quote wow fadeInUp" data-wow-duration="1s">
                                                <?php echo get_field('excerpts'); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="<?php echo $class_col_img; ?> <?php echo $order_class_img; ?>">
                                    <a class="imgGroup imgGroup--noEffect governanceLeader__img"
                                        href="<?php echo get_permalink(); ?>">
                                        <img width="500" height="500" src="<?php the_post_thumbnail_url(); ?>"
                                            alt="<?php the_title(); ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                    endif;
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
    </div>

    <?php
    if (!is_page_template(array('page-article.php'))):
        ?>
    </div>
    <?php
    endif;
    ?>

<?php if (is_page_template(array('page-article.php'))): ?>
    <style>
        .sectionGovernanceLeader {
            padding: 0px !important;
            background: #fff !important;
        }
    </style>
<?php endif; ?>