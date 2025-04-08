<?php
// Get values
$index_flexible = $args['index_flexible'];
$block_info = $args['flexible']['block_info'] ?? [];
$tabs = $args['flexible']['block_content']['list'] ?? [];
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ' sectionSlider--noBlockInfo';

// Build UI
?>
<div class="blockTabs">
    <div class="<?php echo get_container_class(); ?>">
        <div class="blockTabs__inner sectionSlider wow fadeInUp <?php echo $class_style; ?>" data-wow-duration="1s">
            <!-- Block info -->
            <?php echo block_info($block_info); ?>
            <!-- Block Tabs -->
            <div class="stories__tabList programs__tabList">
                <div class="selecDropdown">
                    <ul class="nav nav-tabs stories__tabSlider" role="tablist" data-slide="3">
                        <?php
                        foreach ($tabs as $key => $item) :
                            $attr = 'class="nav-link ' . (($key == 0) ? 'active' : '') . '" data-toggle="tab" href="#tabs-' . $index_flexible . $key . '" role="tab"';
                        ?>
                            <li class="nav-item stories__tabItem programs__tabItem blockTabs__tabItem">
                                <a data-mh="blockTabs__tabItem" <?php echo $attr; ?>>
                                    <?php echo $item['title']; ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
            <div class="tab-content stories__tabContent programs__tabContent wow fadeInUp" data-wow-duration="1s">
                <?php
                foreach ($tabs as $key => $item) :
                    $attr = 'class="tab-pane ' . (($key == 0) ? 'active' : '') . '" id="tabs-' . $index_flexible . $key . '" role="tabpanel"';
                    $tab_content = $item['tab_content'];
                ?>
                    <div <?php echo $attr; ?>>
                        <div class="blockTabs__item">
                            <?php
                            $args['tab_content'] = $tab_content;
                            get_template_part('template-parts/tab-content-flexible', '', $args);
                            ?>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>