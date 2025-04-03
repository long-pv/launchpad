<?php
// Get values
$index_flexible = $args['index_flexible'];
$block_info = $args['flexible']['block_info'] ?? [];
$display_type = $args['flexible']['block_content']['display_type'] ?: 'list';
$faqs = $args['flexible']['block_content']['faqs'] ?? '';
$tabs = $args['flexible']['block_content']['tabs'] ?? '';
$class_style = ($block_info['title'] || $block_info['description']) ? 'sectionSlider' : ($display_type == 'list' ? '' : 'sectionSlider sectionSlider--noBlockInfo');
?>
<div class="faqs">
    <div class="<?php echo get_container_class(); ?>">
        <div class="faqs__inner <?php echo !is_page_template(array('page-article.php')) ? $class_style : ''; ?>">
            <?php
            echo block_info($block_info);
            if ($display_type == 'list') :
                $args['faqs'] = $faqs;
                get_template_part('template-parts/single/faqs', '', $args);
            elseif ($display_type == 'tab' && $tabs) :
            ?>
                <div class="stories__tabList programs__tabList">
                    <div class="selecDropdown">
                        <ul class="nav nav-tabs stories__tabSlider" role="tablist" data-slide="4">
                            <?php
                            foreach ($tabs as $key => $item) :
                                $attr = 'class="nav-link ' . (($key == 0) ? 'active' : '') . '" data-toggle="tab" href="#tabsFaq-' . $index_flexible . $key . '" role="tab"';
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
                        $attr = 'class="tab-pane ' . (($key == 0) ? 'active' : '') . '" id="tabsFaq-' . $index_flexible . $key . '" role="tabpanel"';
                        $faqs_tabs = $item['faqs'] ?? [];
                    ?>
                        <div <?php echo $attr; ?>>
                            <div class="storiesItem faqsItem">
                                <?php
                                $args['faqs'] = $faqs_tabs;
                                get_template_part('template-parts/single/faqs', '', $args);
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