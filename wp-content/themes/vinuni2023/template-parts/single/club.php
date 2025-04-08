<?php
$youtube = get_field('sns_icon_youtube') ?? '';
$facebook = get_field('sns_icon_facebook') ?? '';
$mail = get_field('sns_icon_mail') ?? '';
?>

<div class="clubs__item">
    <div class="imgGroup imgGroup--noEffect clubs__img">
        <a href="<?php echo get_permalink(); ?>" target="_blank">
            <img src="<?php echo get_the_post_thumbnail_url() ?: get_template_directory_uri() . '/assets/images/logo_no_image.png'; ?>" alt="<?php the_title(); ?>">
        </a>
    </div>
    <div class="clubs__content">
        <h4 class="h5 clubs__title">
            <a href="<?php echo get_permalink(); ?>" target="_blank">
                <span class="line-2">
                    <?php the_title(); ?>
                </span>
            </a>
        </h4>
        <p class="clubs__desc"><span class="line-5"><?php echo get_field('description'); ?></span></p>
    </div>
    <div class="clubs__sns">
        <?php if ($youtube) : ?>
            <a class="clubs__sns--youtube" href="<?php echo $youtube ?>" target="_blank"></a>
        <?php endif;
        if ($facebook) : ?>
            <a class="clubs__sns--facebook" href="<?php echo $facebook ?>" target="_blank"></a>
        <?php endif;
        if ($mail) :
        ?>
            <a class="clubs__sns--mail" href="mailto:<?php echo $mail ?>"></a>
        <?php endif; ?>
    </div>
</div>