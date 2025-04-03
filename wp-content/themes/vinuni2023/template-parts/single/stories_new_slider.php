<?php
$list = $args['list'];
$count_arr = count($list);
?>
<div class="stories__slider">
    <?php
    $index = 1;
    foreach ($list as $item):
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
    endforeach;
    ?>
</div>