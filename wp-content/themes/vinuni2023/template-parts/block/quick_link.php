<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$link_list = $args['flexible']['block_content']['list'] ?? '';
?>
<div class="quickLink">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <?php echo block_info($block_info); ?>
            </div>

            <?php if ($link_list): ?>
                <div class="col-lg-5">
                    <ul class="quickLink__content">
                        <?php
                        foreach ($link_list as $item):
                            if ($item['link'] && $item['link']['title'] && $item['link']['url']):
                                ?>
                                <li class="wow fadeInUp" data-wow-duration="1s">
                                    <a class="quickLink__link" href="<?php echo $item['link']['url']; ?>"
                                        target="<?php echo $item['link']['target']; ?>">
                                        <span class="text">
                                            <?php echo $item['link']['title']; ?>
                                        </span>
                                        <span class="arrow"></span>
                                    </a>
                                </li>
                                <?php
                            endif;
                        endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>