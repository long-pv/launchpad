<?php
// get values
$block_info = $args['flexible']['block_info'] ?? [];
$list = $args['flexible']['block_content']['list'] ?? [];
?>
<div class="contact">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <div class="row no-gutters">
            <?php foreach ($list as $key => $item) :
                $icon = $item['icon'] ?? '';
                $title = $item['title'] ?? '';
                $email = $item['email'] ?? '';
                $classContact = $key % 2 > 0 ? 'contactItem__secondary' : '';
                if ($icon || $title || $email) :
            ?>
                    <div class="col-md-6">
                        <div class="contactItem <?php echo $classContact; ?>">
                            <?php if ($icon) : ?>
                                <img src="<?php echo $icon; ?>" class="contactItem__img wow fadeInUp" alt="<?php echo $title; ?>" data-wow-duration="1s">
                            <?php endif; ?>
                            <?php if ($title) : ?>
                                <h2 class="h5 contactItem__title wow fadeInUp" data-wow-duration="1s"><?php echo $title; ?></h2>
                            <?php endif; ?>
                            <?php if ($email) :  ?>
                                <a href="mailto:<?php echo $email; ?>" class="contactItem__link wow fadeInUp" data-wow-duration="1s"><?php echo $email; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>
</div>