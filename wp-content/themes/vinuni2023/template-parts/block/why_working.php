<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? '';

// Build UI
?>
<div class="whyWorking">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($list): ?>
            <div class="row whyWorking__list">
                <?php
                foreach ($list as $item):
                    if ($item['image']):
                        ?>
                        <div class="col-md-6">
                            <div
                                class="whyWorking__item <?php echo ($item['link'] && $item['link']['url']) ? 'whyWorking--hover' : ''; ?>">
                                <div class="whyWorking__img"
                                    style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 48.44%, rgba(0, 0, 0, 0.80) 100%), url(<?php echo $item['image']; ?>) center/cover no-repeat, lightgray 50%;">
                                </div>
                                <div class="whyWorking__content">
                                    <?php
                                    if ($item['icon']): ?>
                                        <div class="whyWorking__icon wow fadeInUp" data-wow-duration="1s">
                                            <img width="50" height="50" class="w-100 h-100" src="<?php echo $item['icon']; ?>"
                                                alt="Icon">
                                        </div>
                                        <?php
                                    endif;
                                    if ($item['title']):
                                        ?>
                                        <h3 class="h5 whyWorking__title wow fadeInUp" data-wow-duration="1s">
                                            <?php if ($item['link'] && $item['link']['url']): ?>
                                                <a href="<?php echo $item['link']['url']; ?>"
                                                    target="<?php echo $item['link']['target']; ?>">
                                                    <?php echo $item['title']; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $item['title']; ?>
                                            <?php endif; ?>
                                        </h3>
                                        <?php
                                    endif; ?>
                                </div>

                                <?php if ($item['link'] && $item['link']['url']): ?>
                                    <a class="whyWorking__link" href="<?php echo $item['link']['url']; ?>"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>