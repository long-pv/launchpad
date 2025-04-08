<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$stats = $args['flexible']['block_content']['list'] ?? '';
$display_type = $args['flexible']['block_content']['display_type'] ?? '';
$background = $args['flexible']['block_content']['background'] ?? '';
$stats_class = ($display_type !== 'center') ? ' stats--modify ' : '';
$stats_class .= ($background == "yes") ? 'space section--bg stats--bg' : '';
$class_row = ($display_type == 'center') ? 'justify-content-center' : '';
?>
<div class="stats <?php echo $stats_class; ?>">
    <div class="container">
        <?php
        echo $display_type !== 'center' ? '<div class="row"><div class="col-lg-3">' . block_info($block_info) . '</div><div class="col-lg-9">' : block_info($block_info);

        if ($stats):
            $count = custom_count_array($stats, ['title']);
            $colClass = $count == 1 ? 'col-lg-12' : ($count == 2 ? 'col-lg-6' : ($count == 3 ? 'col-lg-4' : ($count == 4 ? 'col-lg-3' : '')));
            ?>
            <div class="row stats__gutters <?php echo $class_row; ?>">
                <?php
                foreach ($stats as $stat):
                    $stat['title'] = $stat['title'];
                    if ($stat['title']):
                ?>
                    <div class="<?php echo $colClass; ?> stats__col">
                        <div class="stats__content h-100">
                            <div class="h2 stats__number wow fadeInUp" data-wow-duration="1s">
                                <span class="counter">
                                    <?php echo custom_title($stat['title']); ?>
                                </span>

                                <?php if ($stat['suffix']): ?>
                                    <span class="stats__suffix">
                                        <?php echo custom_title($stat['suffix']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($stat['description']): ?>
                                <p class="stats__desc wow fadeInUp" data-wow-duration="1s">
                                    <?php echo $stat['description']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        <?php
        endif;
        echo ($display_type !== 'center') ? '</div>' : '';
        ?>
    </div>
</div>