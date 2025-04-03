<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$sub_title = $args['flexible']['block_content']['subtitle'] ?? '';
$leaders = $args['flexible']['block_content']['leaders'] ?? [];
$display_excerpt = $args['flexible']['block_content']['display_excerpt'] ?? 'no';
$leaders_list = $args['flexible']['block_content']['leaders_list'] ?? [];
$data = [];
$arr_leader = [];

if ($display_excerpt == 'yes') {
    if ($leaders_list) {

        $list = array_map(function ($item) {
            return $item["people"];
        }, $leaders_list);

        foreach ($leaders_list as $item) {
            $arr_leader[$item["people"]] = $item["excerpts"];
        }

        $data = load_people_data($list);
    }
} else {
    $data = load_people_data($leaders);
}

// check attr target
$target = '';
if (!is_main_site()) {
    $target = ' target="_blank" ';
}
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

        <?php if ($data): ?>
            <div class="governanceLeader__list">
                <?php
                $counter = 1;
                foreach ($data as $people_id => $item):
                    if ($item->title && $item->image):
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
                                            <a <?php echo $target; ?> href="<?php echo $item->link; ?>"
                                                class="governanceLeader__link">
                                                <?php echo $item->title; ?>
                                            </a>
                                        </h3>

                                        <?php
                                        $position = $item->position;
                                        if ($position):
                                            $position = implode('<br> ', $position);
                                            ?>
                                            <div class="governanceLeader__position wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $position; ?>
                                            </div>
                                            <?php
                                        endif;
                                        ?>

                                        <?php
                                        if ($display_excerpt == 'yes') {
                                            $excerpts = $arr_leader[$people_id] ?? '';
                                        } else {
                                            $excerpts = $item->excerpts ?? '';
                                        }

                                        if ($excerpts):
                                            ?>
                                            <p class="governanceLeader__quote wow fadeInUp" data-wow-duration="1s">
                                                <?php echo $excerpts; ?>
                                            </p>
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="<?php echo $class_col_img; ?> <?php echo $order_class_img; ?>">
                                    <a <?php echo $target; ?> class="imgGroup imgGroup--noEffect governanceLeader__img"
                                        href="<?php echo $item->link; ?>">
                                        <img width="500" height="500" src="<?php echo $item->image; ?>"
                                            alt="<?php echo $item->title; ?>">
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
        .sectionGovernanceLeaderNew {
            padding: 0px !important;
            background: #fff !important;
        }
    </style>
<?php endif; ?>