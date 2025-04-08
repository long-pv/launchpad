<?php
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? [];
$title = $args['flexible']['block_content']['title'] ?? '';
if(!$list && !$title) return;
?>
<div class="accreditation">
    <div class="container wow fadeInUp" data-wow-duration="1s">
        <?php if($title): ?>
        <h3 class="h6 accreditation__title"><?php echo $title ?></h3>
        <?php endif; 
        if($list):
        ?>
        <div class="accreditation__slide accreditation__list">
            <?php foreach ($list as $item) :
                $link = $item['link'];
                if ($item['image']) :
            ?>
                    <div class="accreditation__item">
                        <?php echo $link && $link['url'] ? '<a href="' . $link['url'] . '" target="' . $link['target'] . '">' : '' ?>
                            <img src="<?php echo $item['image']; ?>" class="accreditation__img" alt="<?php echo $item['title']; ?>">
                        <?php echo $link && $link['url'] ? '</a>' : '' ?>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>