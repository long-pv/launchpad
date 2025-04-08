<?php
$block_info = $args['flexible']['block_info'] ?? [];
$factFigure = $args['flexible']['block_content']['fact_figure'] ?? [];
$image = $args['flexible']['block_content']['image'] ?? '';
$colClass = $image ? 'col-lg-6' : 'col-md-6 col-lg-4';
$linkImage = $args['flexible']['block_content']['link'] ?? '';
?>
<div class="factFigure">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <div class="factFigure__list">
            <div class="row">
                <?php if ($image) : ?>
                    <div class="col-md-8">
                        <div class="row no-gutters">
                            <?php endif;
                        if ($factFigure) :
                            foreach ($factFigure as $item) : ?>
                                <div class="<?php echo $colClass; ?>">
                                    <div class="factFigure__item wow fadeInUp" data-wow-duration="1s">
                                        <?php if ($item['icon']) : ?>
                                            <div class="factFigure__icon">
                                                <img src="<?php echo $item['icon'] ?>" alt="<?php echo $item['title'] ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="factFigure__content editor">
                                            <?php echo $item['title'] ? '<h3 class="factFigure__title">'.$item['title'].'</h3>' : '';  ?>
                                            <?php echo $item['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif;
                        if ($image) : ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php echo custom_img_link($linkImage, $image, 'factFigure__image', $block_info['title']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>