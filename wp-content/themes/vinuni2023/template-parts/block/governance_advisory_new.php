<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$leaders = $args['flexible']['block_content']['leaders'] ?? '';
$page_current_id = get_the_ID();

$data = load_people_data($leaders);

// check attr target
$target = '';
if (!is_main_site()) {
    $target = ' target="_blank" ';
}
?>

<div class="container">
    <?php echo block_info($block_info); ?>

    <?php if ($data): ?>
        <div class="governanceAdvisory">
            <div class="governanceAdvisory__list">
                <div class="row governanceAdvisory__gutters">
                    <?php
                    foreach ($data as $item):
                        if ($item->title):
                            ?>
                            <div class="col-md-6">
                                <div class="governanceAdvisory__item" data-mh="governanceAdvisory__item">
                                    <h3 class="h5 governanceAdvisory__title wow fadeInUp">
                                        <a <?php echo $target; ?> href="<?php echo $item->link; ?>"
                                            class="governanceAdvisory__link">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </h3>

                                    <?php
                                    $position = $item->position;
                                    if ($position):
                                        $position = implode('<br> ', $position);
                                        ?>
                                        <p class="governanceAdvisory__position wow fadeInUp" data-wow-duration="1s">
                                            <?php echo $position; ?>
                                        </p>
                                        <?php
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