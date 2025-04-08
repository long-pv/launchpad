<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$list_year = $args['flexible']['block_content']['list'] ?? '';
?>

<div class="milestones">
    <div class="container">
        <?php echo block_info($block_info); ?>

        <?php if ($list_year): ?>
            <div class="milestones__inner">
                <div class="row no-gutters justify-content-center">
                    <div class="col-10">
                        <div class="milestones__slider">
                            <?php
                            $count = 1;
                            $htmlItemFirst = '';
                            $countitemFirst = 0;
                            foreach ($list_year as $year):
                                $renderHtml = '';
                                if ($year['title'] && $year['items']):
                                    $class_active = ($count == 1) ? 'milestones__itemInner--active' : '';
                                    ?>
                                    <div class="milestones__item">
                                        <div class="milestones__itemInner <?php echo $class_active; ?>">
                                            <div class="milestones__year">
                                                <?php echo $year['title']; ?>
                                            </div>
                                        </div>

                                        <?php
                                        $countItem = 1;
                                        $classitemContent = '';
                                        foreach ($year['items'] as $item) {
                                            if ($item['title'] && $item['content']) {
                                                $renderHtml .= '<div data-index=' . $countItem . ' class="milestones__eventItem">';
                                                $renderHtml .= '<div class="milestones__eventInner">';
                                                $renderHtml .= '<h3 class="h6 milestones__eventTitle wow fadeInUp" data-wow-duration="1s">';
                                                $renderHtml .= $item['title'];
                                                $renderHtml .= '</h3>';
                                                $renderHtml .= '<div class="milestones__eventContent wow fadeInUp" data-wow-duration="1s">';
                                                $renderHtml .= $item['content'];
                                                $renderHtml .= '</div>';
                                                $renderHtml .= '</div>';
                                                $renderHtml .= '</div>';
                                                $countItem++;
                                            }
                                        }
                                        if ($count == 1) {
                                            $htmlItemFirst = $renderHtml;
                                            $classitemContent = 'milestones__itemContent--first';
                                            $countitemFirst = $countItem;
                                        }
                                        ?>

                                        <div class="milestones__itemContent <?php echo $classitemContent; ?>"
                                            data-items="<?php echo $countItem; ?>">
                                            <?php echo $renderHtml; ?>
                                        </div>
                                    </div>
                                    <?php

                                    $count++;
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="milestones__eventWrap <?php echo $countitemFirst > 3 ? '' : 'milestones__eventWrap--smallItem'; ?>">
                <div class="milestones__event">
                    <?php echo $htmlItemFirst; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>