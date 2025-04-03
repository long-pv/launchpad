<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$leaders = $args['flexible']['block_content']['leaders'] ?? '';
$title = $args['flexible']['block_content']['title'] ?? '';
$display_type = $args['flexible']['block_content']['display_type'] ?? '';
$class_bg = $display_type == 'gray' ? 'governanceOfficers--bgGray' : '';
$class_bg .= $display_type == 'pattern' ? 'section__bgImg' : '';

$page_current_id = get_the_ID();

$data = load_people_data($leaders);

// check attr target
$target = '';
if (!is_main_site()) {
    $target = ' target="_blank" ';
}
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

        <?php if ($data): ?>
            <div class="governanceOfficers__list">
                <div class="row governanceOfficers__gutters">
                    <?php
                    foreach ($data as $item):
                        if ($item->title && $item->image):
                            ?>
                            <div class="col-md-6 col-xl-4">
                                <div class="governanceOfficers__item">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <div class="governanceOfficers__img">
                                                <a <?php echo $target; ?>
                                                    class="imgGroup imgGroup--noEffect governanceOfficers__image"
                                                    href="<?php echo $item->link; ?>" data-mh="governanceOfficers__image">
                                                    <img width="300" height="300" src="<?php echo $item->image; ?>"
                                                        alt="<?php echo $item->title; ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="governanceOfficers__content" data-mh="governanceOfficers__image">
                                                <h3 class="governanceOfficers__title wow fadeInUp" data-wow-duration="1s">
                                                    <a <?php echo $target; ?> href="<?php echo $item->link; ?>"
                                                        class="governanceOfficers__link">
                                                        <?php echo $item->title; ?>
                                                    </a>
                                                </h3>

                                                <?php
                                                $position = $item->position;
                                                if ($position):
                                                    $count = 0;
                                                    foreach ($position as $item):
                                                        if ($count < 2):
                                                            ?>
                                                            <p class="governanceOfficers__position mt-1 wow fadeInUp" data-wow-duration="1s">
                                                                <?php echo $item; ?>
                                                            </p>
                                                            <?php
                                                            $count++;
                                                        else:
                                                            break;
                                                        endif;
                                                    endforeach;
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