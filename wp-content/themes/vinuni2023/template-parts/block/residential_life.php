<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$gallery = $args['flexible']['block_content']['gallery'] ?? '';
$counter = 0;
?>

<div class="residentialLife">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($gallery): ?>
        <div class="residentialLife__list">
            <div class="row residentialLife__gutters">
                <?php
                foreach ($gallery as $key => $item):
                    $bg_class = ($counter % 6 < 3) ? 'residentialLife__bg--left' : 'residentialLife__bg--right';
                ?>
                <?php if ($counter % 3 === 0): ?>
                <div class="col-lg-6">
                    <div class="residentialLife__bg <?php echo $bg_class; ?>">
                <?php endif; ?>
                        <div class="residentialLife__item wow fadeInUp" data-wow-duration="1s">
                            <div class="imgGroup imgGroup--noEffect residentialLife__imgGroup">
                                <img width="300" height="300" src="<?php echo $item; ?>"
                                    alt="<?php echo get_the_title() . '-image-' . ($key + 1); ?>">
                            </div>
                        </div>
                <?php if (($counter + 1) % 3 === 0): ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php
                    $counter++;
                endforeach;
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
