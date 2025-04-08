<?php
$list = $args['list'];
$count_arr = count($list);
?>
<div class="stories__tabList">
    <div class="selecDropdown">
        <ul class="nav nav-tabs stories__tabSlider" role="tablist"
            data-slide="<?php echo ($count_arr < 4) ? $count_arr : 4; ?>">
            <?php
            $index = 1;
            foreach ($list as $item):
                if ($item["title_tab"]):
                    $attr = 'class="nav-link ' . (($index == 1) ? 'active' : '') . '" data-toggle="tab" href="#tabs-' . $index . '" role="tab"';
                    ?>
                    <li class="nav-item stories__tabItem">
                        <a data-mh="stories__tabItem" <?php echo $attr; ?>>
                            <?php echo $item["title_tab"]; ?>
                        </a>
                    </li>
                    <?php
                    $index++;
                endif;
            endforeach;
            ?>
        </ul>
    </div>

    <div class="tab-content stories__tabContent">
        <?php
        $index = 1;
        foreach ($list as $item):
            if ($item["title_tab"]):
                if ($item['display_type'] == 'content' && $item['content']) {
                    $args['data'] = $item["content"];
                    $args['index'] = $index;
                    get_template_part('template-parts/single/stories_new_content', null, $args);
                } elseif ($item['display_type'] == 'post' && $item['article']) {
                    $args['data'] = $item["article"];
                    $args['index'] = $index;
                    get_template_part('template-parts/single/stories_new_article', null, $args);
                } elseif ($item['display_type'] == 'people' && $item['faculty_stories'] && $item["faculty_stories"]["people"]) {
                    $args['people_id'] = $item["faculty_stories"]["people"];
                    $args['index'] = $index;
                    $args['quote'] = $item["faculty_stories"]["quote"] ?? null;
                    get_template_part('template-parts/single/stories_new_people', null, $args);
                }
                $index++;
            endif;
        endforeach;
        ?>
    </div>
</div>