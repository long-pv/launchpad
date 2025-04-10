<?php
$data = $args['flexible'];

if (!empty($data['list'])):
    echo '<div class="block_btn_list">';
    foreach ($data['list'] as $item) :
        echo '<div class="block_btn_item">';
        $type = $item['display_type'];
        $link = $item['link'];
        $title = esc_html($link['title']);
        $url = esc_url($link['url']);
        $target = $link['target'] ? ' target="' . esc_attr($link['target']) . '"' : '';

        // Mapping style
        switch ($type) {
            case 'text_link':
                echo '<a href="' . $url . '" class="read_more"' . $target . '>' . $title . '</a>';
                break;
            case 'primary':
                echo '<a href="' . $url . '" class="button_1"' . $target . '>' . $title . '</a>';
                break;
            case 'secondary':
                echo '<a href="' . $url . '" class="button_1 button_1__active"' . $target . '>' . $title . '</a>';
                break;
        }
    echo '</div>';
    endforeach;
     echo '</div>';
endif;
