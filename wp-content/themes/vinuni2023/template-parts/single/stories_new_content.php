<?php
$data_item = $args['data'];
$index = $args['index'];
$attr = 'class="tab-pane ' . (($index == 1) ? 'active' : '') . '" id="tabs-' . $index . '" role="tabpanel"';
?>
<div <?php echo $attr; ?>>
    <div class="storiesItem">
        <div class="row">
            <div class="col-lg-6">
                <div class="storiesItem__content">
                    <h3 class="storiesItem__title ">
                        <?php echo $data_item['title']; ?>
                    </h3>

                    <?php if ($data_item['position']): ?>
                        <div class="storiesItem__position ">
                            <?php echo $data_item['position']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($data_item['quote']): ?>
                        <blockquote class="storiesItem__quote ">
                            <?php echo $data_item['quote']; ?>
                        </blockquote>
                    <?php endif; ?>

                    <?php
                    if ($data_item['link'] && $data_item['link']['url']):
                        ?>
                        <a target="<?php echo $data_item['link']['target']; ?>"
                            href="<?php echo $data_item['link']['url']; ?>" class="btnSeeMore  testimonialItem__link">
                            <?php
                            if ($data_item['link']['title']) {
                                echo $data_item['link']['title'];
                            } else {
                                _e('See more', 'clvinuni');
                            }
                            ?>
                        </a>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <?php
                if ($data_item && $data_item['media_type'] == 'iframe' && $data_item['iframe_youtube']):
                    $attr = 'src="' . $data_item['iframe_youtube'] . '?controls=0&autoplay=0&mute=1&playsinline=1&loop=1"';
                    ?>
                    <div class="storiesItem__video">
                        <iframe <?php echo $attr; ?>></iframe>
                    </div>
                    <?php
                endif;
                ?>
                <?php
                if ($data_item && $data_item['media_type'] == 'image' && $data_item['image']):
                    ?>
                    <div class="row no-gutters justify-content-center">
                        <div class="col-md-6 col-lg-12">
                            <div class="imgGroup imgGroup--noEffect storiesItem__img">
                                <img width="300" height="300" src="<?php echo $data_item['image']; ?>"
                                    alt="<?php $data_item['title']; ?>">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>