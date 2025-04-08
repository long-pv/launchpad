<?php
// Get values
$index_flexible = $args['index_flexible'];
$block_info = $args['flexible']['block_info'] ?? [];
$display_type = $args['flexible']['block_content']['display_type'];
$program_group = $args['flexible']['block_content']['program_group'] ?? [];
$tabs = $args['flexible']['block_content']['tabs'];
$class_style = ($block_info['title'] || $block_info['description']) ? '' : ($display_type == 'list' ? '' : ' sectionSlider--noBlockInfo');
?>
<div class="programs">
    <div class="container">
        <div class="programs__inner sectionSlider <?php echo $class_style; ?>">
            <?php echo block_info($block_info); ?>
            <?php if ($display_type == 'list') :
                $args['program_group'] = $program_group;
                get_template_part('template-parts/single/program', '', $args);
            elseif ($display_type == 'tab' && $tabs) :
            ?>
                <div class="stories__tabList programs__tabList">
                    <div class="selecDropdown">
                        <ul class="nav nav-tabs stories__tabSlider" role="tablist" data-slide="4">
                            <?php
                            foreach ($tabs as $key => $item) :
                                $attr = 'class="nav-link ' . (($key == 0) ? 'active' : '') . '" data-toggle="tab" href="#tabsProgram-' . $index_flexible . $key . '" role="tab"';
                            ?>
                                <li class="nav-item stories__tabItem programs__tabItem">
                                    <a data-mh="stories__tabItem" <?php echo $attr; ?>>
                                        <?php echo $item['title']; ?>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content stories__tabContent programs__tabContent">
                    <?php
                    foreach ($tabs as $key => $item) :
                        $attr = 'class="tab-pane ' . (($key == 0) ? 'active' : '') . '" id="tabsProgram-' . $index_flexible . $key . '" role="tabpanel"';
                        $program_group = $item['program_group'] ?? [];
                    ?>
                        <div <?php echo $attr; ?>>
                            <div class="storiesItem">
                                <?php
                                $args['program_group'] = $program_group;
                                get_template_part('template-parts/single/program', '', $args);
                                ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>