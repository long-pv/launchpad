<?php
$index_flexible = $args['index_flexible'];
$block_info = $args['flexible']['block_info'] ?? [];
$featured_title = $args['flexible']['block_content']['featured_title'] ?? '';
$list = $args['flexible']['block_content']['list'] ?? '';
$choose_type = $args['flexible']['block_content']['choose_type'] ?? 'link';
$addClassBlockInfo = $choose_type == 'content' ? 'moreResources__hideDesc' : '';
?>

<div class="moreResources" id="moreResources<?php echo $index_flexible;?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="<?php echo $addClassBlockInfo; ?>">
                    <?php echo block_info($block_info); ?>
                </div>
                <?php
                if ($choose_type == 'content' && $list) :
                    foreach ($list as $key => $item) : ?>
                        <div class="editor resourcesItem__content <?php echo $key == 0 ? 'active' : '' ?> wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-resourcesitemkey="resourcesItem<?php echo $index_flexible; echo $key + 1 ?>">
                            <?php echo $item['content'] ?: ''; ?>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
            <div class="col-md-7 col-lg-6">
                <?php if ($featured_title || $list) : ?>
                    <div class="resources">
                        <?php if ($featured_title) : ?>
                            <h3 class="resources__title">
                                <span class="line-3">
                                    <?php echo $featured_title; ?>
                                </span>
                            </h3>
                        <?php endif; ?>
                        <div class="resources__inner">
                            <?php
                            if ($list) :
                                foreach ($list as $key => $item) :
                                    $title = $item['title'] ?? '';
                                    $icon = $item['icon'] ?? '';
                                    $link = $item['link'] ?? '';
                                    $addClass = $link || ($choose_type == 'content' && $item['content']) ? 'resourcesItem__hover' : '';
                                    $addClass .= $choose_type == 'content' ? ' resourcesItem__showContent' : '';
                                    if ($title || $icon) :
                            ?>
                                        <div class="resourcesItem <?php echo $addClass; ?> " <?php if($choose_type == 'content'): ?> data-resourcesitemkey="resourcesItem<?php echo $index_flexible; echo $key + 1 ?>" <?php endif; ?> data-moreresourcesid="moreResources<?php echo $index_flexible;?>">
                                            <?php if ($title) : ?>
                                                <h4 class="resourcesItem__title">
                                                    <span class="<?php echo $icon ? 'line-1' : 'line-2' ?>">
                                                        <?php echo $title; ?>
                                                    </span>
                                                </h4>
                                            <?php endif;
                                            if ($icon) :
                                            ?>
                                                <div class="resourcesItem__img">
                                                    <img src="<?php echo $icon; ?>" alt="<?php echo $title ?: $featured_title; ?>">
                                                </div>
                                            <?php endif;
                                            echo ($choose_type == 'link' && $link && $link['url']) ? '<a href="' . $link['url'] . '" target="' . $link['target'] . '"></a>' : '';
                                            ?>

                                        </div>
                            <?php endif;
                                endforeach;
                            endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>