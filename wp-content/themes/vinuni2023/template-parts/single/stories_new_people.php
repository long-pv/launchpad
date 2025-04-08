<?php
$people_id = $args['people_id'];
$quote = $args['quote'];
$index = $args['index'];
$attr = 'class="tab-pane ' . (($index == 1) ? 'active' : '') . '" id="tabs-' . $index . '" role="tabpanel"';
$target = '';
if (!is_main_site()) {
    $target = ' target="_blank" ';
}

$data = load_people_data([$people_id]);
$item = ($data && $data[$people_id]) ? $data[$people_id] : null;

if ($item && $item->image && $item->title):
    ?>
    <div <?php echo $attr; ?>>
        <div class="storiesItem">
            <div class="row">
                <div class="col-lg-6">
                    <div class="storiesItem__content">
                        <h3 class="storiesItem__title ">
                            <?php echo $item->title; ?>
                        </h3>

                        <?php
                        if ($item->position):
                            $position = $item->position;
                            $position = implode('<br> ', $position);
                            ?>
                            <div class="storiesItem__position ">
                                <?php echo $position; ?>
                            </div>
                            <?php
                        endif;
                        ?>

                        <?php if ($quote): ?>
                            <blockquote class="storiesItem__quote ">
                                <?php echo $quote; ?>
                            </blockquote>
                        <?php endif; ?>

                        <a <?php echo $target; ?> href="<?php echo $item->link; ?>"
                            class="btnSeeMore  testimonialItem__link">
                            <?php _e('See more', 'clvinuni'); ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-md-6 col-lg-12">
                            <div class="imgGroup imgGroup--noEffect storiesItem__img">
                                <img width="300" height="300" src="<?php echo $item->image; ?>"
                                    alt="<?php echo $item->title; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;