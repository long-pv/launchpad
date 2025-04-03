<?php
function get_position_people_single($post_id)
{
    ob_start();

    $position_list = get_field('position_list', $post_id) ?? null;
    $position_arr = [];

    if ($position_list) {
        foreach ($position_list as $position) {
            $p_dept_text = [];

            if ($position['name'] && $position['name']->name) {
                $p_dept_text['child'][] = $position['name']->name;
            }

            $p_dept = $position['dept_program'];

            if ($p_dept) {
                if ($p_dept->parent) {
                    $p_dept_text['child'][] = $p_dept->name;
                    $p_dept_parent = get_term($p_dept->parent);
                    $p_dept_text['parent'] = $p_dept_parent->name;
                } else {
                    $p_dept_text['parent'] = $p_dept->name;
                }
            }

            if ($p_dept_text['child'] && $p_dept_text['parent']) {
                $position_arr[] = $p_dept_text;
            }
        }
    }

    $result = [];

    foreach ($position_arr as $item) {
        $parent = $item['parent'];
        $child = implode(', ', $item['child']);

        if (!isset($result[$parent])) {
            $result[$parent] = [];
        }

        $result[$parent][] = $child;
    }

    if ($result):
        ?>
        <div class="leaderDetail__posList">
            <?php
            foreach ($result as $parent => $pos_item):
                ?>
                <div class="leaderDetail__posItem">
                    <h3 class="leaderDetail__posParent">
                        <?php echo $parent; ?>
                    </h3>
                    <?php
                    foreach ($pos_item as $dept_item):
                        ?>
                        <h4 class="leaderDetail__posChild">
                            <?php echo $dept_item; ?>
                        </h4>
                        <?php
                    endforeach;
                    ?>
                </div>

                <?php
            endforeach;
            ?>
        </div>
        <?php
    endif;

    return ob_get_clean();
}